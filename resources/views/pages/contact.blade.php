@extends('layouts.app')

@section('title', 'Contact | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">Contact</div>
        <h2>Book a shade consult</h2>
        <p class="lead">Share patio photos or approximate dimensions—we respond within one business day.</p>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container grid-2">
        <div class="form-card">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            <form method="post" action="{{ route('contact.store') }}">
                @csrf
                <label for="name">Name</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                <label for="phone">Phone</label>
                <input id="phone" name="phone" value="{{ old('phone') }}">
                <label for="subject">Subject</label>
                <input id="subject" name="subject" value="{{ old('subject', 'Pergola / gazebo estimate') }}">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                <button class="btn btn-primary" type="submit">Send message</button>
            </form>
        </div>
        <div>
            <p><strong>Phone:</strong> {{ config('brand.phone') }}</p>
            <p><strong>Email:</strong> {{ config('brand.email') }}</p>
            <p><strong>Studio:</strong> {{ config('brand.address') }}</p>
            <p><strong>Hours:</strong> {{ config('brand.hours') }}</p>
            <img src="{{ config('brand.images.service_pergola') }}" alt="Contact Ashwick" style="border-radius:1rem;margin-top:1.5rem">
        </div>
    </div>
</section>
@endsection
