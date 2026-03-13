@extends('frontend.homepage.layout')
@section('content')
    <script>
        window.LindenHeroSettings = <?php echo isset($slides) && isset($slides->setting) && is_array($slides->setting) ? json_encode($slides->setting) : 'null'; ?>;
    </script>
    <div id="scroll-progress"></div>

    <div class="linden-page">

        <section class="ln-hero">
            <div class="ln-hero__content">
                <div class="ln-hero__badge">{{ $property->status ?? 'ĐANG MỞ BÁN' }}</div>
                <h1 class="ln-hero__title">{{ $property->tagline ?? 'Không Gian Sống Sang Trọng Cho Cuộc Sống Hiện Đại' }}
                </h1>
                <div class="ln-hero__tagline uk-container">
                    {{ $property->description_short ?? 'Nơi mỗi chi tiết đều được chăm chút tỉ mỉ' }}</div>
                <div class="ln-hero__buttons">
                    <a href="/thu-vien-anh.html" class="ln-btn-outline">Khám Phá</a>
                    <a href="/lien-he.html" class="ln-btn">Đặt Lịch Tham Quan</a>
                </div>
            </div>

            <div class="ln-hero__bottom">
                <div class="ln-hero__address"><i class="fa fa-map-marker"></i>
                    {{ $property->address ?? '742 Evergreen Terrace, Quận 7, TP. HCM' }}</div>
                <div class="ln-hero__price">
                    {{ number_format($property->price ?? 0, 0, ',', '.') }} {{ $property->price_unit ?? 'Tỷ' }}
                    <span>Giá bán</span>
                </div>
            </div>

            <a href="#about-section" class="ln-hero__scroll-indicator"><i class="fa fa-angle-down"></i></a>
            <div class="ln-hero__watermark">LINDEN</div>

            <div class="swiper ln-hero-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"
                        style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}')">
                    </div>
                    @if ($galleries->count() > 0)
                        @foreach ($galleries as $gallery)
                            @if (is_array($gallery->album))
                                @foreach ($gallery->album as $img)
                                    <div class="swiper-slide" style="background-image: url('{{ $img }}')"></div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <section class="ln-project-overview"
            style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
            <div class="uk-grid uk-grid-collapse" data-reveal="up">
                <div class="uk-width-medium-1-2 uk-hidden-small">

                </div>
                <div class="uk-width-medium-1-2 uk-width-small-1-1">
                    <div class="ln-project-overview__content">
                        <h2 class="overview-title">Tổng Quan Dự Án</h2>
                        <ul class="overview-list">
                            <li><span>Tên dự án:</span> {{ $property->title ?? 'Linden Residence' }}</li>
                            <li><span>Vị trí:</span> {{ $property->address ?? '184 Trần Văn Kiểu, P. 10, Q. 6, Tp.HCM' }}
                            </li>
                            @if (!empty($property->investor))
                                <li><span>Chủ đầu tư:</span> {{ $property->investor }}</li>
                            @endif
                            <li><span>Thời gian hoàn thành:</span> {{ $property->year_built ?? '5/2021' }}</li>
                            <li><span>Diện tích dự án:</span> {{ $property->area_sqm ?? '4.274,1' }} m2</li>
                            <li><span>Quy mô dự án:</span> {{ $property->floors ?? '373' }} tầng nổi,
                                {{ $property->bedrooms ?? '19' }} phòng</li>
                            <li><span>Giá bán:</span> {{ number_format($property->price ?? 0, 0, ',', '.') }}
                                {{ $property->price_unit ?? 'Tỷ' }}</li>
                            <li><span>Trạng thái:</span> {{ $property->status ?? 'Đang mở bán' }}</li>
                            <li><span>Thời hạn sở hữu:</span> Lâu dài</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-about" id="about-section">
            <div class="uk-container uk-container-center">
                <div class="ln-about__grid">
                    <div class="ln-about__text" data-reveal="left">
                        <div class="ln-label">Giới thiệu dự án</div>
                        <h2 class="ln-section-title">{{ $property->title ?? 'Linden Residence' }}</h2>
                        <div class="ln-section-desc">{!! $property->description ??
                            'Ngôi nhà đặc biệt này mang đến không gian sống tinh tế với những không gian mở rộng rãi, nội thất sáng sủa và thiết kế hiện đại ấm áp.' !!}</div>
                        <div style="margin-top: 30px;">
                            <a href="/bat-dong-san.html" class="ln-btn">Tìm Hiểu Thêm</a>
                        </div>
                        <div class="ln-about__awards">
                            <div class="ln-about__award">
                                <div class="ln-about__award-icon"><i class="fa fa-trophy"></i></div>
                                <div class="ln-about__award-text">Giải Thưởng<br>Thiết Kế Quốc Tế</div>
                            </div>
                            <div class="ln-about__award">
                                <div class="ln-about__award-icon"><i class="fa fa-star"></i></div>
                                <div class="ln-about__award-text">Lux Life<br>Magazine</div>
                            </div>
                        </div>
                    </div>

                    <div class="ln-about__images" data-reveal="right">
                        @php
                            $aboutImg0 = $property->image ?? asset('frontend/resources/img/homely/slider/1.webp');
                            $aboutImg1 = null;
                            if ($galleries->count() > 0 && is_array($galleries->first()->album)) {
                                $album = $galleries->first()->album;
                                if (isset($album[0])) {
                                    $aboutImg0 = $album[0];
                                }
                                if (isset($album[1])) {
                                    $aboutImg1 = $album[1];
                                }
                            }
                        @endphp
                        <div class="ln-about__img-main"><img src="{{ $aboutImg0 }}"
                                alt="{{ $property->title ?? 'Property' }}"></div>
                        @if ($aboutImg1)
                            <div class="ln-about__img-secondary"><img src="{{ $aboutImg1 }}" alt="Interior"></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-details">
            <div class="uk-container uk-container-center">
                <div class="ln-details__header" data-reveal="up">
                    <div class="ln-label ln-label-center">Thông Tin</div>
                    <h2 class="ln-section-title" style="text-align:center;">Chi Tiết Dự Án</h2>
                </div>

                <div class="ln-details__top" data-reveal="up">
                    <div class="ln-details__top-item">
                        <div class="item-label">Loại hình</div>
                        <div class="item-value"><i class="fa fa-home"></i> <span>Nhà Riêng</span></div>
                    </div>
                    <div class="ln-details__top-item">
                        <div class="item-label">Phòng ngủ</div>
                        <div class="item-value"><i class="fa fa-bed"></i> <span>x{{ $property->bedrooms ?? '3' }}</span>
                        </div>
                    </div>
                    <div class="ln-details__top-item">
                        <div class="item-label">Phòng tắm</div>
                        <div class="item-value"><i class="fa fa-bath"></i> <span>x{{ $property->bathrooms ?? '2' }}</span>
                        </div>
                    </div>
                    <div class="ln-details__top-item">
                        <div class="item-label">Diện tích</div>
                        <div class="item-value"><i class="fa fa-arrows-alt"></i> <span>{{ $property->area_sqm ?? '—' }}
                                m²</span></div>
                    </div>
                </div>

                <div class="ln-details__bottom" data-reveal="up">
                    <div class="ln-details__bottom-item">
                        <div class="item-label">Chỗ đỗ xe</div>
                        <div class="item-value"><i class="fa fa-car"></i>
                            {{ $property->parking_spots ?? '—' }}</div>
                    </div>
                    <div class="ln-details__bottom-item">
                        <div class="item-label">Số tầng</div>
                        <div class="item-value"><i class="fa fa-building-o"></i> {{ $property->floors ?? '—' }}
                        </div>
                    </div>
                    <div class="ln-details__bottom-item">
                        <div class="item-label">Năm xây dựng</div>
                        <div class="item-value"><i class="fa fa-calendar-o"></i> {{ $property->year_built ?? '—' }}
                        </div>
                    </div>
                    <div class="ln-details__bottom-item">
                        <div class="item-label">Vị trí</div>
                        <div class="item-value"><i class="fa fa-map-marker"></i>
                            {{ $property->district ?? 'Quận 7' }}, {{ $property->city ?? 'TP. HCM' }}
                        </div>
                    </div>
                    <div class="ln-details__bottom-item">
                        <div class="item-label">Giá tiền</div>
                        <div class="item-value"><i class="fa fa-tag"></i>
                            {{ number_format($property->price ?? 0, 0, ',', '.') }}
                            {{ $property->price_unit ?? 'Tỷ' }}</div>
                    </div>
                    <div class="ln-details__bottom-item">
                        <div class="item-label">Địa chỉ</div>
                        <div class="item-value"><i class="fa fa-location-arrow"></i> {{ $property->address ?? '—' }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-gallery-preview">
            <div class="uk-container uk-container-center">
                <div class="ln-gallery-preview__header">
                    <div>
                        <div class="ln-label" data-reveal="fade">Bộ Sưu Tập</div>
                        <h2 class="ln-section-title" data-reveal="up">Không Gian Sống Đẳng Cấp</h2>
                    </div>
                    <div data-reveal="fade">
                        <a href="/thu-vien-anh.html" class="ln-btn">Xem Tất Cả</a>
                    </div>
                </div>

                <div class="ln-gallery-preview__grid" data-reveal="up">
                    @php $allImages = collect(); @endphp
                    @if ($galleries->count() > 0)
                        @foreach ($galleries as $gallery)
                            @if (is_array($gallery->album))
                                @foreach ($gallery->album as $img)
                                    @php $allImages->push(['url' => $img, 'name' => $gallery->name ?? 'Không gian sống']); @endphp
                                @endforeach
                            @endif
                        @endforeach
                    @endif

                    @if ($allImages->count() > 0)
                        @foreach ($allImages->take(5) as $img)
                            <a href="{{ $img['url'] }}" class="ln-gallery-preview__item" data-fancybox="gallery"
                                data-caption="{{ $img['name'] }}">
                                <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}">
                                <div class="gallery-overlay"><span class="gallery-zoom"><i
                                            class="fa fa-expand"></i></span></div>
                                <div class="gallery-caption">{{ $img['name'] }}</div>
                            </a>
                        @endforeach
                    @else
                        @php $roomNames = ['Phòng Khách', 'Phòng Ngủ', 'Phòng Ăn', 'Nhà Bếp', 'Phòng Tắm']; @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            <a href="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                class="ln-gallery-preview__item" data-fancybox="gallery"
                                data-caption="{{ $roomNames[$i - 1] }}">
                                <img src="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                    alt="{{ $roomNames[$i - 1] }}">
                                <div class="gallery-overlay"><span class="gallery-zoom"><i
                                            class="fa fa-expand"></i></span></div>
                                <div class="gallery-caption">{{ $roomNames[$i - 1] }}</div>
                            </a>
                        @endfor
                    @endif
                </div>
            </div>
        </section>

        @if (!empty($property->video_tour_url))
            <section class="ln-video"
                style="position: relative; width: 100%; height: 600px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.4);"></div>

                <div style="position: relative; z-index: 2; text-align: center; margin-bottom: 60px;">
                    <div class="ln-label ln-label-center"
                        style="color: var(--ln-white); border-color: rgba(255,255,255,0.4);" data-reveal="fade">Trải
                        Nghiệm Thực Tế</div>
                    <h2 class="ln-section-title" style="color: var(--ln-white); margin-bottom: 0;" data-reveal="up">Góc
                        nhìn từ trong căn hộ</h2>
                </div>

                <a href="{{ $property->video_tour_url }}" data-fancybox class="ln-video-play-btn">
                    <i class="fa fa-play" style="margin-left: 6px;"></i>
                </a>
            </section>
        @endif

        <section class="ln-floorplan">
            <div class="uk-container uk-container-center">
                <div class="uk-text-center" style="margin-bottom: 50px;">
                    <div class="ln-label ln-label-center" data-reveal="fade">Sơ đồ căn hộ</div>
                    <h2 class="ln-section-title" data-reveal="up">Khám Phá Không Gian</h2>
                </div>

                <div class="ln-floorplan__grid">
                    <div data-reveal="left">
                        @if ($floorplans->count() > 0)
                            <ul class="ln-floorplan__tabs uk-subnav" data-uk-switcher="{connect:'#floorplan-switcher'}">
                                @foreach ($floorplans as $index => $floor)
                                    <li><a
                                            href="#">{{ $floor->floor_label ?? 'Tầng ' . ($floor->floor_number ?? $index + 1) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul id="floorplan-switcher" class="uk-switcher">
                                @foreach ($floorplans as $floor)
                                    <li>
                                        <div class="ln-floorplan__image"><img
                                                src="{{ strpos($floor->plan_image, 'http') === 0 ? $floor->plan_image : asset($floor->plan_image ?? 'frontend/resources/img/homely/misc/floorplan.webp') }}"
                                                alt="{{ $floor->floor_label }}"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="ln-floorplan__image"><img
                                    src="{{ asset('frontend/resources/img/homely/misc/floorplan.webp') }}"
                                    alt="Sơ đồ tầng"></div>
                        @endif
                    </div>

                    <div data-reveal="right">
                        <div class="ln-floorplan__short-desc">Mỗi tầng được thiết kế thông minh, tối ưu không gian sống và
                            ánh sáng tự nhiên cho toàn bộ gia đình.</div>
                        <div class="ln-spec-grid">
                            <div class="ln-spec-card"><i class="fa fa-arrows-alt"></i>
                                <div class="spec-text"><span>{{ $property->area_sqm ?? '—' }} m²</span><br>Diện tích</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-bed"></i>
                                <div class="spec-text"><span>{{ $property->bedrooms ?? '—' }}</span><br>Phòng ngủ</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-bath"></i>
                                <div class="spec-text"><span>{{ $property->bathrooms ?? '—' }}</span><br>Phòng tắm</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-car"></i>
                                <div class="spec-text"><span>{{ $property->parking_spots ?? '—' }}</span><br>Chỗ đỗ xe
                                </div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-building"></i>
                                <div class="spec-text"><span>{{ $property->floors ?? '—' }}</span><br>Số tầng</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-calendar"></i>
                                <div class="spec-text"><span>{{ $property->year_built ?? '—' }}</span><br>Năm xây dựng
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-schedule">
            <div class="uk-container uk-container-center">
                <div class="ln-schedule__form-header" data-reveal="up">
                    <div class="ln-label ln-label-center">Tôi Sẵn Sàng Hỗ Trợ</div>
                    <h2 class="ln-section-title" style="text-align:center;">Liên Hệ Với Chúng Tôi</h2>
                    <p class="ln-section-desc" style="margin: 0 auto; text-align:center;">Bạn quan tâm đến dự án? Đừng
                        ngần ngại liên hệ để được tư vấn và đặt lịch tham quan.</p>
                </div>
                <div class="ln-schedule__grid">
                    <div class="ln-schedule__agent-card" data-reveal="left">
                        @php $contactAgent = $primaryAgent ?? ($agents->first() ?? null); @endphp
                        @if ($contactAgent)
                            @if ($contactAgent->avatar ?? $contactAgent->image)
                                <img src="{{ $contactAgent->avatar ?? $contactAgent->image }}"
                                    alt="{{ $contactAgent->full_name }}">
                            @else
                                <div class="ln-avatar-fallback"
                                    style="width:280px;height:340px;margin:0 auto 24px;border-radius:0;font-size:60px;"><i
                                        class="fa fa-user"></i></div>
                            @endif
                            <div class="agent-name">{{ $contactAgent->full_name }}</div>
                            <div class="agent-role">Chuyên Viên Tư Vấn</div>
                            <div class="agent-contact">
                                <a href="tel:{{ $contactAgent->phone }}"><i class="fa fa-phone"></i>
                                    {{ $contactAgent->phone }}</a>
                                @if ($contactAgent->email ?? false)
                                    <a href="mailto:{{ $contactAgent->email }}"><i class="fa fa-envelope-o"></i>
                                        {{ $contactAgent->email }}</a>
                                @endif
                            </div>
                        @else
                            <div class="ln-avatar-fallback"
                                style="width:280px;height:340px;margin:0 auto 24px;border-radius:0;font-size:60px;"><i
                                    class="fa fa-user"></i></div>
                            <div class="agent-name">Tư Vấn Viên</div>
                            <div class="agent-role">Chuyên Viên Tư Vấn</div>
                            <div class="agent-contact"><a href="#"><i class="fa fa-phone"></i> (+84) 123 456
                                    789</a></div>
                        @endif
                    </div>

                    <div class="ln-schedule__form-wrapper" data-reveal="right">
                        <form id="visit-request-form" method="post" action="{{ route('visit-request.store') }}">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1" style="margin-bottom:25px;"><input type="text"
                                        name="full_name" placeholder="Họ và tên *" required class="ln-input"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="email" name="email" placeholder="Email *" class="ln-input"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="text" name="phone" placeholder="Số điện thoại *" required
                                        class="ln-input"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="text" name="preferred_date" placeholder="Ngày hẹn" class="ln-input"
                                        onfocus="this.type='date'" onblur="if(!this.value){this.type='text'}"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="text" name="preferred_time" placeholder="Giờ hẹn" class="ln-input"
                                        onfocus="this.type='time'" onblur="if(!this.value){this.type='text'}"></div>
                                <div class="uk-width-1-1" style="margin-bottom:25px;">
                                    <textarea name="message" class="ln-input ln-textarea" placeholder="Tin nhắn của bạn"></textarea>
                                </div>
                                <div class="uk-width-1-1"><button type="submit" class="ln-btn-submit">Gửi Tin
                                        Nhắn</button></div>
                            </div>
                            <div class="visit-form-success"
                                style="display:none;margin-top:20px;padding:24px;background:var(--ln-cream);text-align:center;">
                                <h4 style="margin-bottom:8px;color:var(--ln-dark);">Yêu Cầu Đã Được Ghi Nhận!</h4>
                                <p style="color:var(--ln-gray);margin:0;">Cảm ơn bạn. Đội ngũ của chúng tôi sẽ liên hệ sớm
                                    nhất.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>


@endsection
