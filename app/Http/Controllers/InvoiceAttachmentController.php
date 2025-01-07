<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:اضافة مرفق', ['only' => ['store']]);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'file_name'=>'required|mimes:pdf, jpeg ,.jpg , png|max:10000',
            ],[
                'file_name.required'=>'يجب ادخال ملف',
                'file_name.mimes'=>'يجب ان يكون صيغه منpdf, jpeg ,.jpg , png ',
            ]
        );
        $invoiceId=$request->invoice_id;
        $image=$request->file('file_name');
        $fileName=$image->getClientOriginalName();
        $attachment=new InvoiceAttachment();
        $attachment->fileName=$fileName;
        $attachment->invoiceNumber=$request->invoice_number;
        $attachment->createdBy=Auth::user()->name;
        $attachment->invoice_id=$invoiceId;
        $attachment->save();
        $imageName=$request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/Invoice'),$imageName);
        return back()->with('success','تم اضافه المرفق بنجاح');
    }

}
