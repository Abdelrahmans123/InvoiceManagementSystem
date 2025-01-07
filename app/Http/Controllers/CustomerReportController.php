<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    public function index()
    {
        $department=Department::all();
        return view('CustomerReport.index',compact('department'));
    }
    public function searchCustomer(Request $request){
        if($request->Section && $request->product && $request->start_at=='' && $request->end_at == ''){
            $invoices=Invoice::select('*')->where('department_id','=',$request->Section)->where('product','=',$request->product)->get();
            $department=Department::all();
            return view('CustomerReport.index',compact('invoices','department'));
        }else{
            $start_at=date($request->start_at);
            $end_at=date($request->end_at);
            $invoices=Invoice::select('*')->whereBetween('invoiceDate',[$start_at,$end_at])->where('department_id','=',$request->Section)->where('product','=',$request->product)->get();
            $department=Department::all();
            return view('CustomerReport.index',compact('invoices','department','start_at','end_at'));
        }
    }
}
