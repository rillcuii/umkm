@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Responsive Sidebar</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100">

        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
            type="button"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm  rounded-lg sm:hidden  focus:outline-none focus:ring-2 focus:ring-gray-200 text-gray-400 hover:bg-gray-700 focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

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
    


    </html>
