<div>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form wire:submit.prevent="save">
            <div class="flex justify-between items-center w-full">
                <x-input label="Nama Kriteria" wire:model.defer="name" type="text" name="name"
                    icon="mdi mdi-lightbulb-on-outline" />
                <div class="w-full">
                    <x-select label="Attribute" name="attribute" wire:model="attribute"
                        icon="mdi mdi-lightbulb-on-outline">
                        <option value="">Pilih</option>
                        @foreach ($attr as $index => $a)
                            <option value="{{ $index }}">{{ $a }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>

            @foreach ($fields as $key => $list)
                <div class="flex justify-between items-center w-full">
                    <div class="w-full px-3 mb-5">
                        <label class="text-gray-600 text-xs font-semibold px-1">
                            Sub Kriteria
                        </label>
                        <div class="flex">
                            <div
                                class="w-10 mt-2 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                <i class="mdi mdi-lightbulb-on-outline text-gray-400 text-lg"></i>
                            </div>
                            <input wire:model.defer="fields.{{ $key }}" type="text"
                                class="@error('fields.' . $key) border-red-400 @enderror w-full mt-2 -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 dark:border-gray-800 focus:outline-none focus:border-yellow-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        @error("fields.{$key}")
                            <small class="text-red-400">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-full flex justify-between pr-3 items-center">
                        <div class="w-full px-3 mb-5">
                            <label class="text-gray-600 text-xs font-semibold px-1">Value</label>
                            <div class="flex">
                                <div
                                    class="w-10 mt-2 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="mdi mdi-lightbulb-on-outline text-gray-400 text-lg"></i>
                                </div>
                                <input wire:model.defer="values.{{ $key }}" type="text"
                                    class="@error('values.' . $key) border-red-400 @enderror w-full mt-2 -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 dark:border-gray-800 focus:outline-none focus:border-yellow-500 dark:bg-gray-700 dark:text-gray-200">
                            </div>
                            @error("values.{$key}")
                                <small class="text-red-400">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <button type="button" wire:click.prevent="removeField('{{ $key }}')"
                                class="@error('fields.' . $key) -mt-4 @enderror @error('values.' . $key) -mt-4 @enderror p-2 bg-red-600 border-2 border-red-600 rounded-lg text-white text-md mt-3 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-x-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="px-3 flex justify-start space-x-2">
                <button
                    class="px-3 py-2 bg-red-600 rounded-md text-white hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Simpan
                </button>
                <button wire:click.prevent="addField" type="button"
                    class="px-3 py-2 bg-red-600 rounded-md text-white hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Tambah Field
                </button>
            </div>
        </form>
    </div>
</div>
