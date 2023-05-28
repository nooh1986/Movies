@extends('layouts.app')

@section('content')

    <div>
        <h2>Change Password</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">Change Password</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    

                    {{--old_password--}}
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" name="old_password" class="form-control" value="" required>
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" value="" required>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" value="" required>
                    </div>

                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection