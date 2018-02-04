@extends('layouts.app.frame')
@section('title', 'Edit Bar & Lounge')
@section('description', 'Please make sure to check all input')
@section('breadcrumbs', Breadcrumbs::render('gallery.edit', $page))
@section('button', '<a href="'.url('/root/bar-lounge').'" class="btn btn-info btn-xs no-border">Back
</a>')

@section('content')


    {!! Form::model($page, [
            'method' => 'PATCH',
            'url' => ['/root/bar-lounge', $page->id],
            'files' => true,
            'id' => 'formValidate',
        ]) !!}

        @include ('root.coffee.form')

	{!! Form::close() !!}
@endsection

@push("script")
<script>
$(document).ready(function() {

    $('#formValidate').validate();

});
    
tinymce.init({
      selector: "textarea",
      theme: "modern",
      paste_data_images: true,
      height : 250,
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      image_advtab: true
    });
</script>
@endpush