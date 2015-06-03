<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
     //load the google visualization module
	 google.load("visualization", "1", {packages:["corechart"]});
     //callback function after loading the library
	 google.setOnLoadCallback(draw_bar_chart);
      
	  function draw_bar_chart() {
        //initialize the object for holiding table data
		var data = new google.visualization.DataTable();
		//add the column in the matrix
        data.addColumn('string', 'Year');
        data.addColumn('number', 'New York');
        data.addColumn('number', 'London');
		//add the row along with data in the row
		data.addRows([
			['1980', 7071639,6805000],
			['1990', 7322564,6829300],
			['2000', 8008278,7322400]
		]);
      	//create the column chart object
        var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
        chart.draw(data, {width: 600, height: 360, title: 'Population by Years',
				   hAxis: {title: 'Year'} , vAxis : {title: 'Population'}
				   });
      }
</script>

<div class="container page-content">
    <div class="row">
        <div id="chart"></div>
    </div>
</div>