@extends('user.layout')

@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href='{{ action("MainController@userindex") }}'>Home</a></li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
      </section>
    
      <div class="row">
        <div class="col-md-8" style="margin: auto;">

          <!-- general form elements -->
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Withdraw</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ url('/transaction/withdraw') }}" id="transactionForm">
              {{ csrf_field() }}
                <div class="card-body">
                    <div class="col-10" style="margin: auto;">
                        <div class="form-group">
                            <label for=fromAccount>From account</label>
                            <select class="form-control" name="account" id="account">
                              <option value="0">Choose account</option>
                              @foreach($accounts as $account)
                              <option value="{{$account->id}}">{{$account->name}}</option>
                              @endforeach  
                            </select>
                        </div>
                    </div> 
                    <div class="col-10" style="margin: auto;">   
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="$" id="amount" disabled>
                        </div>
                    </div>   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col-10" style="margin: auto;">
                      <div class="row">
                        <div class="col-4">
                          <button type="button" class="btn btn-primary" id="transactionBut" disabled onclick="checkFields();">Submit</button>
                        </div>
                        <div class="col-8">  
                          @if(count($errors)>0)
                            <ul style="color:#C00;">
                            @foreach($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                            </ul>
                          @endif
                          @if(\Session::has('success'))
                            <span style="color:#0C0;">{{ \Session::get('success') }}<span>
                          @endif
                          @if(\Session::has('fail'))
                            <span style="color:#C00;">{{ \Session::get('fail') }}<span>
                          @endif
                          <span style="color:#C00;" id="checkFieldsMessage"><span>
                        </div>  
                      </div><!--row--> 
                    </div>   
                </div>
              </form>
            </div>
            <!-- /.card -->

          <!-- /.card -->
          
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <!------------------ Jquery code for field validation -------------------------------
     ====================================================================================-->
     <script>

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });

        /* ----------- enable fields based on selected/entered value --------------*/
        $(document).ready(function(){
            
              $('#account').change(function(){
                var value = $(this).val();
                if(value==0)
                {
                  $("#amount").prop('disabled', true);
                  return;
                }
                else
                {
                  $("#amount").prop('disabled', false);
                  return;
                }
  
              });

              $('#amount').change(function(){
                var value = $(this).val();
                if(value=="")
                {
                  $("#transactionBut").prop('disabled', true);
                  return;
                }
                else
                {
                  $("#transactionBut").prop('disabled', false);
                  return;
                }
  
              });
        });

        /* ----------- check if user entered required fields -------------*/
        function checkFields()
        {
          if($("#account").val()==0)
          {
            $("#transactionBut").prop('disabled', true);
            $("#checkFieldsMessage").html("Choose account.");
            return;
          }
          else if($("#amount").val()=="")
          {
            $("#transactionBut").prop('disabled', true);
            $("#checkFieldsMessage").html("Enter amount.");
            return;
          }
          else
          {
              $("#transactionForm").submit();
          }

        }
        $(function() {
          $('#amount').maskMoney();
        })

    </script>
@endsection