@extends('layouts.app')

@section('content')
<style>
    .chat-container {
        height: calc(100vh - 250px);
        display: flex;
        flex-direction: column;
    }
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: #f8f9fa;
    }
    .chat-message {
        margin-bottom: 15px;
        display: flex;
    }
    .chat-message.sent {
        justify-content: flex-end;
    }
    .chat-message.received {
        justify-content: flex-start;
    }
    .message-bubble {
        max-width: 60%;
        padding: 12px 16px;
        border-radius: 18px;
        position: relative;
    }
    .chat-message.sent .message-bubble {
        background: #007bff;
        color: white;
        border-bottom-right-radius: 4px;
    }
    .chat-message.received .message-bubble {
        background: white;
        color: #333;
        border-bottom-left-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .message-time {
        font-size: 0.75rem;
        opacity: 0.7;
        margin-top: 4px;
    }
    .message-subject {
        font-weight: bold;
        margin-bottom: 5px;
        padding-bottom: 5px;
        border-bottom: 1px solid rgba(255,255,255,0.3);
    }
    .chat-message.received .message-subject {
        border-bottom-color: rgba(0,0,0,0.1);
    }
    .chat-input-area {
        padding: 15px;
        background: white;
        border-top: 2px solid #dee2e6;
    }
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin: 0 10px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('messages.inbox') }}" class="btn btn-light btn-sm mr-3">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h4 class="mb-0">
                                    <i class="fas fa-comments mr-2"></i>
                                    Conversation with {{ $otherUser->name }}
                                </h4>
                                @if($otherUser->getRoleNames()->first())
                                    <small>{{ $otherUser->getRoleNames()->first() }}</small>
                                @endif
                            </div>
                        </div>
                        <div>
                            <span class="badge badge-light">{{ $messages->count() }} messages</span>
                        </div>
                    </div>
                </div>

                <div class="chat-container">
                    <!-- Chat Messages -->
                    <div class="chat-messages" id="chatMessages">
                        @forelse($messages as $message)
                            <div class="chat-message {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}">
                                @if($message->sender_id !== auth()->id())
                                    @if($message->sender->profile_image)
                                        <img src="{{ route('image.show', $message->sender->profile_image) }}" class="user-avatar" alt="{{ $message->sender->name }}">
                                    @else
                                        <div class="user-avatar bg-secondary text-white d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                @endif

                                <div class="message-bubble">
                                    @if($message->subject && !$message->parent_id)
                                        <div class="message-subject">{{ $message->subject }}</div>
                                    @endif
                                    <div class="message-text">{{ $message->message }}</div>
                                    <div class="message-time">
                                        {{ $message->created_at->format('M d, h:i A') }}
                                        @if($message->sender_id === auth()->id() && $message->is_read)
                                            <i class="fas fa-check-double ml-1"></i>
                                        @endif
                                    </div>
                                </div>

                                @if($message->sender_id === auth()->id())
                                    @if(auth()->user()->profile_image)
                                        <img src="{{ route('image.show', auth()->user()->profile_image) }}" class="user-avatar" alt="{{ auth()->user()->name }}">
                                    @else
                                        <div class="user-avatar bg-primary text-white d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-comments fa-3x mb-3"></i>
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Chat Input -->
                    <div class="chat-input-area">
                        <form action="{{ route('messages.store') }}" method="POST" id="chatForm">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                            <input type="hidden" name="subject" value="{{ $lastMessage ? $lastMessage->subject : 'Chat with ' . $otherUser->name }}">
                            @if($lastMessage)
                                <input type="hidden" name="parent_id" value="{{ $lastMessage->parent_id ?? $lastMessage->id }}">
                            @endif
                            
                            <div class="input-group">
                                <textarea name="message" 
                                          id="messageInput" 
                                          class="form-control @error('message') is-invalid @enderror" 
                                          placeholder="Type your message..."
                                          rows="2"
                                          required></textarea>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-paper-plane"></i> Send
                                    </button>
                                </div>
                            </div>
                            @error('message')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-scroll to bottom
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
        
        // Focus on input
        document.getElementById('messageInput').focus();
        
        // Handle Enter key (Shift+Enter for new line, Enter to send)
        document.getElementById('messageInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('chatForm').submit();
            }
        });
    });
</script>
@endsection
