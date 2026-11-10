<x-guest-layout>

    <div style="text-align: center; margin-bottom: 28px;">

        <div style="width: 65px; height: 65px; margin: 0 auto 15px; background: #d9a441; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
            🔐
        </div>

        <h2 style="font-size: 25px; font-weight: 700; color: #172b4d; margin: 0;">
            Recuperar contraseña
        </h2>

        <p style="font-size: 14px; color: #64748b; margin-top: 8px;">
            LibreApp Biblioteca Virtual
        </p>

    </div>

    <div style="background: #f4f6fa; border-left: 4px solid #d9a441; border-radius: 8px; padding: 15px; margin-bottom: 24px;">

        <p style="font-size: 14px; color: #475569; line-height: 1.7; margin: 0;">
            ¿Olvidaste tu contraseña? No te preocupes. Introduce tu correo electrónico y te enviaremos un enlace para restablecerla y elegir una nueva.
        </p>

    </div>

    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Correo electrónico -->
        <div style="margin-bottom: 24px;">

            <label for="email" style="display: block; font-size: 14px; font-weight: 600; color: #294c72; margin-bottom: 9px;">
                Correo electrónico
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                placeholder="nombre@ejemplo.com"
                style="width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px; outline: none;"
            >

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- Botón -->
        <div style="margin-top: 25px;">

            <button
                type="submit"
                style="width: 100%; background: #172b4d; color: #ffffff; padding: 14px 20px; border-radius: 9px; border: none; cursor: pointer; font-size: 15px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
            >
                Enviar enlace de recuperación
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
