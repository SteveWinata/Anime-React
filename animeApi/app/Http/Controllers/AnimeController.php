<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimeUpdateRequest;
use App\Models\Anime;
use Illuminate\Http\Request;
use App\Http\Resources\AnimeResource;
use App\Http\Requests\StoreAnimeRequest;
use App\Http\Requests\UpdateAnimeRequest;
use Illuminate\Support\Facades\Validator;

class AnimeController extends Controller
{
    public function index()
    {
        // $animes = Anime::all();
        $animes = Anime::get();

        if ($animes->isEmpty()) {
            return response([
                'message' => "Animes can't be found"
            ]);
        }

        return AnimeResource::collection($animes)
            ->additional([
                'message' => 'Successfully retrieved animes data'
            ])
            ->response()
            ->setStatusCode(200);

        // return response([
        //     'message' => "Successfully retrieved animes data",
        //     "animes" => $animes
        // ]);
    }
    public function show($slug)
    {
        $anime = Anime::whereSlug($slug)->first();

        if (!$anime) {
            return response([
                "message" => "Anime can't be found"
            ], 404);
        }

        return (new AnimeResource($anime))
            ->additional([
                'message' => 'Successfully retrieved anime data'
            ])
            ->response()
            ->setStatusCode(200);
    }
    public function store(StoreAnimeRequest $request)
    {
        // $vd = $request->validated();
        $anime = Anime::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'synopsis' => $request->synopsis,
            'producer' => $request->producer
        ]);


        return (new AnimeResource($anime))
            ->additional([
                'message' => 'Successfully created anime data'
            ]);
        // ->response();
        // ->setStatusCode(200);
    }

    public function update(AnimeUpdateRequest $request, Anime $anime)
    {
        // if($request->slug === $slug){

        // }
        $anime->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'synopsis' => $request->synopsis,
            'producer' => $request->producer
        ]);

        return (new AnimeResource($anime))
            ->additional([
                'message' => 'Successfully updated anime data'
            ]);
    }

    public function destroy(Anime $anime)
    {
        $anime->delete();

        return response(["message" => "Successfully deleted anime data"]);
    }

    public function createSlug(Request $request)
    {
        $slug = $request->get('slug');

        if (!$slug) {
            return response([
                "message" => "There's no slug data",
                "slug" => $slug
            ]);
        }

        if (!Anime::where('slug', $slug)->exists()) {
            return response([
                "slug" => $slug
            ]);
        }

        $slug = uniqid();
        while (Anime::where('slug', $slug)->exists()) {
            $slug = uniqid();
        }

        return response([
            'slug' => $slug
        ]);
    }
}
