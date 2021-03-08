<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\department;
use App\Models\leave;
use App\Models\user_leave;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    function __construct(){
        session_start();
    }
    public function login(Request $req)
    {
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = $req->email;
        $password = $req->password;
        $confirm_login = employee::where('email', '=', $email)->where('password', '=', $password)->count();
        if($confirm_login > 0)
        {
            $get_emp_data = employee::where('email', '=', $email)->where('password', '=', $password)->get(['id','name','role']);
            $req->session()->put('ROLE', $get_emp_data[0]->role);
            $req->session()->put('USER_ID', $get_emp_data[0]->id);
            $req->session()->put('USER_NAME', $get_emp_data[0]->name);
            $req->session()->put('EMAIL', $email);
            return redirect('dashboard');
        }
        else
        {
            $req->session()->flash('login_status', 'Failed to Login');
            return redirect('/');
        }
    }
    
    public function dashboard(Request $req)
    {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        else
        {
            if(session()->get('ROLE') == '2')
            {
                $emp_data = employee::where('role', '=', session()->get('ROLE'))->get();
                $dept_name = department::where('id', '=', $emp_data[0]->department_id)->get();
                return view('dashboard', ['emp_data' => $emp_data, 'dept_name'=>$dept_name]);
            }
            $data = department::get();
            return view('dashboard', ['data'=> $data]);
        }
    }

    public function logout(Request $req)
    {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        $req->session()->flush();
        return redirect('/');
    }

    public function adddept(Request $req)
    {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $dept = new department();
        $dept->department = $req->dept;
        $dept->save();
        return response()->json($dept);
    }

   public function edit_dept(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $data = department::find($req->edit_id);
        $data->department = $req->edit_department;
        $confirm_update = $data->save();
        if($confirm_update)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Department Updated Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('dashboard');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Update Department</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('dashboard');
        }
   }

   public function delete_dept(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $data = department::find($req->id);
        $confirm_delete = $data->delete();
        if($confirm_delete)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Department Deleted successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('dashboard');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Delete Department</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('dashboard');
        }
   }

   public function leave_type(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        else
        {
            $data = leave::get();
            return view('leave_type', ['data'=> $data]);
        }
   }
   
   public function add_leave_type(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $dept = new leave();
        $dept->leave_type = $req->leave;
        $confirm_leave = $dept->save();
        if($confirm_leave)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Leave Type Added Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave_type');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Add Leave Type</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave_type');
        }
   }

   public function edit_leave_type(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $data = leave::find($req->edit_id);
        $data->leave_type = $req->edit_leave_type;
        $confirm_update = $data->save();
        if($confirm_update)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Department Updated Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave_type');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Update Department</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave_type');
        }
   }

   public function delete_leave_type(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $data = leave::find($req->id);
        $confirm_delete = $data->delete();
        if($confirm_delete)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Leave Type Deleted successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave_type');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Delete Leave Type</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave_type');
        }
   }

   public function employee(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        else
        {
            $data = employee::get();
            $dept = department::get();
            return view('employee', ['data'=> $data, 'dept'=>$dept]);
        }
   }

   public function add_employee(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $emp = new employee();
        $emp->name = $req->employee;
        $emp->email = $req->email;
        $emp->password = $req->password;
        $emp->mobile = $req->mobile;
        $emp->department_id = $req->department_id;
        $emp->address = $req->address;
        $emp->birthday = $req->birthday;
        $emp->role = 2;
        $confirm_emp = $emp->save();
        if($confirm_emp)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Employee Added Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('employee');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Add Employee</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('employee');
        }
   }

   public function edit_employee(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $emp = employee::find($req->id);
        $emp->name = $req->edit_employee;
        $emp->email = $req->edit_email;
        $emp->password = $req->edit_password;
        $emp->mobile = $req->edit_mobile;
        $emp->department_id = $req->edit_department_id;
        $emp->address = $req->edit_address;
        $emp->birthday = $req->edit_birthday;
        $emp->role = 2;
        $confirm_emp = $emp->save();
        if($confirm_emp)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Employee Updated Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('employee');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Update Employee</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('employee');
        }
   }

   public function delete_employee(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $data = employee::find($req->id);
        $confirm_delete = $data->delete();
        if($confirm_delete)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Employee Deleted successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('employee');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Delete Employee</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('employee');
        }
   }

   public function user_leave(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        $user_leave_data = user_leave::get();
        $user1_leave_data = user_leave::where('employee_id', '=', session()->get('USER_ID'))->get();
        // return $user1_leave_data;
        $leave_type = leave::get();
        return view('leave', ['user_leave_data'=>$user_leave_data, 'leave_type'=>$leave_type, 'user1_leave_data'=>$user1_leave_data]);
   }

   public function request_leave(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '1')
        {
            return redirect('dashboard');
        }
        $data = new user_leave();
        $data->employee_id = session()->get('USER_ID');
        $data->leave_id = $req->leave_type;
        $data->leave_from = $req->fromdate;
        $data->leave_to = $req->todate;
        $data->leave_description = $req->leave_desc;
        $request_leave = $data->save();
        if($request_leave)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Request for Leave Send Successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Send Request for Leave</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave');
        }
   }

   public function delete_leave(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '1')
        {
            return redirect('dashboard');
        }
        $data = user_leave::find($req->id);
        $confirm_delete = $data->delete();
        if($confirm_delete)
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Leave Deleted successfully</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave');
        }
        else
        {
            $req->session()->flash('db_change_status', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to Delete Leave</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect('leave');
        }
   }

   public function change_status(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $t=time();
        $updated = date("Y-m-d H:i:s",$t);
        $data = DB::update("UPDATE `user_leave` SET leave_status='$req->change_leave_status', updated_at='$updated' WHERE id=$req->id");
        return response()->json($data);
   }

   public function check_email(Request $req)
   {
        if(empty($req->session()->has('USER_NAME')))
        {
            return redirect('/');
        }
        if(session()->get('ROLE') == '2')
        {
            return redirect('dashboard');
        }
        $data = employee::where('email', '=', $req->email_val)->count();
        return response()->json($data);
   }
}
