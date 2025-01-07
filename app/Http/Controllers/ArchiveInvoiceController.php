<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class ArchiveInvoiceController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:ارشيف الفواتير', ['only' => ['index']]);

    }
    public function index()
    {
        $invoices=Invoice::onlyTrashed()->get();
        $count=Invoice::onlyTrashed()->count();
        return view('invoices.archiveInvoice',compact('invoices','count'));
    }
    public function update(Request $request)
    {
        $invoiceId=$request->invoice_id;
        $archive=Invoice::withTrashed()->where('id',$invoiceId)->restore();
        return redirect('invoices')->with('success','تم استعاده الفاتوره بنجاح');
    }
    public function destroy(Request $request)
    {
        $invoiceId=$request->invoice_id;
        $archive=Invoice::withTrashed()->where('id',$invoiceId)->first();
        $archive->forceDelete();
        return redirect('invoices')->with('success','تم حذف الفاتوره بنجاح');
    }
}
