@extends('layouts.master2')
@section('title')
  تسجيل الدخول
@stop

@section('css')
  <!-- Sidemenu-respoansive-tabs css -->
  <link
    href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
    rel="stylesheet">
@endsection
@section('content')
  <div class="container-fluid">
    <div class="row no-gutter">
      <!-- The image half -->
      <!-- The content half -->
      <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
        <div class="login d-flex align-items-center py-2">
          <!-- Demo content-->
          <div class="container p-0">
            <div class="row">
              <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                <div class="card-sigin">
                  <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'Home')) }}"><img
                        class="sign-favicon ht-40"
                        src="{{ URL::asset('assets/img/brand/favicon.png') }}" alt="logo"></a>
                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Mora<span>So</span>ft</h1>
                  </div>
                  <div class="card-sigin">
                    <div class="main-signup-header">
                      <h2>مرحبا بك</h2>
                      <h5 class="font-weight-semibold mb-4"> تسجيل الدخول</h5>
                      <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                          <label>البريد الالكتروني</label>
                          <input class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" type="email" value="{{ old('email') }}"
                            required autocomplete="email" autofocus>
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>كلمة المرور</label>

                          <input class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" type="password" required
                            autocomplete="current-password">

                          @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                              <div class="form-check">
                                <input class="form-check-input" id="remember" name="remember"
                                  type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="form-check-label" for="remember">
                                  {{ __('تذكرني') }}
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-main-primary btn-block" type="submit"
                          onclick="copy_cred()">
                          {{ __('تسجيل الدخول') }}
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End -->
        </div>
      </div><!-- End -->

      <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
        <div class="row wd-100p mx-auto text-center">
          <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
            <img class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto"
              src="{{ URL::asset('assets/img/media/login.png') }}" alt="logo">
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
@section('js')
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    function copy_cred() {
      $('#signinEmail').val('admin@admin.com');
      $('#signinPassword').val('12345678');
      toastr.success('Copied successfully!', 'Success!', {
        CloseButton: true,
        ProgressBar: true
      });
    }
  </script>
@endsection
