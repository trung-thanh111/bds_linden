<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="{{ $seo['meta_description'] ?? '' }}">
<meta name="keyword" content="{{ $seo['meta_keyword'] ?? '' }}">
<meta name="author" content="{{ $system['homepage_company'] ?? '' }}" />
<meta name="copyright" content="{{ $system['homepage_company'] ?? '' }}" />
<meta name="robots" content="index, follow" />
<link rel="canonical" href="{{ $seo['canonical'] ?? '' }}">
<link rel="icon" href="{{ $system['homepage_favicon'] ?? '' }}" type="image/png" sizes="30x30">
<title>{{ $seo['meta_title'] ?? '' }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=Jost:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="{{ asset('frontend/resources/uikit/css/uikit.modify.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/resources/library/css/library.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/resources/plugins/wow/css/libs/animate.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/resources/style.css') }}">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('frontend/resources/css/linden.css') }}">

<script type="text/javascript">
    var BASE_URL = '{{ config('app.url') }}';
    var SUFFIX = '{{ config('apps.general.suffix') }}';
    window.LindenConfig = {
        csrfToken: '{{ csrf_token() }}',
        visitRequestUrl: '{{ route('visit-request.store') }}'
    };
</script>
<link rel="canonical" href="{{ $seo['canonical'] }}" />
<meta property="og:locale" content="vi_VN" />
<!-- for Facebook -->
<meta property="og:title" content="{{ $seo['meta_title'] }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ $seo['meta_image'] }}" />
<meta property="og:url" content="{{ $seo['canonical'] }}" />
<meta property="og:description" content="{{ $seo['meta_description'] }}" />
<meta property="og:site_name" content="" />
<meta property="fb:admins" content="" />
<meta property="fb:app_id" content="" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $seo['meta_title'] }}" />
<meta name="twitter:description" content="{{ $seo['meta_description'] }}" />
<meta name="twitter:image" content="{{ $seo['meta_image'] }}" />

<script src="{{ asset('vendor/frontend/library/js/jquery.js') }}"></script>
