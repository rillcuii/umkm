@extends('navbar')
@section('navbar')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <title>Document</title>

        <style>
            .swiper-pagination-bullet {
                background-color: #d1d5db;
                /* Abu-abu untuk bullet tidak aktif */
                width: 10px;
                height: 10px;
                opacity: 1;
                transition: background-color 0.3s ease-in-out;
            }

            .swiper-pagination-bullet-active {
                background-color: #facc15;
                /* Kuning untuk bullet aktif */
            }

            .swiper-slide {
                flex-shrink: 0;
                width: 100%;
            }

            img {
                max-width: 100%;
                height: auto;
                object-fit: contain;
                /* Pastikan gambar tetap proporsional */
            }

            body {
                margin: 0;
                padding: 0;
                overflow-x: hidden;
                /* Cegah scroll horizontal */
            }

            .max-w-screen-xl {
                overflow: hidden;
                /* Hindari elemen melampaui container */
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                /* Responsif grid */
                gap: 1rem;
                /* Jarak antar elemen */
            }

            a {
                max-width: 100%;
                /* Hindari elemen link melampaui container */
            }

            @media (min-width: 1024px) {
                .grid-cols-4 {
                    grid-template-columns: repeat(4, 1fr);
                }

                .grid-cols-1,
                .grid-cols-2,
                .grid-cols-3 {
                    grid-template-columns: repeat(4, 1fr);
                    /* Tetapkan 4 kolom meskipun sedikit item */
                }
            }
        </style>
    </head>

    <body>

        <div class="relative w-screen px-4 py-2 md:px-8 md:py-6 md:mb-4">
            <!-- Swiper Container -->
            <div id="mySwiper" class="swiper w-full overflow-hidden rounded-3xl">
                <div class="swiper-wrapper">
                    @forelse ($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/banner/' . $banner->link) }}"
                                class="block w-full h-[300px] md:h-[400px] object-cover rounded-lg" alt="Banner" />
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-center text-gray-500">No banners available.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>


        <!-- Section Kategori -->
        <div class="max-w-screen-xl mx-auto py-8 px-4 sm:px-6 md:px-8 overflow-hidden">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 md:mb-10 text-center">
                Kategori
            </h2>

            <!-- Tombol Semua Kategori (muncul hanya jika ada kategori yang dipilih) -->
            {{-- @if (request('kategori'))
                <div class="text-center mb-6">
                    <a href="{{ route('index') }}"
                        class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                        Semua Kategori
                    </a>
                </div>
            @endif --}}

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
                @foreach ($kategoris as $kategori)
                    @php
                        $isActive = request('kategori') == $kategori->id_kategori;
                        $images = [
                            'Food & Drink' =>
                                'https://i.gojekapi.com/darkroom/gofood-id/v2/images/uploads/9550dc29-2fbb-4734-90e0-40b91a847549_gofood_categories_lebaran_healthy_food.png',
                            'Fashion' =>
                                'https://i.gojekapi.com/darkroom/gofood-id/v2/images/uploads/7bbf55f7-c896-4efb-8227-b83e828d1e43_categories_foodiskon.png',
                            'Elektronik' => 'https://cdn-icons-png.flaticon.com/512/186/186239.png',
                            'Sports' => asset('img/sport.png'),
                            'Buku' => asset('img/buku.png'),
                            'Beauty' => asset('img/beuty.png'),
                            'Lainnya' => asset('img/other.png'),
                        ];
                        $defaultImage = 'https://via.placeholder.com/150';
                        $image = $images[$kategori->nama_kategori] ?? $defaultImage;
                    @endphp

                    <!-- Jika kategori aktif diklik lagi, kembali ke semua kategori -->
                    <a href="{{ $isActive ? route('index') : route('index', ['kategori' => $kategori->id_kategori]) }}"
                        class="block text-center transition duration-300 transform hover:scale-105 hover:shadow-lg border {{ $isActive ? 'border-blue-500 bg-blue-100' : 'border-gray-200' }} rounded-xl p-4 bg-white max-w-full overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $kategori->nama_kategori }}"
                            class="w-16 h-16 md:w-20 md:h-20 mx-auto object-contain" />
                        <p class="mt-3 text-sm md:text-base font-semibold text-gray-800">{{ $kategori->nama_kategori }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="max-w-screen-xl mx-auto py-8 px-4 sm:px-6 md:px-8">
            <h2 class="text-2xl font-semibold mb-6 text-center md:mb-12">
                {{ request('kategori') ? $kategoris->firstWhere('id_kategori', request('kategori'))->nama_kategori ?? 'Kategori Tidak Ditemukan' : 'Semua Kategori' }}
            </h2>

            <!-- Grid Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @forelse ($umkms as $umkm)
                    <a href="{{ route('umkm.show', $umkm->id_umkm) }}">
                        <div
                            class="bg-white border border-gray-200 rounded-xl overflow-hidden transition duration-500 hover:shadow-2xl hover:border-transparent">
                            <div class="p-2">
                                <div class="relative">
                                    @if ($umkm->foto_umkm)
                                        <img src="{{ asset('storage/foto_umkm/' . $umkm->foto_umkm) }}"
                                            alt="{{ $umkm->nama_umkm }}"
                                            class="w-full h-44 lg:h-60 object-cover rounded-xl">
                                    @else
                                        <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/faa7bdd5-cbf2-4cae-bd41-2737662fe189_file20191217-15681-1b0ys12.jpeg?auto=format"
                                            alt="{{ $umkm->nama_umkm }}"
                                            class="w-full h-44 lg:h-60 object-cover rounded-xl">
                                    @endif
                                </div>
                            </div>
                            <div class="p-4 lg:py-6">
                                <h2 class="font-semibold text-lg truncate lg:mb-2">{{ $umkm->nama_umkm }}</h2>
                                <p class="text-sm text-gray-600 lg:mb-4 break-words">
                                    <strong>Alamat:</strong> {{ $umkm->alamat_pemilik }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <!-- Ensure the "belum ada UMKM" text is centered -->
                    <p class="text-center col-span-4 text-gray-500">Belum ada UMKM yang terdaftar.</p>
                @endforelse
            </div>

            <div class="flex justify-center mt-6"></div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script>
            // Inisialisasi Swiper
            const swiper = new Swiper("#mySwiper", {
                loop: true, // Mengaktifkan loop pada slider
                speed: 800, // Kecepatan transisi antar slide
                autoplay: { // Menambahkan autoplay
                    delay: 2000, // Waktu tunggu (dalam milidetik) sebelum slide berikutnya
                    disableOnInteraction: false, // Tetap autoplay meskipun pengguna berinteraksi
                },
                pagination: {
                    el: ".swiper-pagination", // Elemen untuk pagination
                    clickable: true, // Pagination dapat diklik
                },
                grabCursor: true, // Mengaktifkan kursor grab
            });
        </script>

    </body>

    </html>
    @include('footer')
@endsection
