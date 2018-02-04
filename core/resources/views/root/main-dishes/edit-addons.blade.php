@extends('layouts.app.frame')
@section('title', 'Edit Addon')
@section('description', 'Please make sure to check all input')
@section('breadcrumbs', Breadcrumbs::render('main-dishes.edit',$addons))
@section('button', '<a href="'.url('/root/main-dishes').'/'.$main->id.'" class="btn btn-info btn-xs no-border">Back
</a>')

@section('content')
    {!! Form::open(['url' => '/root/main-dishes-addons/'.$addons->id.'/update', 'id' => 'formValidate', 'files' => true]) !!}
    @if($main->addons == "images")
    <div aria-required="true" class="form-group form-group-default {{ $errors->has('images') ? 'has-error' : ''}}">
        {!! Form::label('images', 'Image') !!}
        @if(isset($addons->image))
            <img src="{{url('').'/files/main-dishes/'.$addons->image}}" style="max-width:200px; margin:10px 0px;" />
        @endif
        {!! Form::file('images', null, ['class' => 'form-control']) !!}
    </div>
    {!! $errors->first('images', '<label class="error">:message</label>') !!}
    @endif

    <div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', $addons->title, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    {!! $errors->first('title', '<label class="error">:message</label>') !!}

    <div aria-required="true" class="form-group required form-group-default {{ $errors->has('descriptions') ? 'has-error' : ''}}">
        {!! Form::label('descriptions', 'Description') !!}
        {!! Form::textarea('descriptions', $addons->descriptions, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    {!! $errors->first('descriptions', '<label class="error">:message</label>') !!}

    <div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('order_no', 'Order') !!}
        {!! Form::text('order_no', $addons->order_no, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    {!! $errors->first('order_no', '<label class="error">:message</label>') !!}

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
