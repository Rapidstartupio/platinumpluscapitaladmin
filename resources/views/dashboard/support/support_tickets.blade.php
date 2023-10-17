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

        .create-ticket-btn {
            background-color: #4b5563;
        }
        .create-ticket-btn:hover {
            background-color: #404650;
        }

        .support-group {
            margin-top: 220px;
        }


             /*Transaction Table Dark Mode Classes*/
             .caption, .table-head, .table-row {
            background: #151521;
            color: #9ca3af;
        }
        tr.border-b {
           border-color: #2b2b40;
        }
        td a{
            color: #4390ff !important;
        }
        nav[role=navigation] {
            padding: 10px 10px;
            background: #151521;
        }
        nav[role=navigation] p {
            color: #9ca3af;
            margin: 0px 15px;
        }
        nav[role=navigation] div > span {
            color: #9ca3af;
            background: #1e1e2d;
            border-color: #151521;
        }
        nav[role=navigation] div > a {
            color: #9ca3af;
            background: #1e1e2d;
            border-color: #151521;
        }
        span[aria-hidden=true] {
            color: #9ca3af;
            background: #1e1e2d;
            border-color: #151521;
        }
        span[aria-current=page] span{
            color: #9ca3af;
            background: #1e1e2d;
            border-color: #151521;
        }
        span > a[rel=next], span > a[rel=prev] {
            color: #9ca3af;
            background: #1e1e2d;
            border-color: #151521;
        }
        span > a[aria-label*="Go to page"] {
            color: #9ca3af;
            background: #1e1e2d;
            border-color: #151521;
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
                 
                    @if($tickets == null)
                    <p class="text flex text-lg font-small leading-6 text-gray-600 mt-5" style="margin-left: 30px">Welcome to our&nbsp;<strong>Support.</strong>&nbsp;Here you can check your active support ticket or you can create a new one!</p>

                    <div class="support-group">
                        <p class="text flex justify-center w-full text-lg font-small leading-6 text-gray-600">There is no ticket right now.</p>

                        <div class="flex justify-center w-full">
                            <a href="{{ route('dashboard.create_ticket') }}" class="create-ticket-btn flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md">Create Your Ticket</a>
                        </div>
                    </div>
                    @else
                    
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800">
                        <caption class="caption p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Support Tickets
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of your created tickets, stay organized, get answers, keep in touch, grow your business, and more.</p>
                            <a href="{{ route('dashboard.create_ticket') }}" class="create-ticket-btn flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md">Create Your Ticket</a>
                        </caption>
                        <thead class="table-head text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Subject
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Message
                            </th>
                            <th scope="col" class="px-6 py-3">
                                File
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date Created
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr class="table-row bg-white border-b">
                            <th scope="row" class="px-6 py-4">
                               {{ $ticket->subject }}
                            </th>
                            <td class="px-6 py-4">
                                {!! \Illuminate\Support\Str::limit($ticket->message, 30) !!}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->file ? $ticket->file : 'No File Attached' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
        

                </div>
            </div>
        </div>

    </div>

    <script>
    </script>
@endsection



