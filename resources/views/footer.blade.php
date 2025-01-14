<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <!-- footer -->
    <footer class="w-full bg-[#DC143C] md:p-12 text-white py-4 mt-auto">
        <div class="flex flex-col md:ml-12 items-start px-8">
            <div class="flex items-center mb-3">
                <img src="{{ asset('img/train.png') }}" class="w-8 h-8 mr-2" alt="Logo" />
                <h2 class=" mt-1 ml-2 text-xl font-bold" style="font-family: 'Rubik', sans-serif">
                    Laris Manis
                </h2>
            </div>
            <div class="flex items-center mt-3 justify-center space-x-8 md:mb-8 mb-6">
                <div class="grid grid-cols-2 font-medium md:grid-cols-3 gap-4">
                    <span class="col-span-1">Kebijakan privasi</span>
                    <span class="col-span-1">Syarat dan ketentuan</span>
                    <span class="col-span-1 md:ml-8">Ikuti kami <i class="md:ml-2 fab fa-instagram"></i></span>
                </div>
            </div>
            <div class="text-left text-base md:text-sm mb-5 md:mb-2 md:w-[700px]">
                <span>© 2025 LARIS MANIS | Laris Manis adalah merek milik PT LARD Indonesia
                    Tbk. Terdaftar pada Direktorat Jenderal Kekayaan Intelektual
                    Republik Indonesia.</span>
            </div>
        </div>
    </footer>
</body>

</html>

@yield('footer')
