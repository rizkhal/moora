<div class="px-3 mb-5">
    <div class="relative inline-block w-full">
        <label class="text-gray-600 text-xs font-semibold px-1">{{ $label }}</label>
        <div class="flex">
            <div class="w-10 mt-2 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                <i class="mdi {{ $icon }} text-gray-400 text-lg"></i>
            </div>
            <select {{ $attributes->wire('model') }}
                class="@error($name) border-red-400 @enderror -ml-10 pl-10 w-full text-gray-600 bg-white h-11 mt-2 pr-6 appearance-none rounded-lg border-2 border-gray-200 focus:outline-none focus:border-yellow-500 dark:border-gray-800 dark:bg-gray-700">
                {{ $slot }}
            </select>
        </div>
        <div class="absolute inset-y-0 text-gray-400 top-8 right-0 flex items-center px-2 pointer-events-none">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                <path
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
        </div>
        @error($name)
            <small class="text-red-400">{{ $message }}</small>
        @enderror
    </div>
</div>
