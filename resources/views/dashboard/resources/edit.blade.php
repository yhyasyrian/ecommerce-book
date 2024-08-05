@use(App\Services\DashboardResource\TypeColumn)
@extends('dashboard.layouts.app')
@section('title',"تعديل {$title}: {$data?->name}{$data?->title}")
@php($isPhoto = false)
@section('content')
    <div class="row overflow-x-auto pb-4">
        <div class="col-8 mx-auto">
            <form action="{{routeDashboard($nameRoute.'.update',[$paramRoute=>$data->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method($method)
                @foreach($columns as $column)
                    @if($column->getTypeColumn()->name === TypeColumn::SELECT->name)
                        @if(is_a($data->{$column->getColumn()},\Illuminate\Support\Collection::class))
                            <x-dashboard.input
                                :name="$column->getColumn()"
                                :type="$column->getTypeColumn()->value"
                                :label="$column->getTitle()"
                                :otherAttributes="$column->getAttributes()"
                                :oldData="$data->{$column->getColumn()}"
                                :optionSelected="is_array($data->{$column->getColumnAs().'Array'}) ? $data->{$column->getColumnAs().'Array'} : [$data->{$column->getColumnAs().'Array'}]"
                                :options="$column->getSelects()->map(fn ($model) => [$model->id ,$model->name])"
                            />
                        @else
                            <x-dashboard.input
                                :name="$column->getColumn()"
                                :type="$column->getTypeColumn()->value"
                                :label="$column->getTitle()"
                                :otherAttributes="$column->getAttributes()"
                                :oldData="$data->{$column->getColumn()}"
                                :optionSelected="is_array($data->{$column->getColumn()}) ? $data->{$column->getColumn()} : [$data->{$column->getColumn()}]"
                                :options="$column->getSelects()->map(fn ($model) => [$model->id ,$model->name])"
                            />
                        @endif
                    @else
                        <x-dashboard.input
                            :name="$column->getColumn()"
                            :type="$column->getTypeColumn()->value"
                            :label="$column->getTitle()"
                            :oldData="$data->{$column->getColumn()}"
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
                <button class="btn btn-primary d-block mx-auto" style="width: 100%;">
                    تعديل
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
