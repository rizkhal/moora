@props(['url'])

<div class="w-8">
    <a href="{{ $url }}"
        class="flex items-center justify-center bg-blue-700 text-white px-2 py-2 text-sm font-medium leading-5 rounded-lg dark:text-white focus:outline-none focus:shadow-outline-blue"
        aria-label="Detail">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
    </a>
</div>
