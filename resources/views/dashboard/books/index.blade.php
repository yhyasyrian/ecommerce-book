@extends('dashboard.layouts.app')
@section('title','الكتب')
@section('content')
    <div class="row overflow-x-auto">
        <a href="{{routeDashboard('books.create')}}" class="btn btn-primary mb-2">
            إضافة كتاب
            <i class="fa fa-plus"></i>
        </a>
        <div class="col-12">
            @include('dashboard.components.table',[...compact('books'),'columns'=>['العنوان','الرقم التسلسلي','التصنيف','المؤلفون','الناشر','السعر']])
        </div>
    </div>
@endsection
