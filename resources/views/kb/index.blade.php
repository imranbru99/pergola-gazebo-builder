@extends('layouts.app')

@section('title', 'Knowledge Base | '.config('brand.name'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-kicker">Knowledge base</div>
        <h2>Guides for homeowners & Ashwick staff</h2>
        <p class="lead">Common structure questions, step-by-step build guides, admin manual, and troubleshooting.</p>
    </div>
</section>
<section class="section" style="padding-top:1rem">
    <div class="container">
        @php
            $labels = [
                'common_issues' => 'Common issues',
                'guides' => 'Step-by-step guides',
                'admin_manual' => 'Admin manual',
                'troubleshooting' => 'Troubleshooting',
            ];
        @endphp
        @foreach($articles as $category => $items)
            <div class="kb-group">
                <h3 style="font-family:var(--font-display);font-size:1.8rem">{{ $labels[$category] ?? ucfirst($category) }}</h3>
                <ul class="kb-list">
                    @foreach($items as $article)
                        <li><a href="{{ route('kb.show', $article) }}">{{ $article->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>
@endsection
