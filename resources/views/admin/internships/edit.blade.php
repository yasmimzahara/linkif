<x-app-layout>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">

            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">

                <div class="mb-4">
                    <h1 class="text-3xl font-bold">{{ __('Editar Vaga') }}</h1>
                </div>

                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="post" action="{{ route('admin.internships.update', $internship->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="requirements">
                                {{ __('Requisitos') }}
                            </label>

                            <textarea class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="requirements" >{{ old('requirements', $internship->requirements) }}</textarea>
                            @error('requirements')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="integration_agency">
                                {{ __('Agência Integradora') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="integration_agency" value="{{old('integration_agency', $internship->integration_agency)}}">
                            @error('integration_agency')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <select name="course_id">
                                <option>{{ __('Selecionar Curso') }}</option>
                                @foreach($courses as $id => $name)
                                <option value="{{ $id }}" @if($internship->course_id == $id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="title">
                                {{ __('Título') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="title" value="{{old('title', $internship->title)}}">
                            @error('title')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="workload">
                                {{ __('Carga de Trabalho') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" step="1" min="1" max="40" name="workload" value="{{old('workload', $internship->workload)}}">
                            @error('workload')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <select name="shift">
                                <option>{{ __('Selecionar Turno') }}</option>
                                <option value="morning" @if($internship->shift == 'morning') selected @endif>{{ __('Manhã') }}</option>
                                <option value="afternoon" @if($internship->shift == 'afternoon') selected @endif>{{ __('Tarde') }}</option>
                                <option value="night" @if($internship->shift == 'night') selected @endif>{{ __('Noite') }}</option>
                            </select>
                            @error('shift')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="description">
                                {{ __('Descrição') }}
                            </label>

                            <textarea class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="description" >{{ old('description', $internship->description) }}</textarea>
                            @error('description')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="wage">
                                {{ __('Salário') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" step="0.01" min="1" name="wage" value="{{old('wage', $internship->wage)}}">
                            @error('wage')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[street]">
                                    {{ __('Rua') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[street]" value="{{old('address.street', $internship->address->street)}}">
                                @error('address[street]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[number]">
                                    {{ __('Número') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[number]" value="{{old('address.number', $internship->address->number)}}">
                                @error('address[number]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[zip_code]">
                                    {{ __('CEP') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[zip_code]" value="{{old('address.zip_code', $internship->address->zip_code)}}">
                                @error('address[zip_code]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[neighborhood]">
                                    {{ __('Bairro') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[neighborhood]" value="{{old('address.neighborhood', $internship->address->neighborhood)}}">
                                @error('address[neighborhood]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[city]">
                                    {{ __('Cidade') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[city]" value="{{old('address.city', $internship->address->city)}}">
                                @error('address[city]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[state]">
                                    {{ __('Estado') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[state]" value="{{old('address.state', $internship->address->state)}}">
                                @error('address[state]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="address[country]">
                                    {{ __('País') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address[country]" value="{{old('address.country', $internship->address->country)}}">
                                @error('address[country]')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <select name="company_id">
                                <option>{{ __('Selecionar Empresa') }}</option>
                                @foreach($companies as $id => $name)
                                <option value="{{ $id }}" @if($internship->company_id == $id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="expires_at">
                                {{ __('Prazo') }}
                            </label>

                            <div class="flex">
                                <input class="block w-1/2 m-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="date" name="expires_at_date" value="{{old('expires_at_date', $internship->expires_at_date)}}">
                                <input class="block w-1/2 m-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="time" name="expires_at_time" value="{{old('expires_at_time', $internship->expires_at_time)}}">
                            </div>
                            @error('expires_at_date')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                            @error('expires_at_time')
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
