<div>
    <h1>funciona</h1>
    <form wire:submit="store" wire:key="{{ uniqid() }}">
        <div class="p-5">
            <div class="mb-5 mt-5 text-3xl text-center">
                Editar usuario </div>
            <hr class="mb-5">
            <div class="grid grid-cols-2 gap-3">
                {{-- <div>
                    <x-custom.input wire:model="user.name" id="user.name" label="nombre" type="text" required />
                </div>
                <div>
                    <x-custom.input wire:model="user.phone" id="user.phone" label="Telefono" type="number"
                        maxlength="12" />
                </div>
                <div>
                    <x-custom.input wire:model="user.email" id="user.email" label="Correo" type="email" required />
                </div>
                <div>
                    <x-custom.input wire:model="user.currentPassword" required="{{ $this->user?->id ? 0 : 1 }}"
                        id="user.currentPassword" label="Contraseña" autocomplete="false" type="password" />
                </div> --}}
                <div>
                    {{--  <x-base.form-label for="user.company_id">Empresa *</x-base.form-label>
                    <x-base.tom-select class="w-full" id="user.company_id" wire:model="user.company_id" required>
                        <option value="" selected>Seleccione una empresa</option>
                        @foreach ($this->companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </x-base.tom-select> --}}
                </div>
                <div>
                    {{-- <x-base.form-label for="userRolesName">Roles *</x-base.form-label>
                    <x-base.tom-select class="w-full" id="userRolesName" wire:model="userRolesName" required multiple>
                        <option value="" selected>Seleccione un rol</option>
                        @foreach ($this->roles as $rol)
                            <option value="{{ $rol->name }}">{{ $rol->name }} </option>
                        @endforeach
                    </x-base.tom-select> --}}
                </div>

            </div>
            {{--  @if ($errors->any())
                <div class="mt-3">
                    <x-base.alert type="danger">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-base.alert>
                </div>
            @endif --}}
        </div>
        <x-custom.modal.footer>
            <div class="text-right">
                <x-custom.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                    Cancelar
                </x-custom.button>
                <x-custom.button class="w-24" type="submit" variant="primary">
                    {{-- {{ $user->id ? 'Actualizar' : 'Guardar' }} --}}
                    Guardar
                </x-custom.button>
            </div>
        </x-custom.modal.footer>
    </form>
</div>
