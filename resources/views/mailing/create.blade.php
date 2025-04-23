@extends('layouts.app')
@section('content')
    <h4 class="title_page">Crear template</h4>
    <form action="{{ route('store_mailing') }}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Remitente</label>
                        <input type="email" name="from" class="form-control" placeholder="Ingrese el remitente..."
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Por defecto</label>
                        <select name="selected" class="form-control">
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Asunto</label>
                        <input type="text" name="subject" class="form-control" placeholder="Ingrese el asunto..."
                            required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Cuerpo del correo</label>
                        <textarea name="body" class="form-control rich-text-editor"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="javascript:void(0)" onclick="agregarAdjunto();" class="float-right p-2">Agregar adjunto</a>
                </div>
                <div class="col-md-12 p-3" id="box_contenedor_adjuntos"
                    style="-webkit-box-shadow: 4px 3px 17px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 4px 3px 17px 0px rgba(0,0,0,0.75);
box-shadow: 4px 3px 17px 0px rgba(0,0,0,0.75);">
                    <center><button type="button" class="btn btn-primary" onclick="agregarAdjunto();">Agregar
                            adjunto</button></center>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-3">
                    <input type="submit" class="btn btn-primary float-right" value="Guardar">
                </div>
            </div>
        </div>
    </form>
@endsection
@section('custom_scripts')
    {{--  <script src="https://cdn.tiny.cloud/1/NO-API-KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
      --}}
    <script src="https://cdn.tiny.cloud/1/2mxfpm0vse8m4hoxzni9m5d38iogmphk1vu65lk79et0x74m/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        let contador_adjuntos = 0;

        function agregarAdjunto() {
            if (contador_adjuntos == 0) {
                $("#box_contenedor_adjuntos").html('');
            }
            contador_adjuntos++;
            $("#box_contenedor_adjuntos").append(`
                <div id="input_adjunto_${contador_adjuntos}" style="border:solid 1px #2980b9" class="p-2">
                        <span onclick="quitarAdjunto(${contador_adjuntos});" class="icon-cross float-right p-2" style="cursor:pointer;"></span>
                        <input type="file" name="adjuntos[]" class="form-control"  accept=".pdf, .jpg, .jpeg, .png" required>
                </div>
            `);

        }

        function quitarAdjunto(adjunto_id) {
            contador_adjuntos--;
            $("#input_adjunto_" + adjunto_id).remove();
            if (contador_adjuntos == 0) {
                $("#box_contenedor_adjuntos").html(`<center><button type="button" class="btn btn-primary" onclick="agregarAdjunto();">Agregar
                            adjunto</button></center>`);
            }
        }
        tinymce.init({
            selector: 'textarea',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
                'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Apr 2, 2025:
                'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
                'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
                'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
                'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                'See docs to implement AI Assistant')),
        });
    </script>
    <style>
        .select2-selection__choice__display {
            color: black;
        }
    </style>
@endsection
