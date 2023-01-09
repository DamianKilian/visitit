@extends('layouts.account')

@section('content')
    <div class="col-md-8">
        <div class="d-sm-flex align-items-center justify-content-between mb-sm-3">
            <h1 class="bd-title mb-0">{{ __('Edit') }} {{ $place->title }}</h1>
        </div>
        <form action="{{ route('places.update', $place->id) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="place-title" class="form-label">{{ __('Place title') }}</label>
                <input value="{{ $place->title }}" name="title" type="text"
                    class="form-control @error('title') is-invalid @enderror" id="place-title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input value="{{ $place->slug }}" name="slug" type="text" value="slug-placeholder">
            <div class="mb-3">
                <label for="excerpt" class="form-label">{{ __('Excerpt') }}</label>
                <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" rows="3">{{ $place->excerpt }}</textarea>
                @error('excerpt')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">{{ __('Content') }}</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="3">{{ $place->content }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
        </form>
    </div>
@endsection
