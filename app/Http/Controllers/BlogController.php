<?php

namespace App\Http\Controllers;

use App\Services\NewsApiService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $newsApiService;

    public function __construct(NewsApiService $newsApiService)
    {
        $this->newsApiService = $newsApiService;
    }

    public function index(Request $request)
    {
        $articles = $this->newsApiService->getArticles($request->query('page', 1));

        //dd($articles);

        return view('blog.index', compact('articles'));
    }
}
