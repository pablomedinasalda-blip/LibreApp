<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #172b4d; color: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                ✍️
            </div>

            <div>
                <h2 style="font-size: 25px; font-weight: 800; color: #172b4d; margin: 0;">
                    Detalles del autor
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Consulta la información completa del autor.
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 30px; max-width: 950px; margin: 0 auto;">

        <div style="background: #ffffff; border-radius: 18px; padding: 32px; box-shadow: 0 8px 25px rgba(23, 43, 77, 0.08); border: 1px solid #e5eaf1;">

            <div style="display: flex; align-items: center; gap: 18px; border-bottom: 2px solid #f0f2f5; padding-bottom: 22px; margin-bottom: 25px;">

                <div style="width: 65px; height: 65px; flex-shrink: 0; background: #172b4d; color: #d9a441; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 30px;">
                    ✍️
                </div>

                <div>
                    <h3 style="font-size: 21px; font-weight: 800; color: #172b4d; margin: 0;">
                        Información del autor
                    </h3>
                    <p style="font-size: 13px; color: #64748b; margin-top: 5px;">
                        Ficha de registro del autor en LibreApp.
                    </p>
                </div>

            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px;">

                <div style="background: #f4f6fa; padding: 18px; border-radius: 12px; border: 1px solid #e5eaf1;">
                    <p style="font-size: 12px; color: #64748b; font-weight: 700; margin: 0 0 8px;">
                        ID DEL AUTOR
                    </p>
                    <p style="font-size: 17px; color: #172b4d; font-weight: 800; margin: 0;">
                        #{{ $author->id }}
                    </p>
                </div>

                <div style="background: #f4f6fa; padding: 18px; border-radius: 12px; border: 1px solid #e5eaf1;">
                    <p style="font-size: 12px; color: #64748b; font-weight: 700; margin: 0 0 8px;">
                        NOMBRE
                    </p>
                    <p style="font-size: 17px; color: #172b4d; font-weight: 800; margin: 0;">
                        {{ $author->name }}
                    </p>
                </div>

                <div style="background: #f4f6fa; padding: 18px; border-radius: 12px; border: 1px solid #e5eaf1;">
                    <p style="font-size: 12px; color: #64748b; font-weight: 700; margin: 0 0 8px;">
                        NACIONALIDAD
                    </p>
                    <p style="font-size: 15px; color: #172b4d; font-weight: 600; margin: 0;">
                        {{ $author->nationality ?? 'No especificada' }}
                    </p>
                </div>

                <div style="background: #f4f6fa; padding: 18px; border-radius: 12px; border: 1px solid #e5eaf1;">
                    <p style="font-size: 12px; color: #64748b; font-weight: 700; margin: 0 0 8px;">
                        FECHA DE CREACIÓN
                    </p>
                    <p style="font-size: 15px; color: #172b4d; font-weight: 600; margin: 0;">
                        {{ $author->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>

            </div>

            <div style="margin-top: 22px; background: #fffaf0; padding: 20px; border-radius: 12px; border: 1px solid #f3dfb2;">

                <h4 style="font-size: 14px; color: #172b4d; font-weight: 800; margin: 0 0 12px;">
                    Biografía
                </h4>

                <p style="font-size: 14px; color: #475569; line-height: 1.8; margin: 0; white-space: pre-line;">
                    {{ $author->bio ?? 'Sin biografía registrada' }}
                </p>

            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; border-top: 1px solid #e5eaf1; padding-top: 22px;">

                <a
                    href="{{ route('authors.edit', $author) }}"
                    style="background: #172b4d; color: #ffffff; padding: 13px 23px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
                >
                    Editar autor
                </a>

                <a
                    href="{{ route('authors.index') }}"
                    style="background: #e8edf4; color: #172b4d; padding: 13px 23px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 700;"
                >
                    Volver
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
