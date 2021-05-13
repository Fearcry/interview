@extends('layouts.frontend')
@section('body')
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4  container  h-100 d-flex align-items-center">
        <div class="w-100">
            <div class="card">

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success p-2 mt-2 ">
                            <div><strong>Success</strong></div>
                            <div>{{ session()->get('success') }} </div>
                        </div>
                    @else
                        @error('error')
                            <div class="alert alert-danger p-2 mt-2 ">
                                <div><strong>Error</strong></div>
                                <div> {{ $message }}</div>
                            </div>
                        @enderror
                        <form action="{{ route('post-unverified') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Your account has not been activated yet. If you are having trouble activating,
                                    try resending the activation code.</label>

                            </div>
                            <div class="form-group">
                                <button type="submit"  name="activation" value="resend" class="btn btn-primary">Resend activation code</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
