@if (Auth::user()->role==1)
@include('layouts.navbar.admin')
@endif