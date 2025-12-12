<?php

namespace App\Http\Controllers;

use App\Models\News;
use Barryvdh\DomPDF\Facade\Pdf;

class NewsController extends Controller
{
    public function downloadPDF($slug)
    {
        $news = News::with(['category', 'user', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $pdf = Pdf::loadView('pdf.news', compact('news'));

        return $pdf->download('berita-' . $news->slug . '.pdf');
    }

    public function downloadReport()
    {
        $news = News::with(['category', 'user'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.report', compact('news'));

        return $pdf->download('laporan-berita-' . date('Y-m-d') . '.pdf');
    }
}
