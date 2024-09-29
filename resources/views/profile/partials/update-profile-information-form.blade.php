<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if(\Auth::user()->type == 'company')
        <div>
            <x-input-label for="info.cnpj" :value="'CNPJ'" />
            <x-text-input id="info.cnpj" name="info[cnpj]" type="text" class="mt-1 block w-full" :value="old('info.cnpj', $user->info->cnpj)" autocomplete="info.cnpj" />
            <x-input-error class="mt-2" :messages="$errors->get('info.cnpj')" />
        </div>

        <div>
            <x-input-label for="info.phone" :value="'Telefone'" />
            <x-text-input id="info.phone" name="info[phone]" type="tel" class="mt-1 block w-full" :value="old('info.phone', $user->info->phone)" autocomplete="info.phone" />
            <x-input-error class="mt-2" :messages="$errors->get('info.phone')" />
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
            <div>
                <x-input-label for="info.address.street" :value="'Rua'" />
                <x-text-input id="info.address.street" name="info[address][street]" type="text" class="mt-1 block w-full" :value="old('info.address.street', $user->info->address->street)" autocomplete="info.address.street" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.street')" />
            </div>
            <div>
                <x-input-label for="info.address.number" :value="'Número'" />
                <x-text-input id="info.address.number" name="info[address][number]" type="text" class="mt-1 block w-full" :value="old('info.address.number', $user->info->address->number)" autocomplete="info.address.number" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.number')" />
            </div>
            <div>
                <x-input-label for="info.address.zip_code" :value="'CEP'" />
                <x-text-input id="info.address.zip_code" name="info[address][zip_code]" type="text" class="mt-1 block w-full" :value="old('info.address.zip_code', $user->info->address->zip_code)" autocomplete="info.address.zip_code" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.zip_code')" />
            </div>
            <div>
                <x-input-label for="info.address.neighborhood" :value="'Bairro'" />
                <x-text-input id="info.address.neighborhood" name="info[address][neighborhood]" type="text" class="mt-1 block w-full" :value="old('info.address.neighborhood', $user->info->address->neighborhood)" autocomplete="info.address.neighborhood" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.neighborhood')" />
            </div>
            <div>
                <x-input-label for="info.address.city" :value="'Cidade'" />
                <x-text-input id="info.address.city" name="info[address][city]" type="text" class="mt-1 block w-full" :value="old('info.address.city', $user->info->address->city)" autocomplete="info.address.city" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.city')" />
            </div>
            <div>
                <x-input-label for="info.address.state" :value="'Estado'" />
                <x-text-input id="info.address.state" name="info[address][state]" type="text" class="mt-1 block w-full" :value="old('info.address.state', $user->info->address->state)" autocomplete="info.address.state" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.state')" />
            </div>
            <div>
                <x-input-label for="info.address.country" :value="'País'" />
                <x-text-input id="info.address.country" name="info[address][country]" type="text" class="mt-1 block w-full" :value="old('info.address.country', $user->info->address->country)" autocomplete="info.address.country" />
                <x-input-error class="mt-2" :messages="$errors->get('info.address.country')" />
            </div>
        </div>
        @endif

        @if(\Auth::user()->type == 'student')
        <div>
            <p>Matrícula: {{ \Auth::user()->info->registration_number }}</p>
            <p>Curso: {{ \Auth::user()->info->course->name }}</p>
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
