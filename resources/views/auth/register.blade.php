
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
                Crear una cuenta
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Únete a LibreApp y descubre un mundo de lectura.
            </p>

        </div>

        {{-- Formulario de registro --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Nombre --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-[#172b4d] mb-2">
                    Nombre completo
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Ingresa tu nombre completo"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-[#294c72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#294c72]/20"
                >

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

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
                    autocomplete="new-password"
                    placeholder="Crea una contraseña"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-[#294c72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#294c72]/20"
                >

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Confirmar contraseña --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#172b4d] mb-2">
                    Confirmar contraseña
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repite tu contraseña"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-[#294c72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#294c72]/20"
                >

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Botón de registro --}}
            <button
                type="submit"
                style="
                    display: block;
                    width: 100%;
                    padding: 15px;
                    background-color: #172b4d;
                    color: #ffffff;
                    border: none;
                    border-radius: 12px;
                    font-size: 15px;
                    font-weight: bold;
                    text-align: center;
                    cursor: pointer;
                    margin-top: 24px;
                "
            >
                Registrarme
            </button>

        </form>

        {{-- Enlace para iniciar sesión --}}
        <div class="mt-7 border-t border-gray-200 pt-6 text-center">

            <p class="text-sm text-gray-500">
                ¿Ya tienes una cuenta?
            </p>

            <a
                href="{{ route('login') }}"
                class="mt-2 inline-block font-bold text-[#294c72] transition hover:text-[#d9a441]"
            >
                Iniciar sesión
            </a>

        </div>

        {{-- Pie de página --}}
        <p class="mt-8 text-center text-xs text-gray-400">
            © {{ date('Y') }} LibreApp Biblioteca Virtual.
            Todos los derechos reservados.
        </p>

    </div>

</x-guest-layout>
