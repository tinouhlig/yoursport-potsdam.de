@if (count($courses))
    <div class="box">
        <div class="box-body">
            <table id="coursetable" class="table table-bordered table-striped" data-page-length="25">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Wochentag</th>
                        <th>Uhrzeit</th>
                        <th>Teilnehmeranzahl</th>
                        <th>Enddatum</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->name_kursplan}}</td>
                            <td>{{$course->day}}</td>
                            <td>{{$course->time}}</td>
                            <td>{{$course->user->count()}} / {{ $course->max_participants }}</td>
                            <td>{{$course->end_datum}}</td>
                            <td>{{$course->status}}</td>
                            <td><a href="{{ route('admin::courses_show', $course->slug) }}" class="btn btn-default btn-xs center-block" role="button">Details</a></td>
                            <td><a class="btn btn-danger btn-xs center-block" role="button" data-toggle="modal" data-target="#deleteModal" data-whatever="{{ $course->name }}" data-link="{{ route('admin::courses_delete', $course->slug) }}" ><i class="fa fa-trash-o fa-fw"></i> Löschen</a></td>
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
