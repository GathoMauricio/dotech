<!-- Modal -->
<div class="modal fade" id="send_binnacle_pdf_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Enviar Bitácora
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('send_binnacle_pdf') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Email
                                </label>
                                <input type="hidden" name="binnacle_id" id="txt_binnacle_id_send_pdf" />
                                <input type="email" id="txt_email_binnacle_pdf" name="email" class="form-control" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Acción</button>
                </div>
            </form>
        </div>
    </div>
</div>