<!-- resources/views/tickets.blade.php -->
@extends('layouts.app2')
@push('css')
    <link href="{{ asset('css/tickets.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- Bootstrapの定形コード… -->
<body>
        <!-- ①チャート描画先を設置 -->
        <div class="card shadow mb-4" id="Cashflowestimated">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    Cash Flow</h6>
            </div>
            <canvas id="myChart" style="width: 100%; height: 300px;"></canvas>
        </div>
        <!-- その他内容（任意） -->
        <!-- Current Cash Balance -->
        <div id="cards">
        <div class="col-xl-3 col-md-6 mb-4 cardEllement">
            <div class="card border-left-info shadow h-100 py-2 cardEllement">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Current Cash Balance 
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{number_format($balances->balance)}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto">
                            <a href="{{ url('/balance')}}">
                                <button type="submit" class="btn btn-outline-secondary btn">
                                    <i class="fa-solid fa-pen"></i>
                                </button> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Ready to Settlement -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 cardEllement">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ready to Pay</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($ticket2s)}}</div>
                        </div>
                        
                        <div class="col-auto">
                            <a href="{{ url('/settlement')}}">
                                <button type="submit" class="btn btn-outline-secondary btn">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                </button> 
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <!-- ②Chart.jsの読み込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        
        <!-- ③チャート描画情報の作成 -->
        <script>
            const tickets = @json($tickets);
            console.log(tickets);
            
            const balances = @json($balances->balance);
            console.log(Number(balances));
            
            const data_keys = Object.keys(tickets);
            console.log(data_keys);
            
            const label = [];
            const data = [];
            
            console.log(tickets[0].cfdate);
            
            let cf = Number(balances);
            
            for(var i=0; i< data_keys.length; i++){
                label.push(tickets[i].cfdate);
                cf += (Number(tickets[i].sum_income)-Number(tickets[i].sum_expense));
                data.push(cf);
            };
            
            
            console.log(label);
            console.log(data);

            
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar', // チャートのタイプ
                data: { // チャートの内容
                    labels: label,
                    datasets: [{
                        label: 'Balance Estimated',
                        data: data,
                        backgroundColor: 'rgba(78, 115, 223, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: { // チャートのその他オプション
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                callback: function(label, index, labels) {
                                    return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') +' Yen';
                                }
                            }
                        }]
                    }
                    
                }
            });
        </script>
</body>
@endsection