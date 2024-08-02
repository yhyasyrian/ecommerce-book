@use(App\Services\DashboardResource\TypeColumn)
@extends('dashboard.layouts.app')
@section('title',$titlePage)
@php($isPhoto = false)
@section('content')
    <div class="row overflow-x-auto pb-4">
        <div class="col-8 mx-auto">
            <form action="{{routeDashboard('books.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method($method)
                @foreach($columns as $column)
                    @if($column->getTypeColumn()->name === TypeColumn::SELECT->name)
                        <x-dashboard.input
                            :name="$column->getColumn()"
                            :type="$column->getTypeColumn()->value"
                            :label="$column->getTitle()"
                            :otherAttributes="$column->getAttributes()"
                            :options="$column->getSelects()->map(fn ($model) => [$model->id ,$model->name])"
                        />
                    @else
                        <x-dashboard.input
                        :name="$column->getColumn()"
                        :type="$column->getTypeColumn()->value"
                        :label="$column->getTitle()"
                        :otherAttributes="$column->getAttributes()"
                    />
                    @endif
                    @if ($column->getTypeColumn()->name === TypeColumn::PHOTO->name)
                        @php($isPhoto = true)
                        <div class="form-group container text-center">
                            <img class=" w-50" alt="الرجاء وضع صورة للكتاب" id="photoBook">
                        </div>
                    @endif
                @endforeach
                <button class="btn btn-success d-block mx-auto" style="width: 100%;">
                    إضافة
                </button>
            </form>
        </div>
    </div>
@endsection
@if($isPhoto)
    @section('script')
        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.getElementById('photoBook');
                        img.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // Handle case when no file is selected
                    const img = document.getElementById('photoBook');
                    img.src = ''; // Clear the preview image
                }
            }
        </script>
    @endsection
@endif
