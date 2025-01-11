@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
    <!-- Main Content -->
    <div class="flex-1 ml-0 lg:ml-64">
        <main class="p-5 md:p-10 space-y-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang admin paling keren,
                    {{ Auth::user()->nama_lengkap }}!</h2>
                <p class="mt-2 text-gray-600">Kelola data pengguna, informasi UMKM, dan lainnya melalui halaman ini.</p>
            </div>
        </main>
    </div>

    <div class="main-content flex-1 p-4">
        <h1>Chart UMKM</h1>
        <canvas id="umkmChart" class="chart-size"></canvas>
    </div>
    <style>
        .chart-size {
            width: 80%;
            /* Chart mengambil lebar 80% dari kontainer */
            max-width: 350px;
            /* Ukuran maksimum chart */
            height: 150px;
            /* Tinggi chart lebih kecil */
            margin: 0 auto;
            /* Menjaga chart tetap di tengah */
        }
    </style>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <script>
        var ctx = document.getElementById('umkmChart').getContext('2d');
        var umkmChart = new Chart(ctx, {
            type: 'bar', // Jenis chart: bar chart
            data: {
                labels: ['Total Pemilik UMKM'], // Label untuk satu bar
                datasets: [{
                    label: 'Jumlah Pemilik UMKM',
                    data: [{{ $totalPemilikUmkm }}], // Data total pemilik UMKM
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna latar belakang bar
                    borderColor: 'rgba(54, 162, 235, 1)', // Warna border bar
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    </script>
@endsection
