@extends('layouts.app')
@section('content')
    @if(Auth::check())
        <script>window.location = "/";</script>
    @endif
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <form action="{{ url("/login") }}" method="post">
                        {{ csrf_field() }}
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-4">Sign in</h3>
                            <hr class="my-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Username"
                                       aria-label="Username" aria-describedby="basic-addon2">
                            </div>

                            <div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
