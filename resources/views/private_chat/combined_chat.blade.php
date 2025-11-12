
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
                        </div>
                    </a>
                @empty
                    <p class="p-4 text-center text-sm text-gray-500">No other users found.</p>
                @endforelse
            </div>
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
                
                {{-- Message Input Area --}}
                <div class="p-4 bg-white border-t border-gray-200 shadow-t-lg">
                    <form id="chat-form" action="{{ route('private.chat.store', $receiver->id) }}" method="POST" class="flex items-center">
                        @csrf
                        <input type="text" name="content" placeholder="Type your message..." required
                            class="flex-1 p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
                        <button type="submit" class="ml-3 px-5 py-3 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-700 transition duration-150 flex items-center shadow-lg">
                            <i class="fas fa-paper-plane"></i>
                        </button>
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

        </div>
    </div>

    {{-- Auto-scroll to bottom on load (Crucial for chat experience) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('message-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>

@endsection