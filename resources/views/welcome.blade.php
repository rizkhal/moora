@extends('layouts.base')

@push('styles')
    <style>
        #bg {
            z-index: 20;
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
        }
    </style>
@endpush

@section('body')
    <div id="bg" style="background-image: url('{{ asset("img/banner-bg.svg") }}');">
        <!--Nav-->
        <div class="w-full container mx-auto p-6">
            <div class="w-full flex items-center justify-between">
                <a class="flex items-center text-gray-200 hover:no-underline font-bold text-2xl lg:text-4xl"  href="#"> 
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo Kpu">
                    <div class="flex flex-col ml-3">
                        <h3 class="hidden lg:block">Komisi Pemilihan Umum</h3>
                        <h3 class="block lg:hidden">KPU</h3>
                        <h3>Kota Lubuk Linggau</h3>
                    </div>
                </a>

                <div class="flex w-1/2 justify-end content-center">		
                    <a href="#" class="px-4 py-2 rounded-md font-bold text-white bg-gradient-to-r from-red-600 via-orange-400 to-yellow-500 hover:from-red-500 hover:to-yellow-500">
                        Alur Pendaftaran
                    </a>
                </div>
                
            </div>

        </div>
        <!--Main-->
        <div class="container pt-20 pb-24 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
                <h1 class="my-4 text-3xl md:text-5xl text-gray-200 leading-tight text-center md:text-left slide-in-bottom-h1">
                    <span class="font-extrabold">Indonesia</span>
                    <span>memanggil.</span>
                </h1>
                <p class="leading-loose flex text-gray-800 flex-col font-semibold md:text-2xl mb-8 text-center md:text-left">
                    <span>Ayoo gabung dengan <span class="font-extrabold">KPU</span> sekarang juga.</span>
                    <span>bersama <span class="font-extrabold">KPU</span> kita bangun indonesia yang demokratis! </span>
                </p>
            
                <div class="flex w-full justify-center space-x-2 md:justify-start pb-24 lg:pb-0 fade-in">
                    @guest
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-red-700 rounded-md text-white font-bold hover:bg-red-800">Daftar</a>
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-red-700 rounded-md text-white font-bold hover:bg-red-800">Masuk</a>
                    @else
                        <a href="{{ route('home') }}" class="px-4 py-2 bg-red-700 rounded-md text-white font-bold hover:bg-red-800">Dashboard</a>
                    @endguest
                </div>

            </div>
            
            <!--Right Col-->
            <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom" src="{{ asset('img/bg2.svg') }}" alt="Background illustrator">
            </div>
            
            <!--Footer-->
            <div class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in">
                <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; Skripsi {{date('Y')}}</a>
            </div>
        </div>
    </div>
@endsection
