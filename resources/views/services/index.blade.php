@extends('layouts.app')

@section('title', 'Services | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">Services</div>
        <h2>Pergolas, gazebos & attached shade—end to end</h2>
        <p class="lead">Pick a path—or combine freestanding and attached structures into one build schedule.</p>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container grid-3">
        @foreach($services as $service)
            <article class="service-card">
                <img src="{{ $service->image_url }}" alt="{{ $service->name }}">
                <h3>{{ $service->name }}</h3>
                <p>{{ $service->summary }}</p>
                <a class="btn btn-primary" href="{{ route('services.show', $service) }}">Learn more</a>
            </article>
        @endforeach
    </div>
</section>
@endsection
