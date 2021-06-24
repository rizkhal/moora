@if ($paginationEnabled && $showPerPage)
    <div class="w-full md:w-auto ml-0 md:ml-2">
        <select wire:model="perPage" id="perPage"
            style="height: 2.6em;"
            class="rounded-md bg-white shadow-sm block w-full pl-3 pr-18 text-base leading-6 border-gray-300 sm:text-sm sm:leading-5  dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-red-300 focus:outline-none focus:shadow-outline-red">
            @foreach ($perPageAccepted as $item)
                <option value="{{ $item }}">{{ $item === -1 ? __('All') : $item }}</option>
            @endforeach
        </select>
    </div>
@endif
