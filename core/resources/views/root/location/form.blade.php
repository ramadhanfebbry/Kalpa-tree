<div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title') !!}
    {!! Form::textarea('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('title', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('descriptions') ? 'has-error' : ''}}">
    {!! Form::label('descriptions', 'Descriptions') !!}
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