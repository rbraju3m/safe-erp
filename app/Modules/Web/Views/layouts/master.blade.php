
    @include('Web::layouts.header')
    <!-- Top Header Area -->
     @include('Web::layouts.top_header')
    <!-- Navbar Area -->
    @include('Web::layouts.nav_area')
        
    
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    @yield('breaking_news')
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Featured Post Area Start ##### -->
    @yield('feature_post')
    <!-- ##### Featured Post Area End ##### -->

    <!-- ##### Singel news Area Start ##### -->
    @yield('single_news')
    <!-- ##### Singel news Area End ##### -->

    <!-- ##### Popular News Area Start ##### -->
    @yield('popular_news')
    <!-- ##### Popular News Area End ##### -->

    <!-- ##### Video Post Area Start ##### -->
    @yield('vedio_post')
    <!-- ##### Video Post Area End ##### -->

    <!-- ##### Editorial Post Area Start ##### -->
    @yield('editorial')
    <!-- ##### Editorial Post Area End ##### -->

    <!-- ##### Footer Add Area Start ##### -->
    @yield('footer_img')
    <!-- ##### Footer Add Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    @include('Web::layouts.footer_area')
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    @include('Web::layouts.body_end')