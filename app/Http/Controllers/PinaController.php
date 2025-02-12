<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pina;

class PinaController extends Controller
{
    public function index(Request $request)
    {
        $posts = Pina::all()->sortByDesc('updated_at');

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('pina.index', ['headline' => $headline, 'posts' => $posts]);
    }

    public function showPets(Request $request)
    {
        $posts = Pina::where('type', 'pet')->orderByDesc('updated_at')->get();

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('pina.index', ['headline' => $headline, 'posts' => $posts]);
    }

    public function showYacho(Request $request)
    {
        $posts = Pina::where('type', 'yacho')->orderByDesc('updated_at')->get();

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('pina.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
