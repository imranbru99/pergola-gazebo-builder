@extends('layouts.app')

@section('title', $service->name.' | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">Service</div>
        <h2>{{ $service->name }}</h2>
        <p class="lead">{{ $service->tagline ?? $service->summary }}</p>
        @if($service->starting_price)
            <p class="price">Starting at ${{ number_format($service->starting_price, 0) }}</p>
        @endif
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container grid-2">
        <div class="article-body">
            {!! nl2br(e($service->body)) !!}
            <p style="margin-top:2rem"><a class="btn btn-primary" href="{{ route('contact') }}">Get this estimate</a></p>
        </div>
        <img src="{{ $service->image_url }}" alt="{{ $service->name }}" style="border-radius:1rem">
    </div>
</section>
@endsection
