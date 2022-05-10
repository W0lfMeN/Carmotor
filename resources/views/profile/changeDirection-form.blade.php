<x-jet-form-section submit="updateProfileAddressInformation">
    <x-slot name="title">
        {{ __('Update Direction') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change your direction') }}
        <br>
        <p class="font-bold text-lg">Direccion Actual: {{$this->user->direccion}}</p>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="calle" value="{{ __('Street') }}" />
            <x-jet-input id="calle" type="text" class="mt-1 block w-full" wire:model.defer="state.calle" autocomplete="calle" aria-placeholder="Calle" placeholder="Calle, Nº" />
            <x-jet-input-error for="calle" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cp" value="{{ __('CP') }}" />
            <x-jet-input id="cp" type="text" class="mt-1 block w-full" wire:model.defer="state.cp" autocomplete="cp" aria-placeholder="Codigo postal" placeholder="Codigo Postal" />
            <x-jet-input-error for="cp" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="ciudad" value="{{ __('City') }}" />
            <x-jet-input id="ciudad" type="text" class="mt-1 block w-full" wire:model.defer="state.ciudad" autocomplete="ciudad" aria-placeholder="Ciudad" placeholder="Ciudad"/>
            <x-jet-input-error for="ciudad" class="mt-2" />
        </div>


    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
