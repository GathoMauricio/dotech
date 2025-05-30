@extends('layouts.app')
@section('content')
    <h4 class="title_page">Editar template</h4>
    <form action="{{ route('update_mailing', $mailing->id) }}" method="post" enctype="multipart/form">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Remitente</label>
                        <input type="email" name="from" value="{{ $mailing->from }}" class="form-control"
                            placeholder="Ingrese el remitente..." required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Por defecto</label>
                        <select name="selected" class="form-control">
                            @if ($mailing->selected == 'SI')
                                <option value="SI" selected>SI</option>
                                <option value="NO">NO</option>
                            @else
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Asunto</label>
                        <input type="text" value="{{ $mailing->subject }}" name="subject" class="form-control"
                            placeholder="Ingrese el asunto..." required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Cuerpo del correo</label>
                        <textarea name="body" class="form-control rich-text-editor">{{ $mailing->body }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
@endsection
