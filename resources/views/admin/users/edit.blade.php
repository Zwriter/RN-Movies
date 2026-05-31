@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Edit User</h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" value="{{ old('name', $user->name) }}" class="form-control bg-dark text-white border-secondary" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" value="{{ old('email', $user->email) }}" class="form-control bg-dark text-white border-secondary" />
                        </div>

                        <div class="form-check form-switch text-white mb-4">
                            <input class="form-check-input" type="checkbox" name="is_admin" id="isAdmin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isAdmin">Administrator</label>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
