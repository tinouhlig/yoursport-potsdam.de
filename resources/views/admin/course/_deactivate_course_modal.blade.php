<div class="modal fade" id="course_deactivate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ACHTUNG! Diesen Kurs wirklich deaktivieren?</h4>
            </div>
            {!! Form::open(array('route' => ['admin::courses_deactivate', 'course' => $course->slug], 'role' => 'form')) !!}
            <div class="modal-body">
                @if ($course->user->count())
                    <table>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>lfd. Nr</th>
                                    <th>Name</th>
                                    <th>neuer Kurs</th>
                                </tr>
                            </thead>
                        @foreach ($course->user as $id=>$user)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td><a href="{{ route('admin::users_show', [$user->slug]) }}">{{ $user->fullname }}</a></td>
                                <td>
                                    <select name="user_course[{{$user->id}}]" class="form-control" required="required">
                                        <option selected="selected"></option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name_with_details }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <?php $id++ ?>
                        @endforeach
                    </table>
                @endif
                <hr>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <label for="deactivate_on">Zu wann willst du den Kurs deaktivieren?</label>
                        <input type="date" name="deactivate_on" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Schließen</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-sign-out fa-fw"></i> Jetzt deaktivieren</button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->