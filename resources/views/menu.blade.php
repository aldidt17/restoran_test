@extends('layout.main')
@section('title', 'menudata')
@section('content')

    <div class="p-3 bg-white min-vh-100 shadow" style="margin-top: 5px;border-radius: 10px">

        <div class="p-1">
            <p class="fs-5 text-bold text-start" style="color: grey">Food Menu</p>
        </div>

        <div class="p-3 w-100 mb-4 " style="background-color: white">
            @if (Auth::user()->hasRole('admin'))
                <button type="submit" class="btn btn-lg btn-success  text-white" data-bs-toggle="modal" data-bs-target="#addmenu">
                    Add
                </button>
            @else
                <button type="submit" class="btn btn-lg btn-success text-white" data-bs-toggle="modal" data-bs-target="#addmenu" hidden>
                    Add
                </button>
            @endif

        </div>
        <div class="col-12 mb-4 d-flex justify-content-end">
            <form action="/menu/search" method="get">
                <div class="input-group flex-nowrap">
                    <input style="width: 350px" name="pencarian" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        @foreach ($menu as $list)
                            <option value="{{ $list->name }}"></option>
                        @endforeach

                    </datalist>
                    {{-- <input type="text" name="pencarian" class="form-control" placeholder="Cari Data Barang....." aria-label="Username" aria-describedby="addon-wrapping"> --}}
                    <button class="input-group-text btn btn-primary">Search</button>
                </div>
            </form>
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
        <div class="card mb-3 shadow"style="border-radius: 10px">
            <div class="col-12 table-responsive  p-3">
                <table class="table table-striped table-sm table-hover p-2" style="border-radius: 10px">
                    <thead class="p-2">
                        <tr class="p-3">
                            <td class="text-center ">No</td>
                            <td class="text-center " hidden>Id</td>
                            <td class="text-center ">Name</td>
                            <td class="text-center ">price</td>
                            @if (Auth::user()->hasRole('admin'))
                                <td class="text-center ">action</td>
                            @else
                                <td hidden class="text-center ">action</td>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($menu as $list)
                            <tr style="border-radius: 10px">
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center" hidden>{{ $list->id }}</td>
                                <td class="text-center">{{ $list->name }}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($list->price, 0, ',', '.') }}</td>

                                <td class="text-center">
                                    @if (Auth::user()->hasRole('admin'))
                                        <button type="button" class="btn btn-sm text-white text-center" style="background-color:#FFC107" data-bs-toggle="modal" data-bs-target="#editdata{{ $list->id }}"><i class="fa-solid fa-pen"></i></button>
                                    @else
                                        <button hidden type="button" class="btn btn-sm text-white text-center" style="background-color:#FFC107" data-bs-toggle="modal" data-bs-target="#editdata{{ $list->id }}"><i class="fa-solid fa-pen"></i></button>
                                    @endif


                                    <!-- Modal edit -->
                                    <div class="modal fade" id="editdata{{ $list->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <form action="/editmenu/{{ $list->id }}" method="post" enctype="multipart/form-data" class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Menu <i class="fa-sharp fa-solid fa-fork-knive" style="color: #F3CB51; margin-left:5px"></i></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" class="form-control" placeholder="enter menu name!" required value="{{ $list->name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price">Price</label>
                                                            <input type="number" name="price" class="form-control" placeholder="enter menu price!" value="{{ $list->price }}" required>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn text-white" style="background-color: green">Save</button>
                                                    <button type="button" class="btn text-white" style="background-color: grey" data-bs-dismiss="modal">Cancel</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>



                                    {{-- </div> --}}
                                    {{-- modal hapus data --}}
                                    @if (Auth::user()->hasRole('admin'))
                                        <button type="button" class="btn btn-sm text-white" style="background-color: red" data-bs-toggle="modal" data-bs-target="#deletemenu{{ $list->id }}"><i class="fa-solid fa-trash"></i></button>
                                    @else
                                        <button hidden type="button" class="btn btn-sm text-white" style="background-color: red" data-bs-toggle="modal" data-bs-target="#deletemenu{{ $list->id }}"><i class="fa-solid fa-trash"></i></button>
                                    @endif

                                    <!-- Modal delete -->
                                    <div class="modal fade" id="deletemenu{{ $list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <form action="/deletemenu/{{ $list->id }}" method="post" enctype="multipart/form-data"class="modal-dialog">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 " style="" id="exampleModalLabel">De licius <i class="fa-sharp fa-solid fa-fork-knive" style="color: #F3CB51; margin-left:1"></i></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 style="font-size: 20px">Are you sure you want to delete the menu data?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn text-white" style="background-color: red">Delete</button>
                                                        <button type="button" class="btn text-white" style="background-color: grey" data-bs-dismiss="modal">Cancel</button>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3">
                    {{ $menu->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade modal-md" id="addmenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="/addmenu" method="post" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Add Menu<i class="fa-sharp fa-solid fa-fork-knive" style="color: #F3CB51"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            @csrf
                            <div class="mb-3">
                                <label for="name">Menu name</label>
                                <input type="text" name="name" class="form-control" placeholder="enter the menu name!" required>
                            </div>
                            <div class="mb-3">
                                <label for="price">Menu price</label>
                                <input type="number" name="price" class="form-control " placeholder="enter the menu price!" required>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn text-white" style="background-color: green">Save</button>
                        <button type="button" class="btn text-white" style="background-color: grey" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('asset/js') }}/jquery.min.js"></script>
    <script src="{{ asset('asset/bootstrap') }}/js/bootstrap.min.js"></script>
@endsection
