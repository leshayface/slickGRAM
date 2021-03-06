@extends('layouts.app')

@section('content')
    <div class="lg:flex lg:justify-between">
        <div class="lg:w-32">
            @include('_sidebar-links')
        </div>
        <div class="lg:flex-1 lg:mx-10" style="max-width:700px">
             @include('_publish-slick-panel')

            <div class="border border-gray-300 rounded-lg">
            @foreach ($slicks as $slick)
                @include('_slick')
            @endforeach               
            </div>
        </div>
        <div class="lg: w-1/6 bg-blue-100 rounded-lg p-4">
            @include('_friends-list')
        </div>
    </div>
@endsection