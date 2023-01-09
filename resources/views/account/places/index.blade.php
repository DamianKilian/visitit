@extends('layouts.account')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-sm-3">
        <h1 class="bd-title mb-0">{{ __('Places added by you') }}</h1>
        <a class="btn btn-dark float-end my-3 my-sm-0" href="{{ route('places.create') }}">
            {{ __('Create place') }}
        </a>
    </div>
    <div class="col-md-8">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Title') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $place)
                    <tr>
                        <th>{{ $place->id }}</th>
                        <td>{{ $place->title }}</td>
                        <td class="has-text-right">
                            <a class="btn" target="_blank" href="{{ route('place', $place->slug) }}">{{ __('View') }}</a>
                            <a class="btn" href="{{ route('places.edit', $place->id) }}">{{ __('Edit') }}</a>
                            <a class="btn btn-warning"
                                href="{{ route('places.index', $place->id) }}">{{ __('Disable') }}
                            </a>
                            <a class="btn btn-danger" href="{{ route('places.index', $place->id) }}">{{ __('Remove') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
