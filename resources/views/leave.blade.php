<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Leave System | Leave</title>

@include('partials/links')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <a href="/logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Emp Leave System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{session()->get('USER_NAME')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(session()->get('ROLE')==1)
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Department Master</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/leave_type')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Leave Type Master</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/employee')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Employee Master</p>
            </a>
          </li>
          @endif
          @if(session()->get('ROLE')==2)
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Profile</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{url('/leave')}}" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>Leave</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Leave</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="container">
            <span id="msg"></span>
            {!! session('db_change_status') !!}
            @if(session()->get('ROLE') == 2)
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addleave"><i class="fas fa-plus-circle"></i> Add Leave</button>
            @endif

            <!-- Add Leave Modal -->
            <div class="modal fade" id="addleave" tabindex="-1" aria-labelledby="addleaveLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addleaveLabel">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/request_leave" method="post">
                    <div class="modal-body">
                      @csrf
                        <div class="form-group">
                            <label for="leave_type">Leave Type:</label>
                            <select class="custom-select" id="leave_type" name="leave_type" required>
                                <option value="">Select Leave Type</option>
                                @foreach($leave_type as $row)
                                <option value="{{$row->id}}">{{$row->leave_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fromdate">From Date:</label>
                            <input type="text" class="form-control" name="fromdate" id="fromdate" placeholder="From Date" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="todate">To Date:</label>
                            <input type="text" class="form-control" name="todate" id="todate" placeholder="To Date" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="leave_desc">Leave Description:</label>
                            <input type="text" class="form-control" name="leave_desc" id="leave_desc" placeholder="Leave Description" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" id="add_dept_btn" value="Request Leave" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            @if(session()->get('ROLE')==2)
            <div class="table-responsive mb-4">
              <table class="table" id="leave_table2">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Leave Type</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Leave Description</th>
                    <th>Leave Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="emp_tbody">
                @foreach($user1_leave_data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>
                    @foreach($leave_type as $leave)
                        @if($leave->id == $row->leave_id)
                            {{$leave->leave_type}}
                        @endif
                    @endforeach
                    </td> 
                    <td>{{$row->leave_from}}</td> 
                    <td>{{$row->leave_to}}</td> 
                    <td>{{$row->leave_description}}</td>
                    <td id="td_{{$row->id}}">{{$row->leave_status}}</td>
                      @if($row->leave_status == 'pending')
                      <td><a href="/delete_leave/{{$row->id}}" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i></a>
                      <script type="text/javascript">
                          function confirmDelete() {
                            return confirm('Are you sure you want to delete this leave?')
                          }
                      </script>
                      </td>
                      @elseif($row->leave_status == 'approved')
                      <td><i class="fas fa-check-circle text-success"></i></td>
                      @else
                      <td><i class="fas fa-times-circle text-danger"></i></td>
                      @endif
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div><!--- resp table --->
            @endif

            @if(session()->get('ROLE')==1)
            <div class="table-responsive mb-4">
              <table class="table" id="leave_table">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Leave Type</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Leave Description</th>
                    <th>Leave Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="emp_tbody">
                @foreach($user_leave_data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <p style="display:none;">{{$d= App\Models\employee::where('id', '=', $row->employee_id)->get('name') }}</p>
                    <td>{{$d[0]->name}}</td>
                    <td>
                    @foreach($leave_type as $leave)
                        @if($leave->id == $row->leave_id)
                            {{$leave->leave_type}}
                        @endif
                    @endforeach
                    </td> 
                    <td>{{$row->leave_from}}</td> 
                    <td>{{$row->leave_to}}</td> 
                    <td>{{$row->leave_description}}</td>
                    <td id="td_{{$row->id}}">{{$row->leave_status}}</td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <form id="status_action_{{$row->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{$row->id}}">
                            <select name="change_leave_status" class="custom-select" id="change_leave_status_{{$row->id}}" required>
                              <option value="">Select Action</option>
                              <option value="approved">approved</option>
                              <option value="rejected">rejected</option>
                            </select>
                          </form>
                        </div>
                        <div class="col-md-3">
                          <button class="btn btn-info" id="status_change_btn_{{$row->id}}" value="{{$row->id}}" onclick="updateStatus({{$row->id}});"><i class="fas fa-arrow-alt-circle-right"></i></button>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div><!--- resp table --->
            @endif
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="javascript:void(0)">Employee Leave System</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@include('partials/scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready( function () {
    var leave_table = $('#leave_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy','excel','print']
    });
    leave_table
    .order([0, 'desc']).draw();

    var leave_table2 = $('#leave_table2').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy','excel','print']
    });
    leave_table2
    .order([0, 'desc']).draw();

    $('input[name="fromdate"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale:{
            cancelLabel: 'Clear'
        }
    });

    $('input[name="fromdate"]').on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('input[name="fromdate"]').on('cancel.daterangepicker', function(ev, picker){
        $(this).val('');
    });

    $('input[name="todate"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale:{
            cancelLabel: 'Clear'
        }
    });

    $('input[name="todate"]').on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('input[name="todate"]').on('cancel.daterangepicker', function(ev, picker){
        $(this).val('');
    });

    window.updateStatus = (id) =>{
      var status = $('#change_leave_status_'+id).val();
      var token = $("#token_"+id).val();
      if(status == '')
      {
        alert('Please select action');
      }
      else
      {
        // console.log(id+' '+status);
        // console.log(token);
        $.ajax({
          url:'change_status',
          type:'post',
          data:{change_leave_status:status, id, _token:token},
          success:function(result){
            if(result==1)
            {
              $('#msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Leave Status Changed Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              $('#td_'+id).html(status);
              $('#change_leave_status_'+id).val('')
              console.log(status);
            }
            else
            {
              $('#msg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Change Leave Status</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
          }
        });
      }
    }

});
</script>
</body>
</html>
