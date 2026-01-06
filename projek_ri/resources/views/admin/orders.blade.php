<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pesanan</title>
    <style>
        body {
            font-family: Arial;
            background: #f6f6f6;
            padding: 20px;
        }
        table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #2E6F4E;
            color: #fff;
        }
        td ul {
            list-style: disc;
            font-size: 13px;
        }
        td ul li {
            margin-bottom: 4px;
        }
        .btn {
            padding: 6px 12px;
            background: #2E6F4E;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
        }
        .wait { background: orange; color: #fff; }
        .paid { background: green; color: #fff; }
    </style>
</head>
<body>

<h2>Dashboard Admin - Pesanan</h2>

<form method="POST" action="/admin/logout" style="margin-bottom: 15px; text-align: right;">
    @csrf
    <button type="submit" style="
        background: #c0392b;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
    ">
        Logout
    </button>
</form>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Meja</th>
        <th>Total</th>
        <th>Pesanan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($orders as $i => $o)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $o->customer->nama }}</td>
        <td>{{ $o->customer->meja }}</td>
        <td>Rp {{ number_format($o->total,0,',','.') }}</td>
        <td>
            <ul style="padding-left:16px; margin:0;">
                @foreach($o->items as $item)
                    <li>
                        {{ $item->nama }} 
                        ({{ $item->qty }}x)
                    </li>
                @endforeach
            </ul>
        </td>
        <td>
            @if($o->status === 'MENUNGGU_PEMBAYARAN')
                <span class="badge wait">Menunggu</span>
            @else
                <span class="badge paid">Lunas</span>
            @endif
        </td>
        <td>
            @if($o->status === 'MENUNGGU_PEMBAYARAN')
                <form method="POST" action="/admin/orders/{{ $o->id }}/confirm">
                    @csrf
                    <button class="btn">Konfirmasi Bayar</button>
                </form>
            @else
                ✔
            @endif
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>