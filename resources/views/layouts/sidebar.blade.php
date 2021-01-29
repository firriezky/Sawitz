@if (Auth::user()->role==1)
@include('layouts.sidebar.admin-sidebar')
@endif