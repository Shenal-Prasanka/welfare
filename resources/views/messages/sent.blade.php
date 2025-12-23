@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-paper-plane mr-2"></i>Sent Messages
                        </h3>
                        <div>
                            <a href="{{ route('messages.create') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-pen mr-1"></i>Compose
                            </a>
                            <a href="{{ route('messages.inbox') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-inbox mr-1"></i>Inbox
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
                                        <th width="20%">To</th>
                                        <th width="35%">Subject</th>
                                        <th width="30%">Message Preview</th>
                                        <th width="10%">Date</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr style="cursor: pointer;" onclick="window.location='{{ route('messages.conversation', $message->receiver_id) }}'">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($message->receiver->profile_image)
                                                        <img src="{{ route('image.show', $message->receiver->profile_image) }}" 
                                                             class="rounded-circle mr-2" 
                                                             style="width: 40px; height: 40px; object-fit: cover;"
                                                             alt="{{ $message->receiver->name }}">
                                                    @else
                                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mr-2" 
                                                             style="width: 40px; height: 40px; font-size: 18px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div>{{ $message->receiver->name }}</div>
                                                        @if($message->receiver->getRoleNames()->first())
                                                            <small><span class="badge badge-secondary">{{ $message->receiver->getRoleNames()->first() }}</span></small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $message->subject }}</td>
                                            <td class="text-muted">{{ Str::limit($message->message, 50) }}</td>
                                            <td>
                                                <small>{{ $message->created_at->diffForHumans() }}</small>
                                                @if($message->message_count > 1)
                                                    <br><span class="badge badge-info badge-pill">{{ $message->message_count }} messages</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('messages.conversation', $message->receiver_id) }}" 
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
                            <i class="fas fa-paper-plane fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No sent messages</p>
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
