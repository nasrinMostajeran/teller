@extends('user.layout')

@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
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
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <a href='{{ action("AccountTypeController@deposit") }}'>
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Deposit</h3>

                        <p>Deposit to your accounts.</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </a>  
        </div>    
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <a href='{{ action("AccountTypeController@withdraw") }}'>
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Withdraw</h3>

                        <p>Withdraw from your accounts.</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </a>    
        </div>     
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <a href='{{ action("AccountTypeController@transfer") }}'>
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Transfer</h3>

                        <p>Transfer from your accounts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-swap"></i>
                    </div>
                </div>
            </a>    
        </div>
    </div>    
      <!-- /.row -->  

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Accounts</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
      </section>
    
      <div class="row">
        <div class="col-md-12">

          <div class="card">

            <div class="card-header">
              <h3 class="card-title">Checking </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="card-body p-0">        
                <table class="table table-hover" style="text-align:center;">
                <thead>
                    <tr>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($checkingAccount as $account)
                    <tr>
                      @if(($account->account_id_from)=='0')<td>Deposit</td>
                      @elseif(($account->account_id_to)=='0')<td>Withdraw</td>
                      @else <td>Transfer</td>
                      @endif

                      @if(($account->account_id_from)=='0')<td style="color:#0C0">+{{$account->amount}}</td>
                      @elseif(($account->account_id_to)=='0')<td style="color:#C00">{{$account->amount}}</td>
                      @else <td>{{$account->amount}}</td>
                      @endif

                      <td>{{$account->created_at}}</td>
    
                    </tr>
                  @endforeach
                  </tbody>
                </table>  
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Saving</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
            <table class="table table-hover" style="text-align:center;">
                <thead>
                    <tr>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($savingAccount as $account)
                    <tr>
                      @if(($account->account_id_from)=='0')<td>Deposit</td>
                      @elseif(($account->account_id_to)=='0')<td>Withdraw</td>
                      @else <td>Transfer</td>
                      @endif

                      @if(($account->account_id_from)=='0')<td style="color:#0C0">+{{$account->amount}}</td>
                      @elseif(($account->account_id_to)=='0')<td style="color:#C00">{{$account->amount}}</td>
                      @else <td>{{$account->amount}}</td>
                      @endif

                      <td>{{$account->created_at}}</td>
    
                    </tr>
                  @endforeach
                  </tbody>
                </table>  
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection