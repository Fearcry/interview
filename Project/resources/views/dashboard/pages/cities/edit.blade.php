@extends('layouts.backend')
@section('body')
    @include('dashboard.particles.page-header',['title'=>$city->name.' city is editing'])
    <div>
        <a  class="btn btn-outline-dark" href="{{  route('dashboard.cities',['id'=>$city->country_id]) }}" role="button">< Back</a>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            @error('name')
                <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
            @enderror
            <form action="{{ route('post-dashboard.cities.edit') }}" method="POST" class="form-inline mt-3">
                @csrf
                <div class="form-group flex-column">
                    <div class="w-100 text-left">City Name</div>
                    <input type="hidden" name="id" class="form-control" placeholder="" value="{{ $city->id }}" >
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ $city->name }}" required>

                </div>
                <div class="form-group ml-3 mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
