@extends('dashboard.layouts.app')
@section('title','إضافة كتاب')
@section('content')
    <div class="row overflow-x-auto pb-4">
        <div class="col-lg-8 mx-auto">
            <table class="table table-bordered table-hover w-full">
                <tr>
                    <th>اسم الكتاب</th>
                    <td>{{$book->title}}</td>
                </tr>
                <tr>
                    <th>الرقم التسلسلي</th>
                    <td>{{$book->isbn}}</td>
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
        </div>
        <div class="col-lg-4">
            <img src="{{asset($book->thumbnail)}}" alt="{{$book->title}}"
                 class="w-100 mx-auto mb-3" style="max-width: 300px; aspect-ratio: 3/4;"
            >
            <h2 class="font-weight-bold h4">الناشر: {{$book->publisher->name}}</h2>
        </div>
    </div>
@endsection
