<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Commerce UI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
    <style>
        body {
            font-family: "Rubik", sans-serif;
        }

        h1,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Rubik", sans-serif;
        }

        @media (max-width: 768px) {
            .carousel img {
                height: 300px;
                /* Tinggi gambar khusus untuk layar kecil */
            }
        }

        @media (max-width: 768px) {
            #user-popup {
                max-width: 100%;
                padding: 16px;
                border-radius: 12px 12px 0 0;
            }

            #overlay {
                display: block;
            }
        }

        #user-popup,
        #user-popup-guest {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            z-index: 10000;
            transform: translateY(100%);
            opacity: 0;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            /* Tambahkan transisi */
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px 12px 0 0;
            padding: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }

        #user-popup.active,
        #user-popup-guest.active {
            transform: translateY(0);
            /* Geser ke posisi semula */
            opacity: 1;
            /* Buat elemen terlihat */
        }

        /* Overlay Visibility */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            transition: opacity 0.3s ease-in-out;
            /* Transisi untuk overlay */
            opacity: 0;
            /* Default tidak terlihat */
        }

        #overlay.active {
            display: block;
            opacity: 1;
            /* Saat aktif */
        }

        /* Sidebar Z-Index */
        #sidebar {
            z-index: 50;
        }

        /* Pagination Styling */
        /* .swiper-pagination-bullet {
            background-color: #d1d5db;
            width: 10px;
            height: 10px;
            opacity: 1;
            transition: background-color 0.3s ease-in-out;
        }

        .swiper-pagination-bullet-active {
            background-color: #facc15;
        } */
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
            <!-- Logo dan Menu -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="flex items-center whitespace-nowrap overflow-hidden text-ellipsis">
                    <img src="{{ asset('img/logo.png') }}" class="w-8 h-8" alt="Logo" />
                    <h2 class="text-gray-800 mt-1 ml-2 text-lg font-bold" style="font-family: 'Rubik', sans-serif">
                        Laris Manis
                    </h2>

                </div>
            </div>
            <!-- Nama User dengan Dropdown -->
            <div class="flex items-center">
                @if (Auth::check())
                    <!-- Popup Button (Mobile Only) -->
                    <button id="user-popup-btn-mobile" class="md:hidden font-semibold text-gray-800">
                        {{ Auth::user()->username }}
                    </button>



                    <div class="hidden md:block relative">
                        <!-- Button User Menu -->
                        <button id="user-menu-btn"
                            class="flex items-center space-x-2 text-gray-800 hover:text-gray-600 focus:outline-none">
                            <span>
                                <h3 class="font-family font-semibold">{{ Auth::user()->nama_lengkap }}</h3>
                            </span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-menu"
                            class="absolute md:mt-8 right-0 mt-2 w-56 bg-white shadow-2xl rounded-lg shadow-lg hidden z-50">
                            <a href="{{ route('history.transaksi') }}"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <h3 class="font-family font-semibold ml-4">History Transaksi</h3>
                            </a>
                            <a href="{{ route('pelanggan.messages.index', ['id_user' => Auth::user()->id_user]) }}"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                                <h3 class="font-family font-semibold ml-4">Chat</h3>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center px-4 py-3 text-red-500 hover:bg-red-200 transition w-full text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="red" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>
                                    <h3 class="font-family font-semibold ml-4 text-red-500">Logout</h3>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Button Login dan Register -->
                    <button id="user-popup-btn-mobile"
                        class="md:hidden font-semibold font-family px-2 py-2 rounded-lg bg-green-100">
                        <h3 class="text-xs text-green-500">Log In</h3>
                    </button>

                    <div class="hidden md:block relative">
                        <!-- Button User Menu -->
                        <button id="user-menu-btn"
                            class="flex items-center bg-green-100 md:px-4 md:py-2 hover:bg-green-200 rounded-xl space-x-2 text-gray-800 focus:outline-none">
                            @if (request()->routeIs('login'))
                                <a href="{{ route('index') }}"
                                    class="font-semibold font-family text-sm text-green-500">Kembali ke Home</a>
                            @else
                                <span class="font-semibold font-family text-sm text-green-500">Log In</span>
                            @endif
                        </button>

                        <!-- Dropdown Menu, hanya tampil jika bukan di halaman login -->
                        @unless (request()->routeIs('login'))
                            <div id="user-menu"
                                class="absolute md:mt-8 right-0 mt-2 w-56 bg-white shadow-2xl rounded-xl shadow-lg hidden z-50">
                                <a href="{{ route('register.pelanggan') }}"
                                    class="flex items-center px-4 py-3 text-sm rounded-t-xl text-gray-700 hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <h3 class="font-family font-semibold ml-4">Daftar Pelanggan</h3>
                                </a>
                                <a href="{{ route('register.umkm') }}"
                                    class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                    <h3 class="font-family font-semibold ml-4">Daftar UMKM</h3>
                                </a>
                                <a href="{{ route('login') }}"
                                    class="flex items-center px-4 py-3 bg-green-100 text-sm text-green-500 rounded-b-xl hover:bg-green-200 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    <h3 class="font-family font-semibold ml-4">Login</h3>
                                </a>
                            </div>
                        @endunless
                    </div>

                @endif
            </div>
        </div>
    </nav>

    <!-- Overlay -->
    <div id="overlay" class="hidden"></div>
    <!-- Popup untuk Kondisi Sudah Login -->
    @if (Auth::check())
        <div id="user-popup"
            class="fixed bottom-0 left-0 right-0 bg-white p-6 shadow-lg rounded-t-lg z-50 max-w-full md:max-w-md mx-auto hidden">
            <div class="mt-4 space-y-4">
                <div class="p-3 rounded-lg active:bg-gray-100">
                    <a href="{{ route('history.transaksi') }}" class="flex items-center text-gray-600 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <h3 class="font-family font-semibold">History Transaksi</h3>
                    </a>
                </div>
                <div class="p-3 rounded-lg active:bg-gray-100">
                    <a href="{{ route('pelanggan.messages.index', ['id_user' => Auth::user()->id_user]) }}"
                        class="flex items-center text-gray-600 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        <h3 class="font-family font-semibold">Chat</h3>
                    </a>
                </div>
                <div class="bg-red-100 p-3 rounded-lg active:bg-red-200">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center text-red-600 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="red" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            <h3 class="font-family font-semibold">Log Out</h3>
                        </button>
                    </form>
                </div>
            </div>
            <button id="close-popup"
                class="mt-4 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md w-full">
                Close
            </button>
        </div>
    @else
        <!-- Popup untuk Kondisi Belum Login -->
        <div id="user-popup-guest"
            class="fixed bottom-0 left-0 right-0 bg-white p-6 shadow-lg rounded-t-lg z-50 max-w-full md:max-w-md mx-auto hidden">
            <div class="mt-4 space-y-4">
                <div class="p-3 rounded-lg active:bg-gray-100">
                    <a href="{{ route('register.pelanggan') }}" class="flex items-center text-gray-600 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <h3 class="font-family font-semibold">Daftar Pelanggan</h3>
                    </a>
                </div>
                <div class="p-3 rounded-lg active:bg-gray-100">
                    <a href="{{ route('register.umkm') }}" class="flex items-center text-gray-600 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <h3 class="font-family font-semibold">Daftar UMKM</h3>
                    </a>
                </div>
                <div class="p-3 rounded-lg active:bg-green-200 bg-green-100">
                    <a href="{{ route('login') }}" class="flex items-center text-green-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        <h3 class="font-family font-semibold">Login</h3>
                    </a>
                </div>
            </div>
            <button id="close-popup-guest"
                class="mt-4 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md w-full">
                Close
            </button>
        </div>
    @endif
    </div>

    <!-- Include Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        // Referensi Elemen
        const overlay = document.getElementById("overlay");
        const userPopup = document.getElementById("user-popup"); // Popup untuk sudah login
        const userPopupGuest = document.getElementById("user-popup-guest"); // Popup untuk belum login
        const userMenuBtn = document.getElementById("user-menu-btn");
        const userMenu = document.getElementById("user-menu");
        const openPopupBtns = document.querySelectorAll("#user-popup-btn-mobile");
        const closePopupBtn = document.getElementById("close-popup");
        const closePopupGuestBtn = document.getElementById("close-popup-guest");

        // Dropdown Menu untuk Desktop
        if (userMenuBtn) {
            userMenuBtn.addEventListener("click", () => {
                userMenu.classList.toggle("hidden"); // Tampilkan/sembunyikan dropdown
            });
        }

        // Tutup dropdown menu jika klik di luar elemen menu
        document.addEventListener("click", (event) => {
            if (userMenu && !userMenu.contains(event.target) && !userMenuBtn.contains(event.target)) {
                userMenu.classList.add("hidden"); // Sembunyikan dropdown
            }
        });

        // Membuka popup sesuai kondisi login
        if (openPopupBtns) {
            openPopupBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    if (userPopup) {
                        userPopup.style.display = "block"; // Pastikan elemen terlihat
                        setTimeout(() => {
                            userPopup.classList.add(
                                "active"); // Tambahkan kelas setelah elemen tampil
                        }, 10); // Beri jeda kecil agar transisi berjalan
                    } else if (userPopupGuest) {
                        userPopupGuest.style.display = "block";
                        setTimeout(() => {
                            userPopupGuest.classList.add("active");
                        }, 10);
                    }
                    if (overlay) {
                        overlay.style.display = "block";
                        setTimeout(() => {
                            overlay.classList.add("active");
                        }, 10);
                    }
                });
            });
        }

        // Menutup popup untuk sudah login
        if (closePopupBtn) {
            closePopupBtn.addEventListener("click", () => {
                if (userPopup) {
                    userPopup.classList.remove("active"); // Hapus kelas active
                    setTimeout(() => {
                        userPopup.style.display = "none"; // Sembunyikan elemen setelah transisi
                    }, 300); // Sesuaikan durasi dengan CSS transition
                }
                if (overlay) {
                    overlay.classList.remove("active");
                    setTimeout(() => {
                        overlay.style.display = "none";
                    }, 300);
                }
            });
        }

        // Menutup popup untuk belum login
        if (closePopupGuestBtn) {
            closePopupGuestBtn.addEventListener("click", () => {
                if (userPopupGuest) {
                    userPopupGuest.classList.remove("active");
                    setTimeout(() => {
                        userPopupGuest.style.display = "none";
                    }, 300);
                }
                if (overlay) {
                    overlay.classList.remove("active");
                    setTimeout(() => {
                        overlay.style.display = "none";
                    }, 300);
                }
            });
        }

        // Menutup popup ketika overlay diklik
        if (overlay) {
            overlay.addEventListener("click", () => {
                if (userPopup) {
                    userPopup.classList.remove("active");
                    setTimeout(() => {
                        userPopup.style.display = "none";
                    }, 300);
                }
                if (userPopupGuest) {
                    userPopupGuest.classList.remove("active");
                    setTimeout(() => {
                        userPopupGuest.style.display = "none";
                    }, 300);
                }
                overlay.classList.remove("active");
                setTimeout(() => {
                    overlay.style.display = "none";
                }, 300);
            });
        }

        // Inisialisasi Swiper.js
        // const swiper = new Swiper(".mySwiper", {
        //     loop: true, // Mengaktifkan loop pada slider
        //     speed: 800, // Kecepatan transisi
        //     pagination: {
        //         el: ".swiper-pagination", // Elemen untuk pagination
        //         clickable: true, // Pagination dapat diklik
        //     },
        //     grabCursor: true, // Mengaktifkan kursor grab
        // });
    </script>
    @yield('navbar')
</body>

</html>
