<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menus Deck - Show Menu</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>

<body>
    <div class="m-3">
        <div class="h2 mb-4">Menus Deck</div>

        <div class="card p-3">
            <div class="mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{ $menusDeck->menu->nama_menu }}"
                    disabled>
            </div>

            <div class="mb-3">
                <label for="total_serve" class="form-label">Total Serve</label>
                <input type="number" class="form-control" id="total_serve" name="total_serve" value="{{ $menusDeck->total_serve }}"
                    disabled>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $menusDeck->status }}" disabled>
            </div>

            <div class="mb-3">
                <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                <input type="text" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan"
                    value="{{ $menusDeck->tanggal_pelaksanaan }}" disabled>
            </div>

            <a href="{{ route('menus-deck.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>

    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
