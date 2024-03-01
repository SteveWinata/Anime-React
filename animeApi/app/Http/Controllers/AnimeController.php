<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();

        if ($animes->isEmpty()) {
            return response([
                "message" => "Animes can't be found"
            ]);
        }

        return response([
            "message" => "Successfully retrieved animes data",
            "animes" => $animes
        ]);
    }
    public function show($slug)
    {
        $anime = Anime::where('slug', $slug)->first();

        if (!$anime) {
            return response([
                "message" => "Anime can't be found"
            ]);
        }

        return response([
            "message" => "Successfully retrieved an anime data",
            "anime" => $anime
        ]);
    }
    public function store(Request $request)
    {
        $vd = Validator::make($request->all(), [
            "title" => "required|min:5",
            "slug" => "required|unique:animes,slug",
            "producer" => "required",
            "synopsis" => "required|min:10"
        ]);

        if ($vd->fails()) {
            return response([
                "message" => "Animes can't be stored",
                "error" => $vd->errors()
            ]);
        }

        $data = $vd->validated();

        Anime::create($data);


        return response([
            "message" => "Successfully inserted animes data",
            "data" => $data
        ]);
    }
    public function update(Request $request, $slug)
    {   
        $anime = Anime::where('slug', $slug)->first();

        $rules = [
            "title" => "required|min:5",
            "producer" => "required",
            "synopsis" => "required|min:10"
        ];

        if($request->get('slug') !== $anime->slug){
            $rules['slug'] = "required|unique:animes,slug";
        }

        $vd = Validator::make($request->all(), $rules);


        if ($vd->fails()) {
            return response([
                "message" => "Animes can't be stored",
                "error" => $vd->errors()
            ]);
        }

        $data = $vd->validated();

        $anime->update($data);


        return response([
            "message" => "Successfully inserted animes data",
            "data" => $data
        ]);
    }
    
    public function destroy($id){
        Anime::destroy($id);
    }
    
    public function createSlug(Request $request)
    {
        $slug = $request->get('slug');

        if(!$slug){
            return response([
                "message" => "There's no slug data",
                "slug" => $slug
            ]);
        }

        if(!Anime::where('slug', $slug)->exists()){
            return response([
                "slug" => $slug
            ]);
        }

        $slug = uniqid();

        return response([
            'slug' => $slug
        ]);
    }
}
