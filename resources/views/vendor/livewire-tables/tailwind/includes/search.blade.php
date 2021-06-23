@if ($showSearch)
    <div class="flex rounded-md shadow-sm">
        <input wire:model{{ $this->searchFilterOptions }}="filters.search" placeholder="{{ __('Search') }}"
            type="text"
            class="flex-1 w-full px-2 text-sm text-gray-700 placeholder-gray-600 bg-white border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-red-300 focus:outline-none focus:shadow-outline-red form-input" />
    </div>
@endif
