@extends('layouts.app')

@section('content')

    <div>
        <h2>Settings</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('settings.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    {{--logo--}}
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control load-image">
                        <img src="{{ Storage::url('uploads/' . setting('logo')) }}" class="loaded-image" alt="" style="display: {{ setting('logo') ? 'block' : 'none' }}; width: 100px; margin: 10px 0;">
                    </div>

                    {{--fav_icon--}}
                    <div class="form-group">
                        <label>Fav Icon</label>
                        <input type="file" name="fav_icon" class="form-control load-image">
                        <img src="{{ Storage::url('uploads/' . setting('fav_icon')) }}" class="loaded-image" alt="" style="display: {{ setting('fav_icon') ? 'block' : 'none' }}; width: 50px; margin: 10px 0;">
                    </div>

                    {{--title--}}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ setting('title') }}">
                    </div>

                    {{--description--}}
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ setting('description') }}</textarea>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ setting('email') }}">
                    </div>

                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection