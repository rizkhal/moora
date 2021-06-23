<div x-data="{ show: false, color: 'red', message: '' }"
    x-on:flash.window="show = true; color = $event.detail.color; message = $event.detail.message;">
    <div x-show="show" :class="`text-${color}-700 bg-${color}-100`"
        class="relative py-3 pl-4 mt-3 pr-10 leading-normal rounded-lg" role="alert" style="display: none;">
        <span x-text="message"></span>
        <span @click="show = !show" class="absolute inset-y-0 right-0 flex items-center mr-4">
            <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                <path
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
        </span>
    </div>
</div>
