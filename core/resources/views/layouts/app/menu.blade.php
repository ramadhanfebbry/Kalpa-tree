@if(Auth::user()->roles > 1)
<li class="m-t-30 {{ (Request::is('root/user*')) ? 'active' : '' }}">
    <a href="{{url('root/user')}}">User</a>
    <span class="{{ (Request::is('root/user*')) ? 'bg-success' : '' }} icon-thumbnail"><i class="fa fa-users"></i></span>
</li>
@endif
<li class="@if(Auth::user()->roles < 2) m-t-30 @endif {{ (Request::is('root/slider*')) ? 'active' : '' }}">
    <a href="{{url('root/slider')}}">Slider</a>
    <span class="{{ (Request::is('root/slider*')) ? 'bg-success' : '' }} icon-thumbnail"><i class="fa fa-image"></i></span>
</li>
<li class="{{ (Request::is('root/about*') || Request::is('root/menus*') || Request::is('root/appetizer*') || Request::is('root/main-dishes*') || Request::is('root/desserts*') || Request::is('root/drinks*')) ? 'open active' : ''}}">
    <a href="javascript:;"><span class="title">Static Page</span> 
        <span class="arrow {{ (Request::is('root/about*') || Request::is('root/menus*') || Request::is('root/appetizer*') || Request::is('root/main-dishes*') || Request::is('root/desserts*') || Request::is('root/drinks*')) ? 'open active' : ''}}"></span>
    </a> 
    <span class="{{ (Request::is('root/about*') || Request::is('root/menus*') || Request::is('root/appetizer*') || Request::is('root/main-dishes*') || Request::is('root/desserts*') || Request::is('root/drinks*')) ? 'bg-success' : ''}} icon-thumbnail">
        <i class="fa fa-briefcase"></i>
    </span>

    <ul class="sub-menu">
        <li class="{{ (Request::is('root/about*')) ? 'active' : '' }}">
            <a href="{{url('root/about')}}">About Us</a> 
            <span class="{{ (Request::is('root/about*')) ? 'bg-success' : '' }} icon-thumbnail">Au</span>
        </li>
        <li class="{{ (Request::is('root/menus*')) ? 'active' : '' }}">
            <a href="{{url('root/menus')}}">Menus</a> 
            <span class="{{ (Request::is('root/menus*')) ? 'bg-success' : '' }} icon-thumbnail">Me</span>
        </li>
        <li class="{{ (Request::is('root/appetizer*')) ? 'active' : '' }}">
            <a href="{{url('root/appetizer')}}">Appetizer</a> 
            <span class="{{ (Request::is('root/appetizer*')) ? 'bg-success' : '' }} icon-thumbnail">Ap</span>
        </li>
        <li class="{{ (Request::is('root/main-dishes*')) ? 'active' : '' }}">
            <a href="{{url('root/main-dishes')}}">Main Dishes</a> 
            <span class="{{ (Request::is('root/main-dishes*')) ? 'bg-success' : '' }} icon-thumbnail">Md</span>
        </li>
        <li class="{{ (Request::is('root/desserts*')) ? 'active' : '' }}">
            <a href="{{url('root/desserts')}}">Desserts</a> 
            <span class="{{ (Request::is('root/desserts*')) ? 'bg-success' : '' }} icon-thumbnail">De</span>
        </li>
        <li class="{{ (Request::is('root/drinks*')) ? 'active' : '' }}">
            <a href="{{url('root/drinks')}}">Drinks</a> 
            <span class="{{ (Request::is('root/drinks*')) ? 'bg-success' : '' }} icon-thumbnail">Dr</span>
        </li>
    </ul>
</li>
<li class="{{ (Request::is('root/gallery*')) ? 'active' : '' }} hidden">
    <a href="{{url('root/gallery')}}">Gallery</a>
    <span class="{{ (Request::is('root/gallery*')) ? 'bg-success' : '' }} icon-thumbnail"><i class="fa fa-image"></i></span>
</li>
<li class="{{ (Request::is('root/coffee*')) ? 'active' : '' }}">
    <a href="{{url('root/coffee')}}">Coffee</a>
    <span class="{{ (Request::is('root/coffee*')) ? 'bg-success' : '' }} icon-thumbnail"><span>CF</span></span>
</li>
<li class="{{ (Request::is('root/restaurant*')) ? 'active' : '' }}">
    <a href="{{url('root/restaurant')}}">Restaurant</a>
    <span class="{{ (Request::is('root/restaurant*')) ? 'bg-success' : '' }} icon-thumbnail"><span>RT</span></span>
</li>
<li class="{{ (Request::is('root/bar-lounge*')) ? 'active' : '' }}">
    <a href="{{url('root/bar-lounge')}}">Bar & Lounge</a>
    <span class="{{ (Request::is('root/bar-lounge*')) ? 'bg-success' : '' }} icon-thumbnail"><span>BL</span></span>
</li>

<li class="{{ (Request::is('root/event*')) ? 'active' : '' }}">
    <a href="{{url('root/event')}}">Events</a>
    <span class="{{ (Request::is('root/event*')) ? 'bg-success' : '' }} icon-thumbnail"><i class="fa fa-image"></i></span>
</li>
<li class="{{ (Request::is('root/contact*')) ? 'active' : '' }}">
    <a href="{{url('root/contact')}}">Contact</a>
    <span class="{{ (Request::is('root/contact*')) ? 'bg-success' : '' }} icon-thumbnail"><i class="fa fa-envelope"></i></span>
</li>