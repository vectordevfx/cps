<?php
function nameTitles($json,$arrayAlpha){
	// initiate array
	$arrayTracker['success'] = 0;
	$arrayTracker['primary'] = 0;
	$arrayTracker['info'] = 0;
	$arrayTracker['default'] = 0;
	$arrayTracker['warning'] = 0;
	$arrayTracker['danger'] = 0;

	// initiate
	$counterTotalPoints = 0;
	$counter = 0;
	// loop through array
	foreach ($json as $key => $value){
		// check if user set service provider status active, if so we may process item further
		if ($value['active'] == true){
			// loop through array in array
			foreach ($value['fields'] as $key2 => $value2){	
				// Detect if number is integer, otherwise we need to convert letter to number
				if (!is_numeric($value['value'][$key2])){
					$value['value'][$key2] = $arrayAlpha[$value['value'][$key2]];	  
				}
				// check value, start from high to low
				if ($value['value'][$key2] >= 100){					
					$arrayTracker['success'] += 1;
				}elseif($value['value'][$key2] >= 80){						
					$arrayTracker['primary'] += 1;
				}elseif($value['value'][$key2] >= 60){					
					$arrayTracker['info'] += 1;
				}elseif($value['value'][$key2] >= 40){					
					$arrayTracker['default'] += 1;
				}elseif($value['value'][$key2] >= 20){						
					$arrayTracker['warning'] += 1;
				}else{
					$arrayTracker['danger'] += 1;
				}
				// update counter for actual points
				$counter += $value['value'][$key2];		
				// we add 100 points per item to sum up total count
				$counterTotalPoints += 100;	
			}		
		}
	}	
	// loop through our array with results
	// build html
	$sumCounter = 0;
	foreach ($arrayTracker as $key2 => $value2){	
			$sumCounter += $value2;
			echo '<li class="list-group-item">';
		if ($key2 === "success"){
			echo 'Service providers @ 100%';
			echo '<span class="label label-success pull-right">' . $value2 . '</span>';
		}elseif($key2 === "primary"){
			echo 'Service providers @ 80%<span style="color:grey;">+</span>';
			echo '<span class="label label-primary pull-right">' . $value2 . '</span>';
		}elseif($key2 === "info"){
			echo 'Service providers @ 60%<span style="color:grey;">+</span>';
			echo '<span class="label label-info pull-right">' . $value2 . '</span>';
		}elseif($key2 === "default"){
			echo 'Service providers @ 40%<span style="color:grey;">+</span>';
			echo '<span class="label label-default pull-right">' . $value2 . '</span>';
		}elseif($key2 === "warning"){
			echo 'Service providers @ 20%<span style="color:grey;">+</span>';
			echo '<span class="label label-warning pull-right">' . $value2 . '</span>';
		}else{
			echo 'Service providers @ less than 20%<span style="color:grey;">+</span>';
			echo '<span class="label label-danger pull-right">' . $value2 . '</span>';
		}
		echo '</li>';		
	}
	// loop array to convert numbers to percentage
	foreach ($arrayTracker as $key2 => $value2){	
		// calculate percentage based on value
		$result = 100 / $sumCounter * $value2;
		// if float round up to two decimals
		if (is_float($result)){
			$result = number_format((float)$result, 2, '.', '');
		}
		// update array with percentage value
		$arrayTracker[$key2] = $result;
	}
	$arrayTracker['sum'] = $sumCounter;
	// here we return the array with percentages
	return $arrayTracker;
}


// With this function we want to display all active and deactivated items
function checkActiveStatus($json){	
	// initiate
	$counter = 0;
	$counterActive = 0;	
	//loop array
	foreach ($json as $key => $value){	
		foreach ($value['fields'] as $key2 => $value2){
			// check if status is active
			if($value['active'] === true){
				// add to counter when active status has been detected
				$counterActive +=1;
			}	
			// here we count every loop
			$counter +=1;
			// build html
			echo '<li class="list-group-item">';
			echo '<strong>' . $value['title'] . '</strong> ';
			echo '<br><span class="text-muted">' . $value2 . '</span>';
			// check if active status is true
			if ($value['active'] === true){
				echo '<span class="glyphicon glyphicon-ok pull-right" aria-hidden="true" style="color:green;"></span>';
			}else{
				echo '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" style="color:red;"></span>';
			}
			echo '</li>';		
		}
	}	
	// format text for user 
	$result['resultText'] = $counterActive . '/' . $counter;
	// calculate percentage
	$result['progressBar'] = 100 / $counter * $counterActive; // PHP divide, always float
	// float up to two decimals
	$result['progressBar'] = number_format((float)$result['progressBar'], 2, '.', '');
	// return array
	return $result;
}

