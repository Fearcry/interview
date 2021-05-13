@extends('layouts.backend')
@section('body')
    @push('styles')
        <link rel="stylesheet" href="{{ mix('css/dashboard/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ mix('css/dashboard/responsive.bootstrap.min.css') }}">
    @endpush
    @include('dashboard.particles.page-header',['title'=>'Dashboard'])

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="d-flex flex-column">
                <div>
                    <h5>Countries</h5>
                </div>
                <div>
                    @error('name')
                        <div class="alert alert-danger p-2 mt-2 ">{{ $message }}</div>
                    @enderror
                    <form action="{{ route('post-dashboard.countries.create') }}" method="POST" class="form-inline mt-3">
                        @csrf
                        <div class="form-group flex-column">
                            <div class="w-100 text-left">Country Name</div>
                            <input type="text" name="name" class="form-control" placeholder="" required>

                        </div>
                        <div class="form-group ml-3 mt-4">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-2">
                <table id="countries" class=" display responsive nowrap table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th>Country</th>
                            <th class="w-auto">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><a class="btn btn-link bg-light btn-block text-left font-weight-bold" href="{{ route('dashboard.cities',['id'=>$country->id]) }}"
                                        role="button">{{ $country->name }}</a></td>
                                <td style="width: 125px">
                                    <div class="d-flex">
                                        <div> <a role="button"
                                                href="{{ route('dashboard.countries.edit', ['id' => $country->id]) }}"
                                                class="btn btn-outline-primary btn-sm"> <span
                                                    data-feather="edit"></span></a></div>
                                        <div> <a role="button"
                                                href="{{ route('post-dashboard.countries.delete', ['id' => $country->id]) }}"
                                                class="btn btn-outline-danger btn-sm ml-2"> <span
                                                    data-feather="trash"></span></a></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ mix('js/dashboard/jquery.dataTables.min.js') }}"></script>
        <script src="{{ mix('js/dashboard/dataTables.bootstrap5.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#countries').DataTable({
                    responsive: true

                });


            });

        </script>
    @endpush



@endsection
