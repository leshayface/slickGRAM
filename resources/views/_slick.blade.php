<div class="flex p-4 border-b border-b gray-400">
    <div class="mr-2 flex-shrink-0">
        <img 
            src="https://i.pravatar.cc/40?u={{$slick->user->email}}" 
            alt="" 
            class="rounded-full mr-2"
        >
        
    </div>

    <div>
        <h5 class="font-bold mb-4">{{$slick->user->name}}</h5>
        <p class="text-sm">{{$slick->body}}</p>
    </div>   
</div>