@extends('admin/layouts/main')
@section('title', 'Change Password')

@section('main-section')
    <div class="container mx-auto p-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Change Your Password</h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.password.send.otp') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password"
                            class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
                    </div>
                    <div class="mb-6">
                        <label for="new_password" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">New
                            Password</label>
                        <input type="password" id="new_password" name="new_password" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
                    </div>
                    <div class="mb-6">
                        <label for="new_password_confirmation"
                            class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Confirm New
                            Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
