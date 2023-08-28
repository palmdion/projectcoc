<!-- App core JavaScript-->
<script src="{{asset('js/app.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('mainjs.bootstrap.min.js')}}"></script>
<!-- Scripts -->
@vite([ 'resources/js/app.js'])
<script src="{{ asset('tinymce/js/tinymce.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/qx9o1maljl5lo8gofy4ki1fbgi0y0qs4hs0nnxa23jq9h6ay/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<link href=”/src/summernote-0.8.18-dist/summernote-bs4.min.css” rel=”stylesheet”/>

<script src=”/src/summernote-0.8.18-dist/summernote-bs4.min.js”></script>

<script>
    $(document).ready(function() {
        $("#myeditor").summernote({
            placeholder: "Write your content here",
            height: 200,
        });
    });
    </script>
