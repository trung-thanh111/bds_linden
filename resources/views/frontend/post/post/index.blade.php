@extends('frontend.homepage.layout')

@section('content')

@php
$postLang = $post->languages->first()?->pivot;
$postTitle = $postLang?->name ?? ($post->name ?? '');
$postDesc = $postLang?->description ?? '';
$postImage = $post->image ?? null;
$postDate = $post->released_at
? \Carbon\Carbon::parse($post->released_at)
: \Carbon\Carbon::parse($post->created_at);
$catLang = $postCatalogue->languages->first()?->pivot ?? null;
$catName = $catLang?->name ?? ($postCatalogue->name ?? 'Tin tức');
$catUrl = $catLang?->canonical ?? ($postCatalogue->canonical ?? '#');
@endphp

<section class="uk-section uk-flex uk-flex-middle uk-light hero-scroll-effect"
    style="background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.2)),
           url('{{ asset('frontend/resources/img/homely/slider/1.webp') }}') no-repeat center center;
           background-size: 110%; min-height: 400px; padding-top: 100px;">
    <div class="uk-container uk-container-center uk-width-1-1">
        <div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap"
            uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: 100">
            <h1 class="uk-margin-remove title-breadcrumb">{{ $postTitle }}</h1>
            <ul class="uk-breadcrumb uk-margin-remove custom-breadcrumb">
                <li><a href="{{ route('home.index') }}">Trang Chủ</a></li>
                <li><a href="{{ write_url($catUrl) }}">{{ $catName }}</a></li>
                <li><span>{{ \Str::limit($postTitle, 50) }}</span></li>
            </ul>
        </div>
    </div>
</section>

<section class="psd-body-section">
    <div class="uk-container uk-container-center">
        <div class="psd-layout">
            <div class="psd-main">
                <div class="psd-meta">
                    <span class="psd-meta__badge">
                        {{ $postDate->format('d') }} {{ $postDate->translatedFormat('M Y') }}
                    </span>
                    <a href="{{ write_url($catUrl) }}" class="psd-meta__cat">{{ $catName }}</a>
                </div>
                @if ($postImage)
                <figure class="psd-thumb-wrap">
                    <img src="{{ asset($postImage) }}" alt="{{ $postTitle }}" class="psd-thumb"
                        loading="eager" />
                </figure>
                @endif
                @if ($postDesc)
                <div class="psd-excerpt">{!! $postDesc !!}</div>
                @endif
                <div class="psd-content">
                    {!! $contentWithToc ?? $postLang?->content !!}
                </div>
                <div class="psd-share">
                    <span class="psd-share__label">Chia sẻ:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                        target="_blank" rel="noopener" class="psd-share__btn psd-share__btn--fb" title="Facebook">
                        <span uk-icon="icon: facebook"></span>
                    </a>
                </div>

            </div>
            <aside class="psd-sidebar">

                @if (isset($postCatalogue->posts) && $postCatalogue->posts->isNotEmpty())
                <div class="psd-widget">
                    <h4 class="psd-widget__title">Bài viết liên quan</h4>

                    <div class="sidebar-related-list">
                        @foreach ($postCatalogue->posts->where('id', '!=', $post->id)->take(4) as $related)
                        @php
                        $rLang = $related->languages->first()?->pivot;
                        $rTitle = $rLang?->name ?? '';
                        $rUrl = write_url($rLang?->canonical ?? '#');
                        $rImg = $related->image ?? null;
                        $rDate = $related->released_at
                        ? \Carbon\Carbon::parse($related->released_at)
                        : \Carbon\Carbon::parse($related->created_at);
                        @endphp

                        <a href="{{ $rUrl }}" class="src-card" title="{{ $rTitle }}">
                            <div class="src-card__img">
                                <img src="{{ $rImg ? asset($rImg) : asset('frontend/images/no-image.jpg') }}"
                                    alt="{{ $rTitle }}" loading="lazy">
                            </div>
                            <div class="src-card__overlay"></div>
                            <div class="src-card__date">
                                <span class="src-date-day">{{ $rDate->format('d') }}</span>
                                <span class="src-date-month">{{ $rDate->translatedFormat('M') }}</span>
                            </div>
                            <div class="src-card__content">
                                <h5 class="src-card__title">{{ \Str::limit($rTitle, 80) }}</h5>
                            </div>

                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @if (isset($post->tags) && $post->tags->isNotEmpty())
                <div class="psd-widget">
                    <h4 class="psd-widget__title">Popular Tags</h4>
                    <div class="psd-tags">
                        @foreach ($post->tags as $tag)
                        <a href="#" class="psd-tag">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="psd-widget">
                    <h4 class="psd-widget__title">Popular Tags</h4>
                    <div class="psd-tags">
                        @foreach (['Home Care', 'Daily Cleaning', 'Organization Tips', 'Decluttering', 'Minimalist Living', 'Home Maintenance', 'Routine Cleaning', 'Space Management', 'Smart Storage', 'Tidy Home', 'Healthy Living', 'Lifestyle Tips'] as $tag)
                        <a href="#" class="psd-tag">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
                @endif

            </aside>

        </div>
    </div>
</section>

@endsection