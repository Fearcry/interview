<div class="w-100">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Register</h4>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success p-2 mt-2 ">
                    <div><strong>Success</strong></div>
                    <div>{{ session()->get('success') }} </div>
                </div>
            @else
                @error('create')
                    <div class="alert alert-danger p-2 mt-2 ">
                        <div><strong>Error</strong></div>
                        <div> {{ $message }}</div>
                    </div>
                @enderror
                <form id="registerForm" method="POST" action="{{ route('post-register') }}"
                    onsubmit="document.getElementById('submit').disabled=true;">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="">
                        @error('name')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="name">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="example@example.com"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" class="form-control" placeholder=""
                            aria-describedby="helpId" required>
                        @error('password')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder=""
                            required>
                        @error('password_confirmation')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group p-1 m-1 w-100 d-flex flex-column flex-md-row">
                        <a name="" class="btn btn-link  mt-2 mt-md-0" href="{{ Route('login') }}"
                            role="button">Login</a>
                        <button type="submit" name="" class="btn btn-primary ml-md-auto ">Register</button>

                    </div>
                </form>
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            $('form#registerForm').submit(function() {
                $(this).find(':input[type=submit]').prop('disabled', true);
            });

        </script>
    @endpush
</div>
