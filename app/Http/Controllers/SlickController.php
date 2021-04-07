<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlickController extends Controller
{
    public function store() {
        $attributes = request()->validate(['body' => 'required|max:255']);
      
        Slick::create([
          'user_id' => auth()->id(),
          'body' => $attributes['body']
        ]);

        return redirect('/home');
    }
}
