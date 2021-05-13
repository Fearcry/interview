@extends('layouts.backend')
@section('body')
    @include('dashboard.particles.page-header',['title'=>'Editing '.$user->email. ($admin ? ' Admin user':' Standart user') ])
    <div class="card">
        <div class="card-body">
            @if ($admin)
                <form action="{{ route('post-dashboard.user.edit.admin') }}" method="POST">
                @else
                    <form action="{{ route('post-dashboard.user.edit.standart') }}" method="POST">
            @endif
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" class="form-control" placeholder="" value="{{ $user->id }}">
                <label for="">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="" value="{{ $user->name }}" required>
                    @error('name')
                    <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="" value="{{ $user->email }}" required>
                    @error('email')
                    <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
            @if ($admin)
                <form action="{{ route('post-dashboard.user.password.admin') }}" method="POST">
                @else
                    <form action="{{ route('post-dashboard.user.password.standart') }}" method="POST">
            @endif
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" class="form-control" placeholder="" value="{{ $user->id }}">
                <label for="">New Password</label>
                <input type="password" name="password" id="" class="form-control" placeholder="" required>
                @error('password')
                <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="">New Password Confirm</label>
                <input type="password" name="password_confirmation" id="" class="form-control" placeholder="" required>
                    @error('password_confirmation')
                    <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
            </form>
        </div>
    </div>
@endsection
