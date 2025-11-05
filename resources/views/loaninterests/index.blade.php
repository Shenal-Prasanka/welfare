@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="m-0 font-weight-bold">{{ __('Loan Interest Management') }}</h3>
                            <a href="{{ route('loaninterests.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> {{ __('Add New') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10%">{{ __('ID') }}</th>
                                        <th width="30%">{{ __('Months') }}</th>
                                        <th width="30%">{{ __('Interest (%)') }}</th>
                                        <th width="30%">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($loanInterests as $loanInterest)
                                        <tr>
                                            <td>{{ $loanInterest->id }}</td>
                                            <td><strong>{{ $loanInterest->months }} Months</strong></td>
                                            <td>{{ $loanInterest->interest }}%</td>
                                            <td>
                                                <a href="{{ route('loaninterests.show', $loanInterest->id) }}" class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i> {{ __('View') }}
                                                </a>
                                                <a href="{{ route('loaninterests.edit', $loanInterest->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i> {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('loaninterests.destroy', $loanInterest->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                                                        <i class="bi bi-trash"></i> {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('No loan interest rates found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
