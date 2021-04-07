<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form action="">
        <textarea 
        name="body"
        class="w-full" 
        placeholder="What's up doc?"
        ></textarea>

        <hr class="my-4">

        <footer class="flex justify-between">
            <img 
                src="{{ auth()->user()->avatar }}"
                alt="" 
                class="rounded-full mr-2"
            >
        <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">slick-a-roo!</button>

        </footer>

    </form>

    @error('body')
    <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>