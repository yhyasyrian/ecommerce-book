<div class="flex flex-col gap-y-2 text-center bg-white pb-2 rounded-md">
    <a href="{{route('show.book',['book'=>$book->id])}}">
        <div class="relative overflow-hidden group
                after:content-[''] after:w-full after:h-full after:bg-white/75 after:block after:absolute after:top-0 after:-left-full after:rounded-t-md
                after:transition-all after:duration-300 hover:after:left-0 after:z-10
            ">
            <img src="{{asset($book->thumbnail)}}" alt="{{$book->title}}"
                 class="rounded-t-md mx-auto w-full aspect-[2/3]"
            >
            <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20
        opacity-0 group-hover:opacity-100 delay-150 transition
        ">
            <i class="fa-solid fa-eye text-3xl"></i>
        </span>
        </div>
    </a>
    <h2 class="text-xl font-extrabold">
        <a href="{{route('show.book',['book'=>$book->id])}}">
            {{$book->title}}
        </a>
    </h2>
    @if(!is_null($book->category_id))
        <h3 class="text-gray-500 font-bold">
            <a href="{{route('categories.show',$book->category->slug)}}">{{$book->category->name}}</a>
        </h3>
    @endif
    <span>{{$book->price}}$</span>
    <ul class="flex flex-row justify-center">
        @for($i=1;$i<=5;$i++)
            <li><i class="fa-solid fa-star"></i></li>
        @endfor
    </ul>
</div>
