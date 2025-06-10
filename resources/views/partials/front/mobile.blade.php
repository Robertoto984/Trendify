<div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">{{__('messages.Signin')}}</a>
            </div>
            <div class="offcanvas__top__hover">
                <div class="header__top__hover">
                    <span>{{ app()->getLocale() == 'ar' ? 'ع' : 'En' }} <i class="arrow_carrot-down"></i></span>
                    <ul>
                        <li><a style="color:#fff;" href="{{ route('lang.switch', 'en') }}">En</a></li>
                        <li><a style="color:#fff;" href="{{ route('lang.switch', 'ar') }}">ع</a></li>
                    </ul>
                </div>  
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#"><img src="{{ asset("assets/front/img/icon/cart.png") }}" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>{{__('messages.Nav title')}}</p>
        </div>
    </div>