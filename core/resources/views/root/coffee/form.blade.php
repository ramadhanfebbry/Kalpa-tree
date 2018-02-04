<div aria-required="true" class="form-group required form-group-default {{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'Image') !!}
    @if(isset($page->image))
        <img src="{{url('').'/files/pages/'.$page->image}}" style="max-width:200px; margin:10px 0px;" />
    @endif
    {!! Form::file('images', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('images', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('title', '<label class="error">:message</label>') !!}

@if(isset($page->order_no))
<div aria-required="true" class="form-group required form-group-default {{ $errors->has('order_no') ? 'has-error' : ''}}">
    {!! Form::label('order_no', 'Order') !!}
    {!! Form::number('order_no', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('order_no', '<label class="error">:message</label>') !!}
@endif

<div aria-required="true" class="form-group required form-group-default form-group-default-select2 {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status') !!}
	{!! Form::select('status', \App\Page::statusLabels(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2']) !!}
</div>
{!! $errors->first('status', '<p class="help-block">:message</p>') !!}

<div class="pull-left">
    <div class="checkbox check-success">
        <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree">Saya sudah mengecek data sebelum menyimpan</label>
    </div>
</div>
<br/>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>