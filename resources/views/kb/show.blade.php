@extends('layouts.app')

@section('title', $article->title.' | Knowledge')

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">{{ str_replace('_', ' ', $article->category) }}</div>
        <h2>{{ $article->title }}</h2>
        <p class="lead">{{ $article->summary }}</p>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container article-body">
        {!! nl2br(e($article->body)) !!}
        <p style="margin-top:2rem"><a href="{{ route('kb.index') }}">← Back to knowledge base</a></p>
    </div>
</section>
@endsection
