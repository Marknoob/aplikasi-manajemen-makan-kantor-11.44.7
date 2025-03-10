<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions - Show Menu</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>

<body>
    <div class="m-3">
        <div class="h2 mb-4">Transactions</div>

        <div class="card p-3">
            <div class="mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                    value="{{ $transaction->menuDeck->menu->nama_menu }}" disabled>
            </div>

            <div class="mb-3">
                <label for="status_transaksi" class="form-label">Status Transaksi</label>
                <input type="text" class="form-control" id="status_transaksi" name="status_transaksi"
                    value="{{ $transaction->tanggal_transaksi != null  ? 'Completed' : 'Pending' }}" disabled>
            </div>

            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="text" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                    value="{{ $transaction->tanggal_transaksi }}" disabled>
            </div>

            <div class="mb-3">
                <label for="file_path" class="form-label">File Bukti</label>
                @if($transaction->file_path)
                    <a href="{{ asset('storage/' . $transaction->file_path) }}" target="_blank" class="btn btn-primary">Lihat Bukti</a>
                @else
                    <input type="text" class="form-control" value="No File Available" disabled>
                @endif
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" disabled>{{ $transaction->catatan }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>

    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
