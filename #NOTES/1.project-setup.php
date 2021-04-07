<?php

larvel new project-name

//add auth routes and views (ui)
composer require laravel/ui
php artisan ui vue --auth

//check .env for database setup. Rename db if you want
//connect to server in GUI
//create db

//migrate data
php artisan migrate

//add tailwind
https://tailwindcss.com/docs/guides/laravel#configure-tailwind-with-laravel-mix

npm install -D tailwindcss@latest postcss@latest autoprefixer@latest

mix.postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
]);

npm install

npm run dev

//if it fails do this:
https://github.com/JeffreyWay/laravel-mix/issues/307


//add layout and some styling
//example hard code slicks:
@extends('layouts.app')

@section('content')
    <div class="lg:flex lg:justify-between">
        <div class="lg:w-32">
            @include('_sidebar-links')
        </div>
        <div class="lg:flex-1 lg:mx-10" style="max-width:700px">
             @include('_publish-slick-panel')

            <div class="border border-gray-300 rounded-lg">
                @include('_slick')
                @include('_slick')
                @include('_slick')
                @include('_slick')                
            </div>
        </div>
        <div class="lg: w-1/6 bg-blue-100 rounded-lg p-4">
            @include('_friends-list')
        </div>
    </div>
@endsection


//make your data dynamic (eg.slicks)
php artisan make:model Slick -fmc //add a Slick model with a factory, migration and controller


//now edit the migrations.. what does a slick (post) require
//it belongs to a user so you need a user_id foreign key
//and a body

$table->foreignId('user_id');
$table->string('body');

php artisan migrate

//now update you slick factory

//import user model
use App\Models\User;

//and add
return [
  'user_id' =>User::factory(),
  'body' => $this->faker->sentence,
];

php artisan tinker
//FACTORY - use factory to create new data
>>>  Slick::factory()->create();
//create more than one
>>>  Slick::factory()->count(4)->create();
//hard code user id
>>>  Slick::factory()->create(['user_id' => 1]);


//now in the home page you can make the hard coded slicks dynamic - assuming you have access to a slick (which you don't yet)
@foreach ($slicks as $slick)
  @include('_slick') //render partial _slick.blade.php
@endforeach  


//then in your _slick partial file - assuming you have access to a slick (which you don't yet) - we can add the dynamic data
<h5 class="font-bold mb-4">{{$slick->user->name}}</h5>
<p class="text-sm">{{$slick->body}}</p>

//now we need to pass the slicks to the home and _slick partial file
//in home controller import Slick model
use App\Models\Slick;

//then pass all slicks to home page
public function index()
    {
        return view('home',[
            'slicks' => Slick::all()
        ]);
    }

    //OR to order it by latest slicks first

public function index()
    $slicks = Slick::latest()->get();
    return view('home',[
        'slicks' => $slicks
    ]);

//you will get an error about the user name you're trying to call in the _slicks partial
//because you have not yet setup a User -> Slick relationship
public function user() {
  return $this->belongsTo(User::class);
}

//we don't actually want all the slicks. We want the users timeline.
//so in our home controller

public function index()
    {
        return view('home',[
            'slicks' => auth()->user()->timeline();
        ]);
    }

//then in USER MODEL fetch the users slicks
public function timeline()
    {
        return Slick::latest()->get();
    }


//BUT this code will fail as soon as we have slicks by someone we don't follow. For now lets:
//in USER MODEL
public function timeline()
    {
        return Slick::where('user_id', $this->id)->latest()->get();
    }


// we can store the image by users email in a getter in the user model and fetch it

//USER MODEL add getter
public function getAvatarAttribute() {
    return "https://i.pravatar.cc/40?u=" . $this->email;
}


//then in publish-slick-panel fetch the image of the logged in user
<footer class="flex justify-between">
            <img 
                src="{{ auth()->user()->avatar }}"
                alt="" 
                class="rounded-full mr-2"
            >
        <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">slick-a-roo!</button>

        </footer>



//but in the _slick partial (timeline) we need to get the image of user who created the tweet
<div class="flex p-4 border-b border-b gray-400">
    <div class="mr-2 flex-shrink-0">
        <img 
            src="{{ $tweet->user->avatar }}"
            alt="" 
            class="rounded-full mr-2"
        >
        
    </div>

    <div>
        <h5 class="font-bold mb-4">{{$slick->user->name}}</h5>
        <p class="text-sm">{{$slick->body}}</p>
    </div>   
</div>