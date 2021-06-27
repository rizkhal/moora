<div>
    @if ($alternative)
        <div class="w-full flex justify-end mb-2">
            <button wire:click.prevent="calculate"
                class="flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md text-white">
                Hitung
            </button>
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        @foreach ($criterias as $item)
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ $item->name }} ({{ $item->code }})
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($alternative as $altKey => $alt)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('img/gamer.png') }}"
                                            alt="User photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">{{ $alt->name }}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">{{ $alt->email }}</div>
                                    </div>
                                </div>
                            </td>
                            @foreach ($criterias as $criteriaKey => $item)
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <div class="flex flex-col items-center justify-center">
                                        <form class="flex">
                                            <input type="number"
                                                wire:model="values.{{ $alt->id }}.{{ $criteriaKey }}"
                                                class="w-10 border border-gray-200 h-8 bg-gray-100 text-center text-sm appearance-none" />
                                        </form>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
