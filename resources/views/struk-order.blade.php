<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/reguler.min.css">
    <link rel="stylesheet" href="{{ asset('asset/fa') }}/css/all.css">
    <title>Struk Order Food</title>
</head>

<body>
    <div class="receipt">
        <h2>Restaurant De Lecius</h2>
        <p style="font-size: 10px">Jl. Babakan Hegar No.47 Rt03,Rw03 Kel.Campaka Kec.Andir Kota Bandung</p>
        <hr>
        <h3>Struk Order</h3>

        <p><strong>Date:</strong>{{ $cetakstruk[0]->created_at }}</p>
        <p><strong>Kasir:</strong>{{ Auth::user()->name }}</p>
        <hr>
        <ul>
            <li style="display: flex; justify-content: space-between;">
                <span style="flex: 3;">Menu Name</span>
                <span style="flex: 1; text-align: center;">Qty</span>
                <span style="flex: 1; text-align: center;">Price</span>
                <span style="flex: 1; text-align: center;">Subtotal</span>
            </li>
            <hr>
            @foreach ($cetakstruk as $list)
                <li style="display: flex; justify-content: space-between;">
                    <span style="flex: 3;">{{ $list->menu->name }}</span>
                    <span style="flex: 1; text-align: center;">{{ $list->qty }}</span>
                    <span style="flex: 1; text-align: center;">Rp.{{ number_format($list->price, 0, ',', '.') }}</span>
                    <span style="flex: 1; text-align: center;">Rp.{{ number_format($list->subtotal, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>
        <hr>
        <div class="d-flex flex-wrap justify-content-end">
            <p style="margin-right: 10px"><strong>Total:</strong>Rp.{{ number_format($list->total_price, 0, ',', '.') }}</p>
            <p><strong>Pay:</strong> Rp.{{ number_format($list->pay, 0, ',', '.') }}</p>
            <p><strong>return:</strong> Rp.{{ number_format($list->return, 0, ',', '.') }}</p>
        </div>
        <hr>
        <p>Thanks for your Order, Enjoy Eating <3 </p>
    </div>
</body>
<script>
    window.print();
</script>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }

    .receipt {
        background-color: #fff;
        width: 300px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 10px;
        font-size: 30px;
    }

    h3 {
        text-align: center;
        margin-bottom: 10px;
        font-size: 20px;
    }

    p {
        margin: 5px 0;
    }

    hr {
        border: 1px solid black;
        margin: 10px 0;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px; /* added margin for spacing between items */
    }

    span {
        text-align: center;
    }

    strong {
        font-weight: bold;
    }
</style>

</html>
