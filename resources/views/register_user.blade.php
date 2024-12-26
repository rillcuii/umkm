<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- resources/views/auth/register_pelanggan.blade.php -->

    <form method="POST" action="{{ route('register.pelanggan.submit') }}">
        @csrf
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
            @error('nama_lengkap')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Register as Pelanggan</button>
    </form>

</body>

</html>
