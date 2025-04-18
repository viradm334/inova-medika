@include('layouts.links')
<body style="background-color: #f7f6fc;">
    <ul class="nav justify-content-end mb-5 mr-2 mt-2">
        <li class="nav-item">
          {{-- <a class="nav-link active" href="/login"></a> --}}
          <a href="/login" class="btn btn-primary">Login</a>
        </li>
      </ul>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0" style="background-color: #f7f6fc">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="{{ asset('assets/medicine.svg') }}" alt="" width="100%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-start">
                                        <h1 class="h4 text-primary mb-4">Inova Medika</h1>
                                    </div>
                                    <div class="text-start">
                                        <h1 class="h4 text-gray-900">Solusi untuk sistem informasi kesehatan modern.</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
      </div>
</body>
</html>