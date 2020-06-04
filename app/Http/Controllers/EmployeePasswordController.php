<?php

namespace App\Http\Controllers;

use App\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use JWTAuthException;
use TokenExpiredException;
use UnauthorizedHttpException;

class EmployeePasswordController extends Controller
{
    private $employee;
    public function __construct(Employee $employee){
        $this->employee = $employee;
    }
   
    public function register(Request $request){
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'dob' => $request->dob,
                'start_date' => $request->start_date,
                'annual_leave' => $request->annual_leave,
                'id_card' => $request->id_card,
                'bank_account' => $request->bank_account,
                'salary' => $request->salary,
                'phone' => $request->phone,
                'address' => $request->address,
                'contact_name' => $request->contact_name,
                'contact_relation' => $request->contact_relation,
                'contact_phone' => $request->contact_phone,
                'status' => 0,
                'department_id' => 1,
                'unit_id' => 1,
                'position_id' => 1,
                'group_id' => 1,
            ];
            
            if ($request->hasfile('profile'))
            {
                $file = $request->file('profile');
                $name = time() . $file->getClientOriginalName();
                $filePath = 'laravel/images/' . $name;
                $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
                $data['profile'] = Storage::disk('s3')->url($filePath);
            }
            $employee = $this->employee->create($data);
            $token = JWTAuth::fromUser($employee);
            return response()->json([
                'status' => true, 
                'message' => 'Employee created successfully', 
                'data' => $employee,
                'token' => $token
            ]);
        } catch (Exception $ex) { // Anything that went wrong
            return response()->json([
                'status' => false, 
                'message' => $ex
            ]);
        }
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $currentUser = Auth::user();
        return response()->json([
            'token' => $token,
            'user' => $currentUser
        ]);
    }

    public function employee(Request $request){
        $employee = JWTAuth::toUser($request->token);
        return response()->json(['employee' => $employee]);
    }

    public function list(Request $request){
        $employees = Employee::all();
        return response()->json(['employees' => $employees]);
    }

    public function edit(Request $req, $id) {
        $employee = Employee::find($id);
        return response()->json(['employee' => $employee]);
    }

    public function update(Request $req, $id) {
        $employee = Employee::find($id);
        $employee->first_name = $req->get('first_name');
        $employee->last_name = $req->get('last_name');
        if ($req->hasfile('profile'))
        {
            $file = $req->file('profile');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'laravel/images/' . $name;
            $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
            $employee->profile = Storage::disk('s3')->url($filePath);
        }
        $employee->save();
        $employee->update();
        return response()->json(['employee' => $employee]);
    }

    public function refresh()
    {
        $token = Auth::guard()->parseToken()->refresh();
        return response()->json(['token' => $token]);
    }

    public function change_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return redirect('/admin/employees')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $emp = Employee::find($id);
        $emp->password = Hash::make($request->password);
        $emp->save();
        $emp->update();
        return redirect('/admin/employees')
            ->with('success', 'Password have been changed!');
    }

    public function profile_upload(Request $request, $id)
    {
        $emp = Employee::find($id);
        if($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'laravel/images/' . $name;
            $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
            $path = Storage::disk('s3')->url($filePath);
            $emp->profile = $path;
            $emp->save();
            $emp->update();
            return response()->json(['path' => $path]);
        }
        return response()->json(['message' => 'Failed']);
    }
}
