<head>
    <base href="">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="assets/admin/media/logos/favicon.ico" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel=" stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->
    <style>
        .select2-selection__rendered {
            color: black !important;
        }


        input[type=text],
        input[type=number] {
            width: 100%;
            padding: 12px 12px;
            margin: 8px 0;
            height: 37px;
            box-sizing: border-box;
        }

        /* input[type=radio] {
            width: 50%;

            height: 37px;
        } */

        .select2-selection__rendered {
            line-height: 33px !important;
        }

        .select2-container .select2-selection--single {
            height: 37px !important;
        }

        .select2-selection__arrow {
            height: 36px !important;
        }

        table thead tr th {
            font-weight: bold !important;
        }

        .table-outer {
            max-width: 100%;
            overflow-x: auto;
            padding: 8px 15px;
            /* background: white; */
            background: #F4F6FE;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(1, 1, 1, 0.05);
            margin-bottom: 15px;
        }

        #kt_content_container .card {
            background-color: #F4F6FE;
        }

        #kt_content_container .card-body {
            min-height: 500px;
        }

        #kt_content_container {
            padding: 1px;
        }
    </style>
</head>
