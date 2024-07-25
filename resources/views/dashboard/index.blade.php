@extends('dashboard.layouts.app')
@section('title','لوحة التحكم')

@section('content')
    <div class="row">
        <x-dashboard.card title="عدد الكتب" :information="$countBook" icon="fa fa-book" />
        <x-dashboard.card title="عدد الأقسام" :information="$countCategories" icon="fa fa-tags" />
        <x-dashboard.card title="عدد المؤلفين" :information="$countAuthors" icon="fa fa-users" />
        <x-dashboard.card title="عدد الناشرين" :information="$countPublishers" icon="fa fa-feather" />
    </div>
@endsection
