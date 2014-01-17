<div class="">
	<?php
		echo $client_services . '<br /><br />';
		$results = json_decode($client_services, true);
		foreach ($results['result'] as $row) {
			foreach ($row['client_service'] as $row2) {
				echo $row2[CLIENT_ID] . '<br />';
			}
		}
	?>

</div>
