<link href="{{ url('plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ url('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ url('plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ url('plugins/nvd3/nv.d3.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ url('plugins/mapplic/css/mapplic.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('plugins/rickshaw/rickshaw.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ url('plugins/jquery-metrojs/MetroJs.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ url('css/pages-iconss.css') }}" rel="stylesheet" type="text/css"/>
<link class="main-stylesheet" href="{{ url('css/pages.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('css/aldesign.css') }}" rel="stylesheet" type="text/css" />

<!--[if lte IE 9]>
    <link href="{{ url('plugins/codrops-dialogFx/dialog.ie.css') }}" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->

<script>
    window.onload = function()
    {
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
    };

    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>