<x-layouts.auth title="Crear cuenta | EcoEntrega">
    <section class="card">
        <div class="eyebrow">Únete a la comunidad</div>
        <h1>Crea tu cuenta</h1>
        <p>Regístrate para comprar y disfrutar de la moda circular.</p>
        @if ($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="field"><label for="name">Nombre completo</label><input id="name" name="name" value="{{ old('name') }}" required autofocus></div>
            <div class="field"><label for="email">Correo electrónico</label><input id="email" name="email" type="email" value="{{ old('email') }}" required></div>
            <div class="field"><label for="phone">Teléfono <small>(opcional)</small></label><input id="phone" name="phone" value="{{ old('phone') }}"></div>
            <div class="field"><label for="address">Dirección <small>(opcional)</small></label><input id="address" name="address" value="{{ old('address') }}"></div>
            <div class="field"><label for="password">Contraseña</label><input id="password" name="password" type="password" required><div class="hint">Mínimo 8 caracteres.</div></div>
            <div class="field"><label for="password_confirmation">Confirmar contraseña</label><input id="password_confirmation" name="password_confirmation" type="password" required></div>
            <button class="btn" type="submit">Crear mi cuenta</button>
        </form>
        <p class="foot">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </section>
</x-layouts.auth>
