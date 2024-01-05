@extends('layouts.master')
@section('title')
  قائمة الفواتير
@stop
@section('css')
  <!-- Internal Data table css -->
  <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet" />
  <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}"
    rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" />
  <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}"
    rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}"
    rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
  <!--Internal   Notify -->
  <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">الفواتير</h4><span
          class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
          الفواتير</span>
      </div>
    </div>

  </div>
  <!-- breadcrumb -->
@endsection
@section('content')

  @if (session()->has('delete_invoice'))
    <script>
      window.onload = function() {
        notif({
          msg: "تم حذف الفاتورة بنجاح",
          type: "success"
        })
      }
    </script>
  @endif


  @if (session()->has('Status_Update'))
    <script>
      window.onload = function() {
        notif({
          msg: "تم تحديث حالة الدفع بنجاح",
          type: "success"
        })
      }
    </script>
  @endif

  @if (session()->has('restore_invoice'))
    <script>
      window.onload = function() {
        notif({
          msg: "تم استعادة الفاتورة بنجاح",
          type: "success"
        })
      }
    </script>
  @endif


  <!-- row -->
  <div class="row">
    <!--div-->
    <div class="col-xl-12">
      <div class="card mg-b-20">
        <div class="card-header pb-0">
          @can('اضافة فاتورة')
            <a class="modal-effect btn btn-md btn-primary" href="invoices/create" style="color:white">
              <i class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
          @endcan

          @can('تصدير EXCEL')
            <a class="modal-effect btn btn-md btn-primary" href="{{ url('export_invoices') }}"
              style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
          @endcan

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table key-buttons text-md-nowrap" id="example1"
              data-page-length='50'style="text-align: center">
              <thead>
                <tr>
                  <th class="border-bottom-0">#</th>
                  <th class="border-bottom-0">رقم الفاتورة</th>
                  <th class="border-bottom-0">تاريخ القاتورة</th>
                  <th class="border-bottom-0">تاريخ الاستحقاق</th>
                  <th class="border-bottom-0">المنتج</th>
                  <th class="border-bottom-0">القسم</th>
                  <th class="border-bottom-0">الخصم</th>
                  <th class="border-bottom-0">نسبة الضريبة</th>
                  <th class="border-bottom-0">قيمة الضريبة</th>
                  <th class="border-bottom-0">الاجمالي</th>
                  <th class="border-bottom-0">الحالة</th>
                  {{-- <th class="border-bottom-0">ملاحظات</th> --}}
                  <th class="border-bottom-0">العمليات</th>
                </tr>
              </thead>
              <tbody>

                @php $i = 0; @endphp
                @foreach ($invoices as $invoice)
                  @php $i++; @endphp
                  <tr>
                    <td>{{ $i }}</td>
                    <td>
                      <a href="{{ url('invoice') }}/{{ $invoice->id }}">
                        {{ $invoice->invoice_number }}
                      </a>
                    </td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>{{ $invoice->product }}</td>
                    <td>
                      <a href="{{ url('invoice') }}/{{ $invoice->id }}">
                        {{ $invoice->section->section_name }}
                      </a>
                    </td>
                    <td>{{ $invoice->discount }}</td>
                    <td>{{ $invoice->rate_vat }}</td>
                    <td>{{ $invoice->value_vat }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>
                      @if ($invoice->value_status == 1)
                        <span class="text-success">{{ $invoice->status }}</span>
                      @elseif($invoice->value_status == 2)
                        <span class="text-danger">{{ $invoice->status }}</span>
                      @else
                        <span class="text-warning">{{ $invoice->status }}</span>
                      @endif

                    </td>

                    {{-- <td>{{ $invoice->note }}</td> --}}
                    <td>
                      <div class="dropdown btn-group">
                        <button class="btn ripple btn-primary btn-md" data-toggle="dropdown"
                          type="button" aria-expanded="false" aria-haspopup="true">
                          العمليات
                          <i class="fas fa-caret-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu">

                          <a class="dropdown-item tx-14"
                            href="{{ url('invoice') }}/{{ $invoice->id }}">
                            <i class="text-info fas fa-info ml-2"></i>
                            تفاصيل الفاتورة
                          </a>

                          @can('تعديل الفاتورة')
                            <a class="dropdown-item tx-14"
                              href="{{ url('edit_invoice') }}/{{ $invoice->id }}">
                              <i class="text-warning fas fa-pen ml-2"></i>
                              تعديل الفاتورة
                            </a>
                          @endcan

                          @can('حذف الفاتورة')
                            <a class="dropdown-item tx-14" data-invoice_id="{{ $invoice->id }}"
                              data-toggle="modal" data-target="#delete_invoice" href="#">
                              <i class="text-danger fas fa-trash-alt ml-2"></i>
                              حذف الفاتورة
                            </a>
                          @endcan

                          @can('تغير حالة الدفع')
                            <a class="dropdown-item tx-14"
                              href="{{ URL::route('Status_show', [$invoice->id]) }}">
                              <i class="text-success fas fa-check ml-2"></i>
                              حالة الدفع
                            </a>
                          @endcan

                          @can('ارشفة الفاتورة')
                            <a class="dropdown-item tx-14" data-invoice_id="{{ $invoice->id }}"
                              data-toggle="modal" data-target="#Transfer_invoice" href="#"><i
                                class="text-warning fas fa-exchange-alt  ml-2"></i>
                              نقل الي الارشيف
                            </a>
                          @endcan

                          @can('طباعةالفاتورة')
                            <a class="dropdown-item tx-14" href="print_invoice/{{ $invoice->id }}"
                              target="_blank"><i class="text-success fas fa-print ml-2"></i>
                              طباعة الفاتورة
                            </a>
                          @endcan
                        </div>
                      </div>


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

  <!-- حذف الفاتورة -->
  <div class="modal fade" id="delete_invoice" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
          <button class="close" data-dismiss="modal" type="button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <form action="{{ route('invoices.destroy', 'test') }}" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
        </div>
        <div class="modal-body">
          هل انت متاكد من عملية الحذف ؟
          {{-- <input id="invoice_id" name="invoice_id" type="hidden" value="{{ $invoice->id }}"> --}}
          <input id="invoice_id" name="invoice_id" type="hidden" value="">
          <input id="btn_action" name="btn_action" type="hidden" value="0">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button">الغاء</button>
          <button class="btn btn-danger" type="submit">تاكيد</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ارشيف الفاتورة -->
  <div class="modal fade" id="Transfer_invoice" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
          <button class="close" data-dismiss="modal" type="button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <form action="{{ route('invoices.destroy', 'test') }}" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
        </div>
        <div class="modal-body">
          هل انت متاكد من عملية الارشفة ؟
          <input id="invoice_id" name="invoice_id" type="hidden" value="">
          <input id="btn_action" name="btn_action" type="hidden" value="1">

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button">الغاء</button>
          <button class="btn btn-success" type="submit">تاكيد</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  </div>
  <!-- row closed -->
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection
@section('js')
  <!-- Internal Data tables -->
  <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}">
  </script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}">
  </script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}">
  </script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}">
  </script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}">
  </script>
  <!--Internal  Datatable js -->
  <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
  <!--Internal  Notify js -->
  <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

  <script>
    $('#delete_invoice').on('show.bs.modal', function(event) {
      var e = $(event.relatedTarget)
      var invoice_id = e.data('invoice_id')
      var modal = $(this)
      modal.find('.modal-body #invoice_id').val(invoice_id);
    })
  </script>

  <script>
    $('#Transfer_invoice').on('show.bs.modal', function(event) {
      var e = $(event.relatedTarget)
      var invoice_id = e.data('invoice_id')
      var modal = $(this)
      modal.find('.modal-body #invoice_id').val(invoice_id);
    })
  </script>

@endsection
