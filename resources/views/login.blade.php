@extends('navbar')
@section('navbar')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                background: url("{{ asset('img/background.jpg') }}") no-repeat center center fixed;
                background-size: cover;
                font-family: "Arial", sans-serif;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            nav {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 50;
                background-color: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .content-wrapper {
                margin-top: 80px;
                /* Tambahkan margin agar konten tidak tertutup navbar */
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                flex: 1;
            }

            .card {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 12px;
                overflow: hidden;
                background: white;
            }

            @media (max-width: 768px) {
                body {
                    background-color: #f5f5f5;
                    background: none;
                }

                .card {
                    max-width: 100%;
                    margin: 0 16px;
                    box-shadow: none;
                }

                nav {
                    display: none !important;
                }

                .mobile-logo {
                    display: none;
                    position: fixed;
                    top: 10px;
                    right: 10px;
                    z-index: 60;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    background-color: rgba(255, 255, 255, 0.9);
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                }

                .mobile-logo svg {
                    width: 20px;
                    height: 20px;
                    fill: #ff0000;
                }
            }

            .popup {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 400px;
                background-color: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border-radius: 12px;
                padding: 20px;
                display: none;
                z-index: 20;
            }

            .popup.active,
            .overlay.active {
                display: block;
            }

            .popup h3 {
                font-size: 1.25rem;
                margin-bottom: 10px;
            }

            .popup p {
                font-size: 0.875rem;
                margin-bottom: 20px;
                color: #666;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(150, 150, 150, 0.5);
                z-index: 20;
            }

            .popup-buttons {
                display: flex;
                justify-content: space-between;
            }

            .popup-buttons button {
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                font-size: 0.875rem;
                cursor: pointer;
            }

            .popup-buttons .btn-confirm {
                background-color: #16a34a;
                color: white;
            }

            .popup-buttons .btn-cancel {
                background-color: #d1fae5;
                color: #065f46;
            }
        </style>
    </head>

    <body>
        <div id="overlay-login" class="overlay"></div>

        <div class="mobile-logo md:hidden" id="close-btn-login">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <!-- Popup -->
        <div id="popup-login" class="popup">
            <h3>Yakin mau ninggalin ini?</h3>
            <p>Ngasih tau aja. Kalau pergi, kamu harus ulangi proses masuk dari awal.</p>
            <div class="popup-buttons">
                <button class="btn-confirm bg-green-500 text-white px-4 py-2 rounded-lg" id="confirm-exit-login">Iya,
                    keluar</button>
                <button class="btn-cancel bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" id="cancel-exit-login">Gak
                    jadi</button>
            </div>
        </div>

        <!-- Kontainer Utama -->
        <div class="content-wrapper mt-0 md:mt-6">
            <div class="card max-w-md w-full">
                <!-- Header -->
                <div class="card-header text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="mx-auto mt-6" style="height: 80px" />
                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        Selamat datang di Laris Manis!
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Aplikasi serba praktis yang siap membantu kebutuhanmu.
                    </p>
                </div>


                <!-- Formulir Login -->
                <form action="{{ route('login.submit') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Input Username -->
                    <div class="mb-4 mt-2">
                        <label for="username" class="block text-sm font-bold text-gray-700">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                    </div>

                    <!-- Input Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-2 rounded-lg font-semibold text-center hover:bg-green-600 transition mt-6">
                        Masuk
                    </button>
                </form>

                <!-- Footer -->
                <div class="text-center p-6">
                    <p class="text-sm text-gray-500">Belum punya akun?
                        <a href="{{ route('register.umkm') }}" class="text-green-600 font-semibold hover:underline">Daftar
                            UMKM</a> atau
                        <a href="{{ route('register.pelanggan') }}"
                            class="text-green-600 font-semibold hover:underline">Daftar
                            Customer</a> .
                    </p>
                </div>
            </div>
        </div>

        <script>
            const overlayLogin = document.getElementById("overlay-login");
            const closeBtnLogin = document.getElementById("close-btn-login");
            const popupLogin = document.getElementById("popup-login");
            const cancelExitLogin = document.getElementById("cancel-exit-login");
            const confirmExitLogin = document.getElementById("confirm-exit-login");

            closeBtnLogin.addEventListener("click", () => {
                popupLogin.classList.add("active"); // Show popup
                overlayLogin.classList.add("active");
            });

            cancelExitLogin.addEventListener("click", () => {
                popupLogin.classList.remove("active"); // Hide popup
                overlayLogin.classList.remove("active"); // Remove overlay
            });

            confirmExitLogin.addEventListener("click", () => {
                window.location.href = "{{ route('index') }}"; // Replace with your destination URL
            });

            overlayLogin.addEventListener("click", () => {
                popupLogin.classList.remove("active");
                overlayLogin.classList.remove("active"); // Remove overlay
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>

    </html>
@endsection
