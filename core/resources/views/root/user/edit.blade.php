@extends('layouts.app.frame')
@section('title', 'Edit User')
@section('description', 'Please make sure to check all input')
@section('breadcrumbs', Breadcrumbs::render('user.edit', $user))
@section('button', '<a href="'.url('/root').'/'.Request::segment(2).'" class="btn btn-info btn-xs no-border">Back
</a>')

@section('content')


    {!! Form::model($user, [
            'method' => 'PATCH',
            'url' => ['/root/user', $user->id],
            'files' => true,
            'id' => 'formValidate',
        ]) !!}

        @include ('root.user.form')

	{!! Form::close() !!}
@endsection
