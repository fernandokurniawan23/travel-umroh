@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 d-flex justify-content-between">
                <h1 class="m-0">{{ __('Edit User') }}</h1>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">{{ __('Nama') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }} (Biarkan kosong jika tidak ingin diubah)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <label for="role">{{ __('Role') }}</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="ketua" {{ old('role', $user->role) === 'ketua' ? 'selected' : '' }}>{{ __('Ketua') }}</option>
                                    <option value="sekretaris" {{ old('role', $user->role) === 'sekretaris' ? 'selected' : '' }}>{{ __('Sekretaris') }}</option>
                                    <option value="bendahara" {{ old('role', $user->role) === 'bendahara' ? 'selected' : '' }}>{{ __('Bendahara') }}</option>
                                    <option value="administrasi" {{ old('role', $user->role) === 'administrasi' ? 'selected' : '' }}>{{ __('Administrasi') }}</option>
                                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection