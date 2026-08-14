<x-layouts.auth title="Iniciar sesión | EcoEntrega">
    <section class="card">
        <div class="eyebrow">Bienvenido de nuevo</div>
        <h1>Inicia sesión</h1>
        <p>Accede a tu cuenta para seguir descubriendo moda circular.</p>
        @if ($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="field"><label for="email">Correo electrónico</label><input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus></div>
            <div class="field"><label for="password">Contraseña</label><input id="password" name="password" type="password" required></div>
            <label class="check"><input name="remember" type="checkbox"> Recordarme</label>
            <button class="btn" type="submit">Iniciar sesión</button>
        </form>
        <p class="foot">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
    </section>
</x-layouts.auth>
