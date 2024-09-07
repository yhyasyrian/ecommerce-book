<x-app-layout>
    <main class="container mx-auto">
        <section class="bg-gray-100 p-10 grid grid-cols-1 gap-y-4">
            @forelse(auth()->user()->booksPurchases()->get() as $book)
                <div class="bg-white rounded-lg shadow-lg p-4 flex flex-row-reverse items-start justify-end">
                    <!-- Left Section -->
                    <div class="flex flex-col justify-between ms-auto">
                        <!-- Price and Total -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">المجموع الكلي: <span class="text-green-600">{{$book->pivot->copies * $book->pivot->price}}$</span></p>
                            <p class="text-lg font-semibold text-gray-800">{{$book->pivot->price}}$</p>
                        </div>

                        <!-- Button -->
                        <a href="{{route('show.book',['book'=>$book->id])}}" class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg border border-blue-600">
                            تفاصيل الكتاب
                        </a>
                    </div>
                    <!-- Right Section -->
                    <div class="ml-4 text-right">
                        <!-- Title -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{$book->title}}</h3>

                        <!-- Rating -->
                        <div class="flex justify-start mb-2">
                            <ul class="relative flex flex-row-reverse justify-center">
                                @for($i=1;$i<=5;$i++)
                                    @php($star = abs(5-$i+1))
                                    <li class="fa-star">
                                        <i @class(['fa-solid fa-star','text-yellow-500'=>$star<=$book->lastRating()])></i>
                                    </li>
                                @endfor
                            </ul>
                        </div>

                        <!-- Info Section -->
                        <a class="text-sm text-gray-500 font-semibold underline" href="{{route('categories.show',['category'=>$book->category->slug])}}">{{$book->category->name}}</a>
                        <p class="text-sm text-gray-500">تاريخ الشراء: {{now()->setTimestamp(strtotime($book->pivot->bought_at))->diffForHumans()}}</p>
                        <p class="text-sm text-gray-500">عدد النسخ: {{$book->pivot->copies}}</p>
                    </div>
                    <!-- Image Section -->
                    <div class="ml-4 hidden sm:block">
                        <img class="w-full object-center aspect-[2/3] h-40 rounded-lg" src="{{$book->imageUrl}}" alt="Product Image">
                    </div>
                </div>
            @empty
                <p class="text-red-500 font-bold">عذراً لكن لم تقم بشراء أي كتاب بعد</p>
            @endforelse
        </section>
    </main>
</x-app-layout>
