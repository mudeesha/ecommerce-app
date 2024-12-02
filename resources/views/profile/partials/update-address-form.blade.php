<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Address') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your location informations.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="address_line1" :value="__('Address Line 1')" />
            <x-text-input id="address_line1" name="address_line1" type="text" class="mt-1 block w-full" autocomplete="address_line1" />
            <x-input-error :messages="$errors->updatePassword->get('address_line1')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address_line2" :value="__('Address Line 2')" />
            <x-text-input id="address_line2" name="address_line2" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateAddress->get('address_line2')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address_line3" :value="__('Address Line 3')" />
            <x-text-input id="address_line3" name="address_line3" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateAddress->get('address_line3')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="district" :value="__('District')" />
            <x-text-input id="district" name="udistrict" type="text" class="mt-1 block w-full" autocomplete="district" />
            <x-input-error :messages="$errors->updateAddress->get('district')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="zip_code" :value="__('Postal Code')" />
            <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" autocomplete="zip_code" />
            <x-input-error :messages="$errors->updateAddress->get('zip_code')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'address-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
