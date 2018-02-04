<div aria-required="true" class="form-group required form-group-default {{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'Image') !!}
    @if(isset($article->image))
        <img src="{{url('').'/files/articles/'.$article->image}}" style="max-width:200px; margin:10px 0px;" />
    @endif
    {!! Form::file('images', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('images', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('title', '<label class="error">:message</label>') !!}

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('descriptions') ? 'has-error' : ''}}">
    {!! Form::label('descriptions', 'Descriptions') !!}
    {!! Form::textarea('descriptions', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('descriptions', '<label class="error">:message</label>') !!}

@if(isset($article->order_no))
<div aria-required="true" class="form-group required form-group-default {{ $errors->has('order_no') ? 'has-error' : ''}}">
    {!! Form::label('order_no', 'Order') !!}
    {!! Form::number('order_no', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
{!! $errors->first('order_no', '<label class="error">:message</label>') !!}
@endif

<div class="pull-left">
    <div class="checkbox check-success">
        <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree">Saya sudah mengecek data sebelum menyimpan</label>
    </div>
</div>
<br/>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>