<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Service;
use App\Models\FarmingItem;
use App\Models\TourismAttraction;
use App\Models\NewsPost;
use App\Models\Media;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'counts' => [
                'leaders'  => Leader::count(),
                'services' => Service::count(),
                'farming'  => FarmingItem::count(),
                'tourism'  => TourismAttraction::count(),
                'news'     => NewsPost::count(),
                'media'    => Media::count(),
            ],
        ]);
    }
}
