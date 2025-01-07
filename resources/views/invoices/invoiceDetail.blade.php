
@extends('layouts.master')
@section('title','تفاصيل الفاتوره')
@section('css')
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal  Prism css-->
    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمه الفاتوره</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتوره</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.success')
    @include('inc.error')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
<div class="panel panel-primary tabs-style-3">
    <div class="tab-menu-heading">
        <div class="tabs-menu ">
            <!-- Tabs -->
            <ul class="nav panel-tabs">
                <li><a href="#tab12" data-toggle="tab" class="active">معلومات الفاتوره</a></li>
                <li><a href="#tab13" data-toggle="tab">حالات الدفع</a></li>
                <li><a href="#tab14" data-toggle="tab">المرفقات</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body tabs-menu-body">
        <div class="tab-content">

            <div class="tab-pane active" id="tab12">
                <div class="table mt-15">
                    <table class="table table-striped" style="text-align:center">
                        <tbody>
                        <tr>
                            <th scope="row">رقم الفاتوره</th>
                            <td>{{$invoices->invoiceNumber}}</td>
                            <th scope="row">تاريخ الاصدار</th>
                            <td>{{$invoices->invoiceDate}}</td>
                            <th scope="row">تاريخ الاستحقاق</th>
                            <td>{{$invoices->dueDate}}</td>
                            <th scope="row">القسم</th>
                            <td>{{$invoices->department->departmentName}}</td>
                        </tr>
                        <tr>
                            <th scope="row">المنتج</th>
                            <td>{{$invoices->product}}</td>
                            <th scope="row">مبلغ التحصيل</th>
                            <td>{{$invoices->amountCollection}}</td>
                            <th scope="row">مبلغ العموله</th>
                            <td>{{$invoices->amountCommission}}</td>
                            <th scope="row">الخصم</th>
                            <td>{{$invoices->discount}}</td>
                        </tr>
                        <tr>
                            <th scope="row">نسبه الضريبه</th>
                            <td>{{$invoices->rateVat}}</td>
                            <th scope="row">قيمه الضريبه</th>
                            <td>{{$invoices->valueVat}}</td>
                            <th scope="row">اجمالى مع الضريبه</th>
                            <td>{{$invoices->total}}</td>
                            <th scope="row">الحاله الحاليه</th>
                            <td>
                                @if($invoices->valueStatus == 1)
                                    <span class="badge badge-success">{{$invoices->status}}</span>
                                                @elseif($invoices->valueStatus==2)
                                                    <span class="badge badge-danger">{{$invoices->status}}</span>
                                @else
                                    <span class="badge badge-warning">{{$invoices->status}}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">المستخدم</th>
                            <td>{{$invoices->user}}</td>
                            <th scope="row">ملاحظات</th>
                            <td>
                                @if($invoices->note == NULL)
                                    لا يوجد ملاحظات
                                @else
                                    {{$invoices->note}}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="tab13">
                <div class="table mt-15">
                    <table class="table center-aligned-table mb-0 table-hover" style="text-align: center">
                        <thead>
                        <tr class="text-dark">
                            <th>#</th>
                            <th>رقم الفاتوره</th>
                            <th>نوع المنتج</th>
                            <th>القسم</th>
                            <th>حاله الدفع</th>
                            <th>تاريخ الدفع</th>
                            <th>ملاحظات</th>
                            <th>تاريخ الاضافه</th>
                            <th>المستخدم</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($invoiceDetail as $item)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->invoiceNumber}}</td>
                            <td>{{$item->product}}</td>
                            <td>{{$invoices->department->departmentName}}</td>
                            <td>
                                @if($item->valueStatus == 1)
                                    <span class="badge badge-success">{{$item->status}}</span>
                                                @elseif($item->valueStatus==2)
                                                    <span class="badge badge-danger">{{$item->status}}</span>
                                @else
                                    <span class="badge badge-warning">{{$item->status}}</span>
                                @endif
                            </td>
                            <td>{{$item->paymentDate}}</td>
                            <td>
                                @if($item->note == NULL)
                                    لا يوجد ملاحظات
                                @else
                                    {{$item->note}}
                                @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="tab14">
                @can('اضافة مرفق')
                <a class="modal-effect btn btn-outline-primary btn-block" style="margin-bottom:20px" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">اضافه مرفق</a>
                @endcan
                <div class="table mt-15">
                    <table class="table center-aligned-table mb-0 table-hover" style="text-align: center">
                        <thead>
                        <tr class="text-dark">
                            <th>#</th>
                            <th>اسم الملف</th>
                            <th>قام بالاضافه</th>
                            <th>تاريخ الاضافه</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($invoiceAttachment as $item)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->fileName}}</td>
                            <td>{{$item->createdBy}}</td>
                            <td>{{$item->created_at}}</td>
                            <td colspan="2">

                                <a class="btn btn-outline-success btn-sm"
                                   href="{{ url('viewFile') }}/{{ $item->fileName }}" target="_blank"
                                   role="button"><i class="fas fa-eye"></i>&nbsp;
                                    عرض</a>

                                <a class="btn btn-outline-info btn-sm"
                                   href="{{ url('download') }}/{{ $item->fileName }}"
                                   role="button"><i
                                        class="fas fa-download"></i>&nbsp;
                                    تحميل</a>

                                    @can('حذف المرفق')
                                    <button class="btn btn-outline-danger btn-sm"
                                            data-toggle="modal"
                                            data-file_name="{{ $item->fileName }}"
                                            data-id_file="{{ $item->id }}"
                                            data-target="#delete_file">حذف</button>
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
</div>
                </div>
                </div>
            </div>
        </div>
    {{-- Add Modal--}}
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">اضافه مرفق</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('InvoiceAttachment/') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile"
                                   name="file_name" required>
                            <input type="hidden" id="customFile" name="invoice_number"
                                   value="{{ $invoices->invoiceNumber }}">
                            <input type="hidden" id="invoice_id" name="invoice_id"
                                   value="{{ $invoices->id }}">
                            <label class="custom-file-label" for="customFile">حدد
                                المرفق</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-primary  "
                                name="uploadedFile">تاكيد</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('deleteFile')}}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                            <p class="text-center">
                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                            </p>

                            <input type="hidden" name="id_file" id="id_file" value="">
                            <input type="hidden" name="file_name" id="file_name" value="">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- Internal Input tags js-->
    <script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
    <!--- Tabs JS-->
    <script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
    <script src="{{URL::asset('assets/js/tabs.js')}}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
    <!-- Internal Prism js-->
    <script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)
            let id_file = button.data('id_file')
            let file_name = button.data('file_name')
            let modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
        })
    </script>
@endsection
