@extends('layouts.app.frame')
@section('title', 'Create New User')
@section('description', 'Please make sure to check all input')
@section('breadcrumbs', Breadcrumbs::render('user.new'))
@section('button', '<a href="'.url('/root').'/'.Request::segment(2).'" class="btn btn-info btn-xs no-border">Back
</a>')

@section('content')
    {!! Form::open(['url' => '/root/'.Request::segment(2), 'id' => 'formValidate', 'files' => true]) !!}

		@include ('root.user.form')

	{!! Form::close() !!}
@endsection


@push("script")
<script>
$(document).ready(function() {

    $('#formValidate').validate();

});
</script>
@endpush
