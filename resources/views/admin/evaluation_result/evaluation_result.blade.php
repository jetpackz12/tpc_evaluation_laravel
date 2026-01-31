<x-layout_admin>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card">
                            <!-- form start -->
                            <!-- <form action="#"> -->
                            <form action="{{ route('evaluation_result_show') }}" method="POST" id="filter">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Program</label>
                                                <select class="form-control" id="sel-program" name="program" required>
                                                    <option value="" selected disabled>---Select Program---
                                                    </option>
                                                    <option value="0">All Program</option>
                                                    @foreach ($programs as $program)
                                                        <option value="{{ $program->id }}">{{ $program->program_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="sel-acadimic-year">Academic Year</label>
                                                <input type="text" class="form-control" id="sel-acadimic-year"
                                                    name="academic_year" data-inputmask='"mask": "9999-9999"' data-mask
                                                    placeholder="YYYY-YYYY" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <select class="form-control" id="sel-semester" name="semester" disabled
                                                    required>
                                                    <option value="" selected disabled>---Select Semester----
                                                    </option>
                                                    @foreach ($semesters as $semester)
                                                        <option value="{{ $semester->id }}">{{ $semester->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-primary mr-2 filter" style="width: 200px;">
                                        <i class="fa fa-filter mr-1" style="font-size: 20px;"></i>
                                        Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row d-none" id="display-evaluation-result">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Teacher's Performance Evaluation Result</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table"
                                    class="table table-bordered table-striped text-center table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Instructor Name</th>
                                            <th>Program</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="teacherEvaluationTable">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                    <h4 class="modal-title">
                        <i class="fa fa-chart-line mr-1" style="font-size: 25px;"></i>
                        Teacher's Evaluation Result
                    </h4>
                    <button type="button" class="close text-xl text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputInstructorName">Instructor Name</label>
                                <input type="text" class="form-control" id="exampleInputInstructorName" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputAcadamicYear">Academic Year</label>
                                <input type="text" class="form-control" id="exampleInputAcadamicYear" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputSemester">Semester</label>
                                <input type="text" class="form-control" id="exampleInputSemester" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <!-- general form elements -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <b>Face to Face Instruction</b>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach ($categories as $category)
                                                <table id="table" class="table table-bordered">
                                                    <thead>
                                                        <tr class="bg-success">
                                                            <th>
                                                                {{ $category->category_name }}
                                                            </th>
                                                            <th class="text-center">
                                                                Rating
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($face_to_face_questions as $face_to_face_question)
                                                            @if ($category->id == $face_to_face_question->category_id)
                                                                <tr>
                                                                    <td>{{ $face_to_face_question->question }}</td>
                                                                    <td class="w-25">
                                                                        <input type="text"
                                                                            class="form-control text-center face"
                                                                            id="face{{ $face_to_face_question->id }}"
                                                                            disabled>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-12">
                            <!-- general form elements -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <b>Online Instruction</b>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach ($categories as $category)
                                                <table id="table" class="table table-bordered">
                                                    <thead>
                                                        <tr class="bg-success">
                                                            <th>
                                                                {{ $category->category_name }}
                                                            </th>
                                                            <th class="text-center">
                                                                Rating
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($online_questions as $online_question)
                                                            @if ($category->id == $online_question->category_id)
                                                                <tr>
                                                                    <td>{{ $online_question->question }}</td>
                                                                    <td class="w-25">
                                                                        <input type="text"
                                                                            class="form-control text-center online"
                                                                            id="online{{ $online_question->id }}"
                                                                            disabled>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-12">
                            <!-- general form elements -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <b>Knowledge of the Subject Matter</b>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach ($subject_matter_questions as $subject_matter_question)
                                                <div class="form-group">
                                                    <label>Question:
                                                        {{ $subject_matter_question->question }}</label>
                                                    <div class="rounded p-3" style="background-color: #E9ECEF;">
                                                        <span class="matter"
                                                            id="matter{{ $subject_matter_question->id }}"></span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 150px;">
                        <i class="fa fa-times-circle"></i>
                        Close
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <script>
        //Input Mask
        $('[data-mask]').inputmask()

        $("#evaluationResult").addClass("active");
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        //This will be the title of the table when using the table tools like Excel, PDF, and Print.
        const tableTitle = "List of Teacher Performance Evaluation Results";

        $(document).ready(function() {

            $('#sel-program').change(function() {
                selectorOnchange('sel-program', 'sel-acadimic-year');
            });

            $('#sel-acadimic-year').change(function() {
                selectorOnchange('sel-acadimic-year', 'sel-semester');
            });

            $('#sel-semester').change(function() {
                selectorOnchange('sel-semester', '');
            });

            $('#filter').on('submit', function(e) {
                e.preventDefault();

                $('#teacherEvaluationTable').empty();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        console.log(data);

                        const jsonData = JSON.parse(data);

                        for (let i = 0; i < jsonData.length; i++) {
                            const element = jsonData[i];

                            let status = element.status == 1 ? 'Active' : 'Inactive';

                            $('#teacherEvaluationTable').append(`<tr>
                                                <td>${element.lastname} ${element.firstname} ${element.middlename}.</td>
                                                <td>( ${element.program_code} ) - ${element.program_name}</td>
                                                <td>${status}</td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    <button type="button" class="btn btn-primary mr-1 edit" data-id="${element.id}" data-toggle="modal" data-target="#modal-view">
                                                        <i class="fa fa-eye mr-1"></i>
                                                        View Result
                                                    </button>
                                                </td>
                                            </tr>`);

                        }

                        displayEvalutionResult(true);
                    }
                });

            });

            $('#teacherEvaluationTable').on('click', '.edit', function() {
                const path = "{{ route('evaluation_result_show_evaluation') }}";
                const id = $(this).attr('data-id');
                const academic_year = $('#sel-acadimic-year').val();
                const semester = $('#sel-semester').val();

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: path,
                    data: {
                        id: id,
                        academic_year: academic_year,
                        semester: semester,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        console.log(data);

                        const jsonData = JSON.parse(data);
                        const teacher_name = jsonData.teacher.firstname + " " + jsonData.teacher.middlename + " " + jsonData.teacher.lastname;

                        $('#exampleInputInstructorName').val(teacher_name);
                        $('#exampleInputAcadamicYear').val(academic_year);
                        $('#exampleInputSemester').val($('#sel-semester option:selected')
                            .text());

                        if (jsonData.evaluations.length < 1 && jsonData.subject_matters.length < 1) {
                            $('.face').val('No Evaluation');
                            $('.online').val('No Evaluation');
                            $('.matter').text('No Evaluation');
                        } else {
                            jsonData.evaluations.forEach(element => {
                                if (element.modality_id == 1 && element.rate !== '') {
                                    $(`#face${element.question_id}`).val(element.rate);
                                } else {
                                    $(`#online${element.question_id}`).val(element
                                    .rate);
                                }
                            });

                            jsonData.subject_matters.forEach(element => {
                                $(`#matter${element.subject_matter_question_id}`).text(
                                    element.response);
                            });
                        }


                    }
                });
            });

            function selectorOnchange(currectSelectorID, selectorIDToDoAction) {
                if ($(`#${currectSelectorID}`).val() !== '' && selectorIDToDoAction !== '') {
                    $(`#${selectorIDToDoAction}`).removeAttr('disabled');
                }

                displayEvalutionResult(false);
                $('#teacherEvaluationTable').empty();
            }

            // True will display the evaluation result.
            // False will not display the evaluation result.
            function displayEvalutionResult(bool) {
                if (bool) {
                    $('#display-evaluation-result').removeClass("d-none").addClass("d-block");
                } else {
                    $('#display-evaluation-result').removeClass("d-block").addClass("d-none");
                }
            }

        });
    </script>
</x-layout_admin>
