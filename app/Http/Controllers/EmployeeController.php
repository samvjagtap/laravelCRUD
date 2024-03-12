<?php

namespace App\Http\Controllers;

use App\Models\tbl_employees;
use DB;
use Illuminate\Http\Request;
date_default_timezone_set("Asia/Kolkata");

class EmployeeController extends Controller
{
    public function index() {
        $aCityList = json_decode(
            DB::table('tbl_citys')
            ->select('city_id', 'name')
            ->get()
        );
        $aResult['aCityList'] = $aCityList;
        return view('addEmployee', ['aData' => $aResult]);
    }
    public function addEmployee(Request $request) {
        $oEmployee = new tbl_employees;
        
        $sFile = $request->file('profile');
        $fileName = time().''.$sFile->getClientOriginalName();
        $sFilePath = $sFile->storeAs('images',$fileName,'public');

        $dDateTime =  date('Y:m:d H:i:s', time());
        
        $oEmployee->fname = $request->fname;
        $oEmployee->lname = $request->lname;
        $oEmployee->designation = $request->designation;
        $oEmployee->age = $request->age;
        $oEmployee->email = $request->email;
        $oEmployee->city = $request->city;
        $oEmployee->address = $request->address;
        $oEmployee->phone = $request->phone;
        $oEmployee->salary = $request->salary;
        $oEmployee->password = $request->password;
        $oEmployee->created_at = $dDateTime;
        $oEmployee->updated_at = $dDateTime;
        $oEmployee->image = $sFilePath;

        $oEmployee->save();

        $aResult['code'] = 111;
        $aResult['massege'] = 'Employee data added sucessfully';
        
        return response()->json($aResult);
        
        // $dDateTime =  date('Y:m:d H:i:s', time());
        // $iID = DB::table('tbl_employees')
        //     ->insertGetId([
        //         'fname' => $request->fname, 
        //         'lname' => $request->lname, 
        //         'designation' => $request->designation, 
        //         'age' => $request->age, 
        //         'email' => $request->email, 
        //         'city' => $request->city,
        //         'address' => $request->address, 
        //         'phone' => $request->phone, 
        //         'salary' => $request->salary,
        //         'password' => $request->password,
        //         'created_at' => $dDateTime,
        //         'updated_at' => $dDateTime
        //     ]
        // );
        // if ($iID > 0) {
        //     $aResult['code'] = 111;
        //     $aResult['id'] = $iID;
        //     $aResult['massege'] = 'Employee data added sucessfully';
        // } else {
        //     $aResult['code'] = 101;
        //     $aResult['id'] = $iID;
        //     $aResult['massege'] = 'Employee data not added sucessfully';
        // }
        // return redirect()->route('getAllEmp');
    }

    public function getAllEmpData() {
        $aData = json_decode(
                DB::table('tbl_employees as e')
                ->join('tbl_citys as c', 'e.city', '=', 'c.city_id')
                ->select(
                    'e.emp_id', 'e.fname', 'e.lname', 'e.designation', 
                    'e.age', 'e.email', 'e.address', 'e.phone', 
                    'e.salary', 'c.name as city')
                ->get()
            );

        if (!empty($aData)) {
            $aResult['code'] = 111;
            $aResult['data'] = $aData;
            $aResult['message'] = 'Data fetched succesfully';
        } else {
            $aResult['code'] = 101;
            $aResult['data'] = $aData;
            $aResult['message'] = 'Data not fetched succesfully';
        }
        return view('showAllEmployee', ['aData' => $aResult]);
    }
    
    public function deleteEmployee($iID) {
        $iID = DB::table('tbl_employees')
                ->where('emp_id', $iID)
                ->delete();
        if (!empty($iID)) {
            $aResult['code'] = 111;
            $aResult['data'] = $iID;
            $aResult['message'] = 'Data deleted succesfully';
        } else {
            $aResult['code'] = 101;
            $aResult['data'] = $iID;
            $aResult['message'] = 'Data not deleted succesfully';
        }
        return redirect()->route('getAllEmp');
    }

    public function getSingleEmployee($iID) {
        $aData = json_decode(
            DB::table('tbl_employees')
            ->where('emp_id', $iID)
            ->get()
        );

        if (!empty($aData)) {

            $aCityList = json_decode(
                DB::table('tbl_citys')
                ->select('city_id', 'name')
                ->get()
            );
            $aData['aCityList'] = $aCityList;

            $aResult['code'] = 111;
            $aResult['data'] = $aData;
            $aResult['message'] = 'Data fetched succesfully';
        } else {
            $aResult['code'] = 101;
            $aResult['data'] = $aData;
            $aResult['message'] = 'Data not fetched succesfully';
        }
        return view('updateEmployee', ['aData' => $aResult]);
    } 

    public function updateEmployeeData(Request $request, $iID) {
        $dDateTime =  date('Y:m:d H:i:s', time());
        $bResult = DB::table('tbl_employees')
            ->where('emp_id', $iID)
            ->update([
                'fname' => $request->fname, 
                'lname' => $request->lname, 
                'designation' => $request->designation, 
                'age' => $request->age, 
                'email' => $request->email, 
                'city' => $request->city,
                'address' => $request->address, 
                'phone' => $request->phone, 
                'salary' => $request->salary,
                'password' => $request->password,
                'updated_at' => $dDateTime
            ]);

        if ($bResult) {
            $aResult['code'] = 111;
            $aResult['data'] = $bResult;
            $aResult['message'] = 'Data updated succesfully';
        } else {
            $aResult['code'] = 101;
            $aResult['data'] = $bResult;
            $aResult['message'] = 'Data not updated succesfully';
        }
        return redirect()->route('getAllEmp');
    }
}
