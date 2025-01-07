<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{

    public function index()
    {
        return view('InvoiceReport.index');
    }

    public function searchInvoice(Request $request){
        $radiobtn=$request->radio;
        if($radiobtn ==1){
            if($request->type && $request->start_at == "" && $request->end_at==""){
                $invoices=Invoice::where('status','=',$request->type)->get();
                $type=$request->type;
                return view('InvoiceReport.index',compact('type'))->with('invoices',$invoices);
            }else{
                $start=date($request->start_at);
                $end=date($request->end_at);
                $type=$request->type;
                $invoices=Invoice::select('*')->whereBetween('invoiceDate',[$start,$end])->where('status','=',$request->type)->get();
                return view('InvoiceReport.index',compact('type','start','end'))->with('invoices',$invoices);
            }
        }else{
            $invoices=Invoice::select('*')->where('invoiceNumber','=',$request->invoice_number)->get();
            return view('InvoiceReport.index',compact('invoices'));
        }
    }
}
