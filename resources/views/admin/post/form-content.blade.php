<div class="form-group">
    <label for="cover_img" class="form-control-label">cover image</label>
    <input id="cover_img" type="text" class="form-control{{ $errors->has('cover_img') ? ' is-invalid' : '' }}" name="cover_img"
           value="{{ isset($post) ? $post->cover_img : old('cover_img') }}">
    @if ($errors->has('cover_img'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('cover_img') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="title" class="form-control-label">article title*</label>
    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
           value="{{ isset($post) ? $post->title : old('title') }}"
           autofocus>
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="description" class="form-control-label">article description</label>

    <textarea id="post-description-textarea" style="resize: vertical;" rows="3" spellcheck="false"
              id="description" class="form-control autosize-target{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Support Markdown format"
              name="description">{{ isset($post) ? $post->description : old('description') }}</textarea>

    @if ($errors->has('description'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('description') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="slug" class="form-control-label">article slug*</label>
    <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
           value="{{ isset($post) ? $post->slug : old('slug') }}">

    @if ($errors->has('slug'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('slug') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="categories" class="form-control-label">article classification*</label>
    <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
        @foreach($categories as $category)
            @if((isset($post) ? $post->category_id : old('category_id',-1)) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('category_id'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('category_id') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="tags[]" class="form-control-label">article label</label>
    <select style="max-width: 99%" id="post-tags" name="tags[]" class="form-control{{ $errors->has('tags[]') ? ' is-invalid' : '' }}" multiple>
        @foreach($tags as $tag)
            @if(isset($post) && $post->tags->contains($tag))
                <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
            @else
                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('tags[]'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('tags[]') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="post-content-textarea" class="form-control-label">article content*</label>
    <textarea data-save-id="{{ isset($post)?'post.edit.'.$post->id.'.by@' . request()->ip():'post.create' }}" id="simplemde-textarea"
              class="form-control{{ $errors->has('content') ? ' is-invalid ' : ' ' }}"
              name="content"
              spellcheck="false"
              rows="36"
              placeholder="Please write in Markdown format"
              style="resize: vertical">{{ isset($post) ? $post->content : old('content') }}</textarea>
    @if($errors->has('content'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('content') }}</strong>
        </div>
    @endif
</div>
<div class="mb-3" style="font-size: 80%">
    <a class="text-secondary font-italic" data-toggle="collapse" href="#post-extra-info" role="button" aria-expanded="false">
        <span title="评论信息" data-toggle="tooltip">nobility	&raquo;</span>
    </a>
</div>
<div class="collapse" id="post-extra-info">
    <div class="form-group">
        <label for="comment_info" class="form-control-label">Other Information</label>
        <select style="margin-top: 5px" id="comment_info" name="comment_info" class="form-control">
            <?php $comment_info = isset($post) ? $post->getConfig('comment_info', 'default') : 'default'?>
            <option value="default" {{ $comment_info=='default'?' selected' : '' }}>moth</option>
            <option value="force_disable" {{ $comment_info=='force_disable'?' selected' : '' }}>Control theory</option>
            <option value="force_enable" {{ $comment_info=='force_enable'?' selected' : '' }}>Control theory</option>
        </select>
    </div>
    <div class="form-group">
        <label for="comment_type" class="form-control-label">Discussion theory</label>
        <select id="comment_type" name="comment_type" class="form-control">
            <?php $comment_type = isset($post) ? $post->getConfig('comment_type', 'default') : 'default'?>
            <option value="default" {{ $comment_type=='default'?' selected' : '' }}>moth</option>
            <option value="raw" {{ $comment_type=='raw'?' selected' : '' }}>autonomy</option>
            <option value="disqus" {{ $comment_type=='disqus'?' selected' : '' }}>Disqus</option>
        </select>
    </div>

    <div class="form-group">
        <label for="allow_resource_comment" class="form-control-label">remorse</label>
        <select id="allow_resource_comment" name="allow_resource_comment" class="form-control">
            <?php $allow_resource_comment = isset($post) ? $post->getConfig('allow_resource_comment', 'default') : 'default'?>
            <option value="default" {{ $allow_resource_comment=='default'?' selected' : '' }}>moth</option>
            <option value="false" {{ $allow_resource_comment=='false'?' selected' : '' }}>banned argument</option>
            <option value="true" {{ $allow_resource_comment=='true'?' selected' : '' }}>controversy</option>
        </select>
    </div>

    <div class="form-group">
        <label for="enable_toc" class="form-control-label">indication TOC</label>
        <select id="enable_toc" name="enable_toc" class="form-control">
            <?php $enable_toc = isset($post) ? $post->getConfig('enable_toc', 'true') : 'true'?>
            <option value="false" {{ $enable_toc=='false'?' selected' : '' }}>related</option>
            <option value="true" {{ $enable_toc=='true'?' selected' : '' }}>display</option>
        </select>
    </div>
</div>

<div class="form-group">
    <div class="radio radio-inline">
        <label>
            <input type="radio"
                   {{ (isset($post)) && $post->status == 1 ? ' checked ':'' }}
                   name="status"
                   value="1">distribution
        </label>
    </div>
    <div class="radio radio-inline">
        <label>
            <input type="radio"
                   {{ (!isset($post)) || $post->status == 0 ? ' checked ':'' }}
                   name="status"
                    value="0">draft
    
        </label>
    </div>
</div>
{{ csrf_field() }}