<div aria-required="true" class="form-group required form-group-default {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('name', '<label class="error">:message</label>') !!}
 
<div aria-required="true" class="form-group required form-group-default {{ $errors->has('username') ? 'has-error' : ''}}">
    {!! Form::label('username', 'Username') !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('username', '<label class="error">:message</label>') !!}
 
<div aria-required="true" class="form-group required form-group-default {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required']) !!}
</div>
{!! $errors->first('email', '<label class="error">:message</label>') !!}
 
<div aria-required="true" class="form-group required form-group-default {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', Request::is("root/user/create*") ? "required" : "", 'minlength' => '6']) !!}
    @if(!Request::is("root/user/create*") && !Request::is("root/user-admin/create*"))
    {!! Form::hidden('password_old', $user->password, ['class' => 'form-control', "required", 'minlength' => '6']) !!}
    @endif
</div>
{!! $errors->first('password', '<label class="error">:message</label>') !!}
 

<div class="pull-left">
    <div class="checkbox check-success">
        <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree">Saya sudah mengecek data sebelum menyimpan</label>
    </div>
</div>
<br/>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>