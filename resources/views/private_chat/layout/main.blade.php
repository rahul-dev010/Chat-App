<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Dashboard - Mitro App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        
.chat-scroll::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #fff;
}

.chat-scroll::-webkit-scrollbar
{
	width: 5px;
	background-color: #F5F5F5;
}

.chat-scroll::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #4e45e2;
}

  @media (max-width: 768px) {
    .mobile-chat-height {
      max-height: calc(100vh - 323px);
    }
  }


#message-container{
    background-image: url({{ asset('/chatbg.png') }});
    background-size: contain;
}
    </style>
</head>
<body class="overflow-y-hidden">
    <header class="bg-white border-b shadow-sm">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Left: Logo + Navigation -->
        <div class="flex items-center space-x-6">
            <!-- Logo -->
            <a href="{{ route('admin.user.list')}}" class="flex items-center space-x-2">
                <img src="{{ asset('/logo.png') }}" alt="Logo" class="h-10 w-10">
                <!-- <span class="text-xl font-semibold text-gray-800 hidden sm:inline">Admin Panel</span> -->
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('admin.user.list')}}" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    User List
                </a>
                <a href="{{ route('private.chat.users')}}" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    Chat
                </a>
            </nav>
        </div>

        <!-- Right: Notifications + User Menu -->
        <div class="flex items-center space-x-5">
            <!-- Notification Icon -->
            <button class="relative text-gray-700 hover:text-blue-600 focus:outline-none transition">
                <i class="far fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                    3
                </span>
            </button>

            <!-- User Dropdown -->
            <div class="relative">
                <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none group">
                    <div class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold group-hover:bg-blue-600 transition">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:block text-gray-700 font-medium group-hover:text-blue-600 transition">
                        {{ Auth::user()->name }}
                    </span>
                    <i class="fas fa-chevron-down text-sm text-gray-500 group-hover:text-blue-600 transition"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg py-2 z-10">
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="far fa-user mr-2 text-gray-500"></i> Profile
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="bi bi-gear-fill text-gray-500 me-2"></i> Settings
                    </a>
                    <div class="border-t border-gray-100 my-1"></div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav class="md:hidden bg-gray-50 border-t border-gray-100 px-4 py-3 flex space-x-6 justify-center">
        <a href="{{ route('admin.user.list')}}" class="text-gray-700 hover:text-blue-600 font-medium">
            User List
        </a>
        <a href="{{ route('private.chat.users')}}" class="text-gray-700 hover:text-blue-600 font-medium">
            Chat
        </a>
    </nav>
</header>

    <main style="height: calc(100vh - 160px);
    overflow:hidden">
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-blue-50 via-white to-indigo-50 border-t border-gray-200 mt-auto">
    <div class="container mx-auto px-6 py-5">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            
            <!-- Left: Brand / Copyright -->
            <div class="text-center md:text-left">
                <h2 class="text-xl font-bold text-gray-800 flex items-center justify-center md:justify-start space-x-2">
                    <i class="fas fa-comments text-blue-500"></i>
                    <span>Chat App</span>
                </h2>
                <p class="text-sm text-gray-500 mt-1">&copy; 2024 Chat App. All rights reserved.</p>
            </div>

            <!-- Right: Quick Links -->
            <div class="flex flex-wrap justify-center md:justify-end gap-6 text-sm">
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-semibold">
                    Privacy Policy
                </a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-semibold">
                    Terms of Service
                </a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-semibold">
                    Support
                </a>
            </div>
        </div>
    </div>
</footer>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const userMenuButton = document.getElementById("userMenuButton");
        const userMenu = document.getElementById("userMenu");

        userMenuButton.addEventListener("click", (e) => {
            e.stopPropagation();
            userMenu.classList.toggle("hidden");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", (e) => {
            if (!userMenu.contains(e.target) && !userMenuButton.contains(e.target)) {
                userMenu.classList.add("hidden");
            }
        });
    });
</script>
=======
    <title>Dashboard - mitra App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800">My Mitra </h1>
                <nav class="hidden md:flex space-x-4">
                    
                    @if (Auth::user()->role_id == 1) 
                        <a href="{{ route('admin.user.list')}}" class="text-gray-600 hover:text-gray-800 font-medium">User</a>
                    @endif                    
                    {{-- 2. Messages (Always Visible) --}}
                    <a href="{{ route('private.chat.users')}}" class="text-gray-600 hover:text-gray-800 font-medium">Chat</a>                   
                    
                </nav>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <i class="far fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">3</span>
                    </button>
                </div>
                
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden md:block">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="far fa-user mr-2"></i>Profile
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="far fa-cog mr-2"></i>Settings
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-600 text-sm mb-4 md:mb-0">
                    &copy; 2024 Chat App. All rights reserved.
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-800 text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 text-sm">Support</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Dropdown Toggle Script --}}
    <script>
        document.getElementById('userMenuButton').addEventListener('click', function() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        });
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('userMenu');
            const button = document.getElementById('userMenuButton');
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7

</body>
</html>