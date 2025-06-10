<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>{{__('messages.Nav title')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <div class="header__top__links">
                                @if(auth()->check())
                                    <a href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       {{ __('messages.Sign out') }}
                                    </a>
                            
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{ route('user.login') }}">{{ __('messages.Signin') }}</a>
                                @endif
                            </div>
                            
                        </div>
                        <div class="header__top__hover">
                            <span>{{ app()->getLocale() == 'ar' ? 'ع' : 'En' }} <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li><a style="color:#111;" href="{{ route('lang.switch', 'en') }}">En</a></li>
                                <li><a style="color:#111;" href="{{ route('lang.switch', 'ar') }}">ع</a></li>
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{route('home')}}">
                        <img src="{{ asset("assets/front/img/logo.png") }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">{{ __('messages.Home') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">{{ __('messages.Shop') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">{{ __('messages.About Us') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">{{ __('messages.Contact') }}</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href=""><img src="{{ asset("assets/front/img/icon/cart.png") }}" alt=""> <span>{{ count(session('cart', [])) }}</span></a>
                    <div class="price">{{ array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart', []))) }}</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>