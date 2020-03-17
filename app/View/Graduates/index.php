<h1>Graduates List</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Reference Number</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Center</th>
            <th>Issued Date</th>
            <th>Assessment Date</th>
            <th>Assessment Result</th>
            <th>Recommendation</th>
            <th>Assessed By</th>
            <th>Attested By</th>
          </tr>
        </thead>
        <tbody>
        	<?php
    		foreach ($graduates as $value) {
    			$log = $value["Graduate"];

                $result = $log['assessment_result'];
                switch($result) {
                    case 0: 
                        $result = "Passed";
                        break;
                    case 1: 
                        $result = "Failed";
                        break;
                };

    			echo "<tr>";

    			echo "<td>" .$log['reference_number']. "</td>";
    			echo "<td>" .$log['first_name']. "</td>";
                echo "<td>" .$log['middle_name']. "</td>";
    			echo "<td>" .$log['last_name']. "</td>";
    			echo "<td>" .$log['email_address']. "</td>";
    			echo "<td>" .$log['center']. "</td>";
    			echo "<td>" .$log['issued_date']. "</td>";
    			echo "<td>" .$log['assessment_date']. "</td>";
    			echo "<td>" .$result. "</td>";
    			echo "<td>" .$log['recommendation']. "</td>";
                echo "<td>" .$log['assessed_by']. "</td>";
                echo "<td>" .$log['attested_by']. "</td>";


    			echo "</tr>";
    		}
        	?>
        </tbody>
      </table>
    </div>
    	<div style="float:right">
		    <?php 
	      		echo $this->Paginator->prev('« Previous  ', null, null, array('class' => 'disabled'));
	      		echo $this->Paginator->numbers();
				echo $this->Paginator->next('  Next »', null, null, array('class' => 'disabled'));
		    ?>
  		</div>
  </div>
</div>