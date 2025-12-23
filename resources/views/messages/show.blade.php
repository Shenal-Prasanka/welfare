@extends('layouts.app')

@section('content')
<style>
    .message-thread {
        max-height: 500px;
        overflow-y: auto;
    }
    .message-item {
        border-left: 3px solid #007bff;
        margin-bottom: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }
    .message-item.sent {
        border-left-color: #28a745;
        background: #e7f5e9;
    }
    .message-item.received {
        border-left-color: #007bff;
        background: #e7f1ff;
    }
    .reply-form {
        border-top: 2px solid #dee2e6;
        padding-top: 20px;
        margin-top: 20px;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-comments mr-2"></i>{{ $rootMessage->subject }}
                        </h3>
                        <div>
                            <a href="{{ route('messages.inbox') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i>Back to Inbox
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Message Thread -->
                    <div class="message-thread mb-4">
                        @foreach($threadMessages as $msg)
                            <div class="message-item {{ $msg->sender_id === auth()->id() ? 'sent' : 'received' }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="text-primary">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            {{ $msg->sender->name }}
                                        </strong>
                                        @if($msg->sender->getRoleNames()->first())
                                            <span class="badge badge-secondary ml-2">{{ $msg->sender->getRoleNames()->first() }}</span>
                                        @endif
                                        <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                        <strong class="text-success">{{ $msg->receiver->name }}</strong>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $msg->created_at->format('M d, Y h:i A') }}
                                    </small>
                                </div>
                                <div class="message-content" style="white-space: pre-wrap;">{{ $msg->message }}</div>
                                @if($msg->is_read && $msg->read_at)
                                    <small class="text-success mt-2 d-block">
                                        <i class="fas fa-check-double mr-1"></i>Read {{ $msg->read_at->diffForHumans() }}
                                    </small>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Reply Form -->
                    <div class="reply-form">
                        <h5 class="mb-3"><i class="fas fa-reply mr-2"></i>Reply to this conversation</h5>
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $rootMessage->id }}">
                            <input type="hidden" name="receiver_id" value="{{ $message->sender_id === auth()->id() ? $message->receiver_id : $message->sender_id }}">
                            <input type="hidden" name="subject" value="{{ $rootMessage->subject }}">
                            
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-user mr-2"></i>To:
                                </label>
                                <input type="text" class="form-control" 
                                       value="{{ $message->sender_id === auth()->id() ? $message->receiver->name : $message->sender->name }}" 
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label for="reply_message" class="font-weight-bold">
                                    <i class="fas fa-comment mr-2"></i>Your Reply:
                                </label>
                                <textarea name="message" 
                                          id="reply_message" 
                                          rows="5" 
                                          class="form-control @error('message') is-invalid @enderror" 
                                          placeholder="Type your reply here..."
                                          required></textarea>
                                @error('message')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane mr-2"></i>Send Reply
                                </button>
                                <a href="{{ route('messages.inbox') }}" class="btn btn-secondary">
                                    <i class="fas fa-times mr-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-scroll to bottom of message thread
    document.addEventListener('DOMContentLoaded', function() {
        const messageThread = document.querySelector('.message-thread');
        if (messageThread) {
            messageThread.scrollTop = messageThread.scrollHeight;
        }
        
        // Focus on reply textarea
        document.getElementById('reply_message').focus();
    });
</script>
@endsection
