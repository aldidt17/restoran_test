<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/bootstrap/css/app.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/reguler.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/all.css">
    <link rel="stylesheet" href="{{ asset('asset/css') }}/login.css">


</head>

<body>
    <section class="vh-100 d-flex background">
        <img src="{{ asset('asset/image') }}/restaurant-interior.jpg" id="img1">

        <div class="card container shadow d-flex p-3 bg-transparent" style="border-radius: 15px;margin-top: 120px;width: 58rem;height: 35rem;">
            <div class="row align-items-center justify-content-center d-flex">
                <div class="col-6 p-3" style="margin-left: 20px;margin-top: 35px">
                    <form method="post">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-bold mb-0 text-center w-100 text-white" style="font-size: 50px">Login <i class="fa-sharp fa-solid fa-user" style="color: white"></i></p>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-semibold text-white  mx-3 mb-0">Restaurant De lecius<i class="fa-sharp fa-solid fa-fork-knife" style="color:white;margin-left: 5px"></i></p>
                        </div>
                        {{-- error validation --}}
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Email input -->
                        <div class="form-outline mb-3">
                            <label class="form-label text-white" for="form3Example3">Username :</label>
                            <input type="text" id="name" name="name" class="form-control form-control-range" placeholder="Masukkan Username Anda" />

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label text-white" for="form3Example4">Password :</label>
                            <input type="password" id="form3Example4" name="password" class="form-control form-control-range" placeholder="Masukkan password" />

                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label text-white" for="username">
                                    Remember me
                                </label>


                                <div class="text-center text-lg-start mt-2 pt-2">
                                    <button type="submit" class="btn text-white " style="background-color: #F3CB51;;padding-left: 2.5rem; padding-right: 2.5rem; height: 40px;width: 150px">Login</button>

                                </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
    <script src="{{ asset('asset/js') }}/jquery.min.js"></script>
    <script src="{{ asset('asset/js') }}/login.js"></script>
    <script src="{{ asset('asset/bootstrap') }}/js/bootstrap.min.js"></script>
</body>

</html>
