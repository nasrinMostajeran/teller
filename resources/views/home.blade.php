<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ATM App</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a ><b>ATM</b>App</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        @if ($message = Session::get('error'))
        <p style="text-align:center; color:#C00; font-size:12px;">{{ $message }}</p>
        @endif
        @if (count($errors) > 0)
            
            <ul>
            @foreach($errors->all() as $error)
            <li style="text-align:center; color:#C00; font-size:12px;">{{ $error }}</li>
            @endforeach
            </ul>
          
        @endif

        <p class="login-box-msg">Enter your PIN number</p>
        <form method="post" action="{{ url('/main/checklogin') }}">
        {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="hidden" name="card_number" value="1034982" readonly  class="form-control" />
            </div>
            <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="PIN number">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div>
            <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="{{ asset('../../plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script>
  $(function() {
    $("#password").inputmask({
      alias: 'numeric', 
      allowMinus: false,  
      digits: 2, 
      max: 99999999
        }).css('text-align','left');
  })
</script>  

</body>
</html>
