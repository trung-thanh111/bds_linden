@extends('frontend.homepage.layout')

@section('content')
<section class="uk-section uk-flex uk-flex-middle uk-light hero-scroll-effect"
    style="background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.2)), url('{{ asset('frontend/resources/img/homely/slider/1.webp') }}') no-repeat center center; background-size: 110%; min-height: 400px; padding-top: 100px;">
    <div class="uk-container uk-container-center uk-width-1-1">
        <div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap"
            uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: 100">
            <h1 class="uk-margin-remove title-breadcrumb">Tin tức</h1>
            <ul class="uk-breadcrumb uk-margin-remove custom-breadcrumb">
                <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                <li class="uk-active"><span>Tin tức</span></li>
            </ul>
        </div>
    </div>
</section>

<section class="pc-news-section">
    <div class="uk-container uk-container-center container ">

        @if (!empty($posts) && $posts->count() > 0)
        <div class="pc-news-grid ">
            @foreach ($posts as $index => $post)
            @php
            $postImage = !empty($post->image)
            ? asset($post->image)
            : asset('images/placeholder-news.jpg');

            $postUrl = !empty($post->canonical)
            ? url(
            rtrim($post->canonical, '/') .
            (str_ends_with($post->canonical, '.html') ? '' : '.html'),
            )
            : '#';

            $postName = !empty($post->name)
            ? $post->name
            : (!empty($post->post_language_detail->name)
            ? $post->post_language_detail->name
            : 'Untitled');

            $publishedAt = !empty($post->released_at)
            ? \Carbon\Carbon::parse($post->released_at)
            : (!empty($post->created_at)
            ? \Carbon\Carbon::parse($post->created_at)
            : now());

            $dayNum = $publishedAt->format('d');
            $monthAbbr = $publishedAt->locale('en')->isoFormat('MMM');
            @endphp

            <article class="pc-news-card">
                <a href="{{ $postUrl }}" class="pc-news-card__link" aria-label="{{ $postName }}">
                    <div class="pc-news-card__image-wrapper">
                        <img src="{{ $postImage }}" alt="{{ $postName }}" class="pc-news-card__image"
                            loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
                            onerror="this.src='{{ asset('images/placeholder-news.jpg') }}'">
                        <div class="pc-news-card__overlay"></div>
                    </div>
                    <div class="pc-news-card__date-badge"
                        aria-label="Ngày đăng: {{ $dayNum }} {{ $monthAbbr }}">
                        <span class="pc-news-card__date-day">{{ $dayNum }}</span>
                        <span class="pc-news-card__date-month">{{ $monthAbbr }}</span>
                    </div>
                    <div class="pc-news-card__content">
                        <h2 class="pc-news-card__title">{{ $postName }}</h2>
                    </div>

                </a>
            </article>
            @endforeach
        </div>

        @if ($posts->hasPages())
        <div class="pc-pagination">
            {{ $posts->links() }}
        </div>
        @endif
        @else
        <div class="pc-empty-state">
            <svg class="pc-empty-state__icon" viewBox="0 0 64 64" fill="none" stroke="currentColor">
                <rect x="8" y="12" width="48" height="40" rx="4" stroke-width="2" />
                <line x1="16" y1="24" x2="48" y2="24" stroke-width="2" />
                <line x1="16" y1="32" x2="40" y2="32" stroke-width="2" />
                <line x1="16" y1="40" x2="32" y2="40" stroke-width="2" />
            </svg>
            <p class="pc-empty-state__text">Chưa có bài viết nào.</p>
        </div>
        @endif
    </div>
</section>
@endsection