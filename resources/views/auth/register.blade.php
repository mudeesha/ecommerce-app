<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address_line1" :value="__('Address Line 1')" />
            <x-text-input id="addres_line1" class="block mt-1 w-full" type="text" name="address_line1" :value="old('address_line1')" required autofocus autocomplete="address_line1" />
            <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address_line2" :value="__('Address Line 2')" />
            <x-text-input id="address_line2" class="block mt-1 w-full" type="text" name="address_line2" :value="old('address_line2')" />
            <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address_line3" :value="__('Address Line 3')" />
            <x-text-input id="address_line3" class="block mt-1 w-full" type="text" name="address" :value="old('address_line3')" />
            <x-input-error :messages="$errors->get('address_line3')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="district" :value="__('District')" />
            <x-text-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')" required autofocus autocomplete="district" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('address')" required autofocus autocomplete="postal_code" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
