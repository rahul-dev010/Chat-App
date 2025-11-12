@extends('groups.layout.main')
@section('content')
<div class="container">
    <h1>💬 Group Chat: {{ $group->name }}</h1>
    
    <p>
        <strong>👥 Members:</strong> 
        @foreach($groupMembers as $member)
            {{ $member->name }}{{ !$loop->last ? ', ' : '' }}
        @endforeach
    </p>

    <hr>
    
    <!-- Message Display Area -->
    <div id="messages-container" style="height: 500px; border: 2px solid #007bff; background-color: #f0f4f7; overflow-y: scroll; padding: 15px; margin-bottom: 15px; border-radius: 8px;">
        <p style="text-align: center; color: #6c757d;">Messages loading...</p>
    </div>
    
    <!-- Message Sending Form -->
    <form id="message-form" style="display: flex;">
        @csrf
        <input type="text" id="message-input" name="message" placeholder="Write your message..." required style="flex-grow: 1; padding: 12px; border: 1px solid #ccc; border-right: none; border-radius: 5px 0 0 5px;">
        <button type="submit" id="send-button" style="padding: 12px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 0 5px 5px 0; font-weight: bold;">Send</button>
    </form>
</div>

<!-- AJAX / JavaScript for dynamic chat loading and sending -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const messagesContainer = $('#messages-container');
        const fetchUrl = '{{ route('user.groups.chat.messages', $group) }}';
        const storeUrl = '{{ route('user.groups.chat.store', $group) }}';
        
        function formatMessage(msg) {
            const alignment = msg.is_me ? 'right' : 'left';
            const bgColor = msg.is_me ? '#d1e7dd' : '#ffffff'; // Light green for self, white for others
            const borderColor = msg.is_me ? '#badbcc' : '#ccc';
            const nameColor = msg.is_me ? '#007bff' : '#dc3545';
            const shadow = '0 1px 3px rgba(0,0,0,0.1)';

            return `
                <div style="text-align: ${alignment}; margin-bottom: 15px;">
                    <div style="display: inline-block; padding: 10px 15px; border-radius: 12px; background-color: ${bgColor}; max-width: 80%; border: 1px solid ${borderColor}; box-shadow: ${shadow};">
                        <strong style="color: ${nameColor}; font-size: 0.9em;">${msg.user_name}:</strong> 
                        <p style="margin: 0; word-wrap: break-word;">${msg.message_text}</p>
                        <div style="font-size: 0.7em; color: #6c757d; margin-top: 5px; text-align: ${msg.is_me ? 'right' : 'left'}">
                            ${msg.time}
                        </div>
                    </div>
                </div>
            `;
        }
        
        // Fetch and Scroll Logic
        let lastScrollHeight = 0;
        function fetchMessages() {
            $.ajax({
                url: fetchUrl,
                method: 'GET',
                success: function(response) {
                    messagesContainer.empty(); 
                    if (response.messages.length === 0) {
                        messagesContainer.append('<p style="text-align: center; color: #6c757d; margin-top: 15px;">No messages yet. Start the conversation!</p>');
                    } else {
                        response.messages.forEach(function(msg) {
                            messagesContainer.append(formatMessage(msg));
                        });
                    }
                    
                    // Only scroll to bottom if the user was near the bottom before update
                    const currentScrollHeight = messagesContainer[0].scrollHeight;
                    const scrollTop = messagesContainer[0].scrollTop;
                    const clientHeight = messagesContainer[0].clientHeight;
                    
                    if (currentScrollHeight > lastScrollHeight || scrollTop > currentScrollHeight - clientHeight - 50) {
                        messagesContainer.scrollTop(currentScrollHeight);
                    }
                    lastScrollHeight = currentScrollHeight;

                },
                error: function(xhr, status, error) {
                    console.error("Error fetching messages:", error);
                }
            });
        }

        fetchMessages();

        // Polling (Refresh every 3 seconds)
        setInterval(fetchMessages, 3000); 

        // 2. Message Sending Function
        $('#message-form').submit(function(e) {
            e.preventDefault();
            const messageInput = $('#message-input');
            const sendButton = $('#send-button');
            const message = messageInput.val();
            
            if (!message.trim()) return;

            sendButton.prop('disabled', true).text('Sending...');

            $.ajax({
                url: storeUrl,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: message
                },
                success: function(response) {
                    messageInput.val(''); 
                    fetchMessages();
                    sendButton.prop('disabled', false).text('Send');
                },
                error: function(xhr, status, error) {
                    alert('Error sending message: ' + (xhr.responseJSON ? xhr.responseJSON.error : 'Server error'));
                    sendButton.prop('disabled', false).text('Send');
                }
            });
        });
    });
</script>


@endsection