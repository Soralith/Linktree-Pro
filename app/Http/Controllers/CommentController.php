<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, News $news)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu untuk berkomentar.');
        }

        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'news_id' => $news->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        return redirect()->back()->with('success', 'Komentar Anda telah berhasil ditambahkan.');
    }
}
