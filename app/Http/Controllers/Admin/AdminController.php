<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\ImageRepository;
use App\Http\Repositories\MapRepository;
use App\Http\Repositories\PageRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Repositories\TagRepository;
use App\Http\Repositories\UserRepository;
use App\Ip;
use App\Page;
use App\Post;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $postRepository;
    protected $commentRepository;
    protected $userRepository;
    protected $tagRepository;
    protected $categoryRepository;
    protected $pageRepository;
    protected $imageRepository;
    protected $mapRepository;

    /**
     * AdminController constructor.
     * @param PostRepository $postRepository
     * @param CommentRepository $commentRepository
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     * @param PageRepository $pageRepository
     * @param ImageRepository $imageRepository
     * @param MapRepository $mapRepository
     * @internal param MapRepository $mapRepository
     */
    public function __construct(PostRepository $postRepository,
                                CommentRepository $commentRepository,
                                UserRepository $userRepository,
                                CategoryRepository $categoryRepository,
                                TagRepository $tagRepository,
                                PageRepository $pageRepository,
                                ImageRepository $imageRepository,
                                MapRepository $mapRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->pageRepository = $pageRepository;
        $this->imageRepository = $imageRepository;
        $this->mapRepository = $mapRepository;
    }

    public function index()
    {
        $info = [];
        $info['post_count'] = $this->postRepository->count();
        $info['comment_count'] = Comment::withoutGlobalScopes()->count();
        $info['user_count'] = $this->userRepository->count();
        $info['category_count'] = $this->categoryRepository->count();
        $info['tag_count'] = $this->tagRepository->count();
        $info['page_count'] = $this->pageRepository->count();
        $info['image_count'] = $this->imageRepository->count();
        $info['ip_count'] = Ip::count();
        $postDetail = Post::select([
            DB::raw("YEAR(created_at) as year"),
            DB::raw("MONTH(created_at) as month"),
            DB::raw('COUNT(id) AS count'),
        ])->whereBetween('created_at', [Carbon::now()->subYear(1), Carbon::now()])
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->toArray();
        $labels = [];
        $data = [];
        foreach ($postDetail as $detail) {
            array_push($labels, $detail['year'] . '-' . $detail['month']);
            array_push($data, $detail['count']);
        }
        $response = view('admin.index', compact('info', 'labels', 'data'));
        if (($failed_jobs_count = DB::table('failed_jobs')->count()) > 0) {
            $failed_jobs_link = route('admin.failed-jobs');
            $response->withErrors(['failed_jobs' => "You have $failed_jobs_count failed jobs.<a href='$failed_jobs_link'>View</a>"]);
        }
        return $response;
    }

    public function settings()
    {
        $variables = config('configurable_variables');
        $groups = $variables['groups'];
        return view('admin.settings', compact('variables', 'groups'));
    }

    public function saveSettings(Request $request)
    {
        $inputs = $request->except('_token');
        $this->mapRepository->saveSettings($inputs);
        return back()->with('success', 'Successfully saved');
    }

    public function posts()
    {
        $posts = $this->postRepository->pagedPostsWithoutGlobalScopes();
        return view('admin.posts', compact('posts'));
    }

    public function comments(Request $request)
    {
        $comments = Comment::withoutGlobalScopes()->where($request->except(['page']))->orderBy('created_at', 'desc')->paginate(20);
        $comments->appends($request->except('page'));
        $unverified_ids = Comment::withoutGlobalScopes()->where('status', 0)->select('id')->get();
        $unverified_count = count($unverified_ids);
        $unverified_ids = $unverified_ids->implode('id', ',');
        return view('admin.comments', compact('comments', 'unverified_ids', 'unverified_count'));
    }

    public function tags()
    {
        $tags = $this->tagRepository->getAll();
        return view('admin.tags', compact('tags'));
    }

    public function categories()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.categories', compact('categories'));
    }

    public function users(Request $request)
    {
        $users = User::where($request->except(['page']))->paginate(20);
        $users->appends($request->except('page'));
        return view('admin.users', compact('users'));
    }

    public function pages()
    {
        $pages = Page::paginate(20);
        return view('admin.pages', compact('pages'));
    }

    public function ips(Request $request)
    {
        $ips = Ip::withoutGlobalScopes()->where($request->except(['page']))->withCount(
            ['comments' => function ($query) {
                $query->withTrashed();
            }]
        )->with(['user'])->orderBy('user_id', 'id')->paginate(20);
        $ips->appends($request->except('page'));
        return view('admin.ips', compact('ips'));
    }

    public function flushFailedJobs()
    {
        $result = DB::table('failed_jobs')->delete();
        if ($result) {
            return back()->with('success', "Flush $result failed jobs");
        }
        return back()->withErrors("Flush failed jobs failed");
    }

}
