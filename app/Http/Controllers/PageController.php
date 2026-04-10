<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use App\Models\Leader;
use App\Models\Service;
use App\Models\FarmingItem;
use App\Models\TourismAttraction;
use App\Models\NewsPost;
use App\Models\ContactInfo;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'hero'     => PageSection::where('page', 'home')->where('section', 'hero')->pluck('value', 'key'),
            'about'    => PageSection::where('page', 'home')->where('section', 'about')->pluck('value', 'key'),
            'leaders'  => Leader::visible()->ordered()->get(),
            'services' => Service::visible()->ordered()->get(),
            'news'     => NewsPost::published()->latest('published_at')->take(3)->get(),
            'contact'  => ContactInfo::pluck('value', 'key'),
        ]);
    }

    public function farming(): View
    {
        return view('pages.farming', [
            'hero'  => PageSection::where('page', 'farming')->where('section', 'hero')->pluck('value', 'key'),
            'items' => FarmingItem::visible()->ordered()->get(),
        ]);
    }

    public function tourism(): View
    {
        return view('pages.tourism', [
            'hero'        => PageSection::where('page', 'tourism')->where('section', 'hero')->pluck('value', 'key'),
            'attractions' => TourismAttraction::visible()->ordered()->get(),
        ]);
    }

    public function biography(): View
    {
        $raw = \App\Models\PageSection::where('page', 'biography')->pluck('value', 'key');
        return view('pages.biography', ['content' => $raw]);
    }
}
