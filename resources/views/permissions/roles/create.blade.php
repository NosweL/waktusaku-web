@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Roles and Permission</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Create Roles</h2>
            <div class="card" style="border-radius: 15px;">
                <div class="card-header">
                    <h4>Form Create Role</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Role Name" value="{{ old('name') }}"
                                style="border-radius: 15px;">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Guard Name</label>
                            <input type="text" class="form-control @error('guard_name') is-invalid @enderror"
                                id="guard_name" name="guard_name" placeholder="Web" value="{{ old('guard_name', 'web') }}"
                                style="border-radius: 15px;">
                            @error('guard_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('role.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
