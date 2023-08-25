@extends('user.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <div id="chat-messages">
                            <!-- Display chat messages here -->
                        </div>
                        <form id="chat-form" action="{{ route('send-message') }}" method="post">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <input type="text" name="content" placeholder="Type your message">
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    import Echo from 'laravel-echo';

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        encrypted: true,
    });

    // Replace with the actual conversation ID
    const conversationId = '{{ $conversation->id }}';

    // Subscribe to the Pusher channel for this conversation
    window.Echo.private(`conversation.${conversationId}`)
        .listen('.new-message', (event) => {
            // Handle the incoming new message event and update the chat interface
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML += `<div>${event.message.content}</div>`;
        });

    // Submit the chat message via AJAX
    const chatForm = document.getElementById('chat-form');
    chatForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(chatForm);
        fetch(chatForm.action, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                // Clear and update the chat form
                chatForm.reset();
            });
    });

</script>
