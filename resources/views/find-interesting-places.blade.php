@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Find intresting places</h1>
            <div id="find-places"></div>
        </div>
    </div>
</div>
@endsection

@section('scriptsUp')
    <script>
        window.getPlacesUrl = "{{ route('api.get.places') }}";
        window.autocompleteUrl = "{{ route('api.autocomplete') }}";
    </script>
@endsection
