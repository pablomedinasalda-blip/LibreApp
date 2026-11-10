<x-guest-layout>

    <!-- Encabezado -->
    <div style="text-align: center; margin-bottom: 28px;">

        <div style="width: 65px; height: 65px; margin: 0 auto 15px; background: #d9a441; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 32px;">

        </div>

        <h2 style="font-size: 25px; font-weight: 700; color: #172b4d; margin: 0;">
            Verifica tu correo electrónico
        </h2>

        <p style="font-size: 14px; color: #64748b; margin-top: 8px;">
            LibreApp Biblioteca Virtual
        </p>

    </div>

    <!-- Información -->
    <div style="background: #f4f6fa; border-left: 4px solid #d9a441; border-radius: 8px; padding: 18px; margin-bottom: 24px;">

        <p style="font-size: 14px; color: #475569; line-height: 1.8; margin: 0;">
            ¡Gracias por registrarte en LibreApp! Antes de comenzar, necesitamos que verifiques tu dirección de correo electrónico haciendo clic en el enlace que te enviamos.
        </p>

        <p style="font-size: 14px; color: #475569; line-height: 1.8; margin: 12px 0 0;">
            Si no recibiste el correo, puedes solicitar que te enviemos uno nuevo.
        </p>

    </div>

    <!-- Mensaje de confirmación -->
    @if (session('status') == 'verification-link-sent')
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #047857; border-radius: 9px; padding: 14px; margin-bottom: 22px; font-size: 14px; line-height: 1.6;">
            <strong>¡Correo enviado!</strong>
            Hemos enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.
        </div>
    @endif

    <!-- Acciones -->
    <div style="display: flex; flex-direction: column; gap: 15px; margin-top: 25px;">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button
                type="submit"
                style="width: 100%; background: #172b4d; color: #ffffff; padding: 14px 20px; border-radius: 9px; border: none; cursor: pointer; font-size: 15px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
            >
                Reenviar correo de verificación
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                style="width: 100%; background: #e8edf4; color: #294c72; padding: 13px 20px; border-radius: 9px; border: 1px solid #d5deea; cursor: pointer; font-size: 14px; font-weight: 600;"
            >
                Cerrar sesión
            </button>
        </form>

    </div>

    <div style="text-align: center; border-top: 1px solid #e5eaf1; padding-top: 20px; margin-top: 25px;">
        <p style="font-size: 12px; color: #94a3b8; margin: 0;">
            LibreApp Biblioteca Virtual · Tu biblioteca digital
        </p>
    </div>

</x-guest-layout>
