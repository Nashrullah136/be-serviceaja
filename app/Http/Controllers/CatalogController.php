<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogRequest;
use App\Http\Resources\CatalogResource;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');
        $result = Catalog::select('*');
        if($category !== 'all'){
            $result = $result->where('category', $category);
        }
        $result = $result->orderBy('name')->get();
        return CatalogResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogRequest $request)
    {
        $catalog = new Catalog();
        $catalog->name = $request->name;
        $catalog->price = $request->price;
        $catalog->category = $request->category;
        $catalog->image = $request->image;
        $catalog->number_series = $request->number_series;
        $catalog = $catalog->save();
        return new CatalogResource($catalog);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        return new CatalogResource($catalog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogRequest $request, Catalog $catalog)
    {
        $catalog->name = $request->name;
        $catalog->price = $request->price;
        $catalog->category = $request->category;
        $catalog->image = $request->image;
        $catalog = $catalog->save();
        return new CatalogResource($catalog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return new CatalogResource($catalog);
    }
}
