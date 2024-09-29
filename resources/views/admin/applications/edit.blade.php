<x-app-layout>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">

            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">

                <div class="mb-4">
                    <h1 class="text-3xl font-bold">{{ __('Editar Candidatura') }}</h1>
                </div>

                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="post" action="{{ route('admin.applications.update', $application->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <select name="student_id">
                                <option>{{ __('Selecionar Estudante') }}</option>
                                @foreach($students as $id => $name)
                                <option value="{{ $id }}" @if($application->student_id == $id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <select name="internship_id">
                                <option>{{ __('Selecionar Vaga') }}</option>
                                @foreach($internships as $id => $title)
                                <option value="{{ $id }}" @if($application->internship_id == $id) selected @endif>{{ $title }}</option>
                                @endforeach
                            </select>
                            @error('internship_id')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>


                        <div class="flex items-center justify-start mt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-green-100 bg-green-600 hover:bg-green-800 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
