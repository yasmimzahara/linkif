<x-app-layout>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="mb-4">
                    <h1 class="text-3xl font-bold">{{ $internship->title }}</h1>

                    <div class="px-4 py-6 sm:px-0">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="{{ route('company.internships.index') }}">{{ __('Voltar') }}</a>
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="{{ route('company.internships.edit', $internship->id) }}">{{ __('Editar') }}</a>
                    </div>

                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Requisitos') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->requirements }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Agência integradora') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->integration_agency }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Carga Horária') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->workload }} {{ __('horas') }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Turno') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ __("internship.$internship->shift") }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Descrição') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->description }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Salário') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Number::currency($internship->wage, 'BRL') }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Curso') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->course->name }}</dd>
                    </div>

                    <h2 class="text-2xl font-bold">{{ __('Candidatos') }}</h2>

                    <form method="GET" action="{{ route('company.internships.show', $internship->id) }}">
                        <input placeholder="{{ __('Procurar') }}" type="text" name="student_name" value="{{ request()->student_name }}">
                    </form>

                    <div class="py-5">
                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            {{ __('Nome') }}
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            {{ __('Candidatou-se em') }}
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

