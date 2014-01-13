<div class="header">
    <h3 class="text-muted"><?php echo isset($title) ? $title : APP_NAME; ?></h3>
</div>
<ul class="nav nav-tabs" style="margin-bottom: 10px;">

	<?php
		$navigations = array(
			'home/'                  => 'Home',
			'client/'                => 'Client',
			'professional_services/' => 'Professional Services',
			'client_services/'       => 'Client Services'
		);


		$i = 0;
		foreach ($navigations as $key => $value) {
			echo (NAV_ACTIVE_ID == $i) ? '<li class="active">' : '<li>';
			echo '<a href="'. base_url().$key .'">'. $value .'</a>';
			echo '</li>';
			$i++;
		}
	?>
</ul>