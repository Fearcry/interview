<div class="w-100">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Login</h4>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success p-2 mt-2 ">
                    <div><strong>Success</strong></div>
                    <div>{{ session()->get('success') }} </div>
                </div>
                @push('scripts')
                    <script>
                        setTimeout(function() {
                            window.location = '{{ route('home') }}'
                        }, 1500);

                    </script>
                @endpush
            @else
                @error('error')
                    <div class="alert alert-danger p-2 mt-2 ">
                        <div><strong>Error</strong></div>
                        <div> {{ $message }}</div>
                    </div>
                @enderror

                <form id="loginForm" action="{{ route('post-login') }}" method="POST">
                    @csrf
                    <div class="form-group p-1 m-1">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="example@example.com">
                        @error('email')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group p-1 m-1 d-flex flex-column">
                        <label for="Password">Password:</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="">
                        @error('password')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror
                        <a name="" id="" class="btn btn-link ml-auto" href="{{ Route('forgot') }}"
                            role="button">Forgot
                            Password?</a>
                    </div>
                    <div class="form-group p-1 m-1 w-100 d-flex flex-column flex-md-row">
                        <button type="submit" name="" id="" class="btn btn-primary">Login</button>
                        <a name="" id="" class="btn btn-success ml-md-auto mt-2 mt-md-0"
                            href="{{ Route('register') }}" role="button">Register</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            $('form#loginForm').submit(function() {
                $(this).find(':input[type=submit]').prop('disabled', true);
            });

        </script>
    @endpush
</div>
