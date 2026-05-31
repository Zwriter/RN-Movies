@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Edit Genre</h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.genres.update', $genre) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Genre slug</label>
                            <input name="genre" value="{{ old('genre', $genre->genre) }}" class="form-control bg-dark text-white border-secondary" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input name="title" value="{{ old('title', $genre->title) }}" class="form-control bg-dark text-white border-secondary" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="4">{{ old('description', $genre->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image URL</label>
                            <input name="img" value="{{ old('img', $genre->img) }}" class="form-control bg-dark text-white border-secondary" />
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Save Genre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
