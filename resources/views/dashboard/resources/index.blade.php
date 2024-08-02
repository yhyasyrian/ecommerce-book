@extends('dashboard.layouts.app')
@section('title',$titlePage)
@section('content')
    <div class="row overflow-x-auto">
        <a href="{{routeDashboard($nameRoute.'.create')}}" class="btn btn-primary mb-2">
            إضافة {{$title}}
            <i class="fa fa-plus"></i>
        </a>
        <div class="col-12">
            <x-dashboard.table :rows="$data" :columns="$columnsTable" />
        </div>
    </div>
@endsection
