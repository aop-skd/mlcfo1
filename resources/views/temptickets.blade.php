<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グラフ</title>
</head>
<body>
        
        <!-- ①チャート描画先を設置 -->
        <canvas id="myChart" style="width: 100%; height: 300px;"></canvas>
        
        <!-- その他内容（任意） -->
        
        <!-- ②Chart.jsの読み込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        
        <!-- ③チャート描画情報の作成 -->
        <script>
            const tickets = @json($tickets);
            console.log(tickets);
            
            const data_keys = Object.keys(tickets);
            console.log(data_keys);
            
            const label = [];
            const data = [];
            
            console.log(tickets[0].cfdate);
            
            let cf = 0;
            
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
                        label: 'blue',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: { // チャートのその他オプション
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>
</body>
</html>