<form action="{{ route('login.submit') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="text" name="username" id="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Login</button>
</form>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
