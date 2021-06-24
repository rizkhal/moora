<div class="pb-8">
    <div class="flex justify-center my-6">
        <img src="{{ asset('img/gamer.png') }}" alt="Foto Profil" class="w-44">
    </div>
    <form>
        <div class="flex justify-between">
            <x-input wire:model.defer="nik" type="text" name="nik" icon="mdi mdi-lock-outline" label="Nik" disabled />
            <x-input wire:model.defer="name" type="text" name="name" icon="mdi mdi-account-outline" label="Nama"
                disabled />
        </div>
        <div class="flex justify-between">
            <x-input wire:model.defer="email" type="text" name="email" icon="mdi mdi-email-outline" label="Email"
                disabled />
            <x-input wire:model.defer="phone" type="text" name="phone" icon="mdi mdi-cellphone" label="Nomor Hp"
                disabled />
        </div>
        <div class="flex justify-between">
            <x-input wire:model.defer="gender" type="text" name="gender" icon="mdi mdi-account-outline"
                label="Jenis Kelamin" disabled />
            <x-input wire:model.defer="religion" type="text" name="religion" icon="mdi mdi-lightbulb-on-outline"
                label="Agama" disabled />
        </div>
        <div class="flex justify-between">
            <x-input wire:model.defer="birth_place" type="text" name="birth_place" icon="mdi mdi-lightbulb-on-outline"
                label="Tempat Lahir" disabled />
            <x-input wire:model.defer="birth_date" type="text" name="birth_date" icon="mdi mdi-lightbulb-on-outline"
                label="Tanggal Lahir" disabled />
        </div>
    </form>
    <form wire:submit.prevent="upload">
        @foreach ($criterias as $item)
            <x-input wire:model.defer="{{ strtolower($item->name) }}" type="number" name="{{ strtolower($item->name) }}"
                icon="mdi mdi-lightbulb-on-outline" label="{{ ucfirst($item->name) }}" />
        @endforeach
        <button class="px-3 mx-3 py-2 bg-red-500 text-white rounded-md">
            Upload
        </button>
    </form>
</div>
