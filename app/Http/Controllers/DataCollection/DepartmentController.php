<?php

namespace App\Http\Controllers\DataCollection;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
// }
// <?php

// namespace App\Http\Controllers;

// use App\Models\Branches;
// use App\Models\Department;
// use Illuminate\Http\Request;

// class DepartmentController extends Controller
// {
    // Departments
    public function index(){
        return view('data_collection/departments');

        //  $departments=Department::all();
         
        // return view('data_collection/departments', compact('departments'));
    }

    // Store
    public function departments_store(Request $req){
        $req -> validate([
            'departmentName'=> 'required|string|max:250|unique:departments,departmentName'
        ]);

        $department = Department::create($req->all());

        return response()->json([
            'success'=> true,
            'message' => 'Department Added Successfully!',
            'department' => [
                'id' => $department->id,
                'departmentName' => $department->departmentName,
                'created_at' => $department->created_at->format('d/m/Y g:ia')
    ]
        ]);
    }

    // DataTable
    public function departments_datatable(){
        $departments = Department::all();
        return response()->json([
            'data'=> $departments->map(function($department){
                return [
                'id' => $department->id,
                'departmentName' => $department->departmentName,
                'created_at' => $department->created_at->format('d/m/Y g:ia'),
                'updated_at' => $department->updated_at->format('d/m/Y g:ia'),
                'actions'=> '
                    <button data-id="'.$department->id.'" 
                            data-name="'.$department->departmentName.'" 
                            class="button info outline editBtn">Edit</button>
                    <button data-id="'.$department->id.'" 
                            class="button primary outline deleteBtn">Delete</button>
                '
    ];
            })
        ]);
    }


    // Update Department
    public function departments_update(Request $req, $id){
        $req -> validate([
            'departmentName'=> 'required|string|max:250|unique:departments,departmentName'
        ]);

        $department = Department::findOrFail($id);
        $department->update($req->all());

        return response()->json([
            'success'=> true,
            'message'=>'Department Updated Successfully!',
            'department'=>[
                'id'=> $department->id,
                'departmentName'=>$department->departmentName
            ]
        ]);
    }

    // Delete department
    public function department_destroy($id){
        Department::findOrFail($id)->delete();

        return response()->json([
            'success'=> true,
            'message' => 'Department deleted successfully!'
        ]);
    }

    // Bulk Delete department
    public function bulk_department_destroy(Request $request){
        Department::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success'=> true,
            'message' => 'Departments deleted successfully!'
        ]);
    }
}
