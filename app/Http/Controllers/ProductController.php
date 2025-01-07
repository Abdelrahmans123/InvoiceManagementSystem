<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // function __construct()
    // {

    //     $this->middleware('permission:المنتجات', ['only' => ['index']]);
    //     $this->middleware('permission:اضافة منتج', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:تعديل منتج', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:حذف منتج', ['only' => ['destroy']]);

    // }
    public function index()
    {
        $product=Product::all();
        $department=Department::all();
        return view('product.index',compact('product'),compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'product_name'=>'required|string|unique:products,productName',
                'description'=>'required|string',
                'departmentId'=>'required|exists:departments,id',
            ],[
                'product_name.required'=>  'يرجى ادخال اسم المنتج',
                'product_name.unique'=>  'اسم المنتج مسجل مسبقا',
                'departmentId.exists'=>'اسم القسم غير مسجل ',
                'description.required'=>  'يرجى ادخال الوصف',
            ]
        );
        $product=new Product();
        $product->productName=$request->product_name;
        $product->department_id=$request->departmentId;
        $product->description=$request->description;
        $product->save();
        return redirect('product')->with('success','تم اضافه المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request)
    {
        $id=$request->id;
        $request->validate(
            [
                'product_name'=>'required|string|unique:products,productName,'.$id,
                'description'=>'required|string',
                'departmentId'=>'required|exists:departments,id',
            ],[
                'product_name.required'=>  'يرجى ادخال اسم المنتج',
                'product_name.unique'=>  'اسم المنتج مسجل مسبقا',
                'departmentId.exists'=>'اسم القسم غير مسجل ',
                'description.required'=>  'يرجى ادخال الوصف',
            ]
        );
        $product=Product::find($id);
        $product->productName=$request->product_name;
        $product->department_id=$request->departmentId;
        $product->description=$request->description;
        $product->save();
        return redirect('product')->with('success','تم تعديل المنتج بنجاح');
    }


    public function destroy(Request $request)
    {
        $productId=$request->id;
        $product=Product::find($productId)->first();
        $product->delete();
        return redirect('product')->with('success','تم حذف المنتج بنجاح');
    }
}
