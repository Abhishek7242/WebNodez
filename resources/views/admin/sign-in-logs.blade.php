@extends('admin/layouts/main')
@section('title', 'Linkuss - Manage Admins')
@section('main-section')


    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>

    <div class="container mx-auto py-8 h-screen min-h-screen">
        <h1 class="text-2xl font-bold mb-6">Sign in Logs</h1>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 ">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP
                            Address
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Browser
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($logs as $log)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->ip_address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap {{ $log->status == 'Success' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                {{ $log->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->user_agent }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
