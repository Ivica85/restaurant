<x-app-layout>

@section('head')
    <base href="/public">
    @include('admin.partials.admin_css')
@endsection


@section('body')
<div class="container-scroller">
    @include('admin.partials.navigation')
    @yield('content')
    @include('admin.partials.admin_script')
</div>

@endsection



</x-app-layout>
