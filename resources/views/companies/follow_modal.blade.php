<div class="modal fade" id="company_follow_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Seguimiento de compañía
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body comment-box-modal" id="CompanyFollowBox">
            </div>
            <div class="modal-footer">
                <input type="hidden" id="txt_index_company_follow" value="{{ route('index_company_follow') }}">
                <form action="{{ route('store_company_follow') }}" id="form_store_company_follow" style='width: 100%' class="form"   method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="txt_body_company_follow" name="body" class="form-control"
                                    placeholder="Escriba aqui su comentario..." />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>