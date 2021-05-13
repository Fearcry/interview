<div class="w-100">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-6 col-xl-6 ">
            <div class="card m-2 h-100 ">
                <div class="card-header">
                    <h4 class="card-title">Profile</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row">
                        <div class="align-self-center"><img class="user-avatar" src="{{ asset('/images/user.png') }}"
                                alt="">
                        </div>
                        <div class="align-self-center">
                            <ul class="list-group list-group-flush  border-0">
                                <li class="list-group-item p-0 border-0">
                                    <strong>Name:</strong> {{ auth()->user()->name }}
                                </li>
                                <li class="list-group-item p-0 border-0">
                                    <strong>Email:</strong> {{ auth()->user()->email }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-6 col-xl-6 mt-2 mt-lg-0">
            <div class="card m-2 h-100">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row">

                        <div class="align-self-center w-100">
                            <form action="{{ route('post-change-password') }}" method="POST">
                                @csrf
                                @error('password')
                                    <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                                @enderror
                                @error('password_confirmation')
                                    <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                                @enderror
                                <div class="d-flex flex-column flex-md-row">
                                    <div class="form-group m-2">
                                        <label for="name">New Password</label>
                                        <input type="password" name="password" class="form-control" placeholder=""
                                            aria-describedby="helpId" required>

                                    </div>
                                    <div class="form-group p-0 m-2">
                                        <label for="name">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="" required>

                                    </div>
                                </div>
                                <div>
                                    <div class="form-group p-0 m-2">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
