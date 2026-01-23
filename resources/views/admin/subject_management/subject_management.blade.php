<x-layout_admin>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><span class="d-none d-sm-inline">List of </span>Subjects</h3>
                                <div class="float-right d-flex justify-content-center align-items-center">
                                    <div class="mr-3">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="activeCheckBox" checked>
                                            <label for="activeCheckBox">
                                                Active Status
                                            </label>
                                        </div>
                                        <div class="icheck-warning d-inline ml-1">
                                            <input type="checkbox" id="inactiveCheckBox" checked>
                                            <label for="inactiveCheckBox">
                                                Inactive Status
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#modal-add">
                                        <i class="fa fa-plus-square mr-1"></i>
                                        Add New Subject
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tableActionTools"
                                    class="table table-bordered table-striped text-center table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Subject Name</th>
                                            <th>Semester</th>
                                            <th>Year Level</th>
                                            <th>Program Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $subject->subject_code }}</td>
                                                <td>{{ $subject->subject_name }}</td>
                                                <td>{{ $subject->semester }}</td>
                                                <td>{{ $subject->year_level }}</td>
                                                <td>{{ '( ' . $subject->program_code . ' ) - ' . $subject->program_name }}
                                                </td>
                                                <td>{{ $subject->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    <button class="btn btn-primary mr-1 editWithData"
                                                        data-id="{{ $subject->id }}" data-toggle="modal"
                                                        data-target="#modal-edit">
                                                        <i class="fa fa-edit mr-1"></i>
                                                        Edit
                                                    </button>
                                                    @if ($subject->status == 1)
                                                        <button class="btn btn-danger editStatus"
                                                            data-id="{{ $subject->id }}"
                                                            data-status="{{ $subject->status }}" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                            <i class="fa fa-times-circle mr-1"></i>
                                                            Disabled
                                                        </button>
                                                    @else
                                                        <button class="btn btn-warning editStatus"
                                                            data-id="{{ $subject->id }}"
                                                            data-status="{{ $subject->status }}" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                            <i class="fa fa-check-circle mr-1"></i>
                                                            Enabled
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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

    <!-- Add Modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success d-flex justify-content-center align-items-center">
                    <h4 class="modal-title">
                        <i class="fa fa-plus-square mr-1" style="font-size: 25px;"></i>
                        Add new subject
                    </h4>
                    <button type="button" class="close text-xl text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subject_management_store') }}" method="POST" class="postForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputSubjectCode">Subject Code</label>
                                    <input type="text" class="form-control" id="exampleInputSubjectCode"
                                        name="subject_code" placeholder="Enter Subject Code" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputSubjectName">Subject Name</label>
                                    <input type="text" class="form-control" id="exampleInputSubjectName"
                                        name="subject_name" placeholder="Enter Subject Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputSemester">Semester</label>
                                    <select class="form-control" id="exampleInputSemester" name="semester" required>
                                        <option value="" selected disabled>---Select Semester---</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputYearLear">Year Level</label>
                                    <select class="form-control" id="exampleInputYearLear" name="year_level" required>
                                        <option value="" selected disabled>---Select Year Level---</option>
                                        @foreach ($year_levels as $year_level)
                                            <option value="{{ $year_level->id }}">{{ $year_level->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputProgram">Choose your Program</label>
                                    <select class="form-control" id="exampleInputProgram" name="program" required>
                                        <option value="" selected disabled>---Select Program---</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary" style="width: 100px;">
                            <i class="fa fa-paper-plane mr-1"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- Edit Modal -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                    <h4 class="modal-title">
                        <i class="fa fa-edit mr-1" style="font-size: 25px;"></i>
                        Edit subject
                    </h4>
                    <button type="button" class="close text-xl text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subject_management_update') }}" method="POST" class="postForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="e_id" name="id" hidden>
                            <input type="text" class="form-control" id="e_old_subject_code"
                                name="old_subject_code" hidden>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="e_subject_code">Subject Code</label>
                                    <input type="text" class="form-control" id="e_subject_code"
                                        name="subject_code" placeholder="Enter Subject Code" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="e_subject_name">Subject Name</label>
                                    <input type="text" class="form-control" id="e_subject_name"
                                        name="subject_name" placeholder="Enter Subject Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="e_semester">Semester</label>
                                    <select class="form-control" id="e_semester" name="semester" required>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="e_year_level">Year Level</label>
                                    <select class="form-control" id="e_year_level" name="year_level" required>
                                        @foreach ($year_levels as $year_level)
                                            <option value="{{ $year_level->id }}">{{ $year_level->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="e_program">Choose your Program</label>
                                    <select class="form-control" id="e_program" name="program" required>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary" style="width: 100px;">
                            <i class="fa fa-pen mr-1"></i>Update
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">
                        <i class="fa fa-pen mr-1" style="font-size: 25px;"></i>
                        Status
                    </h4>
                </div>
                <form action="{{ route('subject_management_status') }}" method="POST" class="postForm">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control id" name="id" hidden>
                        <input type="text" class="form-control status" name="status" hidden>
                        <p class="text-lg">Are you sure you want to update the status of this subject ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            style="width: 100px;">No</button>
                        <button type="submit" class="btn btn-danger" style="width: 100px;">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script>
        $("#subjectManagement").addClass("active");

        //This will be the title of the table when using the table tools like Excel, PDF, and Print.
        const tableTitle = "List of Subjects";
        const loadingStatus = false;

        $(document).ready(function() {
            $('.editWithData').on('click', function() {
                const path = "{{ route('subject_management_edit') }}";
                const id = $(this).attr('data-id');
                $('.id').val(id);
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: path,
                    data: {
                        id: id
                    },
                    success: function(data) {

                        const json = JSON.parse(data);
                        $('#e_id').val(json['id']);
                        $('#e_old_subject_code').val(json['subject_code']);
                        $('#e_subject_code').val(json['subject_code']);
                        $('#e_subject_name').val(json['subject_name']);
                        $('#e_semester').val(json['semester_id']);
                        $('#e_year_level').val(json['year_level_id']);
                        $('#e_program').val(json['program_id']);

                    }
                });
            });

            function filterTable() {
                const showActive = $('#activeCheckBox').is(':checked');
                const showInactive = $('#inactiveCheckBox').is(':checked');

                $('#tableActionTools tbody tr').each(function() {
                    const statusText = $(this).find('td:nth-child(6)').text().toLowerCase();

                    if (
                        (showActive && statusText === 'active') ||
                        (showInactive && statusText === 'inactive')
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            $('#activeCheckBox, #inactiveCheckBox').on('change', filterTable);

            filterTable();
        });
    </script>
</x-layout_admin>
