<x-app-layout>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="mb-4">
                    <h1 class="text-3xl font-bold">{{ $internship->title }}</h1>

                    <div class="px-4 py-6 sm:px-0">
                        <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('company.internships.index') }}">Voltar</a>
                        <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('company.internships.edit', $internship->id) }}">Editar</a>
                    </div>

                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Requisitos</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->requirements }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Agência integradora</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->integration_agency }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Carga Horária</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->workload }} horas</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Turno</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ __("internship.$internship->shift") }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Descrição</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->description }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Salário</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Number::currency($internship->wage, 'BRL') }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Curso</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->course->name }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Prazo</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->expires_at->isoFormat('LLLL') }} ({{ $internship->expires_at->diffForHumans() }})</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">Endereço</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->address->formatted() }}</dd>
                    </div>

                    <h2 class="text-2xl font-bold">Candidatos</h2>

                    @if($applications->count())
                    <form method="GET" action="{{ route('company.internships.show', $internship->id) }}">
                        <input placeholder="Procurar" type="text" name="student_name" value="{{ request()->student_name }}">
                    </form>

                    <div class="py-5">
                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Nome
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Candidatou-se em
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    @foreach ($applications as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                {{ $application->student->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                            <span> {{ $application->created_at->isoFormat("LLLL") }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="py-2">
                            {{ $applications->appends(request()->input())->links() }}
                        </div>
                    </div>
                    @else
                        A vaga ainda não tem nenhum candidato
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

