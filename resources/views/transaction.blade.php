@extends('layout.main')
@section('title', 'order')
@section('content')

    <div class="card p-3 shadow" style="width: 100%;z-index: 0; height: 100vh;border-radius: 10px">
        <div class="p-1">
            <p class="fs-5 text-bold text-start" style="color: grey">Transaction Order Food</p>
        </div>

        <div class="card shadow mb-3" style="width:max-content;">
            <div class="card-header fs-6 text-white" style="background-color:  #fd6a02">
                Food Menu <i class="fa-regular fa-pot-food"></i>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert"">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search menu..." id="searchInput">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
        </div>
        <div class="col-12 card shadow mb-3" style=" border-radius: 15px">

            <table class="table table-hover table-responsive table-borderless"  id="keranjang-menu">

                <thead>
                    <tr>
                        <td class="text-center text-black " hidden>menu_id</td>
                        <td class="text-center text-black ">Menu name</td>
                        <td class="text-center text-black ">Price</td>
                        <td class="text-center text-black ">action</td>
                    </tr>
                </thead>
                <tbody class="table-group-divider">


                    @foreach ($menu as $list)
                        <tr>
                            <td class="text-center text-success" hidden>{{ $list->id }}</td>

                            <td class="text-center">{{ $list->name }}</td>
                            <td class="text-center">{{ 'Rp ' . number_format($list->price, 0, ',', '.') }}</td>

                            <td class="text-center">
                                <form action="cart/{{ $list->id }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success  text-white"">
                                        add cart
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-3 p-3">
                {{ $menu->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <div class="card shadow mb-3" style="width:max-content;">
            <div class="card-header fs-6 text-white" style="background-color:  #fd6a02">
                Food cart <i class="fa-regular fa-cart-shoping"></i>
            </div>
        </div>
    </div>

    <form action="/order" method="post">
        @csrf
        <main class="w-100 p-2" style="background-color: white; height:auto;">
            <div class="col-12 card shadow" style=" border-radius: 15px">
                <table class="table  table-hover table-striped" id="keranjang">

                    <thead>
                        <tr>
                            <td class="text-center text-success ">No</td>
                            <td class="text-center text-black " hidden>id_produk</td>
                            <td class="text-center text-black ">nama produk</td>
                            {{-- <td class="text-center text-black ">harga</td> --}}
                            <td class="text-center text-black ">qty</td>
                            <td class="text-center text-black ">subtotal</td>
                            <td class="text-center text-black ">action</td>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $no = 1; ?>
                        @foreach ($cart as $list)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center text-success" hidden>{{ $list->id }}</td>
                                <td class="text-center" hidden>
                                    <input type="hidden" name="menu_id[]" value="{{ $list->menu_id }}">
                                    <p class="m-0 text-id">{{ $list->menu_id }}</p>
                                </td>
                                <td class="text-center" hidden>
                                    <input type="hidden" name="price[]" value="{{ $list->price }}">
                                    <p class="m-0 text-ha">{{ $list->price }}</p>
                                </td>
                                <td class="text-center">{{ $list->menu->name }}</td>

                                <td class="text-center d-flex justify-content-center">
                                    <div class="d-flex gap-2">
                                        <input type="number" class="form-control form-control-sm text-end input-qtyy" style="width: 50px" value="{{ $list->qty }}" min="1">
                                        <input type="hidden" name="qty[]" value="{{ $list->qty }}">
                                    </div>

                                </td>
                                <td class="text-center">
                                    <input type="hidden" class="input-subtotal" name="subtotal[]" value="{{ $list->subtotal }}">
                                    <p class="m-0 text-subtotal">{{ $list->subtotal }}</p>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger btn-sm text-white text-center" href="/cart-delete/{{ $list->id }}">hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card shadow p-3 mb-3 d-flex align-items-end " style="width: 100%;z-index: 0;margin-top: 20px">
                <div class="align-bottom " style="margin-right: 5px">
                    <div class="card shadow mb-3 border-gray" style="width: 27rem;">
                        <div class="card-header bg-success fs-6 text-white">
                            Transaction Order Food
                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item" style="height: 60px">Total :
                                <input class=" fs-6 text-black shadow text-end " id="totaltrans" style="position: absolute;right: 10px; top: 10px; border-radius: 10px;background-color: rgba(33,37,41, 0.03);width: 300px;height: 40px; padding-right: 10px" value="0" readonly></input>
                                <input class=" fs-6 text-primary" id="totaltrans2" style="position: absolute;right: 50px; top: 10px;" hidden name="total_price">
                            </li>
                            <li class="list-group-item" style="height: 60px"> Pay :

                                <input type="text" class="shadow fs-6 text-black text-end" id="bayar" style="position: absolute;right: 10px; top: 10px; border-radius: 10px;background-color: rgba(33,37,41, 0.03);width: 300px;height: 40px; padding-right: 10px" required>
                                <input type="text" class=" fs-6" id="bayar2" style="position: absolute;right: 50px; top: 10px;" name="pay" hidden required>

                            </li>
                            <li class="list-group-item" style="height: 60px">Return:
                                <input type="text" class="shadow fs-6 text-end" id="kembali" style="position: absolute;right: 10px; top: 10px; border-radius: 10px;background-color: rgba(33,37,41, 0.03);width: 300px;height: 40px; padding-right: 10px" readonly>
                                <input class=" fs-6" id="kembali2" style="position: absolute;right: 50px; top: 10px;" hidden name="return">
                            </li>

                        </ul>
                    </div>
                    <button type="submit" id="btnsimpan" class="btn text-white shadow mb-4" style="background-color: #198754;width:180px; height:40px;margin-left:250px">
                        Order
                    </button>
                </div>
            </div>
        </main>
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').keyup(function() {
                var searchText = $(this).val().toLowerCase();
    
                $.ajax({
                    url: '{{ route("search.menu") }}',
                    method: 'GET',
                    data: {
                        search: searchText
                    },
                    beforeSend: function() {
                        $('#keranjang-menu tbody').html('<tr><td colspan="4" class="text-center">Searching...</td></tr>');
                    },
                    success: function(response) {
                        var html = '';
    
                        if (response.data.length > 0) {
                            response.data.forEach(function(menu) {
                                html += '<tr>' +
                                    '<td class="text-center text-success" hidden>' + menu.id + '</td>' +
                                    '<td class="text-center">' + menu.name + '</td>' +
                                    '<td class="text-center">Rp ' + menu.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</td>' +
                                    '<td class="text-center">' +
                                    '<form action="cart/' + menu.id + '" method="post">' +
                                    '@csrf' +
                                    '<button type="submit" class="btn btn-sm btn-success text-white">Add Cart</button>' +
                                    '</form>' +
                                    '</td>' +
                                    '</tr>';
                            });
    
                            $('#keranjang-menu tbody').empty();
                            $('#keranjang-menu tbody').html(html);
                        } else {
                            html = '<tr><td colspan="4" class="text-center">No menu found</td></tr>';
                            $('#keranjang-menu tbody').html(html);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    
    
    
    
    <script src="{{ asset('asset/js') }}/penjualan.js"></script>
    <script src="{{ asset('asset/bootstrap') }}/js/bootstrap.min.js"></script>
    <script>
        @if (Session::has('cetak_struk'))
            window.open("http://127.0.0.1:8000/cetakstruk/{{ Session::get('cetak_struk') }}")
        @endif
    </script>
@endsection
