@extends('admin.layouts.app')

@section('title', __('Detail of Rates'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Rates') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of rate.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('rates.index') }}">{{ __('Rates') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $rate->user ? $rate->user->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Sender') }}</td>
                                        <td>{{ $rate->sender ? $rate->sender->id : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Extra') }}</td>
                                            <td>{{ $rate->extra }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Anonymous') }}</td>
                                        <td>{{ $rate->anonymous == 1 ? 'True' : 'False' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Avg') }}</td>
                                            <td>{{ $rate->avg }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Request') }}</td>
                                            <td>{{ $rate->request }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $rate->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $rate->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
