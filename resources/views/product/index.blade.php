@extends('layouts.master')
@section('title','قائمه المنتجات')
@section('css')
    <!-- Internal Data table css -->

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.success')
    @include('inc.error')
    <!-- row -->
    <div class="row"> <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        @can('اضافة منتج')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">اضافه منتج</a>
                        @endcan
                    </div>

                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table text-md-nowrap" id="example1" data-page-length="50">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->productName}}</td>
                                    <td>{{$item->department->departmentName}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        @can('تعديل منتج')
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" id="editbtn"
                                           data-productid="{{ $item->id }}" data-product_name="{{ $item->productName }}"
                                           data-department_name="{{ $item->department->id }}"
                                           data-description="{{ $item->description }}"  onclick="loadEditModal()"
                                           title="تعديل"><i class="las la-pen"></i></a>
                                        @endcan
                                        @can('حذف منتج')
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" id="deletebtn"
                                           data-id="{{ $item->id }}" data-productName="{{ $item->productName }}"
                                           onclick="loadDeleteModal()" title="حذف"><i class="las la-trash"></i></a>
                                            @endcan

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!--/div-->

    </div>
    <!-- row closed -->

    <!-- Container closed -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                  type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                    <form action="{{ route('product.destroy','test') }}" method="post">

                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="productid" value="">
                            <input class="form-control" name="product_name" id="product" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
            </div>
            </form>
        </div>
    </div>

    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($product as $item)
                        <form action="{{route('product.update',$item->id)}}" method="POST" autocomplete="off">
                            @endforeach
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم المنتج</label>
                                <input type="text" class="form-control" id="productname" name="product_name" required >

                            </div>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="departmentId" id="departmentname" class="form-control" required>
                                <option value="" selected disabled> --حدد القسم--</option>
                                @foreach ($department as $item)
                                    <option value="{{ $item->id }}">{{ $item->departmentName }}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">ملاحظات</label>
                                <textarea class="form-control" id="productdescription" name="description" rows="3"></textarea>
                            </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    {{-- Add Modal--}}
    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة منتج</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('product/')}}" method="post">
                   @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المنتج</label>
                            <input type="text" class="form-control" id="Product_name" name="product_name" required >

                        </div>

                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                        <select name="departmentId" id="department_name" class="form-control" required>
                            <option value="" selected disabled> --حدد القسم--</option>
                            @foreach ($department as $item)
                                <option value="{{ $item->id }}">{{ $item->departmentName }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->

    <script src="{{ URL::asset('js/Product/main.js') }}"></script>

@endsection
