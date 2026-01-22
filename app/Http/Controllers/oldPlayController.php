<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function create()
    {
        return view('play.create');        
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $subuser_ids = [];

        foreach ($request->names as $name) {
            $subuser = Subuser::create([
                'user_id' => $user->id,
                'name' => $name,
            ]);

            $subuser_ids[] = $subuser->id;
        }

        session(['created_subuser_ids' => $subuser_ids]);

        return redirect()->route('play.show');
        
    }

    public function show()
    {
        $user = auth()->user();

        $subusers = Subuser::whereIn(
            'id', session('created_subuser_ids') //idがセッションに保存されたidsのものだけ
        )->get();

        return view('play.show', compact('user', 'subusers'));

    }





}
