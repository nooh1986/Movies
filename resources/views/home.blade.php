@extends('layouts.app')

@section('content')

    <div>
        <h2>Home</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">Home</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            {{--top statistics--}}
            <div class="row" id="top-statistics">

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-list"></span>Genres</p>
                                <a href="{{ route('genres.index') }}">Show All</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="genres-count" style="display: none"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-film"></span>Movies</p>
                                <a href="{{ route('movies.index') }}">Show All</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="movies-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-address-book-o"></span>Actors</p>
                                <a href="{{ route('actores.index') }}">Show All</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="actors-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

            </div><!-- end of row -->
            <br>

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between my-2">
                                <h4 class="mb-0">Most Rated</h4>
                                <a href="{{ route('movies.index') }}" class="mx-2 mt-1">Show All</a>
                            </div>
                            

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 15%;">Title</th>
                                    <th>Poster</th>
                                    <th>Vote</th>
                                    <th>Vote Count</th>
                                    <th>Release Date</th>
                                </tr>

                                @foreach ($mostRateds as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td><a href="{{ route ('movies.show' , $movie->id) }}">
                                            <img src="{{ $movie->poster_path }}" style="width: 100px;" alt=""></a>
                                        </td>
                                        <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_data }}</td>
                                    </tr>
                                @endforeach
                            </table>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row -->
            <br>
            
            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between my-2">
                                <h4 class="mb-0">Latest Movies</h4>
                                <a href="{{ route('movies.index') }}" class="mx-2 mt-1">Show All</a>
                            </div>
                            

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">Title</th>
                                    <th>Vote Count</th>
                                    <th>Release Date</th>
                                </tr>

                                @foreach ($latestMovies as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_data }}</td>
                                    </tr>
                                @endforeach
                            </table>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row -->
            <br>

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between my-2">
                                <h4 class="mb-0">Latest Users</h4>
                                <a href="{{ route('users.index') }}" class="mx-2 mt-1">Show All</a>
                            </div>
                            

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">Name</th>
                                    <th>Email</th>
                                    <th>Release Date</th>
                                </tr>

                                @foreach ($latestUsers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                            </table>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </div>    

    </div>    
        
@endsection



@push('scripts')

    <script>

        $(function()
        {
            $.ajax({
                url: "{{route('statistics')}}",
                success: function(data){
                    $('#top-statistics .loader').hide();
                    $('#top-statistics #genres-count').show().text(data.genreCount);
                    $('#top-statistics #movies-count').show().text(data.movieCount);
                    $('#top-statistics #actors-count').show().text(data.actorCount);
                }
            })
        })

    </script>

@endpush
