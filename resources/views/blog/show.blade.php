@extends('layouts.app')

@section('title', $post->title.' | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">{{ $post->category }}</div>
        <h2>{{ $post->title }}</h2>
        <p class="lead">{{ $post->excerpt }}</p>
        <p style="opacity:.7">{{ $post->author_name }} · {{ optional($post->published_at)->format('M j, Y') }}</p>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container">
        <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="width:100%;max-height:420px;object-fit:cover;border-radius:1rem;margin-bottom:2rem">
        <div class="article-body">{!! nl2br(e($post->body)) !!}</div>
    </div>
</section>
@endsection
