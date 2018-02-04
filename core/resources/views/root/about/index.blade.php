@extends('layouts.app.frame')
@section('title', 'About Us')
@section('description', 'About Us Management')
@section('breadcrumbs', Breadcrumbs::render('about'))
@section('button', '<div class="clearfix"></div>')

@section('content')
    <input type="hidden" id="drs" name="drange"/>
    <input type="hidden" id="did" name="did"/>
    <div class="form-group-attached">
        <div class="row clearfix">
            <div class="col-sm-6 col-xs-12">
                <div class="form-group form-group-default">
                    <label>Pencarian</label>
                    <form id="formsearch">
                        <input type="text" id="search-table" class="form-control" name="firstName" placeholder="put your keyword">
                    </form>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="form-group form-group-default">
                    <label>Start date</label>
                    <input type="text" id="datepicker-start" class="form-control" name="firstName" placeholder="pick a start date">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="form-group form-group-default">
                    <label>End date</label>
                    <input type="text" id="datepicker-end" class="form-control" name="firstName" placeholder="pick an end date">
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <table class="table table-hover" id="about-table">
        <thead>
            <tr>
                <th width="15%"> Title </th><th width="25%"> Intro </th><th width="25%"> Descriptions </th><th> Image </th><th width="15%"> Actions </th>
            </tr>
        </thead>
    </table>

@endsection


@push("script")
<script>

var oTable;
oTable = $('#about-table').DataTable({
    processing: true,
    serverSide: true,
    dom: 'lBfrtip',
    order:  [[ 0, "asc" ]],
    buttons: [
        {
            extend: 'print',
            autoPrint: true,
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'padding', '2px' )
                    .prepend(
                        '<img src="{{asset('img/logo.png')}}" style="float:right; top:0; left:0;height: 40px;right: 10px;background: #101010;padding: 8px;border-radius: 4px" /><h5 style="font-size: 9px;margin-top: 0px;"><br/><font style="font-size:14px;margin-top: 5px;margin-bottom:20px;"> Laporan Category</font><br/><br/><font style="font-size:8px;margin-top:15px;">{{date('Y-m-d h:i:s')}}</font></h5><br/><br/>'
                    );


                $(win.document.body).find( 'div' )
                    .css( {'padding': '2px', 'text-align': 'center', 'margin-top': '-50px'} )
                    .prepend(
                        ''
                    );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( { 'font-size': '9px', 'padding': '2px' } );


            },
            title: '',
            orientation: 'landscape',
            exportOptions: {columns: ':visible'} ,
            text: '<i class="fa fa-print" data-toggle="tooltip" title="" data-original-title="Print"></i>'
        },
        {extend: 'colvis', text: '<i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Column visible"></i>'},
        {extend: 'csv', text: '<i class="fa fa-file-excel-o" data-toggle="tooltip" title="" data-original-title="Export CSV"></i>'}
    ],
    sDom: "<'table-responsive fixed't><'row'<p i>> B",
    sPaginationType: "bootstrap",
    destroy: true,
    responsive: true,
    scrollCollapse: true,
    oLanguage: {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    ajax: {
    url: 
        '{!! route('about.data') !!}'
    ,
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
        { data: "title", name: "title" },
        { data: "intro", name: "intro" },
        { data: "descriptions", name: "descriptions" },
        { data: "image", name: "image" },
        { data: "action", name: "action", searchable: false, orderable: false },
    ],
}).on( 'processing.dt', function ( e, settings, processing ) {if(processing){Pace.start();} else {Pace.stop();}});

$("#about-table_wrapper > .dt-buttons").appendTo("div.export-options-container");


$('#datepicker-start').datepicker({format: 'yyyy/mm/dd'}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
    if($('#datepicker-end').val() != ""){
        $('#drs').val($('#datepicker-start').val()+":"+$('#datepicker-end').val());
        oTable.draw();
    }else{
        $('#datepicker-end').focus();
    }

});
$('#datepicker-end').datepicker({format: 'yyyy/mm/dd'}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
    if($('#datepicker-start').val() != ""){
        $('#drs').val($('#datepicker-start').val()+":"+$('#datepicker-end').val());
        oTable.draw();
    }else{
        $('#datepicker-start').focus();
    }

});

$('#formsearch').submit(function () {
    oTable.search( $('#search-table').val() ).draw();
    return false;
} );

oTable.page.len(25).draw();



function deleteData(id) {
    $('#modalDelete').modal('show');
    $('#did').val(id);
}

function hapus(){
    $('#modalDelete').modal('hide');
    var id = $('#did').val();
    $.ajax({
        url: '{{url("root/about")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
        type: 'DELETE',
        complete: function(data) {
            oTable.draw();
        }
    });
}

</script>
@endpush
