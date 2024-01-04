@extends('layouts.master')
@section('css')
  <!---Internal  Prism css-->
  <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
  <!---Internal Input tags css-->
  <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
  <!--- Custom-scroll -->
  <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}"
    rel="stylesheet">
@endsection
@section('title')
  تفاصيل فاتورة
@stop
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span
          class="text-muted mt-1 tx-13 mr-2 mb-0">/
          تفاصيل الفاتورة</span>
      </div>
    </div>

  </div>
  <!-- breadcrumb -->
@endsection
@section('content')


  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif


  @if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session()->get('Add') }}</strong>
      <button class="close" data-dismiss="alert" type="button" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif



  @if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ session()->get('delete') }}</strong>
      <button class="close" data-dismiss="alert" type="button" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif



  <!-- row opened -->
  <div class="row row-sm">

    <div class="col-xl-12">
      <!-- div -->
      <div class="card mg-b-20" id="tabs-style2">
        <div class="card-body">
          <div class="text-wrap">
            <div class="example">

              @can('تعديل الفاتورة')
                <a class="modal-effect btn btn-md btn-primary float-left"
                  href="{{ url('edit_invoice') }}/{{ $invoice->id }}" style="color:white">
                  <i class="fas fa-pen"></i>&nbsp; تعديل فاتورة</a>
              @endcan

              <div class="panel panel-primary tabs-style-2">
                <div class=" tab-menu-heading">
                  <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs main-nav-line">
                      <li><a class="nav-link active" data-toggle="tab" href="#tab1">معلومات
                          الفاتورة</a></li>
                      <li><a class="nav-link" data-toggle="tab" href="#tab2">حالات الدفع</a></li>
                      <li><a class="nav-link" data-toggle="tab" href="#tab3">المرفقات</a></li>
                    </ul>
                  </div>
                </div>
                <div class="panel-body tabs-menu-body main-content-body-right border">
                  <div class="tab-content">


                    <div class="tab-pane active" id="tab1">
                      <div class="table-responsive mt-15">

                        <table class="table table-striped" style="text-align:center">
                          <tbody>
                            <tr>
                              <th scope="row">رقم الفاتورة</th>
                              <td>{{ $invoice->invoice_number }}</td>
                              <th scope="row">تاريخ الاصدار</th>
                              <td>{{ $invoice->invoice_date }}</td>
                              <th scope="row">تاريخ الاستحقاق</th>
                              <td>{{ $invoice->due_date }}</td>
                              <th scope="row">القسم</th>
                              <td>{{ $invoice->section->section_name }}</td>
                            </tr>

                            <tr>
                              <th scope="row">المنتج</th>
                              <td>{{ $invoice->product }}</td>
                              <th scope="row">مبلغ التحصيل</th>
                              <td>{{ $invoice->amount_collection }}</td>
                              <th scope="row">مبلغ العمولة</th>
                              <td>{{ $invoice->amount_commission }}</td>
                              <th scope="row">الخصم</th>
                              <td>{{ $invoice->discount }}</td>
                            </tr>

                            <tr>
                              <th scope="row">نسبة الضريبة</th>
                              <td>{{ $invoice->rate_vat }}</td>
                              <th scope="row">قيمة الضريبة</th>
                              <td>{{ $invoice->value_vat }}</td>
                              <th scope="row">الاجمالي مع الضريبة</th>
                              <td>{{ $invoice->total }}</td>
                              <th scope="row">الحالة الحالية</th>

                              @if ($invoice->value_status == 1)
                                <td><span
                                    class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                </td>
                              @elseif($invoice->value_status == 2)
                                <td><span
                                    class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                </td>
                              @else
                                <td><span
                                    class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                </td>
                              @endif
                            </tr>

                            <tr>
                              <th scope="row">ملاحظات</th>
                              <td>{{ $invoice->note }}</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="tab-pane" id="tab2">
                      <div class="table-responsive mt-15">
                        <table class="table center-aligned-table mb-0 table-hover"
                          style="text-align:center">
                          <thead>
                            <tr class="text-dark">
                              <th>#</th>
                              <th>رقم الفاتورة</th>
                              <th>نوع المنتج</th>
                              <th>القسم</th>
                              <th>حالة الدفع</th>
                              <th>تاريخ الدفع </th>
                              <th>ملاحظات</th>
                              <th>تاريخ الاضافة </th>
                              <th>المستخدم</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 0; ?>
                            @foreach ($details as $x)
                              <?php $i++; ?>
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $x->invoice_number }}</td>
                                <td>{{ $x->product }}</td>
                                <td>{{ $invoice->section->section_name }}</td>
                                @if ($x->value_status == 1)
                                  <td>
                                    <span
                                      class="badge badge-pill badge-success">{{ $x->status }}</span>
                                  </td>
                                @elseif($x->value_status == 2)
                                  <td><span
                                      class="badge badge-pill badge-danger">{{ $x->status }}</span>
                                  </td>
                                @else
                                  <td><span
                                      class="badge badge-pill badge-warning">{{ $x->status }}</span>
                                  </td>
                                @endif
                                <td>{{ $x->payment_date }}</td>
                                <td>{{ $x->note }}</td>
                                <td>{{ $x->created_at }}</td>
                                <td>{{ $x->user }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="tab-pane" id="tab3">
                      <!--المرفقات-->
                      <div class="card card-statistics">
                        @can('اضافة مرفق')
                          <div class="card-body">
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg ,
                              png </p>
                            <h5 class="card-title">اضافة مرفقات</h5>
                            <form method="post" action="{{ url('/invoiceAttachments') }}"
                              enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="custom-file">
                                <input class="custom-file-input" id="customFile" name="file_name"
                                  type="file" required>
                                <input id="customFile" name="invoice_number" type="hidden"
                                  value="{{ $invoice->invoice_number }}">
                                <input id="invoice_id" name="invoice_id" type="hidden"
                                  value="{{ $invoice->id }}">
                                <label class="custom-file-label" for="customFile">حدد
                                  المرفق</label>
                              </div><br><br>
                              <button class="btn btn-primary btn-sm " name="uploadedFile"
                                type="submit">تاكيد</button>
                            </form>
                          </div>
                        @endcan
                        <br>

                        <div class="table-responsive mt-15">
                          <table class="table center-aligned-table mb-0 table table-hover"
                            style="text-align:center">
                            <thead>
                              <tr class="text-dark">
                                <th scope="col">م</th>
                                <th scope="col">اسم الملف</th>
                                <th scope="col">قام بالاضافة</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <th scope="col">العمليات</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 0; ?>
                              @foreach ($attachments as $attachment)
                                <?php $i++; ?>
                                <tr>
                                  <td>{{ $i }}</td>
                                  <td>{{ $attachment->file_name }}</td>
                                  <td>{{ $attachment->created_by }}</td>
                                  <td>{{ $attachment->created_at }}</td>
                                  <td colspan="2">

                                    <a class="btn btn-outline-success btn-sm"
                                      href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                      role="button" target="_blank"><i
                                        class="fas fa-eye"></i>&nbsp;
                                      عرض</a>

                                    <a class="btn btn-outline-info btn-sm"
                                      href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                      role="button"><i class="fas fa-download"></i>&nbsp;
                                      تحميل</a>

                                    @can('حذف المرفق')
                                      <button class="btn btn-outline-danger btn-sm"
                                        data-toggle="modal"
                                        data-file_name="{{ $attachment->file_name }}"
                                        data-invoice_number="{{ $attachment->invoice_number }}"
                                        data-id_file="{{ $attachment->id }}"
                                        data-target="#delete_file">حذف</button>
                                    @endcan

                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
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
      </div>
      <!-- /div -->
    </div>

  </div>
  <!-- /row -->

  <!-- delete -->
  <div class="modal fade" id="delete_file" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
          <button class="close" data-dismiss="modal" type="button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('delete_file') }}" method="post">

          {{ csrf_field() }}
          <div class="modal-body">
            <p class="text-center">
            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
            </p>

            <input id="id_file" name="id_file" type="hidden" value="">
            <input id="file_name" name="file_name" type="hidden" value="">
            <input id="invoice_number" name="invoice_number" type="hidden" value="">

          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">الغاء</button>
            <button class="btn btn-danger" type="submit">تاكيد</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection
@section('js')
  <!--Internal  Datepicker js -->
  <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
  <!-- Internal Select2 js-->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!-- Internal Jquery.mCustomScrollbar js-->
  <script
    src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}">
  </script>
  <!-- Internal Input tags js-->
  <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
  <!--- Tabs JS-->
  <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
  <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
  <!--Internal  Clipboard js-->
  <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
  <!-- Internal Prism js-->
  <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

  <script>
    $('#delete_file').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_file = button.data('id_file')
      var file_name = button.data('file_name')
      var invoice_number = button.data('invoice_number')
      var modal = $(this)

      modal.find('.modal-body #id_file').val(id_file);
      modal.find('.modal-body #file_name').val(file_name);
      modal.find('.modal-body #invoice_number').val(invoice_number);
    })
  </script>

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(
        fileName);
    });
  </script>

@endsection
