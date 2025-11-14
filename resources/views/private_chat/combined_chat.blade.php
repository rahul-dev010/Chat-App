<<<<<<< HEAD
@extends('private_chat.layout.main')
@section('content')
    <div class="flex bg-gray-50" style="height: inherit;">

        <!-- 1. Left Panel: User List (Sidebar) -->
        <div class="w-full md:w-96 bg-white border-r border-gray-200 flex flex-col rounded-lg m-4 shadow-md">
            <div class="px-5 py-3 border-b border-indigo-100">
                <h2 class="text-xl font-bold text-dark">Messages</h2>
            </div>


            <div class="relative mt-3 mx-3">
                <i class="absolute top-1/4 left-3 text-gray-400 bi bi-search"></i>
                <input type="text" id="contactSearch" placeholder="Search contacts..." class="w-full pl-10 pr-4 py-2 rounded-lg text-sm border border-gray-300 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-transparent transition duration-150">

            </div>
            <div class="flex-1 overflow-y-auto divide-y divide-gray-100 chat-scroll mt-2">
                @forelse ($usersWithLastMessage as $userItem)
                    <a href="{{ route('private.chat.show', $userItem->id) }}"
                        class="block p-3 transition duration-150 ease-in-out hover:bg-[#fffde2] 
                           {{ (isset($receiver) && $userItem->id == $receiver->id) ? 'bg-[#fffcca] border-l-4 border-[#f4e90f]' : 'bg-white' }}">

                        <div class="flex items-center justify-between space-x-3">

                            {{-- Left: Avatar + Name + Message --}}
                            <div class="flex items-center space-x-3 min-w-0">
                                <span
                                    class="relative inline-flex items-center justify-center h-12 w-12 rounded-full bg-[#f4cd78] text-white font-bold text-lg">
                                    {{ strtoupper(substr($userItem->name, 0, 1)) }}

                                    <!-- green online Dot -->
                                    <span
                                        class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-white rounded-full"></span>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p class="text-base font-semibold text-gray-900 truncat capitalize">{{ $userItem->name }}</p>

                                    @if ($userItem->last_message)
                                        <p class="text-sm text-gray-500 truncate">
                                            <span
                                                class="font-medium {{ $userItem->last_message->sender_id === Auth::id() ? 'text-indigo-600' : 'text-gray-900' }}">
                                                {{ $userItem->last_message->sender_id === Auth::id() ? 'You: ' : '' }}
                                            </span>
                                            {{ Str::limit($userItem->last_message->content, 30) }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 italic">Say hello!</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Right: Time + Unread badge vertically stacked --}}
                            <div class="flex flex-col items-end justify-center space-y-1">
                                {{-- Message time --}}
                                @if ($userItem->last_message && $userItem->last_message->created_at)
                                    <span class="text-xs text-gray-500 font-medium">
                                        {{ $userItem->last_message->created_at->format('H:i') }}
                                    </span>
                                @endif

                                {{-- Unread message count --}}
                                @if ($userItem->unread_count > 0)
                                    <div
                                        class="h-5 w-5 bg-green-500 text-white text-xs font-bold rounded-full flex items-center p-1 justify-center shadow-sm">
                                        {{ $userItem->unread_count }}
                                    </div>
                                @endif
                            </div>

=======

@extends('private_chat.layout.main')
@section('content')
    <div class="h-screen flex bg-gray-50">
        
        <!-- 1. Left Panel: User List (Sidebar) -->
        <div class="w-full md:w-80 bg-white border-r border-gray-200 flex flex-col shadow-lg">
            <div class="p-5 border-b border-indigo-100 bg-indigo-600">
                <h2 class="text-2xl font-bold text-white">Contacts</h2>
            </div>
            
            <div class="flex-1 overflow-y-auto divide-y divide-gray-100 chat-scroll">
                @forelse ($usersWithLastMessage as $userItem)
                    <a href="{{ route('private.chat.show', $userItem->id) }}" 
                    class="block p-4 transition duration-150 ease-in-out hover:bg-indigo-50 
                    {{ (isset($receiver) && $userItem->id == $receiver->id) ? 'bg-indigo-100 border-l-4 border-indigo-600' : 'bg-white' }}">
                        <div class="flex items-center space-x-3">
                            {{-- Avatar --}}
                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white font-bold text-lg">
                                {{ strtoupper(substr($userItem->name, 0, 1)) }}
                            </span>
                            
                            {{-- User and Message Preview --}}
                            <div class="min-w-0 flex-1">
                                <p class="text-base font-semibold text-gray-900 truncate">{{ $userItem->name }}</p>
                                
                                @if ($userItem->last_message)
                                    <p class="text-sm text-gray-500 truncate">
                                        <span class="font-medium {{ $userItem->last_message->sender_id === Auth::id() ? 'text-indigo-600' : 'text-gray-900' }}">
                                            {{ $userItem->last_message->sender_id === Auth::id() ? 'You: ' : '' }}
                                        </span> 
                                        {{ Str::limit($userItem->last_message->content, 30) }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400 italic">Say hello!</p>
                                @endif
                            </div>
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
                        </div>
                    </a>
                @empty
                    <p class="p-4 text-center text-sm text-gray-500">No other users found.</p>
                @endforelse
            </div>
<<<<<<< HEAD

        </div>

        <!-- 2. Right Panel: Active Chat Window -->
        <div class="flex-1 rounded-lg  flex flex-col m-4 ml-0 bg-white shadow-lg rounded-t-lg">

            @if (isset($receiver))
                {{-- Chat Header --}}
                <div class="px-4 py-4 border-b border-gray-200 bg-white shadow-md flex items-center space-x-3">
                    <!-- Avatar -->
                    <span
                        class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-green-500 text-white font-bold">
                         {{ strtoupper(string: substr(string: $receiver->name, offset: 0, length: 1)) }}
                    </span>

                    <!-- Name + Status -->
                    <div class="flex flex-col">
                        <h3 class="text-xl font-semibold text-gray-800 capitalize">{{ $receiver->name }}</h3>

                        {{-- Show only if active --}}
                        @if ($receiver->is_active ?? false)
                            <span class="text-xs font-medium text-green-600 flex items-center gap-1">
                                <span class="h-2 w-2 bg-green-500 rounded-full"></span>
                                Active
                            </span>
                        @endif
                    </div>
                </div>


                <!-- Chat Messages Area old -->
                


                <!-- old mssg area end here -->
                

                 <!-- chat mssage area new start here  -->
                {{-- Chat Message Area New By Ajax  --}}
=======
        </div>
        
        <!-- 2. Right Panel: Active Chat Window -->
        <div class="flex-1 flex flex-col">
            
            @if (isset($receiver))
                {{-- Chat Header --}}
                <div class="p-4 border-b border-gray-200 bg-white shadow-md flex items-center space-x-3">
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-green-500 text-white font-bold">
                        {{ strtoupper(substr($receiver->name, 0, 1)) }}
                    </span>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $receiver->name }}</h3>
                </div>

                {{-- Chat Messages Area --}}
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
                <div id="message-container" class="flex-1 overflow-y-auto p-6 space-y-4 chat-scroll">
                    
                    @forelse ($messages as $message)
                        {{-- Incoming Message (Left Side) --}}
                        @if ($message->sender_id !== Auth::id())
                            <div class="flex justify-start">
                                <div class="max-w-xs lg:max-w-md">
                                    <p class="bg-white p-3 rounded-xl rounded-tl-none shadow-md text-gray-800 border border-gray-100">
                                        {{ $message->content }}
                                    </p>
                                    <span class="block text-xs text-gray-500 mt-1 ml-2">{{ $message->created_at->format('H:i A') }}</span>
                                </div>
                            </div>
                        @else
                        {{-- Outgoing Message (Right Side) --}}
                            <div class="flex justify-end">
                                <div class="max-w-xs lg:max-w-md">
                                    <p class="bg-indigo-600 p-3 rounded-xl rounded-br-none shadow-md text-white">
                                        {{ $message->content }}
                                    </p>
                                    <span class="block text-xs text-gray-500 mt-1 mr-2 text-right">
                                        {{ $message->created_at->format('H:i A') }}
                                        {{-- Read Status Icon --}}
                                        @if ($message->read_at)
                                            <i class="fas fa-check-double text-blue-300 ml-1"></i>
                                        @else
                                            <i class="fas fa-check text-gray-400 ml-1"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center p-10 text-gray-400 border border-dashed border-gray-300 rounded-lg bg-white">
                            <p class="text-lg font-medium">No messages yet.</p>
                            <p class="text-sm mt-1">Start your conversation with {{ $receiver->name }}.</p>
                        </div>
                    @endforelse
                    
                </div>
