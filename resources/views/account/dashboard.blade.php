@extends('layouts.account')

@section('content')
    <div>Witaj, {{ auth()->user()->name }}</div>
@endsection
