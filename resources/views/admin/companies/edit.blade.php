<x-app-layout>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">

            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">

                <div class="mb-4">
                    <h1 class="text-3xl font-bold">{{ __('Editar Empresa') }}</h1>
                </div>

                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="post" action="{{ route('admin.companies.update', $company->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name">
                                {{ __('Nome') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" placeholder="50" value="{{old('name', $company->name)}}">
                            @error('name')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="email">
                                {{ __('E-mail') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" placeholder="255" value="{{old('email', $company->email)}}">
                            @error('email')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="cnpj">
                                {{ __('CNPJ') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[cnpj]" maxlength="14" value="{{old('info.cnpj', $company->info->cnpj)}}">
                            @error('info.cnpj')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="phone">
                                {{ __('Telefone') }}
                            </label>

                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[phone]" maxlength="14" value="{{old('info.phone', $company->info->phone)}}">
                            @error('info.phone')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][street]">
                                    {{ __('Rua') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][street]" placeholder="255" value="{{old('info.address.street', $company->info->address->street)}}">
                                @error('info.address.street')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][number]">
                                    {{ __('Número') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][number]" placeholder="255" value="{{old('info.address.number', $company->info->address->number)}}">
                                @error('info.address.number')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][zip_code]">
                                    {{ __('CEP') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][zip_code]" placeholder="255" value="{{old('info.address.zip_code', $company->info->address->zip_code)}}">
                                @error('info.address.zip_code')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][neighborhood]">
                                    {{ __('Bairro') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][neighborhood]" placeholder="255" value="{{old('info.address.neighborhood', $company->info->address->neighborhood)}}">
                                @error('info.address.neighborhood')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][city]">
                                    {{ __('Cidade') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][city]" placeholder="255" value="{{old('info.address.city', $company->info->address->city)}}">
                                @error('info.address.city')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][state]">
                                    {{ __('Estado') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][state]" placeholder="255" value="{{old('info.address.state', $company->info->address->state)}}">
                                @error('info.address.state')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="info[address][country]">
                                    {{ __('País') }}
                                </label>

                                <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="info[address][country]" placeholder="255" value="{{old('info.address.country', $company->info->address->country)}}">
                                @error('info.address.country')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>