@extends('layouts.app')

@section('title', 'Journal | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">Journal</div>
        <h2>Cabinet color, care, and craft</h2>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container grid-3">
        @foreach($posts as $post)
            <article>
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="height:190px;width:100%;object-fit:cover;border-radius:.75rem">
                <h3 style="font-family:var(--font-display);font-size:1.45rem">{{ $post->title }}</h3>
                <p>{{ $post->excerpt }}</p>
                <a href="{{ route('blog.show', $post) }}">Read article →</a>
            </article>
        @endforeach
    </div>
    <div class="container" style="margin-top:2rem">{{ $posts->links() }}</div>
</section>
@endsection
