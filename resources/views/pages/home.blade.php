<x-app-layout>
    <form action="{{route('search')}}" class="py-16 flex justify-center flex-row gap-x-6">
        <input type="text" name="search" class=" w-2/3 md:w-full max-w-2xl
            outline-0 border-2 border-blue-500/75 hover:border-blue-500 rounded-md transition
        ">
        <button class="bg-blue-500/75 hover:bg-blue-500 text-white py-2 px-6 rounded-md transition ">
            بحث <i class="fa-solid fa-search"></i>
        </button>
    </form>
    <x-books-element>
        @foreach($books as $book)
            <x-book-element :book="$book" />
        @endforeach
        <div class="sm:col-span-2 md:col-span-3 lg:col-span-4">
            {{$books->links('vendor.pagination.tailwind')}}
        </div>
    </x-books-element>
</x-app-layout>
