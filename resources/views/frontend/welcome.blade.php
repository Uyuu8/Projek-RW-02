@extends('layouts.Frontend.app')
@section('title')
    Website
@endsection

@section('content')
    
    {{-- Slider --}}
    @section('slider')
        @include('frontend.content.slider')
    @endsection

     {{-- Berita & Event --}}
    @section('eventHome')
        @include('frontend.content.eventHome')
    @endsection

    {{-- Berita & Event --}}
    @section('beritaHome')
        @include('frontend.content.beritaHome')
    @endsection


    {{-- kontak --}}
    @section('kontak')
        @include('frontend.content.kontak')
    @endsection

    


@endsection