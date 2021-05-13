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
                    @push('scripts')
                        <script>
                            setTimeout(function() {
                                window.location = '{{ route('dashboard') }}'
                            }, 1500);

                        </script>
                    @endpush
                </div>
            </div>

        @else
            @error('error')
                <div class="alert alert-danger p-2 mt-2 ">
                    <div><strong>Error</strong></div>
                    <div> {{ $message }}</div>
                </div>
            @enderror
            <form id="loginForm" action="{{ route('post-dashboard.login') }}" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <label for="floatingInput">Email address</label>
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                </div>
                <div class="form-floating">
                    <label for="floatingPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password">
                </div>


                <div><a name="" class="btn btn-link ml-0 pl-0" href="{{ route('dashboard.forgot') }}" role="button">Forgot Password?</a></div>

                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Sign in</button>

            </form>
        @endif
    </main>
@endsection
@push('scripts')
<script>
    $('form#loginForm').submit(function() {
        $(this).find(':input[type=submit]').prop('disabled', true);
    });

</script>
@endpush
