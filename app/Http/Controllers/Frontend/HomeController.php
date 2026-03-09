<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\Floorplan;
use App\Models\Gallery;
use App\Models\LocationHighlight;
use App\Models\Agent;
use App\Models\Slide;
use App\Models\VisitRequest;
use App\Repositories\Core\SystemRepository;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    protected $systemRepository;

    public function __construct(
        SystemRepository $systemRepository,
    ) {
        $this->systemRepository = $systemRepository;
        parent::__construct();
    }

    /**
     * Homepage — 9 sections
     */
    public function index()
    {
        $property = Property::where('publish', 2)->first();
        $facilities = PropertyFacility::where('publish', 2)
            ->orderBy('sort_order')
            ->get();
        $floorplans = Floorplan::with('rooms')
            ->where('publish', 2)
            ->orderBy('floor_number')
            ->get();
        $galleries = Gallery::where('publish', 2)
            ->orderBy('id', 'desc')
            ->get();
        $locationHighlights = LocationHighlight::where('publish', 2)
            ->orderBy('sort_order')
            ->get();
        $primaryAgent = Agent::where('is_primary', true)
            ->where('publish', 2)
            ->first();
        $agents = Agent::where('publish', 2)->get();
        $slides = Slide::where('keyword', 'main-slider')
            ->where('publish', 2)
            ->first();

        $system = $this->system;
        $seo = $this->buildSeo();
        $schema = $this->schema($seo);
        $config = $this->config();

        $template = 'frontend.homepage.home.index';
        return view($template, compact(
            'config',
            'seo',
            'system',
            'schema',
            'property',
            'facilities',
            'floorplans',
            'galleries',
            'locationHighlights',
            'primaryAgent',
            'agents',
            'slides',
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
