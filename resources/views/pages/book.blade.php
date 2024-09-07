<x-app-layout>
    <x-card class="w-[90%] mx-auto my-8">
        <h1 class="text-2xl font-extrabold mb-4">كتاب: {{$book->title}}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="sm:order-2">
                <img src="{{$book->imageUrl}}" alt="{{$book->title}}"
                     class="mx-auto sm:mx-0 sm:ms-auto w-[300px] aspect-[3/4]"
                >
                <h2 class="sm:text-end text-xl font-bold">الناشر: {{$book->publisher->name}}</h2>
            </div>
            <div class="md:col-span-2">
                <span class="text-lg font-medium">معلومات الكتاب:</span>
                <table class="table-fixed style-table w-full">
                    <tr>
                        <th>اسم الكتاب</th>
                        <td>{{$book->title}}</td>
                    </tr>
                    <tr>
                        <th>الرقم التسلسلي</th>
                        <td>{{$book->isbn}}</td>
                    </tr>
                    <tr>
                        <th>التقييمات</th>
                        <td>
                            {{$book->ratingAvg() * 2}}/10
                        </td>
                    </tr>
                    <tr>
                        <th>التصنيف</th>
                        <td>{{$book->category?->name ?? "لا يوجد"}}</td>
                    </tr>
                    <tr>
                        <th>المؤلفون</th>
                        <td>
                            @foreach($book->authors as $author)
                                {{$loop->first ? '' : 'و'}}
                                {{$author->name}}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>الوصف</th>
                        <td class="leading-description">{{$book->description}}</td>
                    </tr>
                    <tr>
                        <th>سنة النشر</th>
                        <td>{{$book->date_publish}}</td>
                    </tr>
                    <tr>
                        <th>عدد الصفحات</th>
                        <td>{{$book->pages}}</td>
                    </tr>
                    <tr>
                        <th>عدد النسخ</th>
                        <td>{{$book->copies}}</td>
                    </tr>
                    <tr>
                        <th>السعر</th>
                        <td>{{$book->price}}</td>
                    </tr>
                </table>
                <livewire-cart.add-book :book="$book" />
                <livewire-rating-book :book="$book" />
            </div>
        </div>
    </x-card>
    <x-slot:head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
              integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
    </x-slot:head>
</x-app-layout>
