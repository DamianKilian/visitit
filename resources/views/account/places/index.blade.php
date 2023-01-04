@extends('layouts.account')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-sm-3">
        <h1 class="bd-title mb-0">{{ __("Places added by you") }}</h1>
        <a class="btn btn-dark float-end my-3 my-sm-0" href="{{ route('places.create') }}">
            {{ __("Create place") }}
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
@endsection
