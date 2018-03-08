<?php


    echo'
    <script src="'.base_url().'../assets/js/jquery.min.js"></script>
    <script src="'.base_url().'../assets/js/bootstrap.min.js"></script>
    <script src="'.base_url().'../assets/js/sidebar-nav.min.js"></script>
     <script src="'.base_url().'../assets/chartjs/chart.min.js"></script>
    <script src="'.base_url().'../assets/js/custom.js"></script>';


if(isset($trend)){
	if($trend){
    	echo'

    		 <script type="text/javascript">

		var obj='.$trend.';

		var ctx = document.getElementById("trend").getContext("2d");
        
        var myChart = new Chart(ctx, {
              				type: "bar",
                      		data: {
                        		labels: obj.Label,
                        		datasets: [{
                          			label: "Scores",
                           			backgroundColor: [
                                		"#2ecc71",
                                		"#516673",
                                		"#9b59b6"
                              		],
                          			data: obj.Value
                        		}]
	                   		},
	                   		options:{
	                   			responsive:true,
			                   	legend:{
			                   		display:false
			                   	},
		                   		scales :{
			                   		xAxes:[{
			                   			display:true,
			                   			scaleLabel:{
			                   				display: true,
			                   				labelString: "Term"
			                   			}
			                   		}],
			                   		yAxes:[{
			                   			display:true,
			                   			ticks:{
			                   				beginAtZero: true
			                   			},
			                   			scaleLabel:{
			                   				display: true,
			                   				labelString: "Scores (over 100)"
			                   			}
			                   		}],
	                   			},
			                   	title:{
			                   		display:true,
			                   		text:"Performance Trend of your Ward "
			                   	}
	                  		 }
        });
    </script>


    	';
    }
    else{
    	echo'

    		 <script type="text/javascript">
    		 	$(".trend").html("<h1 class=\'text-center\'><i class=\'fa fa-info-circle fa-2x fa-fw\'></i><br>No Record Found</h1>");
    		 </script>
    	';
    }
}

    
   
echo'</body>
</html>

    ';



?>