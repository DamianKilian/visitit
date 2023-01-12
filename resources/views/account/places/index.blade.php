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
                @php
                    $placesData = [];
                @endphp
                @foreach ($places as $place)
                    <tr>
                        <td>{{ $place->id }}</th>
                        <td>{{ $place->title }}</td>
                        <td class="has-text-right">
                            <a class="btn" target="_blank"
                                href="{{ route('place', $place->slug) }}">{{ __('View') }}</a>
                            <a class="btn" href="{{ route('places.edit', $place->id) }}">{{ __('Edit') }}</a>

                            @php
                                $placesData[$place->id] = [
                                    "routes" => [
                                        'destroy' => route('places.destroy', $place->id),
                                        'restore' => route('places.restore', $place->id),
                                        'forceDelete' => route('places.force.delete', $place->id),
                                    ],
                                    "trashed" => $place->trashed(),
                                ]
                            @endphp

                            <span class="react-delete-button" data-id="{{ $place->id }}"></span>

                            @if ($place->trashed())
                                @php
                                    $destroyRestoreText = 'Enable';
                                    $destroyRestoreUrl = 'places.restore';
                                    $method = 'PUT';
                                    $c = 'success';
                                @endphp
                            @else
                                @php
                                    $destroyRestoreText = 'Disable';
                                    $destroyRestoreUrl = 'places.destroy';
                                    $method = 'DELETE';
                                    $c = 'warning';
                                @endphp
                            @endif

                            <a class="btn btn-{{ $c }}"
                                onclick="event.preventDefault();document.getElementById('destroy-restore-form{{ $place->id }}').submit();">
                                {{ __($destroyRestoreText) }}
                            </a>
                            <form id="destroy-restore-form{{ $place->id }}"
                                action="{{ route($destroyRestoreUrl, $place->id) }}" method="POST" class="d-none">
                                @csrf
                                @method($method)
                            </form>

                            @if ($place->trashed())
                                <a class="btn btn-danger"
                                    onclick="event.preventDefault();document.getElementById('force-delete-form{{ $place->id }}').submit();">
                                    {{ __('Remove') }}
                                </a>
                                <form id="force-delete-form{{ $place->id }}"
                                    action="{{ route('places.force.delete', $place->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scriptsUp')
    <script>
        window.placesData = @json($placesData);
        window.csrf = "{{ csrf_token() }}";
        window.old = {
            email: "{{ old('email') }}"
        };
        window.error = {
            email: "@error('email'){{ $message }} @enderror",
            pass: "@error('password'){{ $message }} @enderror"
        };
    </script>
@endsection
