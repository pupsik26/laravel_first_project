<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class Text extends Controller
{
    const HOME = '/';

    public function index()
    {
        return view('text.index', [
            'texts' => \App\Models\Text::getGroupTexts()
        ]);
    }

    public function view(Request $request)
    {
        $texts = $request->all('text');
        $title = $request->get('title');
        $items = [$title => []];

        foreach ($texts as $text) {
            $items[$title] += $text;
        }

        return view('text.view', [
            'items' => $items
        ])->render();
    }

    public function create()
    {
        return view('text.create');
    }

    public function store(Request $request)
    {
        $title_id = Title::saveByTitle($request->get('title'));
        \App\Models\Text::saveArray($request->get('text'), $title_id);
        return redirect()->intended(self::HOME);
    }

}
