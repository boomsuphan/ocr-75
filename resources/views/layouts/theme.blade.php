<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Nova - Bootstrap 5 Template</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('theme/assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/css/LineIcons.2.0.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/tiny-slider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/lindy-uikit.css') }}"/>

    <!-- icon -->
    <link href="https://kit-pro.fontawesome.com/releases/v6.7.0/css/pro.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('theme/assets/img/logo/logo-cs.png') }}" type="image/x-icon" />
  </head>
  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================= preloader end ========================= -->

    <!-- ========================= hero-section-wrapper-5 start ========================= -->
    <section id="home" class="hero-section-wrapper-5">

      <!-- ========================= header-6 start ========================= -->
      <header class="header header-6">
        <div class="navbar-area">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                  <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('theme/assets/img/logo/logo-cs.png') }}" width="50" />
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                  </button>
  
                  <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                    <ul id="nav6" class="navbar-nav ms-auto">
                      <li class="nav-item">
                        <a class="page-scroll active" href="#home">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#feature">Feature</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#about">About</a>
                      </li>

                      <li class="nav-item">
                        <a class="page-scroll" href="#pricing">Pricing</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#contact">Contact</a>
                      </li>
                    </ul>
                  </div>
                  
                  <!-- <div class="header-action d-flex">
                    <a href="#0"> <i class="lni lni-cart"></i> </a>
                    <a href="#0"> <i class="lni lni-alarm"></i> </a>
                  </div> -->
                  <!-- navbar collapse -->
                </nav>
                <!-- navbar -->
              </div>
            </div>
            <!-- row -->
          </div>
          <!-- container -->
        </div>
        <!-- navbar area -->
      </header>
      <!-- ========================= header-6 end ========================= -->
    </section>
    <!-- ========================= hero-section-wrapper-6 end ========================= -->
    <div style="height: 100px;"></div>
  <main class="py-4">
            @yield('content')
    </main>
    <!-- ========================= footer style-4 start ========================= -->
    <footer class="footer footer-style-4" style="padding-top:10px !important;">
      <div class="container">
        <div class="copyright-wrapper wow fadeInUp" data-wow-delay=".2s">
          <p>Design and Developed by <a href="https://uideck.com" rel="nofollow" target="_blank">UIdeck</a> Built-with <a href="https://uideck.com" rel="nofollow" target="_blank">Lindy UI Kit</a>. Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
        </div>
      </div>
    </footer>
    <!-- ========================= footer style-4 end ========================= -->

    <!-- ========================= scroll-top start ========================= -->
    <a href="#" class="scroll-top"> <i class="lni lni-chevron-up"></i> </a>
    <!-- ========================= scroll-top end ========================= -->
		

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('/theme/assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('/theme/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/js/main.js') }}"></script>
  </body>
</html>
