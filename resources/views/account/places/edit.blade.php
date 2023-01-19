@extends('layouts.account')

@section('content')
    <div class="col-md-8">
        <div class="d-sm-flex align-items-center justify-content-between mb-sm-3">
            <h1 class="bd-title mb-0">{{ __('Edit') }} {{ $place->title }}</h1>
        </div>
        <form action="{{ route('places.update', $place->id) }}" method="POST" id="place-form" style="display: none">
            @method('PUT')
            @csrf
            {{-- <div class="mb-3">
                <label for="place-title" class="form-label">{{ __('Place title') }}</label>
                <input value="{{ $place->title }}" name="title" type="text"
                    class="form-control @error('title') is-invalid @enderror" id="place-title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">{{ __('Slug') }}</label>
                <input class="form-control @error('slug') is-invalid @enderror" value="{{ $place->slug }}" name="slug"
                    id="slug" type="text">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            <div id="react-slug"></div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">{{ __('Excerpt') }}</label>
                <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" rows="3">{{ $place->excerpt }}</textarea>
                @error('excerpt')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="content" class="form-label">{{ __('Content') }}</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="3">{{ $place->content }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label class="form-label">{{ __('Content') }}</label>
                <input value="{{ $place->content }}" id="x" type="hidden" name="content">
                <trix-editor input="x" class="@error('content')border border-3 border-danger @enderror trix-content"></trix-editor>
                @error('content')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
        </form>
    </div>
@endsection

@section('scriptsUp')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        window.slugUniqueUrl = "{{route('api.slug.unique', $place->id)}}";
        window.old = {
            title: "{{ $place->title }}",
            slug: "{{ $place->slug }}"
        };
        window.error = {
            title: "@error('title'){{ $message }} @enderror",
            slug: "@error('slug'){{ $message }} @enderror"
        };
    </script>
@endsection

@section('scripts')
    <script>
        trixLoadAttachment("{{route('api.slug.unique')}}");
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endsection
