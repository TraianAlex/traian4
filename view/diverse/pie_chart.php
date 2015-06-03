<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load("visualization", "1", {packages:["corechart"]});
      
      // Google Visualization API is loaded.
      google.setOnLoadCallback(draw_pie_chart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function draw_pie_chart() {

      // Create our data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Phase');
        data.addColumn('number', 'Hours spent');
        data.addRows([
          ['Analysis', 10],
          ['Designing', 25],
          ['Coding', 70],
          ['Testing', 15],
          ['Debugging', 30]
        ]);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, {width: 600, height: 360, is3D: true, title: 'Project Overview'});
      }
    </script>

<div class="container page-content">
    <div class="row">
        <div id="chart"></div>
    </div>
</div>