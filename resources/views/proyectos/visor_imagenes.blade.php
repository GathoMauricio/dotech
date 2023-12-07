<div id="visor_imagenes_full" class="visor_imagenes_full" style="overflow: hidden;overflow-y:scroll;">
    <a href="javascript:void(0);" onclick="quitarImagenesBitacora();"><span class="icon icon-cross"
            style="color:white;font-size:22px;"></span></a>
    <div class="container">
        <div class="row justify-content-center" id="contenedor_imagenes_bitacora">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ asset('img/background_blue.jpg') }}" target="_BLANK">
                            <img src="{{ asset('img/background_blue.jpg') }}" style="width:100%;height:200">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .visor_imagenes_full {
        display: none;
        z-index: 9999;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: black;
        border-radius: 10px;
        padding: 20px;
    }
</style>

<script>
    function verImagenesBitacora(bitacora_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('ajax_imagenes_bitacora') }}",
            data: {
                bitacora_id: bitacora_id
            },
        }).done(function(response) {
            if (response.cantidad > 0) {
                var html = ``;
                $.each(response.imagenes, function(index, item) {
                    html += `
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">${item.description}</div>
                        <div class="card-body">
                            <a href="http://dotech.dyndns.biz:16666/dotech/public/storage/${item.image}" target="_BLANK">
                                <img src="http://dotech.dyndns.biz:16666/dotech/public/storage/${item.image}" style="width:100%;height:200;">
                            </a>
                        </div>
                        <div class="card-footer">${item.created_at}</div>
                    </div>
                </div>
                `;
                });
                $("#contenedor_imagenes_bitacora").html(html);
                $("#visor_imagenes_full").css('display', 'block');
            } else {
                errorNotification("No hay imagenes para mostrar");
            }
        }).fail(function(jqXHR, textStatus,
            errorThrown) {
            console.log(jqXHR);
        });
    }

    function quitarImagenesBitacora() {
        $("#visor_imagenes_full").css('display', 'none');
    }
</script>
