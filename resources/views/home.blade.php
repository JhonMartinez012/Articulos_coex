@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="container" id="app">
    <div style="padding:75px;"></div>
    <articles></articles>
    <comments/>
</div>
@endsection
