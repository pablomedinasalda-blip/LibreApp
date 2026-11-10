<x-guest-layout>

    <!-- Encabezado -->
    <div style="text-align: center; margin-bottom: 28px;">

        <div style="width: 65px; height: 65px; margin: 0 auto 15px; background: #d9a441; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
            🔑
        </div>

        <h2 style="font-size: 25px; font-weight: 700; color: #172b4d; margin: 0;">
            Crear nueva contraseña
        </h2>

        <p style="font-size: 14px; color: #64748b; margin-top: 8px;">
            LibreApp Biblioteca Virtual
        </p>

    </div>

    <div style="background: #f4f6fa; border-left: 4px solid #d9a441; border-radius: 8px; padding: 15px; margin-bottom: 24px;">
        <p style="font-size: 14px; color: #475569; line-height: 1.7; margin: 0;">
            Introduce tu correo electrónico y escribe una nueva contraseña para recuperar el acceso a tu cuenta.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token de recuperación -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Correo electrónico -->
        <div style="margin-bottom: 20px;">

            <label for="email" style="display: block; font-size: 14px; font-weight: 600; color: #294c72; margin-bottom: 9px;">
                Correo electrónico
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username"
                style="width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px;"
            >

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- Nueva contraseña -->
        <div style="margin-bottom: 20px;">

            <label for="password" style="display: block; font-size: 14px; font-weight: 600; color: #294c72; margin-bottom: 9px;">
                Nueva contraseña
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Escribe tu nueva contraseña"
                style="width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px;"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- Confirmar contraseña -->
        <div style="margin-bottom: 25px;">

            <label for="password_confirmation" style="display: block; font-size: 14px; font-weight: 600; color: #294c72; margin-bottom: 9px;">
                Confirmar nueva contraseña
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Repite tu nueva contraseña"
                style="width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px;"
            >

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        </div>

        <!-- Botón -->
        <div style="margin-top: 25px;">

            <button
                type="submit"
                style="width: 100%; background: #172b4d; color: #ffffff; padding: 14px 20px; border-radius: 9px; border: none; cursor: pointer; font-size: 15px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
            >
                Restablecer contraseña
            </button>

        </div>

    </form>

    <div style="text-align: center; border-top: 1px solid #e5eaf1; padding-top: 20px; margin-top: 25px;">

        <a
            href="{{ route('login') }}"
            style="color: #294c72; font-size: 14px; font-weight: 600; text-decoration: none;"
        >
            ← Volver al inicio de sesión
        </a>

    </div>

</x-guest-layout>
