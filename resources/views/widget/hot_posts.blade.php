<div class="order-md-2 mb-4">
    <h5 class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted">popular articles</span>
        <span class="badge badge-secondary badge-pill">{{ count($hotPosts) }}</span>
    </h5>
    <div class="hot-posts">
        <ul class="list-group shadow">
            @foreach($hotPosts as $post)
                <a class=" border-0 list-group-item list-group-item-action" title="{{ $post->title }}" href="{{ route('post.show',$post->slug) }}">
                    <h6 class="my-0">{{ $post->title }}</h6>
                    <small class="text-muted">Reading volume: {{ $post->view_count }}, comment: {{ $post->comments_count }}</small>
                </a>
            @endforeach
        </ul>
    </div>
</div>