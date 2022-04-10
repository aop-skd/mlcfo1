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