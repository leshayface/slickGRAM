<?php

//we need to add a new relationship where users can follow users and display a list of followers


//lets start in the friends list (_friends-list-blade.php)

<h3 class="font-bold text-xl mb-4">Followers</h3>
<ul>
    @foreach(auth()->user()->follows as $user)
        <li class="mb-4">
            <div class="flex items-center text-sm">
                <img src="{{ $user->avatar }}"
                alt=""
                class="rounded-full mr-2">
                {{ $user->name }}
            </div>
        </li>
    @endforeach
</ul>


//WILL FAIL because we don't have a follows relationship

//in USER MODEL as user can follow many users so we need a belongsToMany relationship (many to many)

public function follows() {
  //be explicit that table name is not user_user. Also specify ids.
  return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
}

***//STOPPED HERE (PHP ERROR)

//then we need a table to store the user and who it belongs to / follows (many to many)
php artisan make:migration create_follows_table


//in the new tables schema (add many to many table schema):
Schema::create('follows', function (Blueprint $table) {
  $table->primary(['user_id', 'following_user_id']);
  $table->foreignId('user_id');
  $table->foreignId('following_user_id');
  $table->timestamps();
});

//and add the neccesary contraints for if you delete the user

$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

$table->foreign('following_user_id')->references('id')->on('users')->onDelete('cascade');


> php artisan migrate

//now manually populate the table in the GUI
user_id |   following_user_id  |   created_at   |  updated_at
    1   |           3          |     NOW()      |     NOW()

//then check if you can fetch a users follows

> php artisan tinker

>>> App\Models\User::find(1)->follows;


//at the moment user 1 follows user 3 but not visa versa
//we can add a follow method to allow user 3 to click follow and follow user 1
//in USER MODEL

public function follow(User $user) {
  return $this->follows()->save($user)
}

//test the follow function:

> php artisan tinker

//store user 1 in a variable
>>> $user_one = App\Models\User::find(1);

//fetch user 3 and hit follow method
>>> App\Models\User::find(3)->follow($user_one);


//CURRENTLY we are following users via tinker. We can add the follow button on the profile page later.

