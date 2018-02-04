<div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('title', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('intro') ? 'has-error' : ''}}">
    {!! Form::label('intro', 'Intro') !!}
    {!! Form::textarea('intro', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('intro', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('descriptions') ? 'has-error' : ''}}">
    {!! Form::label('descriptions', 'Descriptions') !!}
    {!! Form::textarea('descriptions', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('descriptions', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default form-group-default-select2">
    {!! Form::label('addons', 'Add-on Section') !!}
    {!! Form::select('addons', $addon, null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'id' => 'addons']) !!}
</div>

<div class="pull-left">
    <div class="checkbox check-success">
        <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree">Saya sudah mengecek data sebelum menyimpan</label>
    </div>
</div>
<br/>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>