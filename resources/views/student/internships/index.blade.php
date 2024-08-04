<x-app-layout>
    <div class="container max-w-6xl mx-auto mt-20">
        <div class="mb-4">
            <h1 class="text-3xl font-bold decoration-gray-400">{{  __('Vagas') }}</h1>
            @if (session()->has('message'))
            <div class="p-3 rounded bg-green-500 text-green-100 my-2">
                {{ session('message') }}
            </div>
            @endif

            <form method="GET" action="{{ route('student.internships.index') }}">
                <input placeholder="{{ __('Procurar por vaga') }}" type="text" name="title" value="{{ request()->title }}">
                <input placeholder="{{ __('Procurar por empresa') }}" type="text" name="company_name" value="{{ request()->company_name }}">
                <label>
                    Mostrar apenas minhas vagas
                    <input type="checkbox" value="true" name="my_internships_only" @if(request()->my_internships_only) checked @endif>
                </label>
                <label>
                    Mostrar apenas vagas disponíveis
                    <input type="checkbox" value="true" name="available_only" @if(request()->available_only) checked @endif>
                </label>
                <input type="submit" style="display: none" />
            </form>
        </div>

        @foreach ($internships->chunk(1) as $group)
        <div class="flex mb-4">
            @foreach ($group as $internship)
            <div class="w-full py-10 bg-white shadow rounded">
                <div class="p-4 flex flex-col">
                    <p class="text-gray-400 font-light text-center">{{ $internship->company->name }}</p>
                    <h2 class="text-gray-800 mt-1 text-3xl">{{ $internship->title }}</h2>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Requisitos') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->requirements }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Agência integradora') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->integration_agency }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Carga Horária') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->workload }} {{ __('horas') }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Turno') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ __("internship.$internship->shift") }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Descrição') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $internship->description }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="font-medium leading-6 text-gray-900">{{ __('Salário') }}</dt>
                        <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Number::currency($internship->wage, 'BRL') }}</dd>
                    </div>

                    @if($internship->has_application)
                    <p class="text-gray-800 mt-1">{{ __('Já candidatou-se') }}</p>
                    @elseif($internship->isTooOld())
                    <p class="text-gray-800 mt-1">{{ __('Não é mais possível candidatar-se') }}</p>
                    @else
                    <form action="{{ route('student.internships.apply', $internship->id) }}" method="post" onsubmit="return confirm('{{ __('Tem certeza? (A candidatura é irreversível.)') }}');">
                        @csrf
                        @method('POST')
                        <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50 mt-4 w-100 flex items-center justify-center">
                            {{ __('quero essa vaga') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endforeach

        <div class="py-2">
            {{ $internships->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
