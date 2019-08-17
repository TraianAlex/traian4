<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	
     //load the google visualization module
	 google.load("visualization", "1", {packages:["corechart"]});
     //callback function after loading the library
	 google.setOnLoadCallback(draw_line_chart);
      
	  function draw_line_chart() {
        //intialize new datatable 
		var data = new google.visualization.DataTable();
		//add three columns with labels
        data.addColumn('string', 'Year');
        data.addColumn('number', 'New York');
        data.addColumn('number', 'London');
        //adding three rows in three columns
		data.addRows(3);
        data.setValue(0, 0, '1980');
        data.setValue(0, 1, 7071639);
        data.setValue(0, 2, 6805000);
        data.setValue(1, 0, '1990');
        data.setValue(1, 1, 7322564);
        data.setValue(1, 2, 6829300);
        data.setValue(2, 0, '2000');
        data.setValue(2, 1, 8008278);
        data.setValue(2, 2, 7322400);
        //create Linechart object
        var chart = new google.visualization.LineChart(document.getElementById('chart'));
		//draw the chart
        chart.draw(data, {width: 600, height: 360, title: 'Population by Years'});
      }
</script>

<div class="container page-content">
    <div class="row">
        <div id="chart"></div>
    </div>
</div>