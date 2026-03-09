<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\Floorplan;
use App\Models\Agent;
use App\Models\Gallery;
use App\Models\LocationHighlight;
use Illuminate\Http\Request;

class AboutController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * About page
     */
    public function index()
    {
        $property = Property::where('publish', 2)->first();
        $agents = Agent::where('publish', 2)->get();
        $facilities = PropertyFacility::where('publish', 2)
            ->orderBy('id', 'desc')
            ->get();
        $floorplans = Floorplan::with('rooms')
            ->where('publish', 2)
            ->orderBy('floor_number')
            ->get();
        $locationHighlights = LocationHighlight::where('publish', 2)
            ->orderBy('id', 'desc')
            ->get();
        $galleries = Gallery::where('publish', 2)
            ->orderBy('id', 'desc')
            ->get();
        $primaryAgent = Agent::where('is_primary', true)
            ->where('publish', 2)
            ->first();

        $system = $this->system;
        $seo = $this->buildSeo('Tòa Nhà — ' . ($property->name ?? 'Linden Vietnam'));
        $schema = $this->schema($seo);
        $config = $this->config();

        return view('frontend.about.index', compact(
            'config',
            'seo',
            'system',
            'schema',
            'property',
            'agents',
            'facilities',
            'floorplans',
            'locationHighlights',
            'galleries',
            'primaryAgent',
        ));
    }

    // ------ Helpers ------

    private function buildSeo($title = null)
    {
        return [
            'meta_title' => $title ?? ($this->system['seo_meta_title'] ?? 'Homely Vietnam'),
            'meta_keyword' => $this->system['seo_meta_keyword'] ?? '',
            'meta_description' => $this->system['seo_meta_description'] ?? '',
            'meta_image' => $this->system['seo_meta_images'] ?? '',
            'canonical' => config('app.url'),
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
