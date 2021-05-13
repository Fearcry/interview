@extends('layouts.backend')
@section('body')
    @push('styles')
        <link rel="stylesheet" href="{{ mix('css/dashboard/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ mix('css/dashboard/responsive.bootstrap.min.css') }}">
    @endpush
    @include('dashboard.particles.page-header',['title'=>'Users'])
    <div>
        <div class="card">
            <div class="card-body">
                <h5> </h5>
                <div class="d-flex justify-content-between ">
                    <h5>Admin Users</h5>
                    <a role="button" href="{{ route('dashboard.users.admin.create') }}" class="btn btn-outline-dark"> <span data-feather="plus"></span></a>
                </div>
                <div class="mt-5">
                    <table id="adminUsers" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="w-auto">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="width: 125px">
                                        <div class="d-flex">
                                            <div> <a role="button" href="{{ route('dashboard.users.admin.edit', ['id' => $user->id]) }}" class="btn btn-outline-primary btn-sm"> <span
                                                        data-feather="edit"></span></a></div>
                                            <div> <a role="button" href="{{ route('get-dashboard.user.delete.admin',['id'=>$user->id]) }}" class="btn btn-outline-danger btn-sm ml-2"> <span
                                                        data-feather="trash"></span></a></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="w-auto">Actions</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between ">
                <h5>Standart Users </h5>
                <a role="button" href="{{ route('dashboard.users.standart.create') }}" class="btn btn-outline-secondary"> <span data-feather="plus"></span></a>
            </div>
            <div class="mt-5">
                <table id="standartUsers" class=" display responsive nowrap table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="w-auto">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($standart as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="width: 125px">
                                    <div class="d-flex">
                                        <div> <a role="button"
                                                href="{{ route('dashboard.users.standart.edit', ['id' => $user->id]) }}"
                                                class="btn btn-outline-primary btn-sm"> <span
                                                    data-feather="edit"></span></a></div>
                                        <div> <a role="button" href="{{ route('get-dashboard.user.delete.standart',['id'=>$user->id]) }}" class="btn btn-outline-danger btn-sm ml-2"> <span
                                                    data-feather="trash"></span></a></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="w-auto">Actions</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ mix('js/dashboard/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ mix('js/dashboard/jquery.dataTables.min.js') }}"></script>
        <script src="{{ mix('js/dashboard/dataTables.bootstrap5.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#adminUsers').DataTable({
                    responsive: true

                });

                $('#standartUsers').DataTable({
                    responsive: true,

                });
            });

        </script>
    @endpush



@endsection
