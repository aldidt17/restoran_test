<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeLicius.com</title>
    {{-- BOOSTRAP --}}
    <link rel="stylesheet" href="{{ asset('asset/bootstrap') }}/css/bootstrap.min.css">
    <!-- Box Icons  -->
    {{-- <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'> --}}
    <!-- Styles  -->
    {{-- <link rel="shortcut icon" href="assets/img/kxp_fav.png" type="image/x-icon"> --}}
    <link rel="stylesheet" href="{{ asset('asset/css') }}/mainpage.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/reguler.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/all.css">
  

</head>

<body>
    <div class="sidebar close ">
        <!-- ========== Logo ============  -->
        <a class="logo-box" style="margin-top: 80px">
            {{-- <i class="fa-brands fa-a"></i> --}}
            <i class="fa-solid fa-fork-knife"></i>
            <div class="logo-name">De lecius</div>
        </a>

        <!-- ========== List ============  -->
        <ul class="sidebar-list">
           

            <!-- -------- Dropdown List Item ------- -->
            <li class="dropdown" style="margin-bottom: 20px">
                <div class="title">
                    <a class="link">
                        <i class="fa-solid fa-pot-food"></i>
                        <span class="name">Barang</span>
                    </a>
                    <i class='bx bxs-chevron-down'></i>
                </div>
                <div class="submenu">
                    <a href="/menu" class="link"><i class="fa-regular fa-olive-branch"></i> Food Menu</a>
                </div>
            </li>

            <!-- -------- Dropdown List Item ------- -->
                <li class="dropdown" style="margin-bottom: 20px">
                    <div class="title">
                        <a class="link">
                            <i class="fa-solid fa-cart-shopping-fast"></i>
                            <span class="name">Transaction</span>
                        </a>
                        <i class='bx bxs-chevron-down'></i>
                    </div>
                    <div class="submenu">
                        <a href="/order" class="link"><i class="fa-regular fa-toilet-paper-check"></i> order menu</a>
                    </div>


            <!-- -------- Non Dropdown List Item ------- -->
            @if (Auth::user()->hasRole('admin'))
                <li class="dropdown" >
                    <div class="title">
                        <a class="link">
                            <i class="fa-solid fa-rectangle-history"></i>
                            <span class="name">History transcation</span>
                        </a>
                        <i class='bx bxs-chevron-down'></i>
                    </div>
                    <div class="submenu">
                        <a href="/history-order" class="link"><i class="fa-sharp fa-regular fa-clock-rotate-left"></i> History Order</a>
                    </div>
                </li>
            @else
                <li class="dropdown" style="margin-bottom: 350px" hidden>
                    <div class="title">
                        <a class="link">
                            <i class="fa-solid fa-rectangle-history"></i>
                            <span class="name">Laporan dan History</span>
                        </a>
                        <i class='bx bxs-chevron-down'></i>
                    </div>
                    <div class="submenu">
                        {{-- <a class="link submenu-title">History</a> --}}
                        <a href="/laporan-penjualan" class="link"><i class="fa-solid fa-file-chart-column"></i> Laporan Penjualan</a>
                        <a href="/history" class="link"><i class="fa-sharp fa-regular fa-clock-rotate-left"></i> History Pemesanan</a>
                        <!-- submenu links here  -->
                    </div>
                </li>
            @endif

            <!-- -------- Non Dropdown List Item ------- -->

        </ul>
    </div>

    <!-- ============= Home Section =============== -->
    <section class="home min-vh-100" style="height: auto">
        <nav class="navbar bg-body-tertiary navbar-fixed" style="border-bottom: 1px solid grey">
            <div class="container-fluid d-flex justify-content-between">
                <div class="toggle-sidebar">
                    <i class="fa-solid fa-bars" style="font-size: 30px;color: #F3CB51"></i>
                </div>
                <div class="p-1 d-flex gap-2">
                    {{-- <img src="{{ asset('storage/pict/' . Auth::user()->pict) }}" width="40px" height="40px" style="border-radius: 40px;margin-right: 10px;"> --}}
                    <div class="">
                        <p class="m-0 text" style="font-size: 17px;">{{ Auth::user()->name }}</p>
                        <p class="m-0 text-secondary" style="font-size: 10px">({{ Auth::user()->getRoleNames()->first() }})</p>
                    </div>

                    <li class="dropdown" style="margin-left: 15px;margin-top: 7px">
                        <div class="title">
                            <a data-bs-toggle="modal" data-bs-target="#logout"><i class="fa-regular fa-right-from-bracket " style="font-size: 22px;"></i></a>
                        </div>
                    </li>
                </div>
            </div>
        </nav>

        <div class="navbar-spacer"></div>

        <main class="w-100 min-vh-100 p-2" style="background-color: #DCDCDC; height:auto;">
            @yield('content')
        </main>
        
    </section>

    {{-- modal logout --}}
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 " style="" id="exampleModalLabel">De lecius<i class="fa-sharp fa-solid fa-fork-knive" style="color: #fd6a02;"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>are you sure you want to logout?</h4>
                </div>
                <div class="modal-footer">
                    <a href="/logout" class="btn btn-danger">logout</a>
                    <button type="button" class="btn text-white" style="background-color: grey" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Link JS -->
    <script src="{{ asset('asset/bootstrap') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('asset/js') }}/mainpage.js"></script>

    @notifyJs
</body>

</html>
