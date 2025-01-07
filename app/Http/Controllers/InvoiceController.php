<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


// use App\Notifications\AddInvoice;
// use App\Exports\InvoicesExport;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Events\MyEventClass;
class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:قائمة الفواتير', ['only' => ['index']]);
        $this->middleware('permission:اضافة فاتورة', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف الفاتورة', ['only' => ['destroy']]);
    }
    public function index()
    {
        $invoices = Invoice::all();
        $count = Invoice::count();
        return view('invoices.index', compact('invoices', 'count'));
    }
    public function create()
    {
        $department = Department::all();
        return view('invoices.addInvoice', compact('department'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'invoice_number' => 'required|unique:invoices,invoiceNumber',
                'invoice_Date' => 'date|required',
                'Due_date' => 'date|required|after:invoice_Date',
                'departmentId' => 'required|exists:departments,id',
                'productName' => 'required|string',
                'Amount_collection' => 'required|numeric',
                'Amount_Commission' => 'required|numeric',
                'Discount' => 'required|numeric',
                'Rate_VAT' => 'required',
                'Value_VAT' => 'required|numeric',
                'Total' => 'required|numeric',
                'pic' => 'mimes:pdf, jpeg ,.jpg , png|max:10000',
            ],
            [
                'invoice_number.required' => 'يرجى ادخال رقم الفاتوره',
                'invoice_number.unique' =>  'رقم الفاتوره مسجل مسبقا',
                'invoice_Date.date' => 'يرجى ادخال تاريخ صحيح',
                'invoice_Date.required' => 'يرجى ادخال تاريخ الفاتوره',
                'Due_date.required' => 'يرجى ادخال تاريخ الاستحقاق',
                'Due_date.date' => 'يرجى ادخال تاريخ صحيح',
                'departmentId.required' => 'يرجى ادخال اسم قسم',
                'departmentId.exists' => 'اسم القسم غير مسجل ',
                'productName.required' => 'يرجى ادخال اسم المنتج',
                'Amount_collection.required' => 'يرجى ادخال مبلغ التحصيل',
                'Amount_collection.numeric' => 'يرجى ادخال رقم',
                'Amount_Commission.required' => 'يرجى ادخال مبلغ العموله',
                'Amount_Commission.numeric' => 'يرجى ادخال رقم',
                'Discount.required' => 'يرجى ادخال الخصم',
                'Discount.numeric' => 'يرجى ادخال رقم',
                'Rate_VAT.required' => 'يرجى ادخال قيمه المضافه',
                'Value_VAT.required' => 'يرجى ادخال الخصم',
                'Value_VAT.numeric' => 'يرجى ادخال رقم',
                'Total.required' => 'يرجى ادخال الخصم',
                'Total.numeric' => 'يرجى ادخال رقم',
                'pic.mimes' => 'pdf, jpeg ,.jpg , png تم الحفظ الفاتوره ولم يتم حفظ المرفق لابد ان يكون '
            ]
        );
        $invoice = new Invoice();
        $invoice->invoiceNumber = $request->invoice_number;
        $invoice->invoiceDate = $request->invoice_Date;
        $invoice->dueDate = $request->Due_date;
        $invoice->product = $request->productName;
        $invoice->department_id = $request->departmentId;
        $invoice->amountCollection = $request->Amount_collection;
        $invoice->amountCommission = $request->Amount_Commission;
        $invoice->discount = $request->Discount;
        $invoice->rateVat = $request->Rate_VAT;
        $invoice->valueVat = $request->Value_VAT;
        $invoice->total = $request->Total;
        $invoice->note = $request->note;
        $invoice->status = 'غير مدفوعه';
        $invoice->valueStatus = 2;
        $invoice->user = Auth::user()->name;
        $invoice->save();

        $invoiceId = Invoice::latest()->first()->id;
        $invoiceDetail = new InvoiceDetail();
        $invoiceDetail->invoiceNumber = $request->invoice_number;
        $invoiceDetail->invoice_id = $invoiceId;
        $invoiceDetail->product = $request->productName;
        $invoiceDetail->department = $request->departmentId;
        $invoiceDetail->status = 'غير مدفوعه';
        $invoiceDetail->valueStatus = 2;
        $invoiceDetail->user = Auth::user()->name;
        $invoiceDetail->save();
        if ($request->hasFile('pic')) {
            $invoiceId = Invoice::latest()->first()->id;
            $invoiceNumber = $request->invoice_number;
            $image = $request->file('pic');
            $fileName = $image->getClientOriginalName();
            $attachment = new InvoiceAttachment();
            $attachment->fileName = $fileName;
            $attachment->invoiceNumber = $invoiceNumber;
            $attachment->createdBy = Auth::user()->name;
            $attachment->invoice_id = $invoiceId;
            $attachment->save();
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/Invoice'), $imageName);
            return redirect('invoices')->with('success', 'تم اضافه الفاتوره بنجاح');
        }
        //Mail
        $user = User::first();
        //    $user->notify(new InvoiceAddition($invoiceId));
        //Notification
        $targetUser = User::find(auth::user()->id)->get();
        $invoiceId = Invoice::latest()->first();
        //        Notification::send($targetUser,new InvoiceNotification($invoiceId));

        return redirect('invoices')->with('success', 'تم اضافه الفاتوره بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice) {}

    public function edit($id)
    {
        $invoice = Invoice::find($id)->first();
        $department = Department::all();
        return view('invoices.edit', compact('invoice', 'department'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'invoice_number' => 'required|unique:invoices,invoiceNumber,' . $id,
                'invoice_Date' => 'date|required',
                'Due_date' => 'date|required|after:invoice_Date',
                'departmentId' => 'required|exists:departments,id',
                'productName' => 'required|string',
                'Amount_collection' => 'required|numeric',
                'Amount_Commission' => 'required|numeric',
                'Discount' => 'required|numeric',
                'Rate_VAT' => 'required',
                'Value_VAT' => 'required|numeric',
                'Total' => 'required|numeric',
            ],
            [
                'invoice_number.required' => 'يرجى ادخال رقم الفاتوره',
                'invoice_number.unique' =>  'رقم الفاتوره مسجل مسبقا',
                'invoice_Date.date' => 'يرجى ادخال تاريخ صحيح',
                'invoice_Date.required' => 'يرجى ادخال تاريخ الفاتوره',
                'Due_date.required' => 'يرجى ادخال تاريخ الاستحقاق',
                'Due_date.date' => 'يرجى ادخال تاريخ صحيح',
                'departmentId.required' => 'يرجى ادخال اسم قسم',
                'departmentId.exists' => 'اسم القسم غير مسجل ',
                'productName.required' => 'يرجى ادخال اسم المنتج',
                'Amount_collection.required' => 'يرجى ادخال مبلغ التحصيل',
                'Amount_collection.numeric' => 'يرجى ادخال رقم',
                'Amount_Commission.required' => 'يرجى ادخال مبلغ العموله',
                'Amount_Commission.numeric' => 'يرجى ادخال رقم',
                'Discount.required' => 'يرجى ادخال الخصم',
                'Discount.numeric' => 'يرجى ادخال رقم',
                'Rate_VAT.required' => 'يرجى ادخال قيمه المضافه',
                'Value_VAT.required' => 'يرجى ادخال الخصم',
                'Value_VAT.numeric' => 'يرجى ادخال رقم',
                'Total.required' => 'يرجى ادخال الخصم',
                'Total.numeric' => 'يرجى ادخال رقم',
            ]
        );
        $invoice = Invoice::find($id);
        $invoice->invoiceNumber = $request->invoice_number;
        $invoice->invoiceDate = $request->invoice_Date;
        $invoice->dueDate = $request->Due_date;
        $invoice->product = $request->productName;
        $invoice->department_id = $request->departmentId;
        $invoice->amountCollection = $request->Amount_collection;
        $invoice->amountCommission = $request->Amount_Commission;
        $invoice->discount = $request->Discount;
        $invoice->rateVat = $request->Rate_VAT;
        $invoice->valueVat = $request->Value_VAT;
        $invoice->total = $request->Total;
        $invoice->note = $request->note;
        $invoice->status = 'غير مدفوعه';
        $invoice->valueStatus = 2;
        $invoice->user = Auth::user()->name;
        $invoice->save();
        $status = 'غير مدفوعه';
        DB::update('update invoices_details set invoiceNumber = ?,product=?,department=?,note=?,status=?,valueStatus=2 where invoice_id = ?', [$request->invoice_number, $request->productName, $request->departmentId, $request->note, $status, $id]);
        return redirect('invoices')->with('success', 'تم تعديل الفاتوره بنجاح');
    }

    public function destroy(Request $request)
    {
        $invoiceId = $request->invoice_id;
        $invoices = Invoice::find($invoiceId);
        $id_page = $request->id_page;
        if ($id_page != 2) {
            Storage::disk('publicUpload')->deleteDirectory('Invoice');
            $invoices->forceDelete();
            return redirect('invoices')->with('success', 'تم الحذف الفاتوره بنجاح');
        } else {
            $invoices->delete();
            return redirect('archiveInvoice')->with('success', ' تم ارشفه الفاتوره بنجاح');
        }
    }
    public function getproduct(Request $request)
    {
        $products = DB::table('products')
            ->join('departments', 'departments.id', '=', 'products.department_id')
            ->where('products.department_id', $request->id)
            ->pluck('products.productName', 'products.id');
        if (count($products) > 0) {
            return response()->json($products);
        }
    }
    public function changeStatus($id)
    {
        $invoices = Invoice::find($id);
        return view('invoices.statusUpdate', compact('invoices'));
    }
    public function updateStatus($id, Request $request)
    {
        $invoices = Invoice::findOrFail($id);
        if ($request->Status == "مدفوعة") {
            $invoices->valueStatus = 1;
            $invoices->status = $request->Status;
            $invoices->paymentDate = $request->Payment_Date;
            $invoices->save();
            $invoiceDetail = new InvoiceDetail();
            $invoiceDetail->invoiceNumber = $request->invoice_number;
            $invoiceDetail->invoice_id = $request->invoice_id;
            $invoiceDetail->product = $request->productName;
            $invoiceDetail->department = $request->departmentId;
            $invoiceDetail->status = $request->Status;
            $invoiceDetail->valueStatus = 1;
            $invoiceDetail->paymentDate = $request->Payment_Date;
            $invoiceDetail->user = Auth::user()->name;
            $invoiceDetail->save();
        } else {
            $invoices->valueStatus = 1;
            $invoices->status = $request->Status;
            $invoices->paymentDate = $request->Payment_Date;
            $invoices->save();
            $invoiceDetail = new InvoiceDetail();
            $invoiceDetail->invoiceNumber = $request->invoice_number;
            $invoiceDetail->invoice_id = $request->invoice_id;
            $invoiceDetail->product = $request->productName;
            $invoiceDetail->department = $request->departmentId;
            $invoiceDetail->status = $request->Status;
            $invoiceDetail->valueStatus = 3;
            $invoiceDetail->paymentDate = $request->Payment_Date;
            $invoiceDetail->user = Auth::user()->name;
            $invoiceDetail->save();
        }
        return redirect('invoices')->with('success', 'تم تحديث حاله الدفع بنجاح');
    }
    public function invoicePaid()
    {
        $invoices = Invoice::where('valueStatus', 1)->get();
        $count = Invoice::where('valueStatus', 1)->count();
        return view('invoices.paidInvoice', compact('invoices', 'count'));
    }
    public function invoiceUnpaid()
    {
        $invoices = Invoice::where('valueStatus', 2)->get();
        $count = Invoice::where('valueStatus', 2)->count();
        return view('invoices.unpaidInvoice', compact('invoices', 'count'));
    }
    public function invoicePartialPaid()
    {
        $invoices = Invoice::where('valueStatus', 3)->get();
        $count = Invoice::where('valueStatus', 3)->count();
        return view('invoices.partiallyPaidInvoice', compact('invoices', 'count'));
    }
    public function printInvoice($id)
    {
        $invoices = Invoice::find($id)->first();
        return view('invoices.printInvoice', compact('invoices'));
    }
    //    public function export()
    //    {
    //        return Excel::download(new InvoiceExport, 'invoices.xlsx');
    //    }
    //    public function markAll(){
    //        $unreadNotification=auth()->user()->unreadNotifications;
    //        if($unreadNotification){
    //            $unreadNotification->markAsRead();
    //            return back();
    //        }
    //    }
}
