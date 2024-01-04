@extends('layouts.master')
@section('css')
  <!--- Internal Select2 css-->
  <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
  <!---Internal Fileupload css-->
  <link type="text/css" href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}"
    rel="stylesheet" />
  <!---Internal Fancy uploader css-->
  <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
  <!--Internal Sumoselect css-->
  <link href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}" rel="stylesheet">
  <!--Internal  TelephoneInput css-->
  <link href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}"
    rel="stylesheet">
@endsection
@section('title')
  تعديل فاتورة
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">الفواتير</h4><span
          class="text-muted mt-1 tx-13 mr-2 mb-0">/
          تعديل فاتورة</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')

  @if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session()->get('edit') }}</strong>
      <button class="close" data-dismiss="alert" type="button" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <!-- row -->
  <div class="row">

    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-body">

          <form action="{{ url('invoices/update') }}" method="post" autocomplete="off">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            {{-- 1 --}}
            <div class="row">
              <div class="col">
                <label class="control-label" for="inputName">رقم الفاتورة</label>
                <input name="invoice_id" type="hidden" value="{{ $invoice->id }}">
                <input class="form-control" id="inputName" name="invoice_number" type="text"
                  value="{{ $invoice->invoice_number }}" title="يرجي ادخال رقم الفاتورة" required>
              </div>

              <div class="col">
                <label>تاريخ الفاتورة</label>
                <input class="form-control fc-datepicker" name="invoice_date" type="text"
                  value="{{ $invoice->invoice_date }}" placeholder="YYYY-MM-DD" required>
              </div>

              <div class="col">
                <label>تاريخ الاستحقاق</label>
                <input class="form-control fc-datepicker" name="due_date" type="text"
                  value="{{ $invoice->due_date }}" placeholder="YYYY-MM-DD" required>
              </div>

            </div>

            {{-- 2 --}}
            <div class="row">
              <div class="col">
                <label class="control-label" for="inputName">القسم</label>
                <select class="form-control SlectBox" name="section"
                  onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                  <!--placeholder-->
                  <option value=" {{ $invoice->section->id }}">
                    {{ $invoice->section->section_name }}
                  </option>
                  @foreach ($sections as $section)
                    <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">المنتج</label>
                <select class="form-control" id="product" name="product">
                  <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                </select>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">مبلغ التحصيل</label>
                <input class="form-control" id="inputName" name="amount_collection" type="text"
                  value="{{ $invoice->amount_collection }}"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
              </div>
            </div>


            {{-- 3 --}}

            <div class="row">

              <div class="col">
                <label class="control-label" for="inputName">مبلغ العمولة</label>
                <input class="form-control form-control-lg" id="Amount_Commission"
                  name="amount_commission" type="text" value="{{ $invoice->amount_commission }}"
                  title="يرجي ادخال مبلغ العمولة "
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                  required>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">الخصم</label>
                <input class="form-control form-control-lg" id="Discount" name="discount"
                  type="text" value="{{ $invoice->discount }}" title="يرجي ادخال مبلغ الخصم "
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                  required>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">نسبة ضريبة القيمة المضافة</label>
                <select class="form-control" id="rate_vat" name="rate_vat"
                  onchange="myFunction()">
                  <!--placeholder-->
                  <option value=" {{ $invoice->rate_vat }}">
                    {{ $invoice->rate_vat }}
                  <option value=" 5%">5%</option>
                  <option value="10%">10%</option>
                </select>
              </div>

            </div>

            {{-- 4 --}}

            <div class="row">
              <div class="col">
                <label class="control-label" for="inputName">قيمة ضريبة القيمة المضافة</label>
                <input class="form-control" id="Value_VAT" name="value_vat" type="text"
                  value="{{ $invoice->value_vat }}" readonly>
              </div>

              <div class="col">
                <label class="control-label" for="inputName">الاجمالي شامل الضريبة</label>
                <input class="form-control" id="Total" name="total" type="text"
                  value="{{ $invoice->total }}" readonly>
              </div>
            </div>

            {{-- 5 --}}
            <div class="row">
              <div class="col">
                <label for="exampleTextarea">ملاحظات</label>
                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoice->note }}
                </textarea>
              </div>
            </div><br>

            <div class="d-flex justify-content-center">
              <button class="btn btn-primary" type="submit">حفظ البيانات</button>
            </div>


          </form>
        </div>
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
  <!--Internal Fileuploads js-->
  <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
  <!--Internal Fancy uploader js-->
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
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

  <script>
    $(document).ready(function() {
      $('select[name="Section"]').on('change', function() {
        var SectionId = $(this).val();
        if (SectionId) {
          $.ajax({
            url: "{{ URL::to('section') }}/" + SectionId,
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('select[name="product"]').empty();
              $.each(data, function(key, value) {
                $('select[name="product"]').append('<option value="' +
                  value + '">' + value + '</option>');
              });
            },
          });

        } else {
          console.log('AJAX load did not work');
        }
      });

    });
  </script>


  <script>
    function myFunction() {

      var Amount_Commission = parseFloat(document.getElementById("amount_commission").value);
      var Discount = parseFloat(document.getElementById("discount").value);
      var Rate_VAT = parseFloat(document.getElementById("rate_vat").value);
      var Value_VAT = parseFloat(document.getElementById("value_vat").value);

      var Amount_Commission2 = Amount_Commission - Discount;


      if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

        alert('يرجي ادخال مبلغ العمولة ');

      } else {
        var intResults = Amount_Commission2 * Rate_VAT / 100;

        var intResults2 = parseFloat(intResults + Amount_Commission2);

        sumq = parseFloat(intResults).toFixed(2);

        sumt = parseFloat(intResults2).toFixed(2);

        document.getElementById("Value_VAT").value = sumq;

        document.getElementById("Total").value = sumt;

      }

    }
  </script>


@endsection
