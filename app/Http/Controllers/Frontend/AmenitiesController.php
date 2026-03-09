<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\Gallery;
use Illuminate\Http\Request;

class AmenitiesController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $property = Property::where('publish', 2)->first();
        $facilities = PropertyFacility::where('publish', 2)
            ->orderBy('id', 'desc')
            ->get();
        $galleries = Gallery::where('publish', 2)
            ->orderBy('id', 'desc')
            ->get();

        $system = $this->system;
        $seo = $this->buildSeo('Tiện Nghi — ' . ($property->name ?? 'Linden Vietnam'));
        $schema = $this->schema($seo);
        $config = $this->config();

        return view('frontend.amenities.index', compact(
            'config',
            'seo',
            'system',
            'schema',
            'property',
            'facilities',
            'galleries'
        ));
    }

    private function buildSeo($title = null)
    {
        return [
            'meta_title' => $title ?? ($this->system['seo_meta_title'] ?? 'Linden Vietnam'),
            'meta_keyword' => $this->system['seo_meta_keyword'] ?? '',
            'meta_description' => $this->system['seo_meta_description'] ?? '',
            'meta_image' => $this->system['seo_meta_images'] ?? '',
            'canonical' => url('/tien-nghi.html'),
        ];
    }

    public function schema(array $seo = []): string
    {
        return "<script type='application/ld+json'>
            {
                \"@context\": \"https://schema.org\",
                \"@type\": \"WebSite\",
                \"name\": \"" . ($seo['meta_title'] ?? '') . "\",
                \"url\": \"" . ($seo['canonical'] ?? '') . "\",
                \"description\": \"" . ($seo['meta_description'] ?? '') . "\"
            }
        </script>";
    }

    private function config()
    {
        return [
            'language' => $this->language,
            'css' => [],
            'js' => []
        ];
    }
}
