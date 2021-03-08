<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Leave System | Leave Type</title>

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
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Department Master</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/leave_type')}}" class="nav-link active">
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
            <h1 class="m-0">Leave Type Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave Type Master</li>
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
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addleave"><i class="fas fa-plus-circle"></i> Add Leave Type</button>

            <!-- Add Dept Modal -->
            <div class="modal fade" id="addleave" tabindex="-1" aria-labelledby="addleaveLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addleaveLabel">Add Leave Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/add_leave_type" method="post">
                    <div class="modal-body">
                      @csrf
                      <div class="form-group">
                        <label for="leave">Add Leave Type:</label>
                        <input type="text" class="form-control" name="leave" id="leave" placeholder="Enter Leave Type" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" id="add_dept_btn" value="Add Leave Type" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Dept Modal -->
            <div class="modal fade" id="edit_leave" tabindex="-1" aria-labelledby="edit_leaveLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="edit_leaveLabel">Edit Leave Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/edit_leave_type" method="post">
                    @csrf
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="edit_leave_type">Edit Leave Type:</label>
                        <input type="text" class="form-control" name="edit_leave_type" id="edit_leave_type" required>
                        <input type="hidden" name="edit_id" id="edit_id">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Edit Leave Type">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="table-responsive mb-4">
              <table class="table" id="leave_table">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Leave Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody id="emp_tbody">
                @foreach($data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->leave_type}}</td> 
                    <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_leave" data-id="{{$row->id}}" data-edit_leave_type={{$row->leave_type}}><i class="fas fa-edit"></i></a></td>
                    <td><a href="/delete_leave_type/{{$row->id}}" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i></a>
                    <script type="text/javascript">
                        function confirmDelete() {
                          return confirm('Are you sure you want to delete this Leave Type?')
                        }
                    </script>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
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
    var leave_table = $('#leave_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy','excel','print']
    });
    leave_table
    .order([0, 'desc']).draw();

    $('#edit_leave').on('show.bs.modal', function (event) {
      // console.log("modal open");
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id') // Extract info from data-* attributes
      var edit_leave_type = button.data('edit_leave_type')
      
      var modal = $(this)
      modal.find('.modal-body #edit_id').val(id)
      modal.find('.modal-body #edit_leave_type').val(edit_leave_type)
      });
        
});
</script>
</body>
</html>
