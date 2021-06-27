<div>
    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Peserta
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Author
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($calculates as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ format_date($item->created_at, 'd F Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex items-center justify-start w-full overflow-x-auto">
                                @for ($i = 0; $i < 6; $i++)
                                    <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
                                        src="https://randomuser.me/api/portraits/men/{{ $i }}.jpg" />
                                    <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                        src="https://randomuser.me/api/portraits/women/{{ $i }}.jpg" />
                                    <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                        src="https://randomuser.me/api/portraits/men/{{ $i }}.jpg" />
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $item->author->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex space-x-2">
                                <x-btn-view url="{{ route('participan.calculate.detail', ['id' => $item->id]) }}">
                                </x-btn-view>
                                <x-btn-trash :row="$item"></x-btn-trash>
                            </div>
                        </td>
                    </tr>
                @empty

                @endforelse

                {{-- @forelse ($result as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ format_date($item->created_at, 'd F Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex items-center justify-start w-full overflow-x-auto">
                                @for ($i = 0; $i < 6; $i++)
                                    <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
                                        src="https://randomuser.me/api/portraits/men/{{ $i }}.jpg" />
                                    <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                        src="https://randomuser.me/api/portraits/women/{{ $i }}.jpg" />
                                    <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                        src="https://randomuser.me/api/portraits/men/{{ $i }}.jpg" />
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $item->author->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex space-x-2">
                                <x-btn-view url="{{ route('participan.calculate.detail', ['id' => $item->id]) }}">
                                </x-btn-view>
                                <x-btn-trash :row="$item"></x-btn-trash>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td align="center" colspan="3" class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <span class="text-sm">Tidak hasil ditemukan</span>
                        </td>
                    </tr>
                @endforelse --}}
            </tbody>
        </table>
    </div>
    <div x-data="{ open: @entangle('deleteModal') }">
        <x-modal>
            <x-slot name="body">
                <h2 class="text-2xl font-bold mb-2">Yakin ingin menghapus?</h2>
                <p>Data hasil perhitungan ini akan dihapus secara permanen.</p>
            </x-slot>
            <x-slot name="button">
                <button @click="open = false"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Tutup
                </button>
                <button wire:click.prevent="deleteResult"
                    class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-800 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Hapus
                </button>
            </x-slot>
        </x-modal>
    </div>
</div>
