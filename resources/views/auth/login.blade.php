
<x-guest-layout>

    <div class="w-full">

        {{-- Encabezado --}}
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center w-16 h-16 rounded-2xl bg-[#172b4d] shadow-lg mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-9 h-9 text-[#d9a441]"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.7">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 7v14m0-14C10.5 5.5 8.5 5 5 5v14c3.5 0 5.5.5 7 2m0-14c1.5-1.5 3.5-2 7-2v14c-3.5 0-5.5.5-7 2"/>
                </svg>
            </div>

            <h1 class="text-3xl font-extrabold text-[#172b4d]">
                Bienvenido a LibreApp
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Tu biblioteca virtual, siempre a tu alcance.
            </p>
        </div>

        {{-- Mensaje de sesión --}}
        <x-auth-session-status
            class="mb-5"
            :status="session('status')"
        />

        {{-- Formulario de inicio de sesión --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Correo electrónico --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-[#172b4d] mb-2">
                    Correo electrónico
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="ejemplo@correo.com"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-[#294c72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#294c72]/20"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Contraseña --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-[#172b4d] mb-2">
                    Contraseña
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Ingresa tu contraseña"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-[#294c72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#294c72]/20"
                >

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                {{-- Recuperar contraseña --}}
                @if (Route::has('password.request'))
                    <div class="flex justify-end mt-3">
                        <a href="{{ route('password.request') }}"
                           class="text-sm font-semibold text-[#294c72] hover:text-[#d9a441] hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif
            </div>

            {{-- Recordarme --}}
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-[#294c72] shadow-sm focus:ring-[#294c72]"
                    >

                    <span class="text-sm text-gray-600">
                        Recordarme
                    </span>
                </label>
            </div>

            {{-- Botón de inicio de sesión --}}
            <button
                type="submit"
                style="
                    display: block;
                    width: 100%;
                    padding: 16px;
                    background-color: #172b4d;
                    color: #ffffff !important;
                    border: none;
                    border-radius: 12px;
                    font-size: 16px;
                    font-weight: 700;
                    text-align: center;
                    cursor: pointer;
                    margin-top: 20px;
                    opacity: 1;
                    visibility: visible;
                "
            >
                <span style="color: #ffffff !important;">
                    Iniciar sesión
                </span>
            </button>

        </form>

        {{-- Enlace de registro --}}
        <div class="mt-7 border-t border-gray-200 pt-6 text-center">
            <p class="text-sm text-gray-500">
                ¿Todavía no tienes una cuenta?
            </p>

            <a
                href="{{ route('register') }}"
                class="mt-2 inline-block font-bold text-[#294c72] transition hover:text-[#d9a441]"
            >
                Crear una cuenta
            </a>
        </div>

        {{-- Pie de página --}}
        <p class="mt-8 text-center text-xs text-gray-400">
            © {{ date('Y') }} LibreApp Biblioteca Virtual.
            Todos los derechos reservados.
        </p>

    </div>

</x-guest-layout>
