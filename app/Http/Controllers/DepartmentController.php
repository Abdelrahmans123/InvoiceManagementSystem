<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:الاقسام', ['only' => ['index']]);
        $this->middleware('permission:اضافة قسم', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);

    }

    public function index()
    {
        $department=Department::paginate(4);
        return view('department.index',compact('department'));
    }

 

    public function store(Request $request)
    {
        $request->validate(
            [
                'department_name'=>'required|string|unique:departments,departmentName',
                'description'=>'required|string',
            ],[
                'department_name.required'=>  'يرجى ادخال اسم القسم',
                'department_name.unique'=>  'اسم القسم مسجل مسبقا',
                'description.required'=>  'يرجى ادخال الوصف',
            ]
        );

        $department=new Department();
        $department->departmentName=$request->department_name;
        $department->description=$request->description;
        $department->createdBy=Auth::user()->name;
        $department->save();
        return redirect('department')->with('success','تم اضافه القسم بنجاح');
    }



    public function update(Request $request, Department $department)
    {
        $id=$request->id;
        $request->validate(
            [
                'department_name'=>'required|string|unique:departments,departmentName,'.$id,
                'description'=>'required|string',
            ],[
                'department_name.required'=>  'يرجى ادخال اسم القسم',
                'department_name.unique'=>  'اسم القسم مسجل مسبقا',
                'description.required'=>  'يرجى ادخال الوصف',
            ]
        );

        $department=Department::find($id);
        $department->departmentName=$request->department_name;
        $department->description=$request->description;
        $department->createdBy=Auth::user()->name;
        $department->save();
        return redirect('department')->with('success','تم تعديل القسم بنجاح');
    }


    public function destroy(Request $request)
    {
        $departmentId=$request->id;
        $department=Department::find($departmentId)->first();
        $department->delete();
        return redirect('department')->with('success','تم حذف القسم بنجاح');
    }
}
