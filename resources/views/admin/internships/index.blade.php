<x-app-layout>
    <div class="container max-w-6xl mx-auto mt-20">
        <div class="mb-4">
            <h1 class="text-3xl font-bold decoration-gray-400">{{  __('Vagas') }}</h1>
            @if (session()->has('message'))
            <div class="p-3 rounded bg-green-500 text-green-100 my-2">
                {{ session('message') }}
            </div>
            @endif

            <form method="GET" action="{{ route('admin.internships.index') }}">
                <input placeholder="{{ __('Procurar por vaga') }}" type="text" name="title" value="{{ request()->title }}">
                <input placeholder="{{ __('Procurar por empresa') }}" type="text" name="company_name" value="{{ request()->company_name }}">
                <input type="submit" style="display: none" />
            </form>

            <div class="flex justify-end">
                <a href="{{ route('admin.internships.create')}}" class="px-4 py-2 rounded-md bg-green-600 text-green-100 hover:bg-green-800">
                    {{ __('Criar Vaga') }}
                </a>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    {{ __('Título') }}
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    {{ __('Empresa') }}
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    {{ __('Criado em') }}
                                </th>
                                <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="2">
                                    {{ __('Ações') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach ($internships as $internship)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        {{ $internship->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        {{ $internship->company->name }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    <span> {{ $internship->created_at->isoFormat("LLLL") }}</span>
                                </td>

                                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex">
                                        <a href="{{ route('admin.internships.edit', $internship->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.internships.destroy', $internship->id) }}" method="post" onsubmit="return confirm('{{ __('Tem certeza?') }}');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-6 h-6 text-red-600 hover:text-red-800 cursor-pointer" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="py-2">
            {{ $internships->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
