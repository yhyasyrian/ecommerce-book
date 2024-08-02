<table class="table table-striped table-hover table-bordered" id="dataTable">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th scope="col">{{$column->getTitle()}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr>
            @foreach($columns as $column)
                @empty($column->getColumnAs())
                    <td>{{ $row->{$column->getColumn()} }}{{$column->getPrefix()}}</td>
                @else
                    <td>{{ $row->{$column->getColumnAs()} }}{{$column->getPrefix()}}</td>
                @endempty
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
{{ $rows->links('pagination::bootstrap-5') }}
@section('head')
    <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{asset('theme/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script>
        $("#dataTable").DataTable({
            "language":{
                "url":"https://cdn.datatables.net/plug-ins/2.1.2/i18n/ar.json"
            },
            paging: false,
            info: false
        })
    </script>
@endsection

