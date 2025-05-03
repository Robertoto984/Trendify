@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('departments')
            </div>
            <div class="col-lg-9">
                @include('hero')
            </div>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @include('categories')
            </div>
        </div>
    </div>
</section>
 
<section class="featured spad">
    @include('featured')
</section>

<div class="banner">
    <div class="container">
        <div class="row">
            @include('banner')
        </div>
    </div>
</div>

@endsection
