@extends('layouts.backend-auth')
@section('body')
    <main class="form-signin">
        @if (session()->has('success'))
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success p-2 mt-2 ">
                        <div><strong>Success</strong></div>
                        <div>{{ session()->get('success') }} </div>
                    </div>
                </div>
            </div>

        @else
            @error('error')
                <div class="alert alert-danger p-2 mt-2 ">
                    <div><strong>Error</strong></div>
                    <div> {{ $message }}</div>
                </div>
            @enderror
            <form id="forgotForm" action="{{ route('post-dashboard.forgot') }}" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Forgot Password</h1>

                <div class="form-floating">
                    <label for="floatingInput">Email address</label>
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                </div>

                <div><a name="" class="btn btn-link ml-0 pl-0" href="{{ route('dashboard.login') }}" role="button">Sign in</a></div>

                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Send</button>

            </form>
        @endif
    </main>
@endsection
@push('scripts')
<script>
    $('form#forgotForm').submit(function() {
        $(this).find(':input[type=submit]').prop('disabled', true);
    });

</script>
@endpush
