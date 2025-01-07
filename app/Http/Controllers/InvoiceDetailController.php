<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:حذف المرفق', ['only' => ['destroy']]);
    }

    public function destroy(Request $request)
    {
        $invoices = InvoiceAttachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('publicUpload')->delete($request->file_name);
        return back()->with('success', 'تم الحذف المرفق بنجاح');
    }

    public function getDepartment($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $invoiceDetail = InvoiceDetail::where('invoice_id', $id)->get();
        $invoiceAttachment = InvoiceAttachment::where('invoice_id', $id)->get();
        return view('invoices.invoiceDetail', compact('invoices', 'invoiceDetail', 'invoiceAttachment'));
    }

    public function openFile($fileName)
    {
        $file = Storage::disk('publicUpload')->getDriver()->getAdapter()->applyPathPrefix($fileName);
        return response()->file($file);
    }

    public function downloadFile($fileName)
    {
        $file = Storage::disk('publicUpload')->getDriver()->getAdapter()->applyPathPrefix($fileName);
        return response()->download($file);
    }
}
