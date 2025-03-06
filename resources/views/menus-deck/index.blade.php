<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menus Deck</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>
<body>

    <div class="m-3">
        <div class="h2 mb-4">Menus Deck</div>

        <a href="{{ route('menus-deck.create') }}" class="btn btn-primary mb-2 mt-2">+ Tambah Menu</a>

        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width: 4vw;">Aksi</th>
                        <th scope="col" style="width: 6vw;">Status</th>
                        <th scope="col">Tanggal Pelaksanaan</th>
                        <th scope="col">Total Serve</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Voted</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menusDeck as $menuDeck)
                        <tr>
                            <td style="width: 4vw;">
                                <a class="text-decoration-none text-reset" href="{{ route('menus-deck.edit', $menuDeck->id)}}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="text-decoration-none text-reset" href="{{ route('menus-deck.show', $menuDeck->id)}}">
                                    <i class="fa-brands fa-readme"></i>
                                </a>
                            </td>
                            <td>{{$menuDeck->status}}</td>
                            <td>{{$menuDeck->tanggal_pelaksanaan}}</td>
                            <td>{{$menuDeck->total_serve}}</td>
                            <td>
                                @if($menuDeck->hasPaidTransaction)
                                    <a href="{{ route('transaction.check', $menuDeck->id) }}">tombol cek transaksi</a>
                                @else
                                    no tombol
                                @endif
                            </td>
                            <td>
                                @if($menuDeck->hasPaidTransaction)
                                    <a href="">tombol cek vote</a>
                                @else
                                    <a href="">vote now</a>
                                @endif
                            </td>
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
