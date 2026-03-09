<footer class="linden-footer">
    <div class="uk-container uk-container-center">
        <div class="linden-footer__grid">
            {{-- Column 1: Logo + Description --}}
            <div>
                <div class="linden-footer__logo">
                    <a href="/">
                        <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/img/homely/logo.webp') }}"
                            alt="Linden" style="max-height: 36px; filter: brightness(0) invert(1);">
                    </a>
                </div>
                <div class="linden-footer__desc">
                    {{ $system['homepage_description'] ?? 'Không gian sống sang trọng được thiết kế dành cho cuộc sống hiện đại. Mỗi chi tiết đều được chăm chút tỉ mỉ để mang đến trải nghiệm hoàn hảo.' }}
                </div>
                <div class="linden-footer__socials">
                    @if (!empty($system['social_facebook']))
                        <a href="{{ $system['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a>
                    @endif
                    @if (!empty($system['social_instagram']))
                        <a href="{{ $system['social_instagram'] }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    @endif
                    @if (!empty($system['social_twitter']))
                        <a href="{{ $system['social_twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a>
                    @endif
                    @if (!empty($system['social_youtube']))
                        <a href="{{ $system['social_youtube'] }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
                    @endif
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <div class="linden-footer__title">Khám Phá</div>
                <div class="linden-footer__links">
                    <a href="/">Trang Chủ</a>
                    <a href="{{ url('/gioi-thieu.html') }}">Tòa Nhà</a>
                    <a href="{{ url('/thu-vien-anh.html') }}">Thư Viện Ảnh</a>
                    <a href="{{ url('/tien-nghi.html') }}">Tiện Nghi</a>
                    <a href="{{ url('/xung-quanh.html') }}">Xung Quanh</a>
                    <a href="{{ url('/lien-he.html') }}">Liên Hệ</a>
                </div>
            </div>

            {{-- Column 3: Address --}}
            <div>
                <div class="linden-footer__title">Địa Chỉ</div>
                @if (isset($menu['footer-menu'][0]))
                    @php
                        $addressMenu = $menu['footer-menu'][0];
                    @endphp
                    <div style="color: rgba(255,255,255,0.6); font-size: 14px; line-height: 1.8;">
                        @foreach ($addressMenu['children'] as $child)
                            {!! $child['item']->languages->first()->pivot->name !!}{!! !$loop->last ? '<br>' : '' !!}
                        @endforeach
                    </div>
                @else
                    <div class="linden-footer__contact-item">
                        <i class="fa fa-map-marker"></i>
                        <span>{{ $system['contact_address'] ?? '742 Evergreen Terrace, Quận 7, TP. HCM' }}</span>
                    </div>
                @endif
            </div>

            {{-- Column 4: Contact --}}
            <div>
                <div class="linden-footer__title">Liên Hệ</div>
                @if (isset($menu['footer-menu'][1]))
                    @php
                        $contactMenu = $menu['footer-menu'][1];
                    @endphp
                    <div style="color: rgba(255,255,255,0.6); font-size: 14px; line-height: 1.8;">
                        @foreach ($contactMenu['children'] as $child)
                            {!! $child['item']->languages->first()->pivot->name !!}{!! !$loop->last ? '<br>' : '' !!}
                        @endforeach
                    </div>
                @else
                    <div class="linden-footer__contact-item">
                        <i class="fa fa-phone"></i>
                        <span>{{ $system['contact_hotline'] ?? '(+84) 123 456 789' }}</span>
                    </div>
                    <div class="linden-footer__contact-item">
                        <i class="fa fa-envelope-o"></i>
                        <span>{{ $system['contact_email'] ?? 'info@linden.vn' }}</span>
                    </div>
                    <div class="linden-footer__contact-item">
                        <i class="fa fa-clock-o"></i>
                        <span>T2 - T7: 8:00 - 18:00</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="linden-footer__bottom">
            <div>{!! $system['homepage_copyright'] ?? '© ' . date('Y') . ' Linden. All rights reserved.' !!}</div>
            <div>
                <a href="#" style="color: rgba(255,255,255,0.4);">Chính sách bảo mật</a>
                <span style="margin: 0 8px;">|</span>
                <a href="#" style="color: rgba(255,255,255,0.4);">Điều khoản sử dụng</a>
            </div>
        </div>
    </div>
</footer>
