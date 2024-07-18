@extends('layout.main')
@section('title', 'laporanpenjualan')
@section('content')

    <div class="mb-3" style="height:100vh ;background-color: white;border-radius: 10px">
        <div class="p-3 mb-3">
            <h4 class="text-center">History Order Food </h4>

        </div>
        <div class="d-flex justify-content-end align-items-end">
            <div class="input-group mb-3" style="width: 500px">
                <input type="text" class="form-control" placeholder="Search menu..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
            </div>
        </div>

        <div class="col-12 table-responsive p-4" style="border-radius:15px ">
            <table class="table table-striped shadow table-hover" id="history" style="border-radius:15px ">

                <thead>
                    <tr>
                        <td class="text-center text-success">Transaction Id</td>
                        <td class="text-center text-primary">Date</td>
                        <td class="text-center text-primary">Name Kasir</td>
                        <td class="text-center text-primary">Pay</td>
                        <td class="text-center text-primary">Return</td>
                        <td class="text-center text-primary">Total</td>
                        <td class="text-center text-primary">action</td>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $noo = 1; ?>
                    @foreach ($history as $list)
                        <tr>
                            <td class="text-center">
                                <input type="hidden" name="id" value="{{ $list->id }}">
                                <p class="m-0">{{ $list->id }}</p>
                            </td>
                            <td class="text-center">
                                <p class="m-0">{{ date('d-M-Y', strtotime($list->created_at)) }}</p>
                            </td>
                            <td class="text-center">
                                <p class="m-0">{{ $list->user->name }}</p>
                            </td>

                            <td class="text-end">
                                <p class="m-0">Rp. {{ number_format($list->pay, 0, ',', '.') }}</p>
                            </td>
                            <td class="text-end">
                                <p class="m-0">Rp. {{ number_format($list->return, 0, ',', '.') }}</p>
                            </td>
                            <td class="text-end">
                                <p class="m-0">Rp. {{ number_format($list->total_price, 0, ',', '.') }}</p>
                            </td>

                            <td class="text-center">
                                <button class="m-0 btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#delete{{ $list->id }}"><i class="fa-regular fa-trash"></i></button>
                                <div class="modal fade" id="delete{{ $list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


                                    <form action="/history-order/{{ $list->id }}" method="post" enctype="multipart/form-data" class="modal-dialog">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 " style="" id="exampleModalLabel">De licius <i class="fa-reguler fa-fork-knive" style="color: #F3CB51; margin-left:1"></i></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 style="font-size: 20px">Are you sure you want to delete Order History?</h4>
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


        </div>
        </td>
        @endforeach

        </tr>
        <tr>
            <td colspan="6" style="column-gap: 300px" class="text-left" style="border-radius: 1px">Total Income :</td>

            <td class="text-end" style="width: 150px">Rp.
                {{ number_format($totjul, 0, ',', '.') }}
            </td>

        </tr>

        </tbody>
        </table>
        <div class="my-3">
            {{ $history->links('pagination::bootstrap-5') }}
        </div>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').keyup(function() {
                var searchText = $(this).val().toLowerCase();

                $.ajax({
                    url: '{{ route('search.history') }}',
                    method: 'GET',
                    data: {
                        search: searchText
                    },
                    beforeSend: function() {
                        $('#history tbody').html('<tr><td colspan="7" class="text-center">Searching...</td></tr>');
                    },
                    success: function(response) {
                        var html = '';

                        if (response.data.length > 0) {
                            response.data.forEach(function(history) {
                                html += '<tr>' +
                                    '<td class="text-center">' + history.id + '</td>' +
                                    '<td class="text-center">' + new Date(history.created_at).toLocaleDateString('en-US', {
                                        day: 'numeric',
                                        month: 'short',
                                        year: 'numeric'
                                    }) + '</td>' +
                                    '<td class="text-center">' + history.user.name + '</td>' +
                                    '<td class="text-end">Rp. ' + formatNumber(history.pay) + '</td>' +
                                    '<td class="text-end">Rp. ' + formatNumber(history.return) + '</td>' +
                                    '<td class="text-end">Rp. ' + formatNumber(history.total_price) + '</td>' +
                                    '<td class="text-center">' +
                                    '<button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#delete' + history.id + '"><i class="fa-regular fa-trash"></i></button>' +
                                    '</td>' +
                                    '</tr>';
                            });

                           
                            $('#history tbody').empty();
                            $('#history tbody').html(html);
                        } else {
                            html = '<tr><td colspan="7" class="text-center">No history found</td></tr>';
                            $('#history tbody').html(html);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

    <script src="{{ asset('asset/js') }}/pemesanan.js"></script>
    <script src="{{ asset('asset/bootstrap') }}/js/bootstrap.min.js"></script>
@endsection
