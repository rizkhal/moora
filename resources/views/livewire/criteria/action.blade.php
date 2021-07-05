<div class="flex items-center space-x-2 text-sm">
    <x-btn-trash :row="$row" />
    <a href="{{ route('criteria.edit', ['id' => $row->id]) }}"
        class="flex items-center bg-yellow-300 text-white justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg dark:text-white focus:outline-none focus:shadow-outline-red"
        aria-label="Edit">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
        </svg>
    </a>
</div>
