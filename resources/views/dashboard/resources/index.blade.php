@extends('dashboard.layouts.app')
@section('title',$titlePage)
@section('content')
    <div class="row">
        <a href="{{routeDashboard($nameRoute.'.create')}}" class="btn btn-primary mb-2">
            إضافة {{$title}}
            <i class="fa fa-plus"></i>
        </a>
        <div class="col-12 overflow-auto">
            <x-dashboard.table :paramRoute="$paramRoute" :nameRoute="$nameRoute" :rows="$data" :columns="$columnsTable" />
        </div>
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
@section('head')
    <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{asset('theme/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script>
        $("#dataTable").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/2.1.2/i18n/ar.json"
            },
            paging: false,
            info: false
        })
        const URL_DESTROY = '{{dirname(routeDashboard($nameRoute.'.destroy',[$paramRoute=>2]))}}';
        $('[data-id-for-remove]').click(function() {
            var idToRemove = $(this).data('id-for-remove');
            $('#form-delete').attr('action',`${URL_DESTROY}/${idToRemove}`)
        });
    </script>
@endsection

