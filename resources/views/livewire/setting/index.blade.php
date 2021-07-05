<div>
    <div class="container px-6 mx-auto grid">
        <div class="flex items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $title }}
            </h2>
        </div>

        <div class="p-1 pb-16 overflow-auto">
            <div class="grid gap-8 mb-8 md:grid-cols-2">
                <div>
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h3 class="mb-3 mt-2 font-semibold dark:text-gray-200">Pengaturan Reqruitment</h3>
                        <form wire:submit.prevent="setupReq">
                            <x-input
                                type="text"
                                name="pas_min"
                                label="Nilai Minimum Kelulusan"
                                wire:model.defer="pas_min"
                                icon="mdi mdi-lightbulb-on-outline"
                            />
                            <x-select
                                name="req_status"
                                wire:model="req_status"
                                label="Status Reqruitment"
                                icon="mdi mdi-lightbulb-on-outline"
                            >
                                @foreach ($status as $i => $item)
                                    <option value="{{ $i }}" {{ $req_status == $i ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </x-select>
                            <div class="px-3 flex justify-start space-x-2">
                                <button
                                    class="px-3 py-2 bg-red-600 rounded-md text-white hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    <span wire:target="setupReq" wire:loading>Loading..</span>
                                    <span wire:target="setupReq" wire:loading.remove>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h3 class="mb-3 mt-2 font-semibold dark:text-gray-200">Pengaturan Email</h3>
                        <form wire:submit.prevent="setupMail">
                            <div class="flex flex-col items-center w-full">
                                <x-input
                                    type="text"
                                    name="mail_encryption"
                                    label="Email Encryption"
                                    wire:model.defer="mail_encryption"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    name="mail_driver"
                                    label="Email Driver"
                                    wire:model.defer="mail_driver"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    name="mail_host"
                                    label="Email Host"
                                    wire:model.defer="mail_host"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    name="mail_port"
                                    label="Email Port"
                                    wire:model.defer="mail_port"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    name="mail_username"
                                    label="Email Username"
                                    wire:model.defer="mail_username"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    name="mail_password"
                                    label="Email Password"
                                    wire:model.defer="mail_password"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    label="Email From Name"
                                    wire:model.defer="mail_from_name"
                                    name="mail_from_name"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    name="mail_from_address"
                                    label="Email From Address"
                                    wire:model.defer="mail_from_address"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                            </div>

                            <div class="px-3 flex justify-start space-x-2">
                                <button
                                    class="px-3 py-2 bg-red-600 rounded-md text-white hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    <span wire:target="setupMail" wire:loading>Loading..</span>
                                    <span wire:target="setupMail" wire:loading.remove>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h3 class="mb-3 mt-2 font-semibold dark:text-gray-200">Pengaturan Situs</h3>
                        <form wire:submit.prevent="setupSite">
                            <div class="flex flex-col items-center w-full">
                                <x-input
                                    label="Nama Situs"
                                    wire:model.defer="site_name"
                                    type="text" name="site_name"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-textarea
                                    label="Keterangan Situs"
                                    name="site_description"
                                    value="{{ $site_description }}"
                                    wire:model.defer="site_description">
                                </x-textarea>

                                <x-input
                                    type="text"
                                    label="Title Landing Page"
                                    wire:model.defer="site_landing_title"
                                    name="site_description" icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-textarea
                                    label="Keterangan Landing Page"
                                    name="site_landing_description"
                                    value="{{ $site_landing_description }}"
                                    wire:model.defer="site_landing_description">
                                </x-textarea>
                                <x-input
                                    type="file"
                                    name="site_logo"
                                    label="Logo Situs"
                                    wire:model.defer="site_logo"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                                <x-input
                                    type="text"
                                    label="Logo Text"
                                    wire:model.defer="site_logo_text"
                                    name="site_description"
                                    icon="mdi mdi-lightbulb-on-outline"
                                />
                            </div>

                            <div class="flex justify-start mb-8 ml-3">
                                <img class="w-28"
                                    src="{{ is_object($site_logo) ? $site_logo->temporaryUrl() : $site_logo }}"
                                    alt="{{ $site_logo_text }}">
                            </div>

                            <div class="px-3 flex justify-start space-x-2">
                                <button
                                    class="px-3 py-2 bg-red-600 rounded-md text-white hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    <span wire:target="save" wire:loading>Loading..</span>
                                    <span wire:target="save" wire:loading.remove>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
