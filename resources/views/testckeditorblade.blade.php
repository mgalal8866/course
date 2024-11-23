@extends('layouts.dashboard.app')
@section('content')
    @push('jslive')
        {{-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script> --}}
        {{-- <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script> --}}
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>



        <script>
            CKEDITOR.plugins.addExternal('ckeditor_wiris', 'https://www.wiris.net/demo/plugins/ckeditor/', 'plugin.js');

            CKEDITOR.editorConfig = function(config) {
                

                config.toolbar = [{
                    name: 'wirisplugins',
                    items: ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry']
                }];
                config.allowedContent = true;
                config.versionCheck = false;
            };

            CKEDITOR.replace('ckeditor', {
                extraPlugins: 'ckeditor_wiris'
            });
        </script>
    @endpush

    <div>
        <form enctype="multipart/form-data">

            <div class="mb-1 col-md-12">
                <label class="form-label" for="ckeditor">Ck Editor</label>

                <textarea class="form-control" id="ckeditor" placeholder="Enter the Description" rows="5" name="body"> </textarea>

            </div>
        </form>
    </div>
@endsection
