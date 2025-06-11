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
                                <h3 class="card-title"><span class="d-none d-sm-inline">List of </span>Approved Accounts
                                </h3>
                                <button class="btn btn-info float-right" id="btn-pending-all" disabled>
                                    <i class="fa fa-spell-check"></i>
                                    Pending All
                                </button>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" class="cb-input" name="cbInputVal[]"
                                                        id="checkbox" value="">
                                                    <label for="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <form action="#"
                                                    class="postForm">
                                                    <input type="text" class="form-control" name="id"
                                                        value="" hidden>
                                                    <button type="submit"
                                                        class="btn btn-info mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                        <i class="fa fa-hourglass-half mr-1"></i>
                                                        Pending
                                                    </button>
                                                    <button type="button" class="btn btn-danger edit"
                                                        data-id="" data-toggle="modal"
                                                        data-target="#modal-cancel">
                                                        <i class="fa fa-times mr-1"></i>
                                                        Cancel
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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
        $("#approvedAccount").addClass("active");

        //This will be the title of the table when using the table tools like Excel, PDF, and Print.
        const tableTitle = "List of Student Approved Accounts";
        const pagination = false;
        const loadingStatus = false;
        const ACCOUNT_STATUS = 2;

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
                $('#btn-pending-all').removeAttr('disabled');
            }

            function disabledButton() {
                $('#btn-pending-all').attr('disabled', 'disabled');
            }

            $('#btn-pending-all').click(function() {
                let selectedIds = [];

                $('.cb-input:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "",
                    data: {
                        selectedData: selectedIds,
                        status: ACCOUNT_STATUS
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
                                console.log(
                                    'There has been an error please contact administrator.');
                                break;
                        }
                    }
                });

            });
        });
    </script>
</x-layout_admin>
