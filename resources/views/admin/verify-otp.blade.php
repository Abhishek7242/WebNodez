@extends('admin/layouts/main')
@section('title', 'Verify OTP')

@section('main-section')
    <div class="container mx-auto p-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Enter OTP</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    An OTP has been sent to your registered email address. Please enter it below to change your password.
                </p>

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

                <form action="{{ route('admin.password.verify.otp') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="otp" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">One-Time
                            Password (OTP)</label>
                        <input type="text" id="otp" name="otp" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600"
                            placeholder="Enter the 6-digit OTP">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Verify & Change Password
                        </button>
                        <a href="{{ route('admin.password.change') }}"
                            class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
