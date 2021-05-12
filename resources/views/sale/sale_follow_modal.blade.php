<div class="modal fade" id="sale_follow_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Seguimientos
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body comment-box-modal" id="SaleFollowBox">
            </div>
            <div class="modal-footer">
                <input type="hidden" id="txt_index_sale_follow" value="{{ route('index_sale_follow') }}">
                <form action="{{ route('store_sale_follow_ajax') }}" id="form_store_sale_follow" style='width: 100%' class="form"   method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <input type="hidden" name="sale_id" id="txt_follow_sale_id">
                            <div class="col-md-12">
                                <input type="text" name="body" class="form-control"
                                       placeholder="Escriba aqui su comentario..." />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
