<div class="">
	<?php
		//echo $client_servces . '<br /><br />';
		$results = json_decode($client_services, TRUE);
		$results = $results['result'];		
		foreach ($results as $row) {
			$row = json_decode($row, TRUE);
			$row = $row['client_service'];
			if( count($row) > 0 ){
				echo $row[0]['client_id'] . '</br>' ;			
				echo $row[0]['description'] . '</br>' ;			
			}
		}
	?>

</div>
