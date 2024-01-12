@extends('layouts.master')
@section('title')
  Photos
@stop
@section('css')
  <!--  Owl-carousel css-->
  <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
  <!-- Maps css -->
  <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="left-content">
      <div>
        <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, {{ Auth::user()->name }}
          welcome
          back!</h2>
        <p class="mg-b-0">Sales monitoring dashboard template.</p>
      </div>
    </div>
    <div class="main-dashboard-header-right">
      <div>
        <label class="tx-13">Customer Ratings</label>
        <div class="main-star">
          <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
            class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
            class="typcn typcn-star"></i> <span>(14,873)</span>
        </div>
      </div>
      <div>
        <label class="tx-13">Online Sales</label>
        <h5>563,275</h5>
      </div>
      <div>
        <label class="tx-13">Offline Sales</label>
        <h5>783,675</h5>
      </div>
    </div>
  </div>
  <!-- /breadcrumb -->
@endsection
@section('content')

  <div class="container direction: ltr;">
    <div class="row">
      <div>

        {{--  
        <h4>{{ $data }}</h4> 
        <h4>{!! $data2 !!}</h4> 

        @if ($data == 'Hussein')
          <h5>Yes, Hussein</h5>
        @else
        @endif

        @unless ($data == 'Hussein')
          <h5>No, Hussein</h5>
        @endunless 

        @isset($data)
          <h4>$data</h4>
        @endisset

        @empty($data3)
          <h5>Data is empty</h5>
        @endempty

        --}}
        {{-- app/Providers/AppServiceProvider.php --}}
        {{-- View::share, View::composer --}}
        {{-- {{ $hs }} --}}
        {{-- {{ $invoices }} --}}
        {{ $hsname }}


        <form action="{{ route('photos.store') }}" method="post">
          @csrf

          <input name="title[]" type="text"><br />
          <input name="title[]" type="text"><br />
          <input name="name" type="text"><br />
          <input name="number" type="number"><br />
          <input name="email" type="email"><br />
          <input id="" name="check" type="checkbox">
          <lalbel>Check</lalbel>
          <br>
          <button type="submit">Send</button>

        </form>
      </div>
    </div>
  </div>

@endsection
@section('js')
  <!--Internal  Chart.bundle js -->
  <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
  <!-- Moment js -->
  <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
  <!--Internal  Flot js-->
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
  <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
  <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
  <!--Internal Apexchart js-->
  <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
  <!-- Internal Map -->
  <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
  <!--Internal  index js -->
  <script src="{{ URL::asset('assets/js/index.js') }}"></script>
  <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
