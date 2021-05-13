<div class="w-100">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">New Password</h4>
        </div>
        <div class="card-body">
            @if ($errors->has('expired'))
                @error('expired')
                    <div class="alert alert-danger p-2 mt-2 ">
                        <div><strong>Error</strong></div>
                        <div> {{ $message }}</div>
                    </div>
                @enderror
            @else
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
                    <form action="{{ route('post-reset-password') }}" method="POST">
                        @csrf
                        <div class="form-group p-1 m-1 d-flex flex-column">

                            <input type="hidden" name="token" id="" class="form-control" placeholder=""
                                value="{{ $token }}">
                        </div>
                        <div class="form-group p-1 m-1 d-flex flex-column">
                            <label for="Password">New Password:</label>
                            <input type="password" name="password" id="" class="form-control" placeholder="">
                            @error('password')
                                <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group p-1 m-1 d-flex flex-column">
                            <label for="Password">Confirm New Password:</label>
                            <input type="password" name="password_confirmation" id="" class="form-control"
                                placeholder="">
                            @error('password_confirmation')
                                <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group p-1 m-1 w-100 d-flex flex-column flex-md-row">
                            <button type="submit" name="" id="" class="btn btn-primary">Change Password</button>

                        </div>
                    </form>
                @endif
            @endif
        </div>
    </div>

</div>
