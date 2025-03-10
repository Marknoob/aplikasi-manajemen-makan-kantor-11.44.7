<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>
<body>

    <div class="m-3">
        <div class="h2 mb-4">Transactions</div>

        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width: 4vw;">Aksi</th>
                        <th scope="col" style="width: 10vw;">Menu Deck ID</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td style="width: 4vw;">
                                <a class="text-decoration-none text-reset" href="{{ route('transactions.edit', $transaction->id)}}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="text-decoration-none text-reset" href="{{ route('transactions.show', $transaction->id)}}">
                                    <i class="fa-brands fa-readme"></i>
                                </a>
                            </td>
                            <td style="width: 10vw;">
                                <a href="{{ route('menus-deck.show', $transaction->menuDeck->id)}}">
                                    {{$transaction->menuDeck->menu_id}}
                                </a>
                            </td>
                            <td>{{$transaction->tanggal_transaksi != null ? 'Paid' : 'Not Paid' }}</td>
                            <td>{{$transaction->tanggal_transaksi ?? "-" }}</td>
                            <td>{{$transaction->catatan ?? "-" }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
