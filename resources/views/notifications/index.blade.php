@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-bell mr-2"></i>Notifications
                            @if($unreadCount > 0)
                                <span class="badge badge-danger ml-2">{{ $unreadCount }} New</span>
                            @endif
                        </h3>
                        <div>
                            @if($unreadCount > 0)
                                <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-light btn-sm">
                                        <i class="fas fa-check-double mr-1"></i>Mark All as Read
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($notifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                <div class="list-group-item {{ !$notification->is_read ? 'bg-light' : '' }}">
                                    <div class="d-flex align-items-start">
                                        <div class="mr-3">
                                            @if($notification->icon)
                                                <i class="{{ $notification->icon }} fa-2x text-{{ $notification->color }}"></i>
                                            @else
                                                <i class="fas fa-bell fa-2x text-{{ $notification->color }}"></i>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 {{ !$notification->is_read ? 'font-weight-bold' : '' }}">
                                                        {{ $notification->title }}
                                                        @if(!$notification->is_read)
                                                            <span class="badge badge-primary badge-pill ml-2">New</span>
                                                        @endif
                                                    </h5>
                                                    <p class="mb-1">{{ $notification->message }}</p>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                                <div class="ml-3">
                                                    <form action="{{ route('notifications.destroy', $notification->id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Delete this notification?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No notifications</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/mark-as-read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection
