<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\Catalog;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');
        $result = News::select('*');
        if($category !== 'all'){
            $result = $result->where('category', $category);
        }
        $result = $result->orderByDesc('updated_at')->get();
        return NewsResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->body = $request->body;
        $news->image = $request->image;
        $news->save();
        return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->title = $request->title;
        $news->body = $request->body;
        $news->image = $request->image;
        $news->save();
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return new NewsResource($news);
    }
}
