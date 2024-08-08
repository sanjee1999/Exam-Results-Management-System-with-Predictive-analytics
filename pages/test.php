<?php 
              $label = [];
              $value1 = [];
              $value2 = [];
              $value3 = [];
              $value4 = [];
              $l1=$l2=$l3=$l4=NULL;
              //$row['ica_1_marks']=$row['ica_2_marks']=$row['ica_3_marks']=NULL;

                if($_SERVER["REQUEST_METHOD"]=="POST"){ 
                  if($type=='attendance'){ 
                        $query=queryattend();
                        $result = $conn->query($query);
                        while($row = $result->fetch_assoc()) {
                          $label[] = $row['Reg_No'];
                          $value1[] = $row['Attendance'];
                          $l1="Attendance";
                        }
                  }
                  if($type=='ica'){ 
                    $query=queryica();
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                      $label[] = $row['reg_no'];
                      $value1[] = isset($row['ica_1_marks'])?$row['ica_1_marks']:NULL;
                      $value2[] = isset($row['ica_2_marks'])?$row['ica_2_marks']:NULL;
                      $value3[] = isset($row['ica_3_marks'])?$row['ica_3_marks']:NULL;
                      $l1="ica_1_marks";
                      $l2="ica_2_marks";
                      $l3="ica_3_marks";
                    }
                  }
                  if($type=='final'){ 
                    $query=queryfinal();
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                      $label[] = $row['reg_no'];
                      $value1[] = isset($row['marks_att1'])?$row['marks_att1']:NULL;
                      $value2[] = isset($row['marks_att2'])?$row['marks_att2']:NULL;
                      $value3[] = isset($row['marks_att3'])?$row['marks_att3']:NULL;
                      $value4[] = isset($row['marks_attsp'])?$row['marks_attsp']:NULL;
                      
                      $l1="marks_att1";
                      $l2="marks_att2";
                      $l3="marks_att3";
                      $l4="marks_attsp";
                    }
                  }
                  
                  if($type=='combo' && $sub_code && $batch){
                    $data=comboMarks($conn,$sub_code,$batch);
                    
                    foreach ($data as $row) {
                      $label[] = $row['reg_no'];
                      $value1[] = $row['Final_Result'];
                      $l1="Final result";
                    }
                        
                  }
              }
              ?>
            </div>
          </section>
          <?php
              
              // print_r($value) ;
              // print_r($label) ;
               //header('Content-Type: application/json');
                //echo json_encode(['labels' => $label,'values' => $value]);
              
          ?>
         
         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
         <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
              if(!empty($_POST)){
                echo"
                    <div class='chart'>
                                <canvas id='myChart'></canvas>
                    </div>";
              }
            }
         ?>
<script>
  const ctx = document.getElementById("myChart").getContext('2d');

  new Chart(ctx, {
    type: "line",
    data: {
      labels: <?php echo json_encode($label);?> ,
      datasets: [
        {
          label: "<?php echo $l1; ?>",
          data: <?php echo json_encode($value1);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#884DEE",
          borderWidth: 2,
          tension: 0.4,
        },
        {
          label: "<?php echo $l2; ?>",
          data: <?php echo json_encode($value2);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#F84DEF",
          borderWidth: 2,
          tension: 0.4,
        },
        {
          label: "<?php echo $l3; ?>",
          data: <?php echo json_encode($value3);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#FF0000",
          borderWidth: 2,
          tension: 0.4,
        },
        {
          label: "<?php echo $l4; ?>",
          data: <?php echo json_encode($value4);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#00000",
          borderWidth: 2,
          tension: 0.4,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
</script>