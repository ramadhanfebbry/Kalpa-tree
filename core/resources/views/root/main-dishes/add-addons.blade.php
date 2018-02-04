@extends('layouts.app.frame')
@section('title', 'Add New Addon')
@section('description', 'Please make sure to check all input')
@section('breadcrumbs', Breadcrumbs::render('main-dishes.new'))
@section('button', '<a href="'.url('/root/main-dishes').'/'.$main->id.'" class="btn btn-info btn-xs no-border">Back
</a>')

@section('content')
    {!! Form::open(['url' => '/root/main-dishes-addons/'.$main->id.'/save', 'id' => 'formValidate', 'files' => true]) !!}
    @if($main->addons == "images")
    <div aria-required="true" class="form-group form-group-default {{ $errors->has('images') ? 'has-error' : ''}}">
        {!! Form::label('images', 'Image') !!}
        {!! Form::file('images', null, ['class' => 'form-control']) !!}
    </div>
    {!! $errors->first('images', '<label class="error">:message</label>') !!}
    @endif

    <div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    {!! $errors->first('title', '<label class="error">:message</label>') !!}

    <div aria-required="true" class="form-group required form-group-default {{ $errors->has('descriptions') ? 'has-error' : ''}}">
        {!! Form::label('descriptions', 'Description') !!}
        {!! Form::textarea('descriptions', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    {!! $errors->first('descriptions', '<label class="error">:message</label>') !!}

    <div class="pull-left">
        <div class="checkbox check-success">
            <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree">Saya sudah mengecek data sebelum menyimpan</label>
        </div>
    </div>
    <br/>

    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
    <button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>
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
