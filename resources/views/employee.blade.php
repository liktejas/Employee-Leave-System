<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Leave System | Employee</title>

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
            <a href="{{url('/employee')}}" class="nav-link active">
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
            <h1 class="m-0">Employee Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Master</li>
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
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addemp"><i class="fas fa-plus-circle"></i> Add Employee</button>

            <!-- Add Dept Modal -->
            <div class="modal fade" id="addemp" tabindex="-1" aria-labelledby="addempLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addempLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/add_employee" method="post">
                    <div class="modal-body">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employee">Add Employee:</label>
                                <input type="text" class="form-control" name="employee" id="employee" placeholder="Enter Employee" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Add Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" autocomplete="off" required>
                                <small id="email_msg"></small>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Add Mobile:</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Add Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department_id">Add Department:</label>
                                <select class="custom-select" id="department_id" name="department_id" required>
                                    <option value="">Select Department</option>
                                    @foreach($dept as $row)
                                    <option value="{{$row->id}}">{{$row->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Add Address:</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Add Birthday:</label>
                                <input type="text" class="form-control" name="birthday" id="birthday" placeholder="Enter Birthday" autocomplete="off" required>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" id="add_emp_btn" value="Add Employee" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Dept Modal -->
            <div class="modal fade" id="edit_emp_modal" tabindex="-1" aria-labelledby="edit_emp_modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="edit_emp_modalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/edit_emp" method="post">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="id" id="edit_id">
                                <label for="edit_employee">Edit Employee:</label>
                                <input type="text" class="form-control" name="edit_employee" id="edit_employee" placeholder="Enter Employee" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Edit Email:</label>
                                <input type="email" class="form-control" name="edit_email" id="edit_email" autocomplete="off" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_mobile">Edit Mobile:</label>
                                <input type="text" class="form-control" name="edit_mobile" id="edit_mobile" autocomplete="off" placeholder="Enter Mobile" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_password">Edit Password:</label>
                                <input type="password" class="form-control" name="edit_password" id="edit_password" placeholder="Enter Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_department_id">Edit Employee:</label>
                                <select class="custom-select" id="edit_department_id" name="edit_department_id" required>
                                    <option value="">Select Department</option>
                                    @foreach($dept as $row)
                                    <option value="{{$row->id}}">{{$row->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_address">Edit Address:</label>
                                <input type="text" class="form-control" name="edit_address" id="edit_address" autocomplete="off" placeholder="Enter Address" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_birthday">Edit Birthday:</label>
                                <input type="text" class="form-control" name="edit_birthday" id="edit_birthday" autocomplete="off" placeholder="Enter Birthday" required>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" id="edit_emp_btn" value="Edit Employee">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="table-responsive mb-4">
              <table class="table" id="emp_table">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody id="emp_tbody">
                @foreach($data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td> 
                    <td>{{$row->email}}</td> 
                    <td>{{$row->mobile}}</td> 
                    <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_emp_modal" data-id="{{$row->id}}" data-edit_employee="{{$row->name}}" data-edit_email="{{$row->email}}" data-edit_mobile="{{$row->mobile}}" data-edit_address="{{$row->address}}" data-edit_password="{{$row->password}}" data-edit_birthday="{{$row->birthday}}" data-edit_department_id="{{$row->department_id}}"><i class="fas fa-edit"></i></a></td>
                    <td><a href="/delete_emp/{{$row->id}}" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i></a>
                    <script type="text/javascript">
                        function confirmDelete() {
                          return confirm('Are you sure you want to delete this employee?')
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready( function () {
    var emp_table = $('#emp_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy','excel','print']
    });
    emp_table
    .order([0, 'desc']).draw();

    $('#edit_emp_modal').on('show.bs.modal', function (event) {
      // console.log("modal open");
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id') // Extract info from data-* attributes
      var edit_employee = button.data('edit_employee')
      var edit_email = button.data('edit_email')
      var edit_mobile = button.data('edit_mobile')
      var edit_password = button.data('edit_password')
      var edit_address = button.data('edit_address')
      var edit_birthday = button.data('edit_birthday')
      var edit_department_id = button.data('edit_department_id')
      
      var modal = $(this)
      modal.find('.modal-body #edit_id').val(id)
      modal.find('.modal-body #edit_employee').val(edit_employee)
      modal.find('.modal-body #edit_email').val(edit_email)
      modal.find('.modal-body #edit_mobile').val(edit_mobile)
      modal.find('.modal-body #edit_address').val(edit_address)
      modal.find('.modal-body #edit_birthday').val(edit_birthday)
      modal.find('.modal-body #edit_password').val(edit_password)
      modal.find('.modal-body #edit_department_id').val(edit_department_id)
      });
        
    $('input[name="birthday"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale:{
            cancelLabel: 'Clear'
        }
    });

    $('input[name="birthday"]').on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('input[name="birthday"]').on('cancel.daterangepicker', function(ev, picker){
        $(this).val('');
    });

    $('input[name="edit_birthday"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale:{
            cancelLabel: 'Clear'
        }
    });

    $('input[name="edit_birthday"]').on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('input[name="edit_birthday"]').on('cancel.daterangepicker', function(ev, picker){
        $(this).val('');
    });

    $('#email').keyup(function () {
        var email_val = $(this).val();
        $.ajax({
          url:'check_email',
          type:'get',
          data:{email_val},
          success:function(result){
            if(email_val.length == '')
            {
              $('#email_msg').css('color','red');
              $('#email_msg').html('Email cannot be empty');
              $('#add_emp_btn').attr('disabled', true);
            }
            else
            {
              if(result == 0)
              {
                $('#email_msg').css('color','green');
                $('#email_msg').html('Email Available');
                $('#add_emp_btn').attr('disabled', false);
              }
              else
              {
                $('#email_msg').css('color','red');
                $('#email_msg').html('Email Already Exist, Please Enter other Email');
                $('#add_emp_btn').attr('disabled', true);
              }
            }
          }
        });
    });

});
</script>
</body>
</html>
