@extends('layouts.master')
@section('css')
@endsection
@section('title')
  تغير حالة الدفع
@stop
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">الفواتير</h4><span
          class="text-muted mt-1 tx-13 mr-2 mb-0">/
          تغير حالة الدفع</span>
      </div>
    </div>

  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('status_update', ['id' => $invoices->id]) }}" method="post"
            autocomplete="off">
            {{ csrf_field() }}
            {{-- 1 --}}
            <div class="row">
              <div class="col">
                <label class="control-label" for="inputName">رقم الفاتورة</label>
                <input name="invoice_id" type="hidden" value="{{ $invoices->id }}">
                <input class="form-control" id="inputName" name="invoice_number" type="text"
                  value="{{ $invoices->invoice_number }}" title="يرجي ادخال رقم الفاتورة" required
                  readonly>
              </div>

              <div class="col">
                <label>تاريخ الفاتورة</label>
                <input class="form-control fc-datepicker" name="invoice_Date" type="text"
                  value="{{ $invoices->invoice_date }}" placeholder="YYYY-MM-DD" required readonly>
              </div>

              <div class="col">
                <label>تاريخ الاستحقاق</label>
                <input class="form-control fc-datepicker" name="Due_date" type="text"
                  value="{{ $invoices->due_date }}" placeholder="YYYY-MM-DD" required readonly>
              </div>

            </div>

            {{-- 2 --}}
            <div class="row">
              <div class="col">
                <label class="control-label" for="inputName">القسم</label>
                <select class="form-control SlectBox" name="section"
                  onclick="console.log($(this).val())" onchange="console.log('change is firing')"
                  readonly>
                  <!--placeholder-->
                  <option value=" {{ $invoices->section->id }}">
                    {{ $invoices->section->section_name }}
                  </option>

                </select>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">المنتج</label>
                <select class="form-control" id="product" name="product" readonly>
                  <option value="{{ $invoices->product }}"> {{ $invoices->product }}</option>
                </select>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">مبلغ التحصيل</label>
                <input class="form-control" id="inputName" name="amount_collection" type="text"
                  value="{{ $invoices->amount_collection }}"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                  readonly>
              </div>
            </div>


            {{-- 3 --}}

            <div class="row">

              <div class="col">
                <label class="control-label" for="inputName">مبلغ العمولة</label>
                <input class="form-control form-control-lg" id="amount_commission" type="text"
                  value="{{ $invoices->amount_commission }}"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                  required readonly>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">الخصم</label>
                <input class="form-control form-control-lg" id="Discount" name="discount"
                  type="text" value="{{ $invoices->discount }}"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                  required readonly>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">نسبة ضريبة القيمة المضافة</label>
                <select class="form-control" id="Rate_VAT" name="rate_vat" onchange="myFunction()"
                  readonly>
                  <!--placeholder-->
                  <option value=" {{ $invoices->rate_vat }}">
                    {{ $invoices->rate_vat }}
                </select>
              </div>

            </div>

            {{-- 4 --}}

            <div class="row">
              <div class="col">
                <label class="control-label" for="inputName">قيمة ضريبة القيمة المضافة</label>
                <input class="form-control" id="Value_VAT" name="value_vat" type="text"
                  value="{{ $invoices->value_vat }}" readonly>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">الاجمالي شامل الضريبة</label>
                <input class="form-control" id="Total" name="total" type="text"
                  value="{{ $invoices->total }}" readonly>
              </div>
            </div>

            {{-- 5 --}}
            <div class="row">
              <div class="col">
                <label for="exampleTextarea">ملاحظات</label>
                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                                {{ $invoices->note }}</textarea>
              </div>
            </div><br>

            <div class="row">
              <div class="col">
                <label for="exampleTextarea">حالة الدفع</label>
                <select class="form-control" id="status" name="status" required>
                  <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                  <option value="مدفوعة">مدفوعة</option>
                  <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                </select>
              </div>

              <div class="col">
                <label>تاريخ الدفع</label>
                <input class="form-control fc-datepicker" name="payment_date" type="text"
                  placeholder="YYYY-MM-DD" required>
              </div>


            </div><br>

            <div class="d-flex justify-content-center">
              <button class="btn btn-primary" type="submit">تحديث حالة الدفع</button>
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
  <!-- Internal Select2 js-->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!--Internal  Form-elements js-->
  <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
  <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
  <!--Internal Sumoselect js-->
  <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
  <!--Internal  Datepicker js -->
  <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
  <!--Internal  jquery.maskedinput js -->
  <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
  <!--Internal  spectrum-colorpicker js -->
  <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
  <!-- Internal form-elements js -->
  <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

  <script>
    var date = $('.fc-datepicker').datepicker({
      dateFormat: 'yy-mm-dd'
    }).val();
  </script>
@endsection
