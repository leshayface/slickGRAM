<?php

//UPDATE CREATE FORM in _publish-slick-panel

//we need a POST request to slicks
//&& add csrf

<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
  <form method="POST" action="slicks">
    @csrf
        <textarea 
        name="body"
        class="w-full" 
        placeholder="What's up doc?"
        required
        ></textarea>

        <hr class="my-4">

        <footer class="flex justify-between">
            <img 
                src="{{ auth()->user()->avatar }}"
                alt="" 
                class="rounded-full mr-2"
            >
        <button
          type="submit"
          class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">
            slick-a-roo!
        </button>

        </footer>

    </form>
</div>


//then create the slicks endpoint in routes file (above Auth::routes();)
Route::post('/slicks', 'SlickController@store');

//now we need a store action in the controller to persist the slick
//the user_id will be the authenticated users id and the body will be the request from the form
public function store() {
  Slick::create([
    'user_id' => auth()->id(),
    'body' => request('body')
  ])
}

//then because we are mass assigning we need to set fillable fields or turn it off in slick model
class Slick extends Model
{
    use HasFactory;

    protected $guarded = [];


//we can then validate the request in the controller store method and use it in our persist
public function store() {
  $attributes = request()->validate(['body' => 'required|max:255']);

  Slick::create([
    'user_id' => auth()->id(),
    'body' => $attributes['body']
  ]);

//redirect home

return redirect('/home');



//YOU SHOULD NOW BE ABLE TO CREATE A NEW TWEET USING THE FORM AND DISPLAY IT



//instead of using required in form textarea (body) use a catch error


<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    // <form action="">
    //     <textarea 
    //     name="body"
    //     class="w-full" 
    //     placeholder="What's up doc?"
    //     ></textarea>

    //     <hr class="my-4">

    //     <footer class="flex justify-between">
    //         <img 
    //             src="{{ auth()->user()->avatar }}"
    //             alt="" 
    //             class="rounded-full mr-2"
    //         >
    //     <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">slick-a-roo!</button>

    //     </footer>

    // </form>

    @error('body')
      <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

//ERROR SHOULD display if text is too long or if field is empty

