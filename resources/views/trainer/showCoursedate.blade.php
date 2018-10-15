@extends('trainer.index')

@section('title')
    Dashboard
@endsection

@section('content')

    <div id="trainer-kurstermin">
        <section id="heading">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <h2>{{ $coursedate->course->name_with_details }} am {{ $coursedate->date_formated }}</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
            

                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 "><p class="help-block text-center">In dieser Übersicht siehst du alle angemeldeten Teilnehmerinnen.</div>
                    <div class="col-lg-8 col-lg-offset-2">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>E-Mailadresse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coursedate->user as $i => $user)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><a href="mailto:{{ $coursedate->mail_list }}" class="btn button-primary btn-sm">Email an Alle</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </div>

@endsection
