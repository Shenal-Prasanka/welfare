@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-{{ request('reply_to') ? 'reply' : 'pen' }} mr-2"></i>{{ request('reply_to') ? 'Reply to Message' : 'Compose Message' }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        
                        <!-- Receiver -->
                        <div class="form-group">
                            <label for="receiver_id" class="font-weight-bold">
                                <i class="fas fa-user mr-2"></i>To:
                            </label>
                            @if(request('reply_to'))
                                @php
                                    $replyUser = $users->firstWhere('id', request('reply_to'));
                                @endphp
                                <input type="hidden" name="receiver_id" value="{{ request('reply_to') }}">
                                <input type="text" class="form-control" value="{{ $replyUser ? $replyUser->name : '' }}" readonly>
                            @else
                                <select name="receiver_id" id="receiver_id" class="form-control @error('receiver_id') is-invalid @enderror" required>
                                    <option value="">Select Recipient</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} 
                                            @if($user->getRoleNames()->first())
                                                ({{ $user->getRoleNames()->first() }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @error('receiver_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="form-group">
                            <label for="subject" class="font-weight-bold">
                                <i class="fas fa-heading mr-2"></i>Subject:
                            </label>
                            @if(request('subject'))
                                <input type="hidden" name="subject" value="{{ request('subject') }}">
                                <input type="text" class="form-control" value="{{ request('subject') }}" readonly>
                            @else
                                <input type="text" 
                                       name="subject" 
                                       id="subject" 
                                       class="form-control @error('subject') is-invalid @enderror" 
                                       placeholder="Enter message subject"
                                       value="{{ old('subject') }}"
                                       required>
                            @endif
                            @error('subject')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="form-group">
                            <label for="message" class="font-weight-bold">
                                <i class="fas fa-comment mr-2"></i>Message:
                            </label>
                            <textarea name="message" 
                                      id="message" 
                                      rows="8" 
                                      class="form-control @error('message') is-invalid @enderror" 
                                      placeholder="Type your message here..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
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
@endsection
