@auth()
    @include('teacher.layouts.navbars.navs.auth')
@endauth
    
@guest()
    @include('teacher.layouts.navbars.navs.guest')
@endguest