@extends('layouts.web.frame')
@section('content')
    <div class="page drinks content">
        <div class="cover-img">
        </div>
        <div class="text-content">
            <div class="container">
                <p class="txt-space3 font-bold font-MyriadPro-Bold font-coklat">MENUS</p>
                <h1 class="h1-dinamis"><span class="font-hitam">- DRINKS -</span></h1>
                <h5 class="h5-dinamis"><span class="font-coklat"></span></h3>
                <div class="line"></div>

                <div class="spasi30"></div>
                <div class="row">
                    @foreach($addon as $addons)
                    <div class="col-xs-6 col-sm-4">
                        <div class="thumbnail">
                            <img src="{{ url('files/drinks').'/'.$addons['image'] }}" alt="...">
                            <div class="caption">
                                <p class="title">{{ strip_tags($addons['title']) }}</p>
                                <p class="price">{{ strip_tags($addons['descriptions']) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="line"></div>
                <div class="spasi30"></div>
                <a href="{{ url('') }}/#3"><img src="{{ url('assets/img/btn-back.png') }}" width="40"></a>
                <div class="spasi30"></div>
            </div>
        </div>
    </div>
@endsection