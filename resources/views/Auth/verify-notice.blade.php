<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Forgot Password (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="cms/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">your email is not verified , request verifcation email </p>

      <form >

        <div class="row">
          <div class="col-12">
            <button type="button"  onclick="send()" class="btn btn-primary btn-block">verify your email</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <span class="mt-4 mb-1">
        <a href="{{route('logout')}}">logout</a>
      </span>

      <span class="mt-4 mb-1" style="margin-left: 200px">
        <a href="{{route('admins.index')}}"><strong>Contiue  After Varifcation</strong></a>
      </span>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>


<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>


  <script>
    function send() //ارسال ايميل لأستعادة كلمة   المرور
    {
        axios.get('/email/verification-notification')
            .then(function(response) {
                toastr.success(response.data.message);

            })
            .catch(function(error) {
                toastr.error(error.response.data.message);

            });
    }
  </script>
</body>
</html>