// Check scores of activated service providers
function fetchScores($json,$arrayAlpha){
	// initiate
	$counterTotalPoints = 0;
	$counter = 0;
	// loop through array!!!
	foreach ($json as $key => $value){
		// check if user set service provider status active, if so we may process item further
		if ($value['active'] == true){
				// loop through array in array
			foreach ($value['fields'] as $key2 => $value2){	
				// Detect if number is integer, otherwise we need to convert letter to number
				if (!is_numeric($value['value'][$key2])){
					$value['value'][$key2] = $arrayAlpha[$value['value'][$key2]];	  
				}
				// build html
				echo '<li class="list-group-item">';
				echo '<strong>' . $value['title'] . '</strong> ';
				echo '<br><span class="text-muted">' . $value2 . '</span>';
				// check value, start from high to low
				if ($value['value'][$key2] >= 100){
					echo '<span class="label label-success pull-right">' . $value['value'][$key2] . '</span>';
				}elseif($value['value'][$key2] >= 80){
					echo '<span class="label label-primary pull-right">' . $value['value'][$key2] . '</span>';
				}elseif($value['value'][$key2] >= 60){
					echo '<span class="label label-info pull-right">' . $value['value'][$key2] . '</span>';
				}elseif($value['value'][$key2] >= 40){
					echo '<span class="label label-default pull-right">' . $value['value'][$key2] . '</span>';
				}elseif($value['value'][$key2] >= 20){
					echo '<span class="label label-warning pull-right">' . $value['value'][$key2] . '</span>';
				}else{
					echo '<span class="label label-danger pull-right">' . $value['value'][$key2] . '</span>';	
				}
				echo '</li>';		
				// update counter for actual points
				$counter += $value['value'][$key2];		
				// we add 100 points per item to sum up total count
				$counterTotalPoints += 100;	
			}			
		}
	}
	// calculate results points
	$result['resultText'] = $counter . '/' . $counterTotalPoints;
	// calculate results in percentage
	$result['progressBar'] = 100 / $counterTotalPoints * $counter;	
	// check if float, and round up to two decimal places
	if (is_float($result['progressBar'])){
		$result['progressBar'] = number_format((float)$result['progressBar'], 2, '.', '');
	}
	// return array
	return $result;	
}

// loop through json data array
function overviewData($json){
	// loop array
	foreach ($json as $key => $value){
		// build html
		echo '
		<div class="media">
		<div class="media-left">
		<a href="' . $value['link'] . '">
		<img class="media-object img-responsive img-max" data-src="holder.js/64x64" alt="64x64" style="" src="' . $value['picture'] . '" data-holder-rendered="true">
		</a>
		</div>
		<div class="media-body">
		<h3 class="media-heading">' . $value['title'] . '</h3>
		<p>' . $value['description'] . '</p>
		<a class="btn btn-success" href="' . $value['link'] . '" target="_blank" role="button">Visit External Website</a>
		</div>
		</div>
		<hr>
		';
	}
}

// check scores of activated service providers
function calculateOverallScore($json,$arrayAlpha){
	// initiate
	$counterTotalPoints = 0;
	$counter = 0;
	// loop through array
	foreach ($json as $key => $value){
		// check if user set service provider status active, if so we may process item further
		if ($value['active'] == true){
			// check if array contains 1+ items
			if (count($value['fields']) > 1){
				// loop through array in array
				foreach ($value['fields'] as $key2 => $value2){	
					// Detect if number is integer, otherwise we need to convert letter to number
					if (!is_numeric($value['value'][$key2])){
						$value['value'][$key2] = $arrayAlpha[$value['value'][$key2]];	  
					}	
					// update counter for actual points
					$counter += $value['value'][$key2];		
					// we add 100 points per item to sum up total count
					$counterTotalPoints += 100;	
				}		
			}else{
				// Detect if number is integer, otherwise we need to convert letter to number
				if (!is_numeric($value['value'][0])){
					$value['value'][0] = $arrayAlpha[$value['value'][0]];	  
				}		
				// update counter for actual points
				$counter +=  $value['value'][0];		
				// we add 100 points per item to sum up total count
				$counterTotalPoints += 100;
			}	
		}
	}
	// calculate results in percentage
	// PHP's division will always return float values
	$result['progressBar'] = 100 / $counterTotalPoints * $counter; 
	
	// we check if the result is actually an integer.., looks nicer when showing the percentage value
	if (!filter_var($result['progressBar'], FILTER_VALIDATE_INT)) {
		// check if float, and round up to two decimal places
		if (is_float($result['progressBar'])){
			$result['progressBar'] = number_format((float)$result['progressBar'], 2, '.', '');
		}
	} 
	// display result
	echo $result['progressBar'];	
}
?>