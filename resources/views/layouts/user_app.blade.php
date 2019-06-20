<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('public/admin/css/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/css/app.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <title>Employee Management System</title>
</head>
<body class="grey lighten-4">
    <!-- 
        This is the default layout that's going to be used in all views
        except for login because i want a login without a navbar
     -->
    <!-- Include Navbar with this layout -->
    @include('inc.user_navbar')
    <main>
        @yield('content')
    </main>
    <!-- Include Footer -->
    @include('inc.footer')
    <script src="{{asset('public/admin/js/jquery.js')}}"></script>
    <script src="{{asset('public/admin/js/materialize.js')}}"></script>
    <script src="{{asset('public/admin/js/app.js')}}"></script>
    <!-- Include the Script after materialize.js is loaded -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>  
         $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to delete?",
                  text: "Once Delete, This will be Permanently Delete!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Safe Data!");
                  }
                });
            });
    </script>

    @include('inc.message')
</body>
</html>