<<<<<<< HEAD
                <!-- chat mssage area new end here  -->

                <!-- chat mssage input area 0ld start here  -->
                

                
            <!-- chat mssage input  area old end here  -->


            <!-- chat input new start -->
                <div class="p-4 bg-white border-t border-gray-200 shadow-t-lg">
                    <form id="chat-form" class="flex items-center p-4 border-t bg-white">
                    @csrf
                    <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $receiver->id }}">
                    <input type="text" name="content" id="message-input" placeholder="Type a message"
                        class="flex-1 border border-gray-300 rounded-full px-4 py-2 mr-2 focus:ring focus:ring-indigo-200 focus:outline-none">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700">
                        Send
                    </button>
=======
                
                {{-- Message Input Area --}}
                <div class="p-4 bg-white border-t border-gray-200 shadow-t-lg">
                    <form id="chat-form" action="{{ route('private.chat.store', $receiver->id) }}" method="POST" class="flex items-center">
                        @csrf
                        <input type="text" name="content" placeholder="Type your message..." required
                            class="flex-1 p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
                        <button type="submit" class="ml-3 px-5 py-3 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-700 transition duration-150 flex items-center shadow-lg">
                            <i class="fas fa-paper-plane"></i>
                        </button>
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
                    </form>
                </div>        
            @else
                {{-- No Chat Selected View --}}
                <div class="flex flex-1 justify-center items-center bg-gray-100">
                    <div class="text-center p-10">
                        <i class="far fa-comments text-indigo-400 text-6xl"></i>
                        <p class="text-2xl text-gray-500 mt-4 font-light">Select a contact to begin chatting.</p>
                    </div>
                </div>
            @endif

