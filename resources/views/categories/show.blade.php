<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="background: #d9a441; color: #172b4d; width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                📂
            </div>

            <div>
                <h2 style="font-size: 23px; font-weight: 700; color: #172b4d; margin: 0;">
                    Detalles de la categoría
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Consulta la información registrada
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 40px 20px; background: #f4f6fa; min-height: 75vh;">
        <div style="max-width: 760px; margin: 0 auto;">

            <div style="background: #ffffff; border-radius: 18px; padding: 35px; box-shadow: 0 8px 25px rgba(23, 43, 77, 0.08); border: 1px solid #e5eaf1;">

                <div style="border-bottom: 1px solid #e5eaf1; padding-bottom: 20px; margin-bottom: 25px;">
                    <h3 style="font-size: 19px; font-weight: 700; color: #172b4d; margin: 0;">
                        Información de la categoría
                    </h3>
                    <p style="font-size: 14px; color: #64748b; margin: 7px 0 0;">
                        Datos generales de la categoría seleccionada.
                    </p>
                </div>

                <!-- ID -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 16px; background: #f8fafc; border-radius: 10px; margin-bottom: 12px;">
                    <strong style="color: #294c72; font-size: 14px;">ID</strong>
                    <span style="color: #475569; font-size: 14px;">{{ $category->id }}</span>
                </div>

                <!-- Nombre -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 16px; background: #f8fafc; border-radius: 10px; margin-bottom: 12px;">
                    <strong style="color: #294c72; font-size: 14px;">Nombre</strong>
                    <span style="color: #172b4d; font-size: 14px; font-weight: 600;">{{ $category->name }}</span>
                </div>

                <!-- Slug -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 16px; background: #f8fafc; border-radius: 10px; margin-bottom: 12px;">
                    <strong style="color: #294c72; font-size: 14px;">Slug</strong>
                    <span style="color: #475569; font-size: 14px;">{{ $category->slug }}</span>
                </div>

                <!-- Descripción -->
                <div style="padding: 16px; background: #f8fafc; border-radius: 10px; margin-bottom: 12px;">
                    <strong style="display: block; color: #294c72; font-size: 14px; margin-bottom: 10px;">
                        Descripción
                    </strong>
                    <p style="color: #475569; font-size: 14px; line-height: 1.7; margin: 0; overflow-wrap: anywhere;">
                        {{ $category->description ?? 'Sin descripción' }}
                    </p>
                </div>

                <!-- Fecha de creación -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 16px; background: #f8fafc; border-radius: 10px; margin-bottom: 12px;">
                    <strong style="color: #294c72; font-size: 14px;">Fecha de creación</strong>
                    <span style="color: #475569; font-size: 14px;">
                        {{ $category->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>

                <!-- Botones -->
                <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; flex-wrap: wrap; border-top: 1px solid #e5eaf1; padding-top: 22px; margin-top: 25px;">

                    <a
                        href="{{ route('categories.index') }}"
                        style="display: inline-block; background: #e8edf4; color: #294c72; padding: 12px 22px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 600;"
                    >
                        Volver
                    </a>

                    <a
                        href="{{ route('categories.edit', $category) }}"
                        style="display: inline-block; background: #172b4d; color: #ffffff; padding: 12px 24px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 600; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
                    >
                        Editar categoría
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
