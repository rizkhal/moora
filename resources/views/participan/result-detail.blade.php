@extends('layouts.app')

@section('content')
    @php
    $decode = json_decode($calculated->data);
    @endphp
    <div class="container px-6 mx-auto grid">
        <div class="flex items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $title }} <span class="capitalize">{{ $calculated->name }}</span> Tanggal
                {{ format_date($calculated->created_at) }}
            </h2>
        </div>
        <div class="p-1 pb-6 overflow-auto">
            <h2 class="font-semibold mb-3 dark:text-gray-200">Tabel Divider</h2>
            <div class="mb-8 align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            @foreach ($criterias as $key => $item)
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $item->name }} ({{ $item->code }})
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            @foreach ($criterias as $key => $item)
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $decode->devider[$key] }}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="font-semibold mb-3 dark:text-gray-200">Tabel Normalisasi</h2>
            <div class="mb-8 align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Alternatif
                            </th>
                            @foreach ($criterias as $key => $item)
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $item->name }} ({{ $item->code }})
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $i => $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $user->name }}
                                </td>
                                @foreach ($decode->normalize as $j => $n)
                                    @php
                                        $normalize = (array) $n;
                                    @endphp
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ $normalize[$user->id] }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="font-semibold mb-3 dark:text-gray-200">Tabel Optimasi</h2>
            <div class="mb-8 align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Alternatif
                            </th>
                            @foreach ($criterias as $key => $item)
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $item->name }} ({{ $item->code }})
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $i => $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $user->name }}
                                </td>
                                @foreach ($decode->optimized as $j => $n)
                                    @php
                                        $optimized = (array) $n;
                                    @endphp
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ $optimized[$user->id] }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="font-semibold mb-3 dark:text-gray-200">Tabel Hasil</h2>
            <div class="mb-8 align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Alternatif
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Nilai Maximize
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Nilai Minimize
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Nilai Yi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $i => $user)
                            @php
                                $max = (array) $decode->max;
                                $min = (array) $decode->min;
                                $yi = (array) $decode->yi;
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $max[$user->id] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $min[$user->id] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    {{ $yi[$user->id] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
