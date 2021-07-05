@props(['name', 'label', 'value'])
<div class="w-full px-3 mb-5">
    <label class="text-gray-600 text-xs font-semibold px-1">{{ $label }}</label>
    <textarea {{ $attributes }}
        class="@error($name) border-red-400 @enderror w-full mt-2 p-3 rounded-lg border-2 border-gray-200 dark:border-gray-800 focus:outline-none focus:border-yellow-500 dark:bg-gray-700 dark:text-gray-200"
        {{ $attributes->wire('model') }}>{{$value}}</textarea>
    @error($name)
        <small class="text-red-400">{{ $message }}</small>
    @enderror
</div>
