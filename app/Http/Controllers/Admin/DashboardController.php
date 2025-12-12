<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $totalComments = Comment::count();
        $totalUsers = User::count();

        $latestNews = News::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $popularNews = News::orderBy('views', 'desc')
            ->take(5)
            ->get();

        $newsPerMonth = News::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $newsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $newsData[] = $newsPerMonth[$i] ?? 0;
        }

        $categoriesChart = Category::withCount('news')
            ->orderBy('news_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalNews',
            'totalCategories',
            'totalTags',
            'totalComments',
            'totalUsers',
            'latestNews',
            'popularNews',
            'months',
            'newsData',
            'categoriesChart'
        ));
    }
}
