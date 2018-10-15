@if (count($coursetypes))
    <div class="box">
        <div class="box-body">
            <table id="coursetable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coursetypes as $coursetype)
                        <tr>
                            <td>{{$coursetype->name}}</td>
                            <td>{{$coursetype->status}}</td>
                            <td><a href="{{ route('admin::coursetypes_show', $coursetype->slug) }}" class="btn btn-default btn-xs center-block" role="button">Details</a></td>
                            <td><a class="btn btn-danger btn-xs center-block" role="button" data-toggle="modal" data-target="#deleteModal" data-whatever="{{ $coursetype->name }}" data-link="{{ route('admin::coursetypes_delete', $coursetype->slug) }}" ><i class="fa fa-trash-o fa-fw"></i> Löschen</a></td>
                            {{-- <td></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <p>Keine Kurse vorhanden</p>
@endif
