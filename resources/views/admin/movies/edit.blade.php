@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Edit Movie</h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.movies.update', $movie) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input name="title" value="{{ old('title', $movie->title) }}" class="form-control bg-dark text-white border-secondary" />
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Year</label>
                                <input name="year" value="{{ old('year', $movie->year) }}" class="form-control bg-dark text-white border-secondary" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Runtime (min)</label>
                                <input name="runtime" value="{{ old('runtime', $movie->runtime) }}" class="form-control bg-dark text-white border-secondary" />
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Excerpt</label>
                            <textarea name="excerpt" class="form-control bg-dark text-white border-secondary" rows="3">{{ old('excerpt', $movie->excerpt) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Plot</label>
                            <textarea name="plot" class="form-control bg-dark text-white border-secondary" rows="4">{{ old('plot', $movie->plot) }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Poster</label>
                                <select name="poster_id" class="form-select bg-dark text-white border-secondary">
                                    <option value="">Choose image</option>
                                    @foreach($images as $image)
                                        <option value="{{ $image->id }}" {{ old('poster_id', $movie->poster_id) == $image->id ? 'selected' : '' }}>{{ $image->URL ?? $image->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Director</label>
                                <select name="director_id" class="form-select bg-dark text-white border-secondary">
                                    <option value="">Choose director</option>
                                    @foreach($directors as $director)
                                        <option value="{{ $director->id }}" {{ old('director_id', $movie->director_id) == $director->id ? 'selected' : '' }}>{{ $director->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Genres</label>
                            <select name="genres[]" class="form-select bg-dark text-white border-secondary" multiple>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', $movie->genres->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $genre->genre }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold CTRL (or CMD) to select multiple genres.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
