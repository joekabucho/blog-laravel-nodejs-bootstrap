@if(isset($open_pay) && $open_pay == 'true')
    <div class="pay mb-3">
        <div class="center">
            <p class="center-block">{{ $pay_description or 'Write well, sponsor the hosting fee'}}</p>
            <button class="btn btn-success center" type="button"
                    data-toggle="collapse" data-target="#pay-content">
                    Appreciate
            </button>
        </div>
        <div id="pay-content" class="collapse pay-content text-center">
            @if(isset($zhifubao_pay_image_url) && !empty($zhifubao_pay_image_url) && isset($wechat_pay_image_url) && !empty($wechat_pay_image_url))
                <div class="btn-group nav pay-buttons justify-content-center mt-3" role="group">
                    <a class="btn btn-light active" href="#zhifubao" role="tab" data-toggle="tab"
                       aria-controls="zhifubao">
                       Alipay
                    </a>
                    <a class="btn btn-light" href="#wechat" role="tab" data-toggle="tab"
                       aria-controls="wechat">
                       WeChat
                    </a>
                </div>
                <div class="tab-content pay-images">
                    <div id="zhifubao" role="tabpanel" class="tab-pane fade show active">
                        <span class="center-block">Sweep and appreciate with Alipay</span>
                        <img src="{{ $zhifubao_pay_image_url }}">
                    </div>
                    <div id="wechat" role="tabpanel" class="tab-pane fade">
                        <span class="center-block">Sweep and appreciate with WeChat</span>
                        <img src="{{ $wechat_pay_image_url }}">
                    </div>
                </div>
            @elseif(isset($zhifubao_pay_image_url) && !empty($zhifubao_pay_image_url))
                <div class="tab-content pay-images">
                    <div role="tabpanel" class="tab-pane fade show active">
                        <span class="center-block">Sweep and appreciate with Alipay</span>
                        <img src="{{ $zhifubao_pay_image_url }}">
                    </div>
                </div>
            @elseif(isset($wechat_pay_image_url) && !empty($wechat_pay_image_url))
                <div class="tab-content pay-images">
                    <div role="tabpanel" class="tab-pane fade show active">
                        <span class="center-block">Sweep and appreciate with WeChat</span>
                        <img src="{{ $wechat_pay_image_url }}">
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif