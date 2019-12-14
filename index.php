<html>
<head>
<?php include ('includes/header.php'); ?>
</head>
<body>
  <nav>
    <?php include ('includes/nav_bar.php'); ?>
</nav>
  <?php
  include ('includes/db-connect.php');

  //$sql = "SELECT * FROM `log` ORDER BY `Sl_pK` DESC LIMIT 20";
  $sql= "SELECT * FROM (
    SELECT * FROM `log` order by `Sl_pK` desc limit 20
) tmp order by tmp.`Sl_pK` asc";
  $waterData=array();
  $moistData=array();
  $res2=mysqli_query($conn, $sql);
    while ($row = $res2->fetch_assoc()){
      array_push($waterData,
                    array(
                        "y" => $row["waterLevel"],
                        "label" => $row["Date"].' '.substr($row['Time'],0,5)

                    )
                );
                          array_push($moistData,
                                        array(
                                            "y" => $row["moist"],
                                            "label" => $row["Date"].' '.substr($row['Time'],0,5)

                                        )
                                    );
                           
    }
    //echo '<br/> ';
    //print_r($humidData);
    //echo '<br/> ';
    ?>
    <script>
window.onload = function () {

var chartWater = new CanvasJS.Chart("chartwaterContainer", {
	title: {
		text: "Water Level"
	},
	axisY: {
		title: "Water level"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($waterData, JSON_NUMERIC_CHECK); ?>
	}]
});

var chartMoisture = new CanvasJS.Chart("chartMoistureContainer", {
	title: {
		text: "Moisture"
	},
	axisY: {
		title: "Moisture"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($moistData, JSON_NUMERIC_CHECK); ?>
	}]
});
chartWater.render();
chartMoisture.render();

}
</script>
<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <?php
          $sql = "SELECT * FROM `log` ORDER BY `Sl_pK` DESC LIMIT 1";
          $res2=mysqli_query($conn, $sql);
            while ($row = $res2->fetch_assoc()){
          ?>
          <div class="">
            <center>
              <h4>Latest reading</h4>
            </center>
            <div class="row">
              <div class="col l6 s6">
                <h5>
                  Water Level:<span class="waterPrevious"> <?php echo $row['waterLevel'].'%'; ?></span>
                </h5>
              </div>

              <div class="col l6 s6">
                <h5>
                  Moisture: <span class="moistPrevious"><?php echo $row['moist']."%"; ?></span>
                </h5>
              </div>


            </div>
          </div>
          <?php }
       ?>
    </div>
    <div class="">

    </div>
    <center>
        <h3>Previous Trends</h3>
    </center>

    <div class="col s12 l6">
        <div id="chartwaterContainer" class="chart"></div>
    </div>
    <div class="col s12 l6">
        <div id="chartMoistureContainer" class="chart"></div>
    </div>
  </div>
  
</div>

</body>
</html>
