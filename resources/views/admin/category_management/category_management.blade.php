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
                                <h3 class="card-title"><span class="d-none d-sm-inline">List of </span>Categories</h3>
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
                                        Add New Category
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tableActionTools"
                                    class="table table-bordered table-striped text-center table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1;
                                        @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $category->category_name}}</td>
                                                <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    <button class="btn btn-primary mr-1 editWithData"
                                                        data-id="{{ $category->id }}" data-toggle="modal"
                                                        data-target="#modal-edit">
                                                        <i class="fa fa-edit mr-1"></i>
                                                        Edit
                                                    </button>
                                                    @if ($category->status == 1)
                                                        <button class="btn btn-danger editStatus" data-id="{{ $category->id }}"
                                                            data-status="{{ $category->status }}" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                            <i class="fa fa-times-circle mr-1"></i>
                                                            Disabled
                                                        </button>
                                                    @else
                                                        <button class="btn btn-warning editStatus" data-id="{{ $category->id }}"
                                                            data-status="{{ $category->status }}" data-toggle="modal"
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
                        Add new category
                    </h4>
                    <button type="button" class="close text-xl text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('category_management_store') }}" method="POST" class="postForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputCategoryName">Category Name</label>
                                    <input type="text" class="form-control" id="exampleInputCategoryName"
                                        name="category_name" placeholder="Enter Category Name" required>
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
                        Edit category
                    </h4>
                    <button type="button" class="close text-xl text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('category_management_update') }}" method="POST" class="postForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="e_id" name="id" hidden>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="e_category_name">Category Name</label>
                                    <input type="text" class="form-control" id="e_category_name"
                                        name="category_name" placeholder="Enter Category Name" required>
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
                <form action="{{ route('category_management_status') }}" method="POST" class="postForm">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control id" name="id" hidden>
                        <input type="text" class="form-control status" name="status" hidden>
                        <p class="text-lg">Are you sure you want to update the status of this category ?</p>
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
        $("#categoryManagement").addClass("active");

        //This will be the title of the table when using the table tools like Excel, PDF, and Print.
        const tableTitle = "List of Categories";
        const loadingStatus = false;

        $(document).ready(function() {
            $('.editWithData').on('click', function() {
                const path = "{{ route('category_management_edit') }}";
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
                        $('#e_category_name').val(json['category_name']);

                    }
                });
            });

            function filterTable() {
                const showActive = $('#activeCheckBox').is(':checked');
                const showInactive = $('#inactiveCheckBox').is(':checked');

                $('#tableActionTools tbody tr').each(function() {
                    const statusText = $(this).find('td:nth-child(3)').text().toLowerCase();

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
