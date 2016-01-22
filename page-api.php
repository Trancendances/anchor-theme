<?php
header('Content-Type: application/json');

$tab = array(
	"error" => true,
	"error_cause" => "init"
);

if(!empty($_GET['key']) && $_GET['key'] == 6539411322186591658609103509959876481786) {
	$tab['error'] = false;
	$tab['error_cause'] = "";
	
	if(!empty($_GET['action']) && $_GET['action'] == "podcasts_list") {
		$tab = define_tab("podcasts", $tab);
	} else {
		$tab['error'] = true;
		$tab['error_cause'] = "action";
	}
} else {
	$tab['error'] = true;
	$tab['error_cause'] = "key";
}

echo json_encode($tab);

?>
