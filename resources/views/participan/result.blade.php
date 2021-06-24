@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <div class="flex items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $title }}
            </h2>
        </div>

        <div class="p-1 pb-6 overflow-auto">
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
                                Peserta
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($result as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $item->created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <div class="flex items-center justify-start w-full overflow-x-auto">
                                        @for ($i = 0; $i < 10; $i++)
                                            <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
                                                src="https://randomuser.me/api/portraits/men/1.jpg" />
                                            <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                                src="https://randomuser.me/api/portraits/women/2.jpg" />
                                            <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                                src="https://randomuser.me/api/portraits/men/3.jpg" />
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <x-btn-view url="/"></x-btn-view>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
