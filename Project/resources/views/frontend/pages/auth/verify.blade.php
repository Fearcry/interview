@extends('layouts.frontend')
@section('body')
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4  container  h-100 d-flex align-items-center">
        @if (isset($success))
            <div class="alert alert-success p-2 mt-2 w-100 ">
                <div><strong>Success</strong></div>
                <div>{{ $success }} </div>
            </div>
            @push('scripts')
                <script>
                    setTimeout(function() {
                        window.location = '{{ route('login') }}'
                    }, 1500);

                </script>
            @endpush
        @elseif(isset($error))
            <div class="alert alert-danger p-2 mt-2  w-100">
                <div><strong>Error</strong></div>
                <div> {{ $error }}</div>
            </div>
        @endif
    </div>
@endsection
