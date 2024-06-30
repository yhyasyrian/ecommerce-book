<div>
    <div class="mt-6">
        <label for="category" class="block text-md mb-4">بحث عن {{$this->titleUtility}}:</label>
        <input type="text"
               class="input-search block mx-auto"
               wire:model.live.250ms="search"
        >
    </div>
    <nav class="flex flex-col gap-y-6 mt-4 font-medium text-gray-800 text-md">
        @foreach($results as $result)
            <a href="{{route($this->routeUtility,[$result->slug])}}" class="border-b pb-2 link-effect w-full after:duration-200">
                {{$result->name}}
                <span>({{$result->books_count}})</span>
            </a>
        @endforeach
    </nav>
</div>
