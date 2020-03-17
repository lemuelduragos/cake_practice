<h1>Certification Requests</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Qualification Title</th>
            <th>Assessment Date</th>
            <th>Center</th>
            <th>Venue</th>
            <th>Email Address</th>
            <th>Conact Number</th>
            <th>Status</th>
            <th>Request Date</th>
          </tr>
        </thead>
        <tbody>
        	<?php
    		foreach ($requests as $value) {
    			$log = $value["Certificate"];

    			$status = $log['status'];
			    switch($status) {
			    	case 0: 
			        	$status = "Pending";
			        	break;
			      	case 1: 
			        	$status = "Claim Slip Sent";
			        	break;
		        	case 2: 
		        		$status = "Claimed";
		        		break;
			    };

    			echo "<tr>";

    			echo "<td>" .$log['first_name']. "</td>";
    			echo "<td>" .$log['middle_name']. "</td>";
    			echo "<td>" .$log['last_name']. "</td>";
    			echo "<td>" .$log['qualification_title']. "</td>";
    			echo "<td>" .$log['assessment_date']. "</td>";
    			echo "<td>" .$log['center']. "</td>";
    			echo "<td>" .$log['venue']. "</td>";
    			echo "<td>" .$log['email_address']. "</td>";
    			echo "<td>" .$log['contact_number']. "</td>";
    			echo "<td>" .$status. "</td>";
    			echo "<td>" .$log['created']. "</td>";


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