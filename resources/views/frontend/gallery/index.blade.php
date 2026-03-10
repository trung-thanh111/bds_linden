@extends('frontend.homepage.layout')
@section('header-class', 'header-inner')
@section('content')
    <div id="scroll-progress"></div>
    <div class="linden-page">

        <section class="ln-page-header"
            style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
            <div class="ln-page-header__content">
                <div class="uk-container uk-container-center">
                    <div class="ln-page-header__breadcrumb">
                        <a href="{{ route('home.index') }}">Trang Chủ</a>
                        <span class="separator">/</span>
                        <span class="current-page">Thư Viện Ảnh</span>
                    </div>
                    <h1 class="ln-page-header__title">Thư Viện Ảnh</h1>
                    <div class="ln-page-header__desc">Khám phá bộ sưu tập hình ảnh nội thất và ngoại thất tuyệt đẹp của
                        {{ $property->title ?? 'dự án' }}.</div>
                </div>
            </div>
        </section>

        <section class="ln-gallery-page">
            <div class="uk-container uk-container-center">
                @php
                    $allImages = collect();
                    $exteriorImages = collect();
                    $interiorImages = collect();
                    if ($galleries->count() > 0) {
                        foreach ($galleries as $gallery) {
                            if (is_array($gallery->album)) {
                                $type = strtolower($gallery->name ?? '');
                                foreach ($gallery->album as $img) {
                                    $allImages->push(['url' => $img, 'name' => $gallery->name ?? '']);
                                    if (
                                        str_contains($type, 'ngoại') ||
                                        str_contains($type, 'exterior') ||
                                        str_contains($type, 'ngoai')
                                    ) {
                                        $exteriorImages->push(['url' => $img, 'name' => $gallery->name ?? '']);
                                    } else {
                                        $interiorImages->push(['url' => $img, 'name' => $gallery->name ?? '']);
                                    }
                                }
                            }
                        }
                    }
                    if ($exteriorImages->count() === 0 && $interiorImages->count() === 0 && $allImages->count() > 0) {
                        $interiorImages = $allImages;
                    }
                @endphp

                <ul class="uk-subnav ln-gallery-page__tabs" data-uk-switcher="{connect:'#gallery-tabs'}" data-reveal="up">
                    <li><a href="#">Tất Cả</a></li>
                    <li><a href="#">Ngoại Thất</a></li>
                    <li><a href="#">Nội Thất</a></li>
                </ul>

                <ul id="gallery-tabs" class="uk-switcher">
                    <li>
                        <div class="ln-gallery-page__grid">
                            @if ($allImages->count() > 0)
                                @foreach ($allImages as $img)
                                    <a href="{{ $img['url'] }}" class="ln-gallery-page__item" data-fancybox="gallery-all"
                                        data-caption="{{ $img['name'] }}" data-reveal="up">
                                        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                        <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                    class="fa fa-expand"></i></span></div>
                                    </a>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= 6; $i++)
                                    <a href="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                        class="ln-gallery-page__item" data-fancybox="gallery-all" data-reveal="up">
                                        <img src="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                            alt="Gallery {{ $i }}" loading="lazy">
                                        <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                    class="fa fa-expand"></i></span></div>
                                    </a>
                                @endfor
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="ln-gallery-page__grid">
                            @if ($exteriorImages->count() > 0)
                                @foreach ($exteriorImages as $img)
                                    <a href="{{ $img['url'] }}" class="ln-gallery-page__item" data-fancybox="gallery-ext"
                                        data-caption="{{ $img['name'] }}" data-reveal="up">
                                        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                        <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                    class="fa fa-expand"></i></span></div>
                                    </a>
                                @endforeach
                            @else
                                <div style="padding:60px;text-align:center;color:var(--ln-gray);grid-column:1/-1;">Chưa có
                                    hình ảnh ngoại thất</div>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="ln-gallery-page__grid">
                            @if ($interiorImages->count() > 0)
                                @foreach ($interiorImages as $img)
                                    <a href="{{ $img['url'] }}" class="ln-gallery-page__item" data-fancybox="gallery-int"
                                        data-caption="{{ $img['name'] }}" data-reveal="up">
                                        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                        <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                    class="fa fa-expand"></i></span></div>
                                    </a>
                                @endforeach
                            @else
                                <div style="padding:60px;text-align:center;color:var(--ln-gray);grid-column:1/-1;">Chưa có
                                    hình ảnh nội thất</div>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </section>

    </div>
    <button id="back-to-top"><i class="fa fa-angle-up"></i></button>
@endsection
