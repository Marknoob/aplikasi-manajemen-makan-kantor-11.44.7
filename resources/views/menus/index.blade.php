<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menus Management</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>
<body>

    <div class="m-3">
        <div class="h2 mb-4">Menus Management</div>

        <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#myModal">+ Add New Menu</button>

        {{-- Card Menus --}}
        {{-- Inspired: https://freefrontend.com/bootstrap-cards/ --}}
        @foreach ($menus as $menu)
            <div class="shadow bg-white card mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$menu->nama_menu}}</h5>
                    <div class="card-text">
                        <div>Karbohidrat: {{$menu->karbohidrat}}</div>
                        <div>Protein: {{$menu->protein}}</div>
                        <div>Sayur: {{$menu->sayur}}</div>
                        <div>Buah: {{$menu->buah}}</div>
                        <div class="mt-3">Kategori: {{$menu->kategori_bahan_utama}}</div>
                        <div>Vendor: {{$menu->vendor_id}}</div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>

    {{-- Modal PopUp Add Dialog --}}
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
</body>
</html>
