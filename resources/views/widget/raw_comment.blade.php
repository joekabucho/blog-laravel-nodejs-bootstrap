<div class="comments shadow" id="comments">
    <div class="comments-body">
        <div id="comments-container"
             data-api-url="{{ route('comment.show',[$commentable->id,
             'commentable_type'=>$commentable_type,
             'redirect'=>(isset($redirect) && $redirect ? $redirect:'')]) }}">
            @if(isset($comments) && !empty($comments))
                @include('comment.show',$comments)
            @endif
        </div>
        <div id="comment-form-wrapper">
            <form id="comment-form" method="post" action="{{ route('comment.store') }}" class="comment-form">
                {{ csrf_field() }}
                <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
                <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
                <?php $final_allow_comment = $commentable->allowComment()?>
                @if(!auth()->check())
                    <div class="form-group">
                        <label class="form-control-label" for="username">姓名<span class="text-danger">*</span></label>
                        <input {{ $final_allow_comment?' ':' disabled ' }} class="form-control" id="username" type="text" name="username" placeholder="Your name">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="email">邮箱<span class="text-danger">*</span></label>
                        <input {{ $final_allow_comment?' ':' disabled ' }} class="form-control" id="email" type="email" name="email" placeholder="Mailbox will not be published">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="site">个人网站</label>
                        <input {{ $final_allow_comment?' ':' disabled ' }} class="form-control" id="site" type="text" name="site" placeholder="Optional, fill in and click on the avatar to enter directly">
                    </div>
                @endif
                <div class="form-group">
                    <label for="comment-content">Comment content, support <a href="https://daringfireball.net/projects/markdown/syntax">Markdown</a><span class="text-danger">*</span></label>
                    <textarea {{ $final_allow_comment?' ':' disabled ' }} placeholder="Will not show until after review"
                              id="comment-content" name="content"
                              rows="5" spellcheck="false"
                              class="form-control markdown-content autosize-target"></textarea>
                </div>
                @if($final_allow_comment)
                    <div class="form-group d-flex">
                        <img id="captcha" class="mr-3" src="{{ captcha_src(config('captcha.use')) }}" onclick="this.src='/captcha/'+XblogConfig.captcha_config+'?'+Math.random()">
                        <input class="form-control col-md-2 col-sm-3" type="text" size="6" name="captcha">
                    </div>
                @endif
                <div class="form-group">
                    <span class="help-block required"><strong id="comment_submit_msg"></strong></span>
                </div>
                <div class="form-group">
                    <input {{ $final_allow_comment?' ':' disabled ' }} type="submit" id="comment-submit" class="btn btn-primary"
                           value="Reply"/>
                </div>
            </form>
        </div>
    </div>
</div>