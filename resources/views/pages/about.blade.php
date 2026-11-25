@extends('layouts.app')

@section('title', 'About | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">About</div>
        <h2>Shade first. Shortcuts never.</h2>
        <p class="lead">Ashwick Outdoor Structures is a Charlotte builder that treats pergolas and gazebos like permanent architecture—because they are.</p>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container grid-2">
        <div class="article-body">
            <p>We built Ashwick for homeowners who want outdoor rooms that survive Carolina clay, summer UV, and real entertaining—not weekend kits that rack after one wet season.</p>
            <p>Every project includes site measure, permit-ready drawings when needed, shop fabrication, and a punch-list walkthrough. The ERP behind the scenes tracks lumber inventory, crew schedules, and invoices so your timeline stays honest.</p>
            <p><strong>Service area:</strong> Charlotte metro, Concord, Matthews, Huntersville, Fort Mill, and nearby Carolinas communities.</p>
        </div>
        <img src="{{ config('brand.images.about') }}" alt="About Ashwick Outdoor Structures" style="border-radius:1rem">
    </div>
</section>
@endsection
