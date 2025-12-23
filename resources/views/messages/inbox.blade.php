@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-inbox mr-2"></i>Inbox
                            @if($unreadCount > 0)
                                <span class="badge badge-danger ml-2">{{ $unreadCount }} New</span>
                            @endif
                        </h3>
                        <div>
                            <a href="{{ route('messages.create') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-pen mr-1"></i>Compose
                            </a>
                            <a href="{{ route('messages.sent') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-paper-plane mr-1"></i>Sent
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($messages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="20%">From</th>
                                        <th width="35%">Subject</th>
                                        <th width="30%">Message Preview</th>
                                        <th width="10%">Date</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr class="{{ $message->unread_count > 0 ? 'font-weight-bold bg-light' : '' }}" style="cursor: pointer;" onclick="window.location='{{ route('messages.conversation', $message->sender_id) }}'">
                                            <td class="text-center">
                                                @if($message->unread_count > 0)
                                                    <span class="badge badge-danger badge-pill">{{ $message->unread_count }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($message->sender->profile_image)
                                                        <img src="{{ route('image.show', $message->sender->profile_image) }}" 
                                                             class="rounded-circle mr-2" 
                                                             style="width: 40px; height: 40px; object-fit: cover;"
                                                             alt="{{ $message->sender->name }}">
                                                    @else
                                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mr-2" 
                                                             style="width: 40px; height: 40px; font-size: 18px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div>{{ $message->sender->name }}</div>
                                                        @if($message->sender->getRoleNames()->first())
                                                            <small><span class="badge badge-secondary">{{ $message->sender->getRoleNames()->first() }}</span></small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $message->subject }}</td>
                                            <td class="text-muted">{{ Str::limit($message->message, 50) }}</td>
                                            <td>
                                                <small>{{ $message->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('messages.conversation', $message->sender_id) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   onclick="event.stopPropagation();"
                                                   title="Open Chat">
                                                    <i class="fas fa-comments"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No messages in your inbox</p>
                            <a href="{{ route('messages.create') }}" class="btn btn-primary">
                                <i class="fas fa-pen mr-2"></i>Compose Message
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
