
<h1><?php echo $name; ?></h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Activity Logs</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Staff Name</th>
            <th>Action</th>
            <th>Description</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
        	<?php
    		foreach ($logs as $value) {
    			$log = $value["Log"];
    			$user = $value['user'];

    			$name = $user['last_name'].", ".$user['first_name']." ".$user['middle_name'];

    			echo "<tr>";

    			echo "<td>" .$name. "</td>";
    			echo "<td>" .$log['action']. "</td>";
    			echo "<td>" .$log['description']. "</td>";
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