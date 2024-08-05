@use(App\Services\DashboardResource\TypeColumn)
@extends('dashboard.layouts.app')
@section('title',"{$title}: {$data?->name}{$data?->title}")
@section('content')
    <div class="row overflow-x-auto pb-4">
        <div class="col-lg-8 mx-auto">
            <table class="table table-bordered table-hover w-full">
                @foreach($columns as $column)
                    @continue($column->getTypeColumn()->name === TypeColumn::PASSWORD->name)
                    <tr>
                        <td>{{$column->getTitle()}}</td>
                        @if($column->getTypeColumn()->name === TypeColumn::PHOTO->name)
                            <td class="text-center"><img style="max-width: 300px; aspect-ratio: 3/4;" src="{{ $data->imageUrl }}" alt="{{ $data->{$column->getColumn()} }}"></td>
                        @elseif(empty($column->getColumnAs()))
                            <td>{{ $data->{$column->getColumn()} }}{{$column->getPrefix()}}</td>
                        @else
                            <td>{{ $data->{$column->getColumnAs()} }}{{$column->getPrefix()}}</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div>
        <a class="btn btn-primary d-inline-block m-1" href="{{routeDashboard($nameRoute.'.edit',[$paramRoute=>$data->id])}}">تعديل</a>
        <button data-id-for-remove="{{$data->id}}" data-toggle="modal" data-target="#removeModel" class="btn btn-danger d-inline-block">حذف</button>
    </div>
    <div class="modal fade" id="removeModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل أنت متأكد أنك تريد حذف ال{{$title}}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">تأكيدك سيؤدي لحذف ال{{$title}} وعدم القدرة على استرجاع المعلومات</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <form id="form-delete" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="تأكيد" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const URL_DESTROY = '{{dirname(routeDashboard($nameRoute.'.destroy',[$paramRoute=>2]))}}';
        $('[data-id-for-remove]').click(function() {
            var idToRemove = $(this).data('id-for-remove');
            $('#form-delete').attr('action',`${URL_DESTROY}/${idToRemove}`)
        });
    </script>
@endsection
