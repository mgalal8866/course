<div>
   @push('csslive')
   <link rel="stylesheet" type="text/css" href="{{ asset('asset/summernote/summernote-bs4.css') }}">

   @endpush
   <div id="summernote"></div>
  @push('jslive')

    <script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
      });
    </script>
   <script src="{{ asset('asset/summernote/ummernote-bs4.js')}}"></script>
   @endpush
</div>
