<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
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
        return view('text.view', [
            'items' => TextHelper::getArrayTextByView($request->all('text'), $request->get('title'))
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