<<<<<<< HEAD
            <!-- chat input new end here -->


=======
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
        </div>
    </div>

    {{-- Auto-scroll to bottom on load (Crucial for chat experience) --}}
    <script>
<<<<<<< HEAD
        document.addEventListener('DOMContentLoaded', function () {
=======
        document.addEventListener('DOMContentLoaded', function() {
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
            const container = document.getElementById('message-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>

<<<<<<< HEAD



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('contactSearch');
            const contactLinks = document.querySelectorAll('.chat-scroll a'); // All contact entries

            // 🔍 Search filter functionality
            searchInput.addEventListener('keyup', function () {
                const filter = this.value.toLowerCase().trim();

                contactLinks.forEach(contact => {
                    const nameElement = contact.querySelector('p.text-base');
                    if (!nameElement) return;

                    const name = nameElement.textContent.toLowerCase();
                    contact.style.display = name.includes(filter) ? '' : 'none';
                });
            });
        });
    </script>

    <!-- new Sctrip start here  -->
       
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    const receiverId = $('#receiver_id').val();

    // 🚀 Fetch messages every 1 second
    setInterval(fetchMessages, 10000);
    fetchMessages(); // Initial load

    function fetchMessages() {
        $.ajax({
            url: "{{ route('messages.fetch') }}",
            method: "GET",
            data: { receiver_id: receiverId },
            success: function(messages) {
                let html = '';

                if (messages.length === 0) {
                    html = `
                        <div class="text-center p-10 text-gray-400 border border-dashed border-gray-300 rounded-lg bg-white">
                            <p class="text-lg font-medium">No messages yet.</p>
                            <p class="text-sm mt-1">Start your conversation with {{ $receiver->name ?? 'NA' }}.</p>
                        </div>`;
                } else {
                    messages.forEach(msg => {
                        if (msg.sender_id == {{ Auth::id() }}) {
                            html += `
                                <div class="flex justify-end">
                                    <div class="max-w-xs lg:max-w-md">
                                        <p class="bg-indigo-600 p-3 rounded-xl rounded-br-none shadow-md text-white">
                                            ${msg.content}
                                        </p>
                                        <span class="block text-xs text-gray-500 mt-1 mr-2 text-right">
                                            ${formatTime(msg.created_at)}
                                            <i class="fas fa-check text-gray-400 ml-1"></i>
                                        </span>
                                    </div>
                                </div>`;
                        } else {
                            html += `
                                <div class="flex justify-start">
                                    <div class="max-w-xs lg:max-w-md">
                                        <p class="bg-white p-3 rounded-xl rounded-tl-none shadow-md text-gray-800 border border-gray-100">
                                            ${msg.content}
                                        </p>
                                        <span class="block text-xs text-gray-500 mt-1 ml-2">${formatTime(msg.created_at)}</span>
                                    </div>
                                </div>`;
                        }
                    });
                }

                $('#message-container').html(html);
                $('#message-container').scrollTop($('#message-container')[0].scrollHeight);
            }
        });
    }

    // 📨 Send message without reloading
    $('#chat-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('messages.store') }}",
            method: "POST",
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function() {
                $('#message-input').val(''); // Clear input
                fetchMessages(); // Refresh immediately
            }
        });
    });

    // 🕐 Format time to "HH:MM AM/PM"
    function formatTime(dateTime) {
        const date = new Date(dateTime);
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
    }
    
</script>

<!-- new Script end here -->



=======
>>>>>>> ca62e9ae08edfb584d441a13f195026f21a2f1e7
@endsection