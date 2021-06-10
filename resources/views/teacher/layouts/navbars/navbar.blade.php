@if(Session::get('nip'))
    @include('teacher.layouts.navbars.navs.auth')
@else
    @include('teacher.layouts.navbars.navs.guest')
@endif