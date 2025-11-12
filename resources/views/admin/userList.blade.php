@extends('admin.layout.main')

@section('title', 'chat')

@section('content')

<body class="bg-gray-100 min-h-screen flex flex-col" x-data="{ open: false }">
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-800">Users List</h2>
            <button 
                @click="open = true"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                Add User
            </button>
        </div>

        <table border="1" cellpadding="10" cellspacing="0" class="bg-white w-full border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">S. No.</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->password }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>      
    </main>     

    <!-- Modal -->
    <div 
        x-show="open"
        x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50"
    >
        <!-- Modal Box -->
        <div 
            @click.away="open = false"
            class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg mx-4 relative"
        >
            <!-- Close Button -->
            <button 
                @click="open = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-lg font-bold"
            >
                ✕
            </button>

            <h3 class="text-xl font-bold mb-4 text-gray-800">Add New User</h3>

            <!-- FORM START -->
            <form action="{{ route('admin.add.user.store') }}" method="POST">
                @csrf

                <!-- User Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">User Name</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter user name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter email address">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6 relative">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter password">
                    <button type="button" id="togglePassword"
                        class="absolute right-3 top-9 text-gray-500 hover:text-gray-700 focus:outline-none">
                        Show
                    </button>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Add User
                    </button>
                </div>
            </form>
            <!-- FORM END -->
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.textContent = type === 'password' ? 'Show' : 'Hide';
            });
        }
    });
    </script>
</body>
@endsection
