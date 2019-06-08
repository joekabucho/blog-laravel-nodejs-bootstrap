@extends('admin.layouts.app')
@section('title','Posts')
@section('content')
    @section('action')
        <a data-toggle="tooltip" data-placement="left" title="Download all posts as markdown file" class="btn btn-sm btn-outline-dark" href="{{ route('post.download-all') }}">Download</a>
    @endsection
    <table class="table table-striped">
        <thead>
        <tr>
            <th>title</th>
            <th>status</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <?php
            $class = 'badge-secondary';
            $status = 'unpublished';
            if ($post->trashed()) {
                $class = 'badge-danger';
                $status = 'deleted';
            } else if ($post->isPublished()) {
                $class = 'badge-success';
                $status = 'published';
            }
            ?>
            <tr>
                <td title="{{ $post->title }}">{{ str_limit($post->title,64) }}</td>
                <td><span class="p-2 p badge {{ $class }}">{{ $status }}</span></td>
                <td>
                    <div>
                        <a {{ $post->trashed()?'disabled':'' }} href="{{ $post->trashed()?'javascript:void(0)':route('post.edit',$post->id) }}"
                           data-toggle="tooltip" data-placement="top" title="edit"
                           class="btn btn-info">
                            <i class="fa fa-pencil fa-fw"></i>
                        </a>
                        @if($post->trashed())
                            <form style="display: inline" method="post" action="{{ route('post.restore',$post->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="restore">
                                    <i class="fa fa-repeat fa-fw"></i>
                                </button>
                            </form>

                        @elseif($post->isPublished())
                            <a href="{{ route('post.show',$post->slug) }}"
                               data-toggle="tooltip" data-placement="top" title="view"
                               class="btn btn-success">
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <form style="display: inline" method="post"
                                  action="{{ route('post.publish',$post->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip"
                                        data-placement="top" title="Revoked release">
                                    <i class="fa fa-undo fa-fw"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('post.preview',$post->slug) }}" data-toggle="tooltip"
                               data-placement="top" title="preview"
                               class="btn btn-success">
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <form style="display: inline" method="post"
                                  action="{{ route('post.publish',$post->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="release">
                                    <i class="fa fa-send-o fa-fw"></i>
                                </button>
                            </form>
                        @endif
                        <button class="btn btn-danger swal-dialog-target"
                                data-toggle="tooltip"
                                data-title="{{ $post->title }}"
                                data-dialog-msg="Are you sure you want to delete this article<label>{{ $post->title }}</label>？"
                                data-dialog-msg="Are you sure you want to delete this article<label>{{ $post->title }}</label>？"
                                data-dialog-msg="Are you sure you want to delete this article<label>{{ $post->title }}</label>？"
                                data-dialog-msg="Are you sure you want to delete this article<label>{{ $post->title }}</label>？"
                                title="delete"
                                data-dialog-enable-html="1"
                                data-url="{{ route('post.destroy',$post->id) }}"
                                data-dialog-confirm-text="{{ $post->trashed()?'
Delete (this will be permanently deleted) ':' delete' }}">
                            <i class="fa fa-trash-o  fa-fw"></i>
                        </button>
                        <a class="btn btn-dark"  data-toggle="tooltip" title="Download as markdown file" href="{{ route('post.download',$post->id) }}">
                            <i class="fa fa-cloud-download fa-fw"></i>
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               comment
                                <span class="caret"></span>
                            </button>
                            <?php $commentable = $post?>
                            <ul class="dropdown-menu">
                                @if($commentable->allowComment())
                                    <a href="#" data-url="{{ route('post.config',$post->id) }}?allow_resource_comment=false"
                                       data-method="post"
                                       data-dialog-title="Prohibit comments"
                                       class="dropdown-item swal-dialog-target">
                                       Prohibi comments
                                    </a>
                                @else
                                    <a href="#" data-url="{{ route('post.config',$post->id) }}?allow_resource_comment=true"
                                       data-method="post"
                                       data-dialog-title=" allow comments"
                                       data-dialog-type="success"
                                       class="dropdown-item swal-dialog-target">
                                       Allow comments
                                    </a>
                                @endif
                                @if($commentable->isShownComment())
                                    <a href="#" data-url="{{ route('post.config',$post->id) }}?comment_info=force_disable"
                                       data-method="post"
                                       data-dialog-title="Don't show comments"
                                       class="dropdown-item swal-dialog-target">
                                       Don't show comments
                                    </a>
                                @else
                                    <a href="#" data-url="{{ route('post.config',$post->id) }}?comment_info=force_enable"
                                       data-method="post"
                                       data-dialog-title="Show comment"
                                       data-dialog-type="success"
                                       class="dropdown-item swal-dialog-target">
                                       Show comment
                                    </a>
                                @endif
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection

