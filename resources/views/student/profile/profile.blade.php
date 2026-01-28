<x-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-md"><a class="nav-text"
                                    href="{{ route('student_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item text-md"><a class="nav-text"
                                    href="{{ route('student_evaluation') }}">Evaluation</a></li>
                            <li class="breadcrumb-item text-md"><a class="nav-text"
                                    href="{{ route('student_history') }}">History</a></li>
                            <li class="breadcrumb-item text-md"><a href="{{ route('student_profile') }}">Profile</a>
                            </li>
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
                                    <i class="nav-icon far fa-user mr-2" style="font-size: 28px;"></i>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('student_profile_update') }}" method="POST" class="postForm">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="text" class="form-control" id="e_id_user" name="id_user"
                                            value="{{ $student->user_id }}" hidden>
                                        <input type="text" class="form-control" id="e_id_student" name="id_student"
                                            value="{{ $student->id }}" hidden>
                                        <input type="text" class="form-control" id="e_old_password"
                                            name="old_password" value="{{ $student->password }}" hidden>
                                        <input type="text" class="form-control" id="e_old_student_identification"
                                            name="old_student_identification" value="{{ $student->username }}" hidden>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="e_lastname">Lastname</label>
                                                <input type="text" class="form-control input-info" id="e_lastname"
                                                    name="lastname" placeholder="Enter Lastname"
                                                    value="{{ $student->last_name }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="e_firstname">Firstname</label>
                                                <input type="text" class="form-control input-info" id="e_firstname"
                                                    name="firstname" placeholder="Enter Firstname"
                                                    value="{{ $student->first_name }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="e_middlename">Middlename</label>
                                                <input type="text" class="form-control input-info" id="e_middlename"
                                                    name="middlename" placeholder="Enter Middlename"
                                                    value="{{ $student->middle_name }}" disabled required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="e_program_name">Program Name</label>
                                                <select class="form-control input-info" id="e_program_name"
                                                    name="program" disabled required>
                                                    @foreach ($programs as $program)
                                                        <option value="{{ $program->id }}"
                                                            {{ $program->id == $student->program_id ? 'selected' : '' }}>
                                                            {{ $program->program_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="e_year_level">Year Level</label>
                                                <select class="form-control input-info" id="e_year_level"
                                                    name="year_level" disabled required>
                                                    @foreach ($year_levels as $year_level)
                                                        <option value="{{ $year_level->id }}"
                                                            {{ $year_level->id == $student->year_level_id ? 'selected' : '' }}>
                                                            {{ $year_level->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="e_status">Status</label>
                                                <select class="form-control input-info" id="e_status" name="status"
                                                    disabled required>
                                                    @foreach ($status as $stat)
                                                        <option value="{{ $stat->id }}"
                                                            {{ $stat->id == $student->student_status_id ? 'selected' : '' }}>
                                                            {{ $stat->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="e_student_identification">Student Identification</label>
                                                <input type="number" class="form-control input-info"
                                                    id="e_student_identification" name="student_identification"
                                                    placeholder="Enter Student Identification"
                                                    value="{{ $student->username }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="e_password">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="e_password"
                                                        name="password" placeholder="Enter Password"
                                                        value="{{ $student->password }}" disabled required>
                                                    <div class="input-group-append">
                                                        <button type="button"
                                                            class="btn btn-warning btn-edit-password" disabled>
                                                            <i class="fa fa-edit" style="font-size: 20px;"></i>
                                                            <i class="fa fa-times-circle" style="font-size: 20px;"
                                                                hidden></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-primary mr-2 edit d-none"
                                        style="width: 200px;" id="cancel">
                                        <i class="fa fa-ban mr-1" style="font-size: 20px;"></i>
                                        Cancel
                                    </button>
                                    <button type="button" class="btn btn-primary mr-2 edit" style="width: 200px;"
                                        id="edit">
                                        <i class="fa fa-user-edit mr-1" style="font-size: 20px;"></i>
                                        Edit
                                    </button>
                                    <button type="submit" class="btn btn-warning d-none" style="width: 200px;"
                                        id="update">
                                        <i class="fa fa-paper-plane mr-1" style="font-size: 20px;"></i>
                                        Update
                                    </button>
                                </div>
                            </form>
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
        let password = '{{ $student->password }}';

        $("#profile").addClass("active");
        $(".edit").click(function() {
            if ($(".input-info").attr("disabled")) {
                $(".input-info").removeAttr("disabled");
                $("#edit").addClass("d-none");
                $("#cancel").removeClass("d-none");
                $("#update").removeClass("d-none");
                $('.btn-edit-password').removeAttr("disabled");
            } else {
                $(".input-info").attr("disabled", "disabled");
                $("#edit").removeClass("d-none");
                $("#cancel").addClass("d-none");
                $("#update").addClass("d-none");
                $('.btn-edit-password').attr("disabled", "disabled");
                $("#e_password").val(password);
                $("#e_password").attr("disabled", "disabled");
                $(".btn-edit-password .fa-edit").removeAttr("hidden");
                $(".btn-edit-password .fa-times-circle").attr("hidden", "hidden");
            }
        });
        $(".btn-edit-password").click(function() {
            if ($("#e_password").attr("disabled")) {
                $("#e_password").removeAttr("disabled");
                $("#e_password").val("");
                $(".btn-edit-password .fa-edit").attr("hidden", "hidden");
                $(".btn-edit-password .fa-times-circle").removeAttr("hidden");
            } else {
                $("#e_password").val(password);
                $("#e_password").attr("disabled", "disabled");
                $(".btn-edit-password .fa-edit").removeAttr("hidden");
                $(".btn-edit-password .fa-times-circle").attr("hidden", "hidden");
            }
        });
    </script>
</x-layout>
