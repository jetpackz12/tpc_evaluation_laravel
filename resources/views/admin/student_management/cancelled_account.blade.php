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
                                <h3 class="card-title"><span class="d-none d-sm-inline">List of </span>Cancelled Accounts
                                </h3>
                                <div class="float-right">
                                    <button class="btn btn-primary" id="btn-approved-all" disabled>
                                        <i class="fa fa-spell-check"></i>
                                        Approved All
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tableActionTools"
                                    class="table table-bordered table-striped text-center table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="checkboxSelectAll">
                                                    <label for="checkboxSelectAll">
                                                        Select All
                                                    </label>
                                                </div>
                                            </th>
                                            <th>Acount#</th>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Middlename</th>
                                            <th>StudentID</th>
                                            <th>Cancel Massage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" class="cb-input" name="cbInputVal[]"
                                                            id="checkbox{{ $student->id }}" value="{{ $student->id }}">
                                                        <label for="checkbox{{ $student->id }}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->first_name }}</td>
                                                <td>{{ $student->middle_name }}</td>
                                                <td>{{ $student->username }}</td>
                                                <td>{{ $student->cancel_reason }}</td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    <form action="{{ route('account_update_approved') }}" class="postForm">
                                                        @csrf
                                                        <input type="text" class="form-control" name="id"
                                                            value="{{ $student->id }}" hidden>
                                                        <button type="submit"
                                                            class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                            <i class="fa fa-check mr-1"></i>
                                                            Approved
                                                        </button>
                                                    </form>
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

    <script>
        $("#studentManagement").addClass("menu-open");
        $("#studentManagementLink").addClass("active");
        $("#cancelledAccount").addClass("active");

        //This will be the title of the table when using the table tools like Excel, PDF, and Print.
        const tableTitle = "List of Student Cancelled Accounts";
        const pagination = false;
        const loadingStatus = false;

        let inputCheckBoxCounter = 0;

        $(document).ready(function() {
            $('#checkboxSelectAll').change(function() {
                if ($('#checkboxSelectAll').is(':checked')) {
                    $('.cb-input').prop('checked', true);
                    inputCheckBoxCounter = $('.cb-input').length;
                    if (inputCheckBoxCounter > 0)
                        enabledButton();
                } else {
                    $('.cb-input').prop('checked', false);
                    $('#btn-approved-all').attr('disabled', 'disabled');
                    $('#btn-pending-all').attr('disabled', 'disabled');
                    inputCheckBoxCounter = 0;
                    disabledButton();
                }
            });

            $('.cb-input').change(function() {
                if (this.checked) {
                    inputCheckBoxCounter++;
                    enabledButton();
                } else {
                    inputCheckBoxCounter--;
                    if (inputCheckBoxCounter === 0) {
                        $('#checkboxSelectAll').prop('checked', false);
                        disabledButton();
                    }
                }
            });

            function enabledButton() {
                $('#btn-approved-all').removeAttr('disabled');
                $('#btn-pending-all').removeAttr('disabled');
            }

            function disabledButton() {
                $('#btn-approved-all').attr('disabled', 'disabled');
                $('#btn-pending-all').attr('disabled', 'disabled');
            }

            function approvedAllAndPendingAll(post_url, account_status) {
                let selectedIds = [];

                $('.cb-input:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Toast.fire({
                        icon: 'error',
                        title: `<p class="text-center pt-2 text-black"> No Data ! </p>`
                    });
                }

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: post_url,
                    data: {
                        selectedData: selectedIds,
                        status: account_status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        const jsonData = JSON.parse(data);

                        switch (jsonData['response']) {
                            case "0":
                                Toast.fire({
                                    icon: 'error',
                                    title: `<p class="text-center pt-2 text-black"> ${jsonData['message']} </p>`
                                });
                                break;

                            case "1":
                                Toast.fire({
                                    icon: 'success',
                                    title: `<p class="text-center pt-2 text-black"> ${jsonData['message']} </p>`
                                });
                                setTimeout(function() {
                                    inputCheckBoxCounter = 0;
                                    location.reload();
                                }, 1500);
                                break;

                            default:
                                console.log('There has been an error please contact administrator.');
                                break;
                        }
                    }
                });
            }

            $('#btn-approved-all').click(function() {
                const ACCOUNT_STATUS = 2;
                approvedAllAndPendingAll("{{ route('account_update_all') }}",
                    ACCOUNT_STATUS);
            });
        });
    </script>
</x-layout_admin>
