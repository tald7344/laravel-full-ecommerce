<div class="modal fade modal-wrapper" id="custom-message" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row mt-3 mb-3 mr-4 ml-4">
                    <h4 class="message-text mb-0 mx-auto"></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-wrapper" id="cart-message-error" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <h4 class="message-text mb-0 mx-auto">
                        {!! trans('all.product-added') !!}
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-wrapper" id="custom-confirm" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row mt-3 mb-3 mr-4 ml-4">
                    <h4 class="message-text mb-0 mx-auto"></h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button {{App::getLocale() == 'en' ? 'mr-2' : 'ml-2'}}" data-dismiss="modal">{{trans('all.button_close')}}</button>
                <button type="button" class="btn btn-primary save-button">{{trans('all.ok')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-wrapper" id="custom-error-message" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row mt-3 mb-3 text-danger mr-4 ml-4">
                    <h4 class="message-text mb-0 mx-auto"></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="message-overlay"></div>
