<div class="w-100">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Forgot Password</h4>
        </div>
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
                <form id="forgorForm" action="{{ route('post-forgot-password') }}" method="POST">
                    @csrf
                    <div class="form-group p-1 m-1">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" class="form-control" placeholder="example@example.com"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group p-1 m-1 w-100 d-flex flex-column flex-md-row">
                        <button type="submit" name="" class="btn btn-primary">Send</button>
                        <a name="" class="btn btn-link ml-md-auto mt-2 mt-md-0" href="{{ Route('login') }}"
                            role="button">Login</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            $('form#forgorForm').submit(function() {
                $(this).find(':input[type=submit]').prop('disabled', true);
            });

        </script>
    @endpush
</div>
