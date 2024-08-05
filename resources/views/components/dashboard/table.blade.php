<table class="table table-striped table-hover table-bordered" id="dataTable">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th scope="col">{{$column->getTitle()}}</th>
        @endforeach
        <th scope="col">اجراء</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr>
            @foreach($columns as $column)
                @empty($column->getColumnAs())
                    <td>@if($column->isClickableShow())
                            <a href="{{routeDashboard($nameRoute.'.show',[$paramRoute=>$row->id])}}">
                                {{ $row->{$column->getColumn()} }}{{$column->getPrefix()}}
                            </a>
                        @else
                            {{ $row->{$column->getColumn()} }}{{$column->getPrefix()}}
                        @endif</td>
                @else
                    <td>
                        @if($column->isClickableShow())
                            <a href="{{routeDashboard($nameRoute.'.show',[$paramRoute=>$row->id])}}">
                                {{ $row->{$column->getColumnAs()} }}{{$column->getPrefix()}}
                            </a>
                        @else
                            {{ $row->{$column->getColumnAs()} }}{{$column->getPrefix()}}
                        @endif</td>
                @endempty
            @endforeach
            <td class="text-center">
                <a class="btn btn-primary d-inline-block m-1" href="{{routeDashboard($nameRoute.'.edit',[$paramRoute=>$row->id])}}">تعديل</a>
                <button data-id-for-remove="{{$row->id}}" data-toggle="modal" data-target="#removeModel" class="btn btn-danger d-inline-block">حذف</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $rows->links('pagination::bootstrap-5') }}
