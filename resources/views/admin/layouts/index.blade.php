@include("admin.layouts.header")
@include("admin.layouts.nav")
@include("admin.layouts.sidebar")
<div class="content-wrapper">
    @include("admin.errors.fetchErrors")
    @include("admin.success.success")
    @yield('content')
</div>
@include("admin.layouts.footer")
