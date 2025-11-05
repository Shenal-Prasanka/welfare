@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="m-0 font-weight-bold">{{ __('Loan Interest Details') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="40%">{{ __('ID') }}</th>
                                            <td>{{ $loaninterest->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Months') }}</th>
                                            <td><strong>{{ $loaninterest->months }} Months</strong></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Interest Rate') }}</th>
                                            <td><span class="badge bg-success fs-6">{{ $loaninterest->interest }}%</span></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Created At') }}</th>
                                            <td>{{ $loaninterest->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Updated At') }}</th>
                                            <td>{{ $loaninterest->updated_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('loaninterests.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> {{ __('Back to List') }}
                            </a>
                            <a href="{{ route('loaninterests.edit', $loaninterest->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> {{ __('Edit') }}
                            </a>
                            <form action="{{ route('loaninterests.destroy', $loaninterest->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                                    <i class="bi bi-trash"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
