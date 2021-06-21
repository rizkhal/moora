<div class="w-full px-3 mb-5">
    <label class="text-gray-600 text-xs font-semibold px-1">{{$label}}</label>
    <div class="flex">
        <div class="w-10 mt-2 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
            <i class="{{$icon}} text-gray-400 text-lg"></i>
        </div>
        <input {{$attributes}} type="{{$type}}" class="w-full mt-2 -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-yellow-500" placeholder="{{$placeholder}}" {{$attributes->wire('model')}}>
    </div>
    @error($name)
        <small class="text-red-400">{{$message}}</small>
    @enderror
</div>