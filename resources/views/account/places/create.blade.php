@extends('layouts.account')

@section('content')
    <div class="col-md-8">
        <div class="d-sm-flex align-items-center justify-content-between mb-sm-3">
            <h1 class="bd-title mb-0">{{ __('Create place') }}</h1>
        </div>
        {{-- <form action="{{ route('places.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="place-title" class="form-label">{{ __('Place title') }}</label>
                <input value="{{ old('title') }}" name="title" type="text"
                    class="form-control @error('title') is-invalid @enderror" id="place-title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">{{ __('Slug') }}</label>
                <input class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" name="slug"
                    id="slug" type="text">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="excerpt" class="form-label">{{ __('Excerpt') }}</label>
                <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">{{ __('Content') }}</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="3">{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </form> --}}
        <div id="place-form"></div>
    </div>
@endsection

@section('scriptsUp')
    <script>
        window.formAction = "{{ route('places.store') }}";
        window.trixAttachmentUrl = "{{ route('api.trix.attachment') }}";
        window.slugUniqueUrl = "{{ route('api.slug.unique') }}";
        window.old = {
            title: "{{ old('title') }}",
            slug: "{{ old('slug') }}",
            excerpt: "{{ old('excerpt') }}",
            content: "{{ old('content') }}",
        };
        window.error = {
            title: "@error('title'){{ $message }} @enderror",
            slug: "@error('slug'){{ $message }} @enderror",
            excerpt: "@error('excerpt'){{ $message }} @enderror",
            content: "@error('content'){{ $message }} @enderror",
        };
    </script>
@endsection
