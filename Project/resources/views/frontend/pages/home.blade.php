@extends('layouts.frontend')
@section('body')
    <div class="container d-flex justify-content-center align-items-center flex-column ">


        @if (auth()->check())
            @include('frontend.particles.profile',$tasks)
            @include('frontend.particles.tasks')
        @else
            <div class="card my-auto m-2">
                <div class="card-body">
                    <div class="my-auto">
                        <h2>Welcome</h2>
                        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum quam tenetur nisi
                            veritatis libero
                            nemo ipsa explicabo, ea quisquam pariatur velit similique qui dolorem ipsum! Sapiente odio
                            facere
                            odit. Reprehenderit?</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>
@endsection
