<x-guest-layout>

    <!-- Encabezado -->
    <div style="text-align: center; margin-bottom: 28px;">

        <div style="width: 65px; height: 65px; margin: 0 auto 15px; background: #d9a441; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
            🛡
        </div>

        <h2 style="font-size: 25px; font-weight: 700; color: #172b4d; margin: 0;">
            Confirmar contraseña
        </h2>

        <p style="font-size: 14px; color: #64748b; margin-top: 8px;">
            LibreApp Biblioteca Virtual
        </p>

    </div>

    <!-- Información -->
    <div style="background: #f4f6fa; border-left: 4px solid #d9a441; border-radius: 8px; padding: 16px; margin-bottom: 25px;">

        <p style="font-size: 14px; color: #475569; line-height: 1.7; margin: 0;">
            Esta es una zona segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.
        </p>

    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Contraseña -->
        <div style="margin-bottom: 25px;">

            <label for="password" style="display: block; font-size: 14px; font-weight: 600; color: #294c72; margin-bottom: 9px;">
                Contraseña
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Introduce tu contraseña"
                style="width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px;"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- Botón -->
        <div style="margin-top: 25px;">

            <button
                type="submit"
                style="width: 100%; background: #172b4d; color: #ffffff; padding: 14px 20px; border-radius: 9px; border: none; cursor: pointer; font-size: 15px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
            >
                Confirmar contraseña
            </button>

        </div>

    </form>

    <div style="text-align: center; border-top: 1px solid #e5eaf1; padding-top: 20px; margin-top: 25px;">

        <p style="font-size: 12px; color: #94a3b8; margin: 0;">
            LibreApp Biblioteca Virtual · Acceso seguro
        </p>

    </div>

</x-guest-layout>
