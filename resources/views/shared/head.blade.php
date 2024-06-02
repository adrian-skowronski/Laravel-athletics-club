<head>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <script defer src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

        body {
            min-height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .container-fluid.bg-body-tertiary {
            margin-top: auto;
        }
    </style>
</head>
