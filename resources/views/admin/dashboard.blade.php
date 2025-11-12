@extends('admin.layout.main')

@section('title', 'Dashboard')

@section('content')

<body class="bg-gray-100 min-h-screen flex flex-col">


    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Dashboard Overview</h2>
            <p class="text-gray-600 mt-2">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your chat application.</p>
        </div>

                {{--
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                                    <h3 class="text-2xl font-bold text-gray-800">1,248</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                    <i class="fas fa-comments text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Messages Today</p>
                                    <h3 class="text-2xl font-bold text-gray-800">3,567</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                    <i class="fas fa-shield-alt text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Active Rooms</p>
                                    <h3 class="text-2xl font-bold text-gray-800">42</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                                    <i class="fas fa-chart-line text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Online Now</p>
                                    <h3 class="text-2xl font-bold text-gray-800">187</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-white rounded-lg shadow">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Recent Users</h3>
                            </div>
                            <div class="p-6">
                                <ul class="space-y-4">
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-3">
                                                J
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">John Doe</p>
                                                <p class="text-sm text-gray-500">Joined 2 hours ago</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Online</span>
                                    </li>
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold mr-3">
                                                S
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Sarah Smith</p>
                                                <p class="text-sm text-gray-500">Joined 1 day ago</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Offline</span>
                                    </li>
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 font-bold mr-3">
                                                M
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Mike Johnson</p>
                                                <p class="text-sm text-gray-500">Joined 3 days ago</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Online</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">System Status</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Server Uptime</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-sm rounded-full">99.8%</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Database</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-sm rounded-full">Healthy</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">API Response</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-sm rounded-full">Fast</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Last Backup</span>
                                        <span class="text-sm text-gray-500">2 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                --}}
                
    </main>

        

   

</body>
    
    <script>
        // User dropdown menu
        document.getElementById('userMenuButton').addEventListener('click', function() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenu');
            const userMenuButton = document.getElementById('userMenuButton');
            
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
@endsection
