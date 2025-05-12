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
        <div class="h2 mb-4 d-flex justify-content-between">
            <a href="{{ route('menus-deck.index') }}" class="text-decoration-none text-dark">Menus Deck</a>
            <!-- Tombol Trigger Modal -->
            <button type="button" class="btn text-white" style="background-color: #203454;" data-bs-toggle="modal"
                data-bs-target="#modalRekomendasi">
                Gunakan Rekomendasi Menu
                <i class="fa-solid fa-wand-magic-sparkles ms-3" style="color: #FFD43B;"></i>
            </button>
        </div>

        <div class="card p-3">
            <form action="{{ route('menus-deck.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="menu_id" class="form-label">Menu</label>
                    <select class="form-control" id="menu_id" name="menu_id" required>
                        <option value="">-- Pilih Menu --</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" {{ (isset($selectedMenu) && $selectedMenu->id == $menu->id) ? 'selected' : '' }}>
                                {{ $menu->nama_menu }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="total_serve" class="form-label">Total Serve</label>
                    <input type="number" class="form-control" id="total_serve" name="total_serve">
                </div>

                {{-- <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="On-going">On-going</option>
                        <option value="Planned">Planned</option>
                        <option value="Done">Done</option>
                    </select>
                </div> --}}

                <div class="mb-3">
                    <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                    <input type="date" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', $tanggal_pelaksanaan ?? '') }}"  required disabled>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('menus-deck.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalRekomendasi" tabindex="-1" aria-labelledby="modalRekomendasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h3>Menus Recommender</h3>
                        <p>Menu direkomendasikan berdasarkan kemiripan komponen menu target</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="menu_target" class="form-label">Pilih Menu Target</label>
                        <select class="form-select" id="menu_target" onchange="filterRekomendasi(this.value)">
                            <option value="">-- Pilih Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <table class="table table-striped mt-3" id="tabelRekomendasi">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Vendor</th>
                                <th>Kemiripan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>
                                        <button class="btn btn-sm btn-success" onclick="pilihMenu('{{ $menu->id }}', '{{ $menu->nama_menu }}')" title="Pilih">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>{{ $menu->kategori_bahan_utama }}</td>
                                    <td>{{ $menu->vendor_id }}</td>
                                    <td>
                                        {{ isset($recommendations[$menu->id]) ? number_format($recommendations[$menu->id] * 100, 2) . '%' : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/jquery.js"></script>

    <script>
        // Menus Recommender Algorithm
        const menus = @json($menus);

        function pilihMenu(menuId, menuNama) {
            const menuSelect = document.getElementById('menu_id');
            menuSelect.value = menuId;

            // Kalau pakai Select2 atau select custom lain, trigger event-nya:
            if (typeof $(menuSelect).trigger === 'function') {
                $(menuSelect).trigger('change');
            }

            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalRekomendasi'));
            modal.hide();
        }

        function calculateMagnitude(vector) {
                return Math.sqrt(vector.reduce((sum, v) => sum + v * v, 0));
            }

            function calculateDotProduct(vector1, vector2) {
                return vector1.reduce((sum, v, i) => sum + v * vector2[i], 0);
            }

            function cosineSimilarity(vector1, vector2) {
                const dot = calculateDotProduct(vector1, vector2);
                const mag1 = calculateMagnitude(vector1);
                const mag2 = calculateMagnitude(vector2);
                return (mag1 * mag2) ? dot / (mag1 * mag2) : 0;
            }

            function getSimilarityScores(menuTargetId) {
                const menuTarget = menus.find(m => m.id == menuTargetId);
                if (!menuTarget) return [];

                const targetVector = [
                    menuTarget.karbohidrat.toLowerCase(),
                    menuTarget.protein.toLowerCase(),
                    menuTarget.sayur.toLowerCase(),
                    menuTarget.buah.toLowerCase(),
                    menuTarget.kategori_bahan_utama.toLowerCase(),
                    menuTarget.vendor_id.toString()
                ];

                const C = [1, 1, 1, 1, 1, 1];

                const result = menus.map(menu => {
                    const inputVector = [
                        menu.karbohidrat.toLowerCase(),
                        menu.protein.toLowerCase(),
                        menu.sayur.toLowerCase(),
                        menu.buah.toLowerCase(),
                        menu.kategori_bahan_utama.toLowerCase(),
                        menu.vendor_id.toString()
                    ];

                    const A = inputVector.map((val, i) => val === targetVector[i] ? 1 : 0);
                    const similarity = cosineSimilarity(A, C);

                    return {
                        ...menu,
                        similarity: similarity
                    };
                }).filter(m => m.similarity > 0)
                    .sort((a, b) => b.similarity - a.similarity);

                return result;
            }


            // Menampilkan list hasil rekomendasi berdasarkan menu target
            function filterRekomendasi(selectedTargetId) {
                const tableBody = document.querySelector('#tabelRekomendasi tbody');
                tableBody.innerHTML = '';

                const results = getSimilarityScores(selectedTargetId);

                results.forEach(menu => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <button class="btn btn-sm btn-success" onclick="pilihMenu('${menu.id}', '${menu.nama_menu}')">
                                <i class="fa fa-plus"></i>
                            </button>
                        </td>
                        <td>${menu.nama_menu}</td>
                        <td>${menu.kategori_bahan_utama}</td>
                        <td>${menu.vendor_id}</td>
                        <td>${(menu.similarity * 100).toFixed(2)}%</td>
                    `;
                    if (menu.id != selectedTargetId) {
                        tableBody.appendChild(row);
                    }
                });
            }
    </script>
</body>

</html>
