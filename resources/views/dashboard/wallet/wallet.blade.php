@extends('theme::layouts.app')

@section('content')
    <style>
         #right-panel
        {
            height: 700px;
            background-image: radial-gradient(ellipse at left bottom, rgb(21 21 33) -1%, rgb(66 44 110) -1%, rgb(21 21 33) 35%);
        }
        .dollar-animation {
            width: 35px;
            height: 35px;
            margin-left: 10px;
            margin-top: -4px;
        }

    </style>


    <div class="flex px-8 mx-auto my-6 max-w-7xl xl:px-5">
        <!-- Left Settings Menu -->
        <div class="w-16 mr-6 md:w-1/5">
            @include('theme::partials.sidebar')
        </div>
        <!-- End Settings Menu -->

        <div id="right-panel" class="dark-section flex flex-col w-full bg-white border rounded-lg md:w-4/5 border-gray-150">

            <div class="dark-section flex flex-wrap items-center justify-between border-b border-gray-200 sm:flex-no-wrap">
                <div class="relative p-6">
                    <h3 class="text flex text-lg font-medium leading-6 text-gray-600">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @if(isset($section_title)){{ $section_title }}@else{{Auth::user()->name}} {{ ucwords(str_replace('-', ' ', Request::segment(2)) ?? 'profile') }} @endif
                    </h3>
                </div>
            </div>

            <div class="uk-card-body h-24 min-h-0 md:min-h-full">
                <div class="heading">
                    <p class="text flex text-lg font-small leading-6 text-gray-600 mt-5" style="margin-left: 30px">Welcome to your&nbsp;<strong>Wallet.</strong>&nbsp;Here you can check and manage your deposits and withdrawals!
                        <img class="dollar-animation" src="{{ asset('storage/themes/July2023/dollar.gif') }}" alt="Image">
                    </p>
                    <p class="text flex text-lg font-small leading-6 text-gray-600 mt-5" style="margin-left: 30px">Balance updates are currently handled manually. You can request this by raising a support ticket. Please allow up to 24 hours for your balance to be updated.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
    </script>
@endsection



