@extends('layouts.app')

@section('home')
{{-- <div class="container"> --}}
<div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#3b5998">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-text mx-3">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0">Dashboard</h1>
                    </div>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Actions
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Schedules</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage:</h6>
                        <a class="collapse-item" href="#addSched">Schedule</a>
                        <a class="collapse-item" href="#schedList">Appointments</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Charts:</h6>
                        <a class="collapse-item" href="#headingCharts">Summary</a>
                        <a class="collapse-item" href="#people">Gender</a>
                        <a class="collapse-item" href="#market">Insight</a>
                        <a class="collapse-item" href="#customer">Customer</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                    <!--Toast-->
                    <div class="toast" id="delToast" style="position: absolute; top: 0; right: 0; background-color:yellow;" delay=5000>
                        <div class="toast-header">
                            <strong class="mr-auto"><i class="fa fa-grav"></i> Delete</strong>
                        </div>
                        <div class="toast-body">Appointment has been removed from the schedule list</div>
                    </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div style="padding-top:25px;"></div>
                    <div class="row">
                    <!-- Divider -->
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" id="headingCharts">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="todayAppoint">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                New Clients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="newClients">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ongoing
                                            <span style="padding-left:10px;" id="ongoingLeft">1 left</span>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="ongoing">0</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 0%" aria-valuenow="100" aria-valuemin="0"
                                                            aria-valuemax="100" id="ongoingProgress"></div>
                                                            {{-- <span class="float-right"><p class="small ">3 of 10</p></span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Finished</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="finish">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" id="addSched">Appointments</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                       <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#appCreate">
                                        ADD
                                        </button>

                                        <!-- Modal ADD -->
                                        <div class="modal fade" id="appCreate" tabindex="-1" role="dialog" aria-labelledby="appCreateLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="appCreateLabel">Schedule new appointment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-success" role="alert" id="statusAppForm"></div>
                                                <form action="#" method="POST" id="appointForm">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" id="name" name="name" placeholder="Name*" required><br>
                                                        <input class="form-control" type="number" id="age" name="age" placeholder="Age*" min='0' max='100' required><br>
                                                        <select name="gender" id="gender" class="custom-select" aria-label=".form-select-lg example">
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                        <br><br>
                                                        <input class="form-control" type="text" id="address" name="address" placeholder="Address*" required><br>
                                                        <input class="form-control" type="date" id="date" name="date" placeholder="YYYY-MM-DD*" required pattern="\d{4}-\d{2}-\d{2}"><br>
                                                        <input class="form-control" type="time" id="time" name="time" placeholder="00:00*" required><br>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="appointSave">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <br><br>
                                       <div class="table-responsive" id="schedList">
                                            <!--Table-->
                                            <table class="table table-striped" id="appTable">

                                                <!--Table head-->
                                                <thead>
                                                    <tr>
                                                        <th>Client</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                 </thead>                           
                                                <!--Table body-->
                                                <tbody id="tableAppoint">
                                                    <?php $id=1 ; ?>
                                                    @foreach($appointments as $key => $value)
                                                        <tr id="app_{{$value->id}}">
                                                            <td>{{$value->clients->name}}</td>
                                                            <td>{{$value->date}}</td>
                                                            <td>{{$value->time}}</td>
                                                            <td>{{$value->status}}</td>
                                                            <td>
                                                            <a data-toggle="modal" data-target="#modal-app-edit" data-id="{{$value->id}}">
                                                            <i class="fa fa-pen"></i></a>
                                                            <a class="deletebtn" data-id="{{$value->id}}">
                                                            <i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    {{-- </div> --}}
                                    <nav aria-label="">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{$appointments->previousPageUrl()}}" id="appP"><</a></li>
                                            @if($appointments->currentPage() > 1)
                                                <li class="page-item"><a class="page-link" href="{{$appointments->url($appointments->currentPage() -1)}}" id="appCb">{{$appointments->currentPage() -1}}</a></li>
                                            @endif 
                                            <li class="page-item"><a class="page-link" href="{{$appointments->url($appointments->currentPage())}}" id="appC">{{$appointments->currentPage()}}</a></li>
                                            @if($appointments->currentPage()+1 < $appointments->lastPage())
                                                <li class="page-item"><a class="page-link" href="{{$appointments->url($appointments->currentPage()+1)}}" id=appCn>{{$appointments->currentPage()+1}}</a></li>
                                            @endif
                                            <li class="page-item"><a class="page-link" href="{{$appointments->url($appointments->lastPage())}}" id="appL">...</a></li>
                                            <li class="page-item"><a class="page-link" href="{{$appointments->nextPageUrl()}}" id="appN">></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class=" pt-4 pb-2" id="people">
                                        <div id="gender_chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary" id="market">Feedbacks</h6>
                                </div>
                                <div class="card-body">
                                    @foreach($feeds as $key => $value)
                                        <p class="small">{{$value->note}}
                                            <span class="float-right font-weight-bold">{{$value->client->name}}</span>
                                        </p><hr>
                                    @endforeach
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{$feeds->previousPageUrl()}}" id="feedP"><</a></li>
                                            @if($feeds->currentPage() > 1)
                                                <li class="page-item"><a class="page-link" href="{{$feeds->url($feeds->currentPage() -1)}}" id="feedCb">{{$feeds->currentPage() -1}}</a></li>
                                            @endif 
                                            <li class="page-item"><a class="page-link" href="{{$feeds->url($feeds->currentPage())}}" id="feedC">{{$feeds->currentPage()}}</a></li>
                                            @if($feeds->currentPage()+1 < $feeds->lastPage())
                                                <li class="page-item"><a class="page-link" href="{{$feeds->url($feeds->currentPage()+1)}}" id=feedCn>{{$feeds->currentPage()+1}}</a></li>
                                            @endif
                                            <li class="page-item"><a class="page-link" href="{{$feeds->url($feeds->lastPage())}}" id="feedL">...</a></li>
                                            <li class="page-item"><a class="page-link" href="{{$feeds->nextPageUrl()}}" id="feedN">></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary" id="customer">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div id="weeklyChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <!--MODAL EDIT-->
                 <div class="modal fade" id="modal-app-edit" tabindex="-1" role="dialog" aria-labelledby="appCreateLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="appCreateLabel">Edit appointment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" role="alert" id="statusAppFormE"></div>
                            <form action="#" method="POST" id="appointEditForm">
                                @csrf
                                <input type="hidden" name="id" id="apppoint_id">
                                <div class="form-group">
                                    <select name="status" id="statusE" class="custom-select" aria-label=".form-select-lg example">
                                        <option value="ongoing">Ongoing</option>
                                        <option value="finished">Finish</option>
                                        <option value="cancelled">Cancel</option>
                                    </select>
                                    <br><br>
                                    <input class="form-control" type="date" id="dateE" name="date" placeholder="YYYY-MM-DD*" required pattern="\d{4}-\d{2}-\d{2}"><br>
                                    <input class="form-control" type="time" id="timeE" name="time" placeholder="00:00*" required><br>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="appointUpdate">Save</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!--END EDIT-->

            </div>
            <!-- End of Main Content -->
    
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Scheduler 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
</div>
@endsection
@section('scripts')
    <script src="./js/scheduler/home.js"></script>
@endsection