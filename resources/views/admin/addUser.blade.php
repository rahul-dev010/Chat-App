@extends('admin.layout.main')

@section('title', 'User')

@section('content')

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->


    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Add User</h2>
        </div>

        <!-- Add User Form -->
        <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
            <form action="{{ route('admin.add.user.store')}}" method="POST">
                @csrf

                <!-- User Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">User Name</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter user name">
                </div>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter email address">
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Password -->
                <div class="mb-6 relative">
    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
    <input type="password" name="password" id="password" required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="Enter password">
    <!-- Show/Hide Button -->
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
        </div>
    </main>

</body>

    <script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Show' : 'Hide';
    });
</script>
    
@endsection