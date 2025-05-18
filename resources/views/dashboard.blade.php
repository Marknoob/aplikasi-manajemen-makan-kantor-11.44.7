<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container mt-4">
        <h2 class="mb-4">Dashboard</h2>

        <div class="row">
            <!-- Card Pengeluaran -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ url('dashboard/pengeluaran') }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0 hover-shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-danger">Rp 15.000.000</h4>
                                    <p class="text-muted mb-1">Total Pengeluaran (Bulan Mei 2025)</p>
                                </div>
                                <div>
                                    <i class="fas fa-arrow-circle-down fa-2x text-danger"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-danger">12% increase</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Pembayaran -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ url('dashboard/pembayaran') }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0 hover-shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-primary">3 Pembayaran Menunggu..</h4>
                                    <p class="text-muted mb-1">Pembayaran belum lunas</p>
                                </div>
                                <div>
                                    <i class="fas fa-credit-card fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-primary">8% increase</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    </div>



</x-app-layout>
