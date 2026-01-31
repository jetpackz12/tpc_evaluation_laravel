<x-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">History</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-md"><a class="nav-text"
                                    href="{{ route('student_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item text-md"><a class="nav-text"
                                    href="{{ route('student_evaluation') }}">Evaluation</a></li>
                            <li class="breadcrumb-item text-md"><a href="{{ route('student_history') }}">History</a>
                            </li>
                            <li class="breadcrumb-item text-md"><a class="nav-text"
                                    href="{{ route('student_profile') }}">Profile</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main box -->
                <div class="row">
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa fa-address-book" style="font-size: 28px;"></i>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('student_history_show') }}" method="POST" id="filter">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Choose the Instructor Being Evaluated</label>
                                                <select class="form-control" name="teacher_id" id="sel-teacher"
                                                    required>
                                                    <option value="" disabled selected>---Select Instructor---
                                                    </option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}"> {{ $teacher->firstname }}
                                                            {{ $teacher->middlename }}{{ $teacher->lastname }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputAcademicyear">Academic Year</label>
                                                <input type="text" class="form-control" id="exampleInputAcademicyear"
                                                    name="academic_year" id="academic_year"
                                                    data-inputmask='"mask": "9999-9999"' data-mask
                                                    placeholder="YYYY-YYYY" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <select class="form-control" name="semester" id="sel-semester" required>
                                                    <option value="" disabled selected>---Select Semester----
                                                    </option>
                                                    <option value="1">First Semester</option>
                                                    <option value="2">Second Semester</option>
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
                <!-- /.row -->
                <!-- Main box -->
                <div class="row d-none" id="display-history">
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
                                                                        id="online{{ $online_question->id }}" disabled>
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
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $("#history").addClass("active");
        //Input Mask
        $('[data-mask]').inputmask()

        // Datable
        $('.table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": false,
        });

        $(document).ready(function() {

            $('#sel-teacher').change(function() {
                $('.face').val('No evaluation');
                $('.online').val('No evaluation');
                $('.matter').text('No evaluation');
                $('#display-history').removeClass("d-block");
                $('#display-history').addClass("d-none");
            });

            $('#exampleInputAcademicyear').change(function() {
                $('.face').val('No evaluation');
                $('.online').val('No evaluation');
                $('.matter').text('No evaluation');
                $('#display-history').removeClass("d-block");
                $('#display-history').addClass("d-none");
            });

            $('#sel-semester').change(function() {
                $('.face').val('No evaluation');
                $('.online').val('No evaluation');
                $('.matter').text('No evaluation');
                $('#display-history').removeClass("d-block");
                $('#display-history').addClass("d-none");
            });

            $('#filter').on('submit', function(e) {
                e.preventDefault();

                $('#display-history').removeClass("d-none");
                $('#display-history').addClass("d-block");

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(data) {

                        const jsonData = JSON.parse(data);

                        jsonData.evaluations.forEach(element => {
                            if (element.modality_id == 1 && element.rate !== '') {
                                $(`#face${element.question_id}`).val(element.rate);
                            } else {
                                $(`#online${element.question_id}`).val(element.rate);
                            }
                        });

                        jsonData.subject_matters.forEach(element => {
                            $(`#matter${element.subject_matter_question_id}`).text(
                                element.response);
                        });
                    }
                });
            });
        });
    </script>
</x-layout>
