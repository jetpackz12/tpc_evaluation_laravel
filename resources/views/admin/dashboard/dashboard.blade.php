<x-layout_admin>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <a href="{{ route('pending_account') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Student Pending Account</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <a href="{{ route('approved_account') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Student Approved Account</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-12">
                        <a href="{{ route('cancelled_account') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Student Cancelled Account</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-12 col-12">
                        <a href="{{ route('teacher_management') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Teacher</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-chalkboard-teacher"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <a href="{{ route('program_management') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Program</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clipboard-list"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <a href="{{ route('subject_management') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Subject</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clipboard-list"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-12">
                        <a href="{{ route('category_management') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Category</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clipboard-list"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <a href="{{ route('facetoface_question') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Face to Face Question</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-comments"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <a href="{{ route('online_question') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Online Question</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-comments"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-12 col-12">
                        <a href="{{ route('evaluation_result') }}" class="w-100 h-100">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>Evaluation Result</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-chart-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $("#dashboard").addClass("active");
    </script>

</x-layout_admin>
