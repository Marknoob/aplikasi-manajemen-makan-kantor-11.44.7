<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions - Edit Menu</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>

<body>
    <div class="m-3">
        <div class="h2 mb-4">Transactions</div>

        <div class="card p-3">
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                        value="{{ $transaction->menuDeck->menu->nama_menu }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                        value="{{ $transaction->tanggal_transaksi }}">
                </div>

                <div class="mb-3">
                    <label for="file_path" class="form-label">Upload Bukti</label>
                    <input type="file" class="form-control" id="file_path" name="file_path">
                    @if($transaction->file_path)
                        <p class="mt-2">File saat ini: <a href="{{ asset($transaction->file_path) }}" target="_blank">Lihat File</a></p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $transaction->catatan }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>

    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
