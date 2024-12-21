

<header>
    <!-- Header desktop -->
    
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->
                <a href="{{ route('/') }}" class="logo">
                    <img src="{{ asset('assits/images/icons/logo-01.png') }}" alt="IMG-LOGO">
                </a>
                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                           <a href="{{ route('/') }}">Home</a>



                        </li>
                        <li>
                            <a href="">Trade</a>
                        </li>
                        <li>
                           <a href="{{ route('about') }}">About</a>
                        </li>
                        <li>
                            <a href="">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Buttons (Login/Logout/Register/Profile) -->
                <ul style="display: flex; gap: 10px; list-style: none; margin: 0; padding: 0;">
                    @guest
                    <li>
                        <a href="{{ route('login') }}" style="display: inline-block; padding: 10px 15px; background-color: #000000; color: white; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" style="display: inline-block; padding: 10px 15px; background-color: #ffffff; color: rgb(0, 0, 0); border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">Register</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('user.profile') }}" style="display: inline-block; padding: 10px 15px; background-color: #080c10; color: white; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: inline-block; padding: 10px 15px; background-color: #040404; color: white; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo mobile -->
        <div class="logo-mobile">
            <a href="index.html">
                <img src="{{ asset('assits/images/icons/logo-01.png') }}" alt="IMG-LOGO">
            </a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li><a href="index.html">Home</a></li>
            <li><a href="product.html">Trade</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>

        <!-- Buttons (Login/Logout/Register/Profile) for Mobile -->
        <ul style="display: flex; flex-direction: column; gap: 10px; padding: 10px;">
            @guest
            <li>
                <a href="{{ route('login') }}" style="display: inline-block; padding: 10px; background-color: #000000; color: white; border-radius: 5px; text-align: center; text-decoration: none; font-size: 14px; font-weight: bold;">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" style="display: inline-block; padding: 10px; background-color: #ffffff; color: rgb(0, 0, 0); border-radius: 5px; text-align: center; text-decoration: none; font-size: 14px; font-weight: bold;">Register</a>
            </li>
            @else
            <li>
                <a href="$" style="display: inline-block; padding: 10px; background-color: #945b7e; color: white; border-radius: 5px; text-align: center; text-decoration: none; font-size: 14px; font-weight: bold;">Profile</a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" style="display: inline-block; padding: 10px; background-color: #040404; color: white; border-radius: 5px; text-align: center; text-decoration: none; font-size: 14px; font-weight: bold;">Logout</a>
            </li>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
        </ul>
    </div>
</header>
