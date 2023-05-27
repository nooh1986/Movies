@extends('layouts.app')

@section('content')

    <div>
        <h2>Movies</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">Movies</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        <form method="post" action="{{ route('movies.bulk_delete') }}" style="display: inline-block;">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="record_ids" id="record-ids">
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i>Bulk delete</button>
                        </form><!-- end of form -->
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="Search">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <select id="genre" class="form-control select2" required>
                                <option value="">All Genres</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ $genre->id == request()->genre_id ? 'selected' : '' }}>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <select id="actor" class="form-control select2" required>
                                <option value="">All Actors</option>
                                @foreach ($actors as $actor)
                                    <option value="{{ $actor->id }}" {{ $actor->id == request()->actor_id ? 'selected' : '' }}>{{ $actor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="genres-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>Poster</th>
                                    <th>Title</th>
                                    <th>Genres</th>
                                    <th>Vote</th>
                                    <th>Vote Count</th>
                                    <th>Release Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>

        let genre = "{{ request()->genre_id }}";
        let actor = "{{ request()->actor_id }}";

        let genresTable = $('#genres-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route('movies.data') }}',

                data: function (params) {
                    params.genre_id = genre;
                    params.actor_id = actor;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'poster', name: 'poster' , searchable: false , sortable: false},
                {data: 'title', name: 'title', width: '15%'},
                {data: 'genres', name: 'genres', searchable: false},
                {data: 'vote', name: 'vote'},
                {data: 'vote_count', name: 'vote_count'},
                {data: 'release_data', name: 'release_data'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[5, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#genre').on('change' , function(){
            genre = this.value;
            genresTable.ajax.reload();
        })

        $('#actor').on('change' , function(){
            actor = this.value;
            genresTable.ajax.reload();
        })

        $('#data-table-search').keyup(function () {
            genresTable.search(this.value).draw();
        })
    </script>

@endpush