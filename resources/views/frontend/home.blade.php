@extends('frontend/layouts/main')
@section('title', 'WebNodez - Home')
@section('home', 'active')
@section('main-section')

   @include('frontend/home/intro')
    
    </header>

    @include('frontend/home/services')
    @include('frontend/home/technologies')
@endsection