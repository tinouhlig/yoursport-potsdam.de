<div class="modal fade" id="course_activate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Diesen Kurs wirklich aktivieren?</h4>
            </div>
            {!! Form::open(array('route' => ['admin::courses_activate', 'course' => $course->slug], 'role' => 'form')) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <label for="start">Zu wann willst du den Kurs aktivieren?</label>
                        <input type="date" name="start" class="form-control" required="required">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <label for="end">Bis wann soll der Kurs laufen? (leer lassen wenn kein Enddatum vorhanden)</label>
                        <input type="date" name="end" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Schließen</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-sign-out fa-fw"></i> Jetzt aktivieren</button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->