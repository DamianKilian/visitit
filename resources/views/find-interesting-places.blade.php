@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('place', ['slug' => 'slug-placeholder']) }}">place</a>
        </div>
    </div>
</div>
@endsection
