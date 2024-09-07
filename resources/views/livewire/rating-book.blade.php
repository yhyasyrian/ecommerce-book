<div class="max-w-3xl mx-auto mt-6 relative">
    <h3 class="text-center text-xl mb-4 font-bold">تقييم الكتاب</h3>
    <div class="group">
        @if(auth()->check() && !auth()->user()->isBookBought($book))
            <p class="text-red-500 font-bold">يجب عليك شراء الكتاب لتستطيع تقييمه</p>
        @else
            <ul @class(['relative flex flex-row-reverse justify-center','group-hover:hidden'=>auth()->check()])>
                @for($i=1;$i<=5;$i++)
                    @php($star = abs(5-$i+1))
                    <li class="fa-star click">
                        <i @class(['fa-solid fa-star','text-yellow-500'=>$star<=$book->lastRating()])></i>
                    </li>
                @endfor
            </ul>
            @auth
                <ul class="hidden group-hover:flex flex-row-reverse justify-center">
                    @for($i=1;$i<=5;$i++)
                        @php($star = abs(5-$i+1))
                        <li class="fa-star click" wire:click="rating({{$star}})">
                            <i @class(['fa-solid fa-star'])></i>
                        </li>
                    @endfor
                </ul>
            @endauth
        @endif
    </div>
</div>
