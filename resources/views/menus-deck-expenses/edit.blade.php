<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menus Deck Expenses - Edit Menu</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>

<body>
    <div class="m-3">
        <div class="h2 mb-4">Menus Deck Expenses</div>

        <div class="card p-3">
            <form action="{{ route('menus-deck-expenses.update', $menusDeckExpense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="deskripsi_biaya">Deskripsi Biaya</label>
                    <input type="text" class="form-control" name="deskripsi_biaya" id="deskripsi_biaya" value="{{ $menusDeckExpense->deskripsi_biaya }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jumlah_biaya">Jumlah Biaya</label>
                    <input type="number" class="form-control" name="jumlah_biaya" id="jumlah_biaya" value="{{ (int) $menusDeckExpense->jumlah_biaya  }}" required>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <!-- Save edit button -->
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    </div>

                    <!-- Delete button -->
                    {{-- <form action="{{ route('menus-deck-expenses.deactivate', $menusDeckExpense->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus biaya ini?');" class="mb-0">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form> --}}
                </div>
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
