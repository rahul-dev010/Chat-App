@extends('admin.layout.main')

@section('title', 'Chat')

@section('content')

<<<<<<< HEAD
    <body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex flex-col" x-data="{ open: false }">
        <main class="max-w-9xl bg-white  m-4 rounded-md">
            <div class="card">
                <div class="card-header border-b-2 border-gray-200 flex justify-between items-center p-5">
                    <h2 class="text-lg sm:text-2xl md:text-[18px] font-semibold text-gray-600 tracking-tight flex items-center gap-2">
                        <span class="flex items-center">
                            <i class="bi bi-person-fill-add me-2 text-base sm:text-xl md:text-[16px]"></i>
                            Users List
                        </span>
                    </h2>
                    <button @click="open = true"
                        class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-md text-white text-[14px] px-3 py-2 duration-300 ease-in-out">
                        <i class="bi bi-plus-circle-fill text-sm sm:text-base md:text-lg"></i>
                        Add User
                    </button>
                </div>
                <div class="card-body p-5">
                    <!-- User Table -->
                    <div class="overflow-x-auto w-[100%]">
                        <table class="w-full border-separate border-spacing-y-3">
                            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-t-lg">
                                <tr>
                                    <th class="px-4 py-3 text-start rounded-s-lg">S. No.</th>
                                    <th class="px-4 py-3 text-start">Name</th>
                                    <th class="px-4 py-3 text-start">Email</th>
                                    <th class="px-4 py-3 text-start rounded-e-lg">Password</th>
                                    <th class="px-4 py-3 text-start rounded-e-lg">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr
                                        class="bg-gradient-to-r from-blue-50 to-indigo-50  border border-gray-200 rounded-lg  transform ">
                                        <td class="px-4 py-3 rounded-s-lg font-semibold text-gray-700">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-800 font-medium">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                                        <td class="px-4 py-3 rounded-e-lg text-gray-500">{{ $user->password }}</td>

                                        <td class="px-4 py-3 rounded-e-lg text-gray-500">f</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </main>

        <!-- Modal -->
        <div x-show="open" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-gray-900/70 backdrop-blur-sm z-50 transition">
            <!-- Modal Box -->
            <div @click.away="open = false"
                class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg mx-4 relative transform transition-all duration-300 scale-100 hover:scale-[1.01]">
                <!-- Close Button -->
                <button @click="open = false"
                    class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-2xl font-bold transition-transform hover:rotate-90">
                    ✕
                </button>

                <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Add New User</h3>

                <!-- FORM START -->
                <form action="{{ route('admin.add.user.store') }}" method="POST">
                    @csrf

                    <!-- User Name -->
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">User Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Enter user name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Enter email address">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6 relative">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Enter password">
                        <button type="button" id="togglePassword"
                            class="absolute right-4 top-10 text-sm text-gray-500 hover:text-blue-600 transition">
                            Show
                        </button>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-2.5 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
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
=======
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
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
