<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul>
                        <li>
                            <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('admin.admins.index') }}">{{ __('Admins') }}</a>
                        </li>
                        <br>
                        <li>
                            <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('admin.applications.index') }}">{{ __('Candidaturas') }}</a>
                        </li>
                        <br>
                        <li>
                            <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('admin.companies.index') }}">{{ __('Empresas') }}</a>
                        </li>
                        <br>
                        <li>
                            <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('admin.courses.index') }}">{{ __('Cursos') }}</a>
                        </li>
                        <br>
                        <li>
                            <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('admin.internships.index') }}">{{ __('Vagas') }}</a>
                        </li>
                        <br>
                        <li>
                            <a class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full" href="{{ route('admin.students.index') }}">{{ __('Estudantes') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
