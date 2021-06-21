@section('title', 'Buat akun baru')

<div>
    <div x-data="{step: @entangle('stepper'), password: @entangle('password'), ...form()}" class="pb-60">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}" class="flex items-center justify-center">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo KPU">
            </a>

            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                Daftarkan diri anda
            </h2>

            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                atau
                <a href="{{ route('login') }}" class="font-medium text-yellow-600 hover:text-yellow-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    masuk ke akun anda
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form wire:submit.prevent="register">
                    <div x-show.transition.in="step === 1">
                        <div class="flex -mx-3">
                            <x-input type="number" name="nik" wire:model.defer="nik" label="Nik" icon="mdi mdi-lock-outline" placeholder="2982729842899" />
                        </div>
                        <div class="flex -mx-3">
                            <x-input type="text" name="name" wire:model.defer="name" label="Nama" icon="mdi mdi-account-outline" placeholder="Ayu Puspita" />
                        </div>
                        <div class="flex -mx-3">
                            <x-input type="email" name="email" wire:model.defer="email" label="Email" icon="mdi mdi-email-outline" placeholder="ayupuspita@domain.com" />
                        </div>
                        <div class="flex -mx-3">
                            <x-input type="number" name="phone" wire:model.defer="phone" label="Nomor Handphone" icon="mdi mdi-cellphone" placeholder="08123456789" />
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-gray-600 text-xs font-semibold px-1">Password</label>
                                <div class="flex relative">
                                    <div class="w-10 mt-2 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input @keydown="checkPasswordStrength" :type="togglePassword ? 'text' : 'password'" class="w-full mt-2 -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-yellow-500" placeholder="{{str_repeat('*', 12)}}" wire:model="password">
                                    <div class="absolute right-0 bottom-0 top-1.5 px-3 py-3 cursor-pointer" 
                                            @click="togglePassword = !togglePassword"
                                        >
                                        <svg :class="{'hidden': !togglePassword, 'block': togglePassword }" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-300" viewBox="0 0 24 24"><path d="M12 19c.946 0 1.81-.103 2.598-.281l-1.757-1.757C12.568 16.983 12.291 17 12 17c-5.351 0-7.424-3.846-7.926-5 .204-.47.674-1.381 1.508-2.297L4.184 8.305c-1.538 1.667-2.121 3.346-2.132 3.379-.069.205-.069.428 0 .633C2.073 12.383 4.367 19 12 19zM12 5c-1.837 0-3.346.396-4.604.981L3.707 2.293 2.293 3.707l18 18 1.414-1.414-3.319-3.319c2.614-1.951 3.547-4.615 3.561-4.657.069-.205.069-.428 0-.633C21.927 11.617 19.633 5 12 5zM16.972 15.558l-2.28-2.28C14.882 12.888 15 12.459 15 12c0-1.641-1.359-3-3-3-.459 0-.888.118-1.277.309L8.915 7.501C9.796 7.193 10.814 7 12 7c5.351 0 7.424 3.846 7.926 5C19.624 12.692 18.76 14.342 16.972 15.558z"/></svg>
                                        <svg :class="{'hidden': togglePassword, 'block': !togglePassword }" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-300" viewBox="0 0 24 24"><path d="M12,9c-1.642,0-3,1.359-3,3c0,1.642,1.358,3,3,3c1.641,0,3-1.358,3-3C15,10.359,13.641,9,12,9z"/><path d="M12,5c-7.633,0-9.927,6.617-9.948,6.684L1.946,12l0.105,0.316C2.073,12.383,4.367,19,12,19s9.927-6.617,9.948-6.684 L22.054,12l-0.105-0.316C21.927,11.617,19.633,5,12,5z M12,17c-5.351,0-7.424-3.846-7.926-5C4.578,10.842,6.652,7,12,7 c5.351,0,7.424,3.846,7.926,5C19.422,13.158,17.348,17,12,17z"/></svg>
                                    </div>
                                </div>
                            @error('password')
                                <small class="text-red-400">{{$message}}</small>
                            @enderror
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-gray-600 text-xs font-semibold px-1">Password</label>
                                <div class="flex relative">
                                    <div class="w-10 mt-2 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input :type="togglePasswordConfirmation ? 'text' : 'password'" class="w-full mt-2 -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-yellow-500" placeholder="{{str_repeat('*', 12)}}" wire:model.defer="passwordConfirmation">
                                    <div class="absolute right-0 bottom-0 top-1.5 px-3 py-3 cursor-pointer" 
                                            @click="togglePasswordConfirmation = !togglePasswordConfirmation"
                                        >
                                        <svg :class="{'hidden': !togglePasswordConfirmation, 'block': togglePasswordConfirmation }" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-300" viewBox="0 0 24 24"><path d="M12 19c.946 0 1.81-.103 2.598-.281l-1.757-1.757C12.568 16.983 12.291 17 12 17c-5.351 0-7.424-3.846-7.926-5 .204-.47.674-1.381 1.508-2.297L4.184 8.305c-1.538 1.667-2.121 3.346-2.132 3.379-.069.205-.069.428 0 .633C2.073 12.383 4.367 19 12 19zM12 5c-1.837 0-3.346.396-4.604.981L3.707 2.293 2.293 3.707l18 18 1.414-1.414-3.319-3.319c2.614-1.951 3.547-4.615 3.561-4.657.069-.205.069-.428 0-.633C21.927 11.617 19.633 5 12 5zM16.972 15.558l-2.28-2.28C14.882 12.888 15 12.459 15 12c0-1.641-1.359-3-3-3-.459 0-.888.118-1.277.309L8.915 7.501C9.796 7.193 10.814 7 12 7c5.351 0 7.424 3.846 7.926 5C19.624 12.692 18.76 14.342 16.972 15.558z"/></svg>
                                        <svg :class="{'hidden': togglePasswordConfirmation, 'block': !togglePasswordConfirmation }" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-300" viewBox="0 0 24 24"><path d="M12,9c-1.642,0-3,1.359-3,3c0,1.642,1.358,3,3,3c1.641,0,3-1.358,3-3C15,10.359,13.641,9,12,9z"/><path d="M12,5c-7.633,0-9.927,6.617-9.948,6.684L1.946,12l0.105,0.316C2.073,12.383,4.367,19,12,19s9.927-6.617,9.948-6.684 L22.054,12l-0.105-0.316C21.927,11.617,19.633,5,12,5z M12,17c-5.351,0-7.424-3.846-7.926-5C4.578,10.842,6.652,7,12,7 c5.351,0,7.424,3.846,7.926,5C19.422,13.158,17.348,17,12,17z"/></svg>
                                    </div>
                                </div>
                            @error('password')
                                <small class="text-red-400">{{$message}}</small>
                            @enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-center mb-6 h-3" x-show="passwordStrengthText != ''" style="display: none;">
                            <div class="w-2/3 flex justify-between h-2">	
                                <div :class="{ 'bg-red-300': passwordStrengthText == '' || passwordStrengthText == 'Too weak' ||  passwordStrengthText == 'Could be stronger' || passwordStrengthText == 'Strong password' }" class="h-2 rounded-full mr-1 w-1/3 bg-gray-300"></div>
                                <div :class="{ 'bg-red-400': passwordStrengthText == 'Could be stronger' || passwordStrengthText == 'Strong password' }" class="h-2 rounded-full mr-1 w-1/3 bg-gray-300"></div>
                                <div :class="{ 'bg-green-400': passwordStrengthText == 'Strong password' }" class="h-2 rounded-full w-1/3 bg-gray-300"></div>
                            </div>
                            <div x-text="passwordStrengthText" class="text-gray-500 font-medium text-sm ml-3 leading-none"></div>
                        </div>
                    </div>
                    <div x-show.transition.in="step === 2" style="display: none;">
                        <div class="flex -mx-3">
                            <x-input type="text" name="birth_place" wire:model.defer="birth_place" label="Tempat Lahir" icon="mdi mdi-earth" placeholder="Ternate " />
                        </div>
                        <div class="-mx-3">
                            <x-select label="Jenis Kelamin" name="gender" wire:model.defer="gender">
                                <option value="" selected>Pilih</option>
                                @foreach ($genders as $index => $gender)
                                    <option value="{{$index}}">{{$gender}}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="mb-5">
                            <x-date name="birth_date" wire:model.defer="birth_date" />
                        </div>
                        <div class="-mx-3">
                            <x-select label="Agama" name="religion" wire:model.defer="religion">
                                <option value="" selected>Pilih</option>
                                @foreach ($religions as $index => $gender)
                                    <option value="{{$index}}">{{$gender}}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="flex space-x-2 justify-between">
                        <span class="block w-1/2 rounded-md shadow-sm">
                            <button style="display: none;" x-show="step > 1" @click="step--" type="button" class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring-yellow active:bg-yellow-700 transition duration-150 ease-in-out">
                                <i class="mdi mdi-arrow-left text-white text-lg mr-2"></i>
                                Kembali
                            </button>
                        </span>
                        <span class="block w-1/2 rounded-md shadow-sm">
                            <button style="display: none;" x-show="step <= 1" wire:click="firstStepSubmit" type="button" class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring-yellow active:bg-yellow-700 transition duration-150 ease-in-out">
                                Lanjut
                                <i class="mdi mdi-arrow-right text-white text-lg ml-2"></i>
                            </button>
                            <button style="display: none;" x-show="step === 2" wire:click="secondStepSubmit" type="button" class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring-yellow active:bg-yellow-700 transition duration-150 ease-in-out">
                                Lanjut
                                <i class="mdi mdi-arrow-right text-white text-lg ml-2"></i>
                            </button>
                            <button x-show="step === 3" wire:click="register" type="button" class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring-yellow active:bg-yellow-700 transition duration-150 ease-in-out">
                                Daftar
                                <i class="mdi mdi-arrow-right text-white text-lg ml-2"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        @push('scripts')
            <script type="text/javascript">
                function form() {
                    return {
                        togglePassword: false,
                        togglePasswordConfirmation: false,
                        passwordStrengthText: '',
                        checkPasswordStrength() {
                            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                            var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                            let value = this.password;

                            if (strongRegex.test(value)) {
                                this.passwordStrengthText = "Strong password";
                            } else if(mediumRegex.test(value)) {
                                this.passwordStrengthText = "Could be stronger";
                            } else {
                                this.passwordStrengthText = "Too weak";
                            }
                        }
                    } 
                }
            </script>
        @endpush
    </div>
</div>