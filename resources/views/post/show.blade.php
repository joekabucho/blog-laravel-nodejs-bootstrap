@extends('layouts.app')
@section('description',trim(strip_tags($post->description)))
@section('keywords',$post->tags->implode('name', ',').',')
@section('title',$post->title)
@section('content')
    <div class="container">
        <?php
        $meta = $post->meta;
        $toc = isset($meta['toc']) ? $meta['toc'] : false;
        $toc_enabled = $post->toc_enabled() && $toc;
        ?>
        <div class="row justify-content-center {{ $toc_enabled?'with-toc':'' }}">
            @if($toc_enabled)
                <div class="col-md-3 col-sm-12 mb-3 phone-no-padding">
                    <aside class="sticky-top">
                        <nav class="toc">
                            <div class="card">
                                <h5 class="card-header">
                                table of Contents
                                </h5>
                                <div class="card-body">
                                    {!! $toc !!}
                                </div>
                            </div>
                        </nav>
                    </aside>
                </div>
            @endif
            <div class="{{ $toc_enabled?'col-md-8':'col-md-10' }} col-sm-12 phone-no-padding">
                <div class="post-detail shadow" id="main-content">
                    @if(!$post->cover_img)
                        <div class="post-detail-title">
                            {{ $post->title }}
                        </div>
                    @endif
                    @can('update',$post)
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-outline-secondary" href="{{ route('post.edit',$post->id) }}">edit</a>
                            <a class="btn btn-outline-secondary swal-dialog-target" data-url="{{ route('post.destroy',$post->id) }}" data-dialog-msg="Delete {{ $post->title }} ?">delete</a>
                        </div>
                    @endcan
                    <div class="post-detail-content">
                        {!! $post->html_content !!}
                        <p><a href="#main-content">⬆️</a></p>
                    </div>
                    @include('widget.pay')
                    <div class="post-info-panel">
                        <p class="info">
                            <label class="info-title">Copyright Notice:</label><i class="fa fa-fw fa-creative-commons"></i>
                            Free reprint - non-commercial - non-derivative - keep signature（<a
                                    href="https://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh">Creative Sharing 3.0 License</a>）
                        </p>
                        <p class="info">
                            <label class="info-title">creation date:</label>{{ $post->created_at->format('Y m d ') }}
                        </p>
                        @if(isset($post->published_at) && $post->published_at)
                            <p class="info">
                                <label class="info-title">Modified date:</label>{{ $post->published_at->format('Y m d ') }}
                            </p>
                        @endif
                        <p class="info">
                            <label class="info-title">Article classification:</label>
                            <a href="{{ route('category.show',$post->category->name) }}">{{ $post->category->name }}</a>
                        </p>
                        <p class="info">
                            <label class="info-title">Article label:</label>
                            @foreach($post->tags as $tag)
                                <a class="tag" href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                        <p class="info">
                            <label class="info-title">Number of comments:</label>
                            <span>{{ $post->comments_count }}</span>
                        </p>
                        <p class="info">
                            <label class="info-title">number of times read:</label>
                            <span>{{ $post->view_count }}</span>
                        </p>
                    </div>
                </div>
                @if(isset($recommendedPosts))
                    @include('widget.recommended_posts',['recommendedPosts'=>$recommendedPosts])
                @endif
                @if(!(isset($preview) && $preview) && $post->isShownComment())
                    @include('widget.comment',[
                            'comment_key'=>$post->slug,
                            'comment_title'=>$post->title,
                            'comment_url'=>route('post.show',$post->slug),
                            'commentable'=>$post,
                            'comments'=>isset($comments) ? $comments:[],
                            'redirect'=>request()->fullUrl(),
                             'commentable_type'=>'App\Post'])
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('widget.mathjax')
@endsection