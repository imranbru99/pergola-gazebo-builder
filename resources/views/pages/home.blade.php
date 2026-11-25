@extends('layouts.app')

@section('title', config('brand.name').' | Custom Pergolas & Gazebos Charlotte')
@section('meta_description', 'Ashwick Outdoor Structures builds custom pergolas and gazebos across Charlotte, NC—engineered shade, cedar craftsmanship, and lasting outdoor rooms.')

@section('content')
<section class="hero">
    <div class="hero-media" style="background-image:url('{{ config('brand.images.hero') }}')"></div>
    <div class="container hero-content fade-up">
        <div class="section-kicker" style="color:var(--accent)">Charlotte outdoor living</div>
        <h1>Ashwick Outdoor Structures</h1>
        <p>{{ config('brand.tagline') }} Site-engineered footings, shop-cut timber, and finishes built for Carolina sun.</p>
        <div class="hero-actions">
            <a class="btn btn-accent" href="{{ route('contact') }}">Book a shade consult</a>
            <a class="btn btn-ghost" style="color:#fff;border-color:rgba(255,255,255,.45)" href="{{ route('services.index') }}">Explore services</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-kicker">What we build</div>
        <h2>Shade structures that feel like outdoor rooms.</h2>
        <p class="lead">From freestanding cedar pergolas to classic gazebo pavilions and attached patio covers, Ashwick designs for how you entertain—not just how the lumber looks on a brochure.</p>
        <div class="grid-3">
            @foreach($services as $service)
                <article class="service-card">
                    <img src="{{ $service->image_url }}" alt="{{ $service->name }}">
                    <h3>{{ $service->name }}</h3>
                    <p>{{ $service->summary }}</p>
                    @if($service->starting_price)
                        <div class="price">From ${{ number_format($service->starting_price, 0) }}</div>
                    @endif
                    <a href="{{ route('services.show', $service) }}">View details →</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="container grid-2">
        <div>
            <div class="section-kicker">About Ashwick</div>
            <h2>A Charlotte builder obsessed with lasting shade.</h2>
            <p class="lead">We started Ashwick after too many backyard “pergolas” failed in Carolina clay and UV. Our crews engineer footings, fabricate clean joinery, and finish timber so outdoor rooms stay plumb and beautiful.</p>
            <a class="btn btn-primary" href="{{ route('about') }}">Our story</a>
        </div>
        <div>
            <img src="{{ config('brand.images.about') }}" alt="Ashwick pergola with climbing vines" style="border-radius:1rem; box-shadow:0 20px 50px rgba(16,42,51,.15)">
        </div>
    </div>
</section>

<section class="section" style="background:var(--mist)">
    <div class="container">
        <div class="panel fade-up">
            <div class="section-kicker" style="color:var(--accent)">Ops preview</div>
            <h2 style="color:#fff;margin:0">ERP dashboard for outdoor structure crews</h2>
            <p style="max-width:50ch;opacity:.9">Jobs, lumber inventory, invoices, and AI assistants live in one admin—so shade consults become scheduled installs without spreadsheet chaos.</p>
            <div class="stats">
                <div class="stat"><strong>2–7</strong><span>typical install days</span></div>
                <div class="stat"><strong>5-yr</strong><span>workmanship warranty</span></div>
                <div class="stat"><strong>CLT</strong><span>Charlotte metro focus</span></div>
            </div>
            <img src="{{ config('brand.images.dashboard') }}" alt="Ashwick outdoor living project visual">
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-kicker">From the journal</div>
        <h2>Shade design tips & build notes</h2>
        <div class="grid-3" style="margin-top:1.5rem">
            @foreach($posts as $post)
                <article>
                    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="height:180px;width:100%;object-fit:cover;border-radius:.75rem">
                    <h3 style="font-family:var(--font-display);font-size:1.45rem;margin:1rem 0 .4rem">{{ $post->title }}</h3>
                    <p style="color:rgba(16,42,51,.7)">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post) }}">Read →</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="container" style="text-align:center">
        <h2>Ready for cooler afternoons outdoors?</h2>
        <p class="lead" style="margin-inline:auto">Tell us your patio size and shade goals—we’ll map a pergola or gazebo plan and timeline.</p>
        <a class="btn btn-primary" href="{{ route('contact') }}">Request free estimate</a>
    </div>
</section>
@endsection
