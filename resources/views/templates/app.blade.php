<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Savings</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    <a class="nav-link active" aria-current="page" href="{{ route('about') }}">about</a>
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.data-staff.index') }}">Data
                            Staff</a>
                    @endif

                    @if (Auth::check() && Auth::user()->role == 'staff')
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('staff.dashboard') }}">Dashboard</a>
                        <a class="nav-link active" aria-current="page" href="{{ route('staff.data-user.index') }}">Data
                            User</a>
                    @endif

                    @if (Auth::check() && Auth::user()->role == 'user')
                        <a class="nav-link active" aria-current="page"
                            href="#">Dashboard</a>
                        {{-- <a class="nav-link active" aria-current="page"
                            href="{{ route('transactions.index') }}">tambah Transaksi</a> --}}
                    @endif

                    @if (Auth::check())
                        <a class="nav-link active" aria-current="page" href="{{ route('logout') }}">Logout</a>
                    @else
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                        <a class="nav-link active" aria-current="page" href="{{ route('signup') }}">signup</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>



    @yield('content')

    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('script')
</body>

</html>
