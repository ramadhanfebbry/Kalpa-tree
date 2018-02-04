@extends('layouts.app.frame')
@section('title', 'Appetizer #' . $appetizer->id)
@section('description', 'Appetizer Details')
@section('breadcrumbs', Breadcrumbs::render('appetizer.show', $appetizer))
@section('button', '<a href="'.url('/root/appetizer').'" class="btn btn-info btn-xs no-border">Back
</a>')

@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			<a href="{{ url('root/appetizer/' . $appetizer->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Appetizer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
			{!! Form::open([
				'method'=>'DELETE',
				'url' => ['root/appetizer', $appetizer->id],
				'style' => 'display:inline'
			]) !!}
				{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
						'type' => 'submit',
						'class' => 'btn btn-danger btn-xs',
						'title' => 'Delete Appetizer',
						'onclick'=>'return confirm("Confirm delete?")'
				))!!}
			{!! Form::close() !!}
			<br/>
			<br/>

			<div class="table-responsive">
				<table class="table table-condensed">
					<tbody>
						<tr>
							<th>ID</th>
							<td>{{ $appetizer->id }}</td>
						</tr>
						<tr>
							<th>Title</th>
							<td>@php echo $appetizer->title @endphp</td>
						</tr>
						<tr>
							<th>Intro</th>
							<td>@php echo $appetizer->intro @endphp</td>
						</tr>
						<tr>
							<th>Descriptions</th>
							<td>@php echo $appetizer->descriptions @endphp</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
    
    @if($appetizer->addons != "-")
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{ $appetizer->addons }}</h3>
            <div class="pull-right">
				<a href="{{url('root').'/appetizer-addons/'.$appetizer->id.'/add'}}" class="btn btn-xs btn-primary" style="margin-top:10px;"><i class="fa fa-plus"></i> Add Data</a>
			</div>
		</div>
        <div class="panel-body table-responsive">
            <table class="table table-condensed">
                <thead>
                    <th width="5%">#</th>
                    @if($appetizer->addons == "images")<th>Image</th>@endif
                    <th>Title</th>
                    <th>Descriptions</th>
                    <th>Order</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($addons as $add)
                    <tr>
                        <td>{{$i++}}</td>
                        @if($appetizer->addons == "images")<td><img src="{{url('').'/files/appetizer/'.$add->image}}" style="max-width:150px;" /></td>@endif
                        <td>{{$add->title}}</td>
                        <td>{{strip_tags($add->descriptions)}}</td>
                        <td>{{$add->order_no}}</td>
                        <td>
                            <a href="{{url('root')}}/appetizer-addons/{{$add->id}}/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="Edit Data"><i class="fa fa-pencil"></i></a> <a onclick="deleteData({{$add->id}})" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="Delete Data"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection
@push('script')
<script type="text/javascript">
    function deleteData(idnya){
        var conf = confirm("Delete Data?");
        if(conf){
            $.ajax({
                type: "GET",
                url: "{{url('').'/root/appetizer-addons/'}}"+idnya+"/delete",
                success: function(){
                    location.reload();  
                }
            });
        }
    }
</script>
@endpush