<x-app-layout>
    @empty($informationHomePage)
        <form action="{{route('search')}}" class="py-16 flex justify-center flex-row gap-x-6">
            <input type="text" name="search" class="input-search">
            <button class="bg-blue-500/75 hover:bg-blue-500 text-white py-2 px-6 rounded-md transition ">
                بحث <i class="fa-solid fa-search"></i>
            </button>
        </form>
    @else
        <div class="py-16 flex items-center flex-col gap-y-6">
            <h2 class="font-bold text-2xl">{{$informationHomePage->title}}</h2>
            <p class="leading-description text-lg">{{$informationHomePage->description}}</p>
        </div>
    @endempty
    <x-books-element>
        @forelse($books as $book)
            <x-book-element :book="$book" />
        @empty
            <x-alert class="sm:col-span-2 md:col-span-3 lg:col-span-4">
                عذراً لا يوجد كتب
            </x-alert>
        @endforelse
        <div class="sm:col-span-2 md:col-span-3 lg:col-span-4">
            {{$books->links('vendor.pagination.tailwind')}}
        </div>
    </x-books-element>
</x-app-layout>
