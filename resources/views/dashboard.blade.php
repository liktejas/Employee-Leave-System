<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Leave System | Dashboard</title>

@include('partials/links')
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
          @if(session()->get('ROLE') == '1')
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link active">
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
          <li class="nav-item">
            <a href="{{url('/leave')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Leave</p>
            </a>
          </li>
          @endif
          @if(session()->get('ROLE') == '2')
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/leave')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Leave</p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session()->get('ROLE') == '1')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Department Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Department Master</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    @if(session()->get('ROLE') == '2')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="container">
            <span id="msg"></span>
            {!! session('db_change_status') !!}
            @if(session()->get('ROLE') == '1')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#adddept"><i class="fas fa-plus-circle"></i> Add Department</button>
            @endif
            <!-- Add Dept Modal -->
            <div class="modal fade" id="adddept" tabindex="-1" aria-labelledby="adddeptLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="adddeptLabel">Add Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="add_dept_form">
                    <div class="modal-body">
                      @csrf
                      <div class="form-group">
                        <label for="department">Add Department:</label>
                        <input type="text" class="form-control" name="department" id="department" placeholder="Enter Department" required>
                      </div>
                      <span id="dept_err_msg" class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <!-- <button type="button" class="btn btn-primary">Add Department</button> -->
                      <input type="submit" id="add_dept_btn" value="Add Department" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Dept Modal -->
            <div class="modal fade" id="edit_dept_modal" tabindex="-1" aria-labelledby="edit_dept_modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="edit_dept_modalLabel">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/edit_dept" method="post">
                    @csrf
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="edit_department">Edit Department:</label>
                        <input type="text" class="form-control" name="edit_department" id="edit_department" required>
                        <input type="hidden" name="edit_id" id="edit_id">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Edit Department">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            @if(session()->get('ROLE') == '1')
            <div class="table-responsive mb-4">
              <table class="table" id="dept_table">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody id="emp_tbody">
                @foreach($data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->department}}</td> 
                    <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_dept_modal" data-id="{{$row->id}}" data-edit_department={{$row->department}}><i class="fas fa-edit"></i></a></td>
                    <td><a href="/delete_dept/{{$row->id}}" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i></a>
                    <script type="text/javascript">
                        function confirmDelete() {
                          return confirm('Are you sure you want to delete this department?')
                        }
                    </script>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            @endif
            @if(session()->get('ROLE') == '2')
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive">
                    <table class="table text-center table-hover table-striped table-borderless">
                      <tr>
                          <th class="bg-dark">Name:</th>
                          <td>{{$emp_data[0]->name}}</td>
                      </tr>
                      <tr>
                          <th class="bg-dark">Email:</th>
                          <td>{{$emp_data[0]->email}}</td>
                      </tr>
                      <tr>
                          <th class="bg-dark">Mobile:</th>
                          <td>{{$emp_data[0]->mobile}}</td>
                      </tr>
                      <tr>
                          <th class="bg-dark">Department:</th>
                          <td>{{$dept_name[0]->department}}</td>
                      </tr>
                      <tr>
                          <th class="bg-dark">Address:</th>
                          <td>{{$emp_data[0]->address}}</td>
                      </tr>
                      <tr>
                          <th class="bg-dark">Birthday:</th>
                          <td>{{$emp_data[0]->birthday}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              
              <!-- {{$emp_data[0]->id}} -->
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
<script>
$(document).ready( function () {
    var dept_table = $('#dept_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy','excel','print']
    });
    dept_table
    .order([0, 'desc']).draw();

    $('#add_dept_form').submit(function(e){
      e.preventDefault();
      var department = $('#department').val();
      var token = $("input[name=_token]").val();
      $.ajax({
          url:'adddept',
          type:'post',
          data:{dept:department, _token:token},
          success:function(result){
            console.log(result);
            $('#dept_table tbody').prepend('<tr><td>'+result.id+'</td><td>'+result.department+'</td><td><a href="edit/'+result.id+'" class="btn btn-warning"><i class="fas fa-edit"></i></a></td><td><a href="delete/'+result.id+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td></tr>');
            $('[name="department"]').val("");
            $('#adddept').modal('hide');
            $('#msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Department Added Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          }
        });
    }); 

    $('#edit_dept_modal').on('show.bs.modal', function (event) {
      // console.log("modal open");
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id') // Extract info from data-* attributes
      var edit_department = button.data('edit_department')
      
      var modal = $(this)
      modal.find('.modal-body #edit_id').val(id)
      modal.find('.modal-body #edit_department').val(edit_department)
      });
        
      

});
</script>
</body>
</html>
