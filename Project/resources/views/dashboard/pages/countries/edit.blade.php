@extends('layouts.backend')
@section('body')
    @include('dashboard.particles.page-header',['title'=>$country->name.' country is editing'])
    <div>
        <a  class="btn btn-outline-dark" href="{{  route('dashboard.countries') }}" role="button">< Back</a>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            @error('name')
                <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
            @enderror
            <form action="{{ route('post-dashboard.countries.edit') }}" method="POST" class="form-inline mt-3">
                @csrf
                <div class="form-group flex-column">
                    <div class="w-100 text-left">Country Name</div>
                    <input type="hidden" name="id" class="form-control" placeholder="" value="{{ $country->id }}" >
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ $country->name }}" required>

                </div>
                <div class="form-group ml-3 mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
