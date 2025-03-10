<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menus Deck - Add Menu</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
</head>

<body>
    <div class="m-3">
        <div class="h2 mb-4">
            <a href="{{ route('menus-deck.index') }}" class="text-decoration-none text-dark">Menus Deck</a>
        </div>

        <div class="card p-3">
            <form action="{{ route('menus-deck.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="menu_id" class="form-label">Menu</label>
                    <select class="form-control" id="menu_id" name="menu_id" required>
                        <option value="">-- Pilih Menu --</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="total_serve" class="form-label">Total Serve</label>
                    <input type="number" class="form-control" id="total_serve" name="total_serve" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="On-going">On-going</option>
                        <option value="Planned">Planned</option>
                        <option value="Done">Done</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                    <input type="date" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" required>
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('menus-deck.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
