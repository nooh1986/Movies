<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta name="description" content="">

    <title>{{ config('app.name') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main-teal.css') }}" media="all">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">

    
    {{--jquery--}}
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('assets/plugins/noty/noty.min.js') }}"></script>

    {{--datatable--}}
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery.dataTables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/dataTables.bootstrap/dataTables.bootstrap.min.js') }}"></script>

    {{--magnific-popup--}}
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/magnific-popup/magnific-popup.css') }}">

    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">

    <style>
        .loader {
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        .loader-sm {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #009688;
            width: 40px;
            height: 40px;
        }

        .loader-md {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #009688;
            width: 90px;
            height: 90px;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="app sidebar-mini">

    @include('layouts.header')

    @include('layouts.aside')

    <main class="app-content">

        @yield('content')

        <div class="modal fade general-modal" id="add-brand" aria-labelledby="add-brand" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>

                </div>
            </div>
        </div>

    </main><!-- end of main -->

    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    {{--select 2--}}
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{--ckeditor--}}
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>

    {{--magnific-popup--}}
    <script src="{{ asset('assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    {{--apex chart--}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{--custom--}}
    <script src="{{ asset('assets/js/custom/index.js') }}"></script>
    <script src="{{ asset('assets/js/custom/roles.js') }}"></script>

    <script>
        $(document).ready(function () {

            //delete
            $(document).on('click', '.delete, #bulk-delete', function (e) {

                var that = $(this)

                e.preventDefault();

                var n = new Noty({
                    text: "@lang('site.confirm_delete')",
                    type: "alert",
                    killer: true,
                    buttons: [
                        Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                            let url = that.closest('form').attr('action');
                            let data = new FormData(that.closest('form').get(0));

                            let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                            let originalText = that.html();
                            that.html(loadingText);

                            n.close();

                            $.ajax({
                                url: url,
                                data: data,
                                method: 'post',
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function (response) {

                                    $("#record__select-all").prop("checked", false);

                                    $('.datatable').DataTable().ajax.reload();

                                    new Noty({
                                        layout: 'topRight',
                                        type: 'alert',
                                        text: response,
                                        killer: true,
                                        timeout: 2000,
                                    }).show();

                                    that.html(originalText);
                                },

                            });//end of ajax call

                        }),

                        Noty.button("@lang('site.no')", 'btn btn-danger mr-2', function () {
                            n.close();
                        })
                    ]
                });

                n.show();

            });//end of delete

        });//end of document ready

        CKEDITOR.config.language = "{{ app()->getLocale() }}";

        //select 2
        $('.select2').select2({
            'width': '100%',
        });

    </script>

    @stack('scripts')

</body>
</html>