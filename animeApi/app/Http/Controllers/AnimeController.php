<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();

        if ($animes->isEmpty) {
            return response([
                "message" => "Animes can't be found"
            ]);
        }

        return response([
            "message" => "Successfully retrieved animes data",
            "animes" => $animes
        ]);
    }
    public function show($id)
    {
        $anime = Anime::find($id);

        if ($anime->isEmpty) {
            return response([
                "message" => "Animes can't be found"
            ]);
        }

        return response([
            "message" => "Successfully retrieved an anime data",
            "anime" => $anime
        ]);
    }
    public function store(Request $request)
    {
        // $vd = Validator::make($req)

        // if ($animes->isEmpty) {
        //     return response([
        //         "message" => "Animes can't be found"
        //     ]);
        // }

        // return response([
        //     "message" => "Successfully retrieved animes data",
        //     "animes" => $animes
        // ]);
    }
}
