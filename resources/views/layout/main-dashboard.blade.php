@extends('layout.main')
@section('title', 'dashboard')
@section('content')
    <div class="p-3 bg-white min-vh-100 shadow " style="margin-top: 5px;border-radius: 10px">
        <div class="p-1 mb-3 d-flex">
            <p class="fs-4 text-bold ">Home Page
            <p class="fs-4" style="color: grey">/</p>
            </p>
            <p class="fs-5 text-end" style="font-weight: 300;color: grey">Hai User {{ Auth::user()->name }} How are you Today?</p>
        </div>
            <div class="container mb-3" style="margin-right: 25px">
                <div class="row align-items-start">

                    <div class="col d-flex card shadow" style="border-radius: 10px;height: 10rem;margin-left: 15px;">
                        <div class="p-1 mb-1 d-flex justify-content-center" style="height: 30px">
                            <p class="text-end w-100" style="font: bold;height: 30px;">Menu Data</p>
                        </div>
                        <div class="d-flex">
                            <div class="P-3 d-flex justify-content-center" style="border-radius: 10px;height: 95px;width:95px;background-color: red">
                                <i class="fa-solid fa-boxes-packing text-white" style="font-size: 50px; margin-top: 22px"></i>
                            </div>
                            <div class="p-3" style="margin-left: 40px; margin-top: 10px">
                                <h2 style="font-size: 25px">{{ $menudata }}</h2>
                            </div>
                        </div>

                    </div>

                    <div class="col d-flex card shadow" style="border-radius: 10px;height: 10rem;margin-left: 15px;">
                        <div class="p-1 mb-1 d-flex justify-content-center" style="height: 30px">
                            <p class="text-end w-100" style="font: bold;height: 30px;">Order All</p>
                        </div>
                        <div class="d-flex">
                            <div class="P-3 d-flex justify-content-center bg-primary" style="border-radius: 10px;height: 95px;width:95px;">
                                <i class="fa-solid fa-person-carry-box text-white" style="font-size: 50px; margin-top: 22px"></i>
                            </div>
                            <div class="p-3" style="margin-left: 40px;margin-top: 10px">
                                <h2 style="font-size: 25px">{{ $orderdata }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex card shadow" style="border-radius: 10px;height: 10rem;margin-left: 15px;">
                        <div class="p-1 mb-1 d-flex justify-content-center" style="height: 30px">
                            <p class="text-end w-100" style="font: bold;height: 30px;">Income</p>
                        </div>
                        <div class="d-flex">
                            <div class="P-3 d-flex justify-content-center" style="border-radius: 10px;height: 95px;width:95px;background-color: rgb(55, 201, 55)">
                                <i class="fa-solid fa-chart-mixed-up-circle-dollar text-white" style="font-size: 50px; margin-top: 22px"></i>
                            </div>
                            <div class="p-1 mt-4 d-flex justify-content-center" style="margin-left: 20px">
                              @if (Auth::user()->hasRole('admin'))
                              <h6 class="text-bold">Rp.{{ number_format($income, 0, ',', '.') }}</h6>
                              @else
                              <h6 class="text-bold">Rp.*****</h6>
                              @endif
                               
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex card shadow" style="border-radius: 10px;height: 10rem;margin-left: 15px;">
                        <div class="p-1 mb-1 d-flex justify-content-center" style="height: 30px">
                            <p class="text-end w-100" style="margin-right: 5px;font: bold;height: 30px;">Trans Today</p>
                        </div>
                        <div class="d-flex">
                            <div class="P-3 d-flex justify-content-center" style="border-radius: 10px;height: 95px;width:95px;background-color:  #fd6a02">
                                <i class="fa-sharp fa-light fa-money-bill-transfer text-white" style="font-size: 50px; margin-top: 22px"></i>
                            </div>
                            <div class="p-1 mt-4 d-flex justify-content-center" style="margin-left: 20px">
                                <h6 class="text-bold">Rp.{{ number_format($transtodayuser, 0, ',', '.') }}</h6>
                            </div>
                        </div>

                    </div>

                    <div class="col d-flex card shadow" style="border-radius: 10px;height: 10rem;margin-left: 15px;">
                        <div class="p-1 mb-1 d-flex justify-content-center" style="height: 30px">
                            <p class="text-end w-100" style="font: bold;height: 30px;">Data User</p>
                        </div>
                        <div class="d-flex">
                            <div class="P-3 d-flex justify-content-center bg-warning" style="border-radius: 10px;height: 95px;width:95px;">
                                <i class="fa-regular fa-person-dolly-empty text-white" style="font-size: 50px; margin-top: 22px"></i>
                            </div>
                            <div class="p-3" style="margin-left: 40px;margin-top: 10px">
                                <h2 style="font-size: 25px">{{ $user }}</h2>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

    </div>
    

    <script src="{{ asset('asset/bootstrap') }}/js/bootstrap.min.js"></script>
@endsection
