<?php 
/*
 * Admin functions
 */


/*
 * Tratar el form enviado
 * TODO hacer esto ok, ahora el código es una mierda, ni limpia, ni fija, ni da esplendor. 
 */
function catch_form($devOptions){
	
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	
	if (isset($_POST['notikumiWP_apikey'])) {
		$devOptions['apikey'] = trim($_POST['notikumiWP_apikey']);
	}
	if (isset($_POST['notikumiWP_secret'])) {
		$devOptions['secret'] = trim($_POST['notikumiWP_secret']);
	}

	if (isset($_POST['notikumiWP_tipo'])) {
		$devOptions['notikumiWP_tipo'] = trim($_POST['notikumiWP_tipo']);
	}
	if (isset($_POST['notikumiWP_busquedaTipo'])) {
		$devOptions['notikumiWP_busquedaTipo'] = trim($_POST['notikumiWP_busquedaTipo']);
	}
	if (isset($_POST['notikumiWP_urlBusqueda'])) {
		$devOptions['notikumiWP_urlBusqueda'] = trim($_POST['notikumiWP_urlBusqueda']);
	}
	if (isset($_POST['notikumiWP_urlEvento']) ) {
		$devOptions['notikumiWP_urlEvento'] = trim($_POST['notikumiWP_urlEvento']);
	}

	if (isset($_POST['notikumiWP_city'])) {
		$devOptions['notikumiWP_city'] = trim($_POST['notikumiWP_city']);
	
		if($_POST['notikumiWP_city'] == ""){
			$devOptions['notikumiWP_purlPlaceSelector'] = "";			
		}
		// si ha puesto ciudad
		else {
			// si no ha seleccionado 
			if($_POST['notikumiWP_purlPlaceSelector'] == ""){
				$devOptions['notikumiWP_city'] 				= "";
				$devOptions['notikumiWP_purlPlaceSelector'] = "";
			}
			else {
				$devOptions['notikumiWP_purlPlaceSelector'] = $_POST['notikumiWP_purlPlaceSelector'];
			}
		}		
	}
	
	if (isset($_POST['notikumiWP_purlProvincSelector'])) {
		$devOptions['notikumiWP_purlProvincSelector'] = $_POST['notikumiWP_purlProvincSelector'];
	}
	
	
	if (isset($_POST['notikumiWP_tematic'])) {
		
		$devOptions['notikumiWP_tematic'] = $_POST['notikumiWP_tematic'];
		
		// hay autocompleter
		if($_POST['notikumiWP_tematic'] == -1 ){
			if($_POST['notikumiWP_tematicInput'] != '' && $_POST['notikumiWP_tematicPurl'] != ''){
				$devOptions['notikumiWP_tematic'] = -1;
				$devOptions['notikumiWP_tematicInput'] = $_POST['notikumiWP_tematicInput'];
				$devOptions['notikumiWP_tematicPurl'] = $_POST['notikumiWP_tematicPurl'];
			}
		}		
	}
	if (isset($_POST['notikumiWP_artistas']) ) {
		$devOptions['notikumiWP_artistas'] = $_POST['notikumiWP_artistas'];
	}
	if (isset($_POST['notikumiWP_salas']) ) {
		$devOptions['notikumiWP_salas'] = $_POST['notikumiWP_salas'];
	}
	if (isset($_POST['notikumiWP_tiempo']) ) {
		if($_POST['notikumiWP_tiempo'] == -1 || $_POST['notikumiWP_tiempo'] == ""){
			$devOptions['notikumiWP_tiempo'] = "";
		}
		else {
			$devOptions['notikumiWP_tiempo'] = $_POST['notikumiWP_tiempo'];
		}
		
	}
	if (isset($_POST['notikumiWP_size']) ) {
		$devOptions['notikumiWP_size'] = $_POST['notikumiWP_size'];
	}
	else {
		$devOptions['notikumiWP_size'] = "all";
	}
	if (isset($_POST['notikumiWP_width'])) {
		$devOptions['notikumiWP_width'] = trim($_POST['notikumiWP_width']);
	}
	if (isset($_POST['notikumiWP_widthM'])) {
		$devOptions['notikumiWP_widthM'] = $_POST['notikumiWP_widthM'];
	}
	if (isset($_POST['notikumiWP_height'])) {
		$devOptions['notikumiWP_height'] = trim($_POST['notikumiWP_height']);
	}
	if (isset($_POST['notikumiWP_heightM'])) {
		$devOptions['notikumiWP_heightM'] = $_POST['notikumiWP_heightM'];
	}
	if (!empty($_POST['notikumiWP_compartir'])) {
		$devOptions['notikumiWP_compartir'] 	= 1;
	}
	else {
		$devOptions['notikumiWP_compartir'] 	= 0;
	}
	if (!empty($_POST['notikumiWP_mapa'])) {
		$devOptions['notikumiWP_mapa']			= 1;
	}
	else {
		$devOptions['notikumiWP_mapa']			= 0;
	}
	if (!empty($_POST['notikumiWP_description'])) {
		$devOptions['notikumiWP_description'] 	= 1;
	}
	else {
		$devOptions['notikumiWP_description'] 	= 0;
	}

	if (!empty($_POST['notikumiWP_color'])) {
		$devOptions['notikumiWP_color'] 	= 1;
	}
	else {
		$devOptions['notikumiWP_color'] 	= 0;
	}
	if (isset($_POST['notikumiWP_linkColor']) ) {
		$devOptions['notikumiWP_linkColor'] = trim($_POST['notikumiWP_linkColor']);
	}
	if (isset($_POST['notikumiWP_textColor']) ) {
		$devOptions['notikumiWP_textColor'] = trim($_POST['notikumiWP_textColor']);
	}
	if (isset($_POST['notikumiWP_backColor']) ) {
		$devOptions['notikumiWP_backColor'] = trim($_POST['notikumiWP_backColor']);
	}
	if (isset($_POST['notikumiWP_borderColor']) ) {
		$devOptions['notikumiWP_borderColor'] = trim($_POST['notikumiWP_borderColor']);
	}

	?>
	<div class="updated"><p><strong>Contenido actualizado.</strong></p></div>
	<?php
	
	return $devOptions;
}

function make_signature($devOptions){
	
	/**
	 * Make signature
	 */
	if(!empty($devOptions['apikey']) && !empty($devOptions['secret'])){
	
		$type = 3;
		$id = "";
		if(!empty($devOptions['notikumiWP_tipo'])){
			if($devOptions['notikumiWP_tipo']=="1") {
				$type = 3;
			
				if(!empty($devOptions['notikumiWP_tematic'])){
					if($devOptions['notikumiWP_tematic'] != -1){
						$id .= $devOptions['notikumiWP_tematic'];
					}
					else if(!empty($devOptions['notikumiWP_tematicPurl'])){
						$id .= $devOptions['notikumiWP_tematicPurl'];
					}
					
				}
				if(!empty($devOptions['notikumiWP_purlPlaceSelector'])){
					$id .= $devOptions['notikumiWP_purlPlaceSelector'];
				}
				if(!empty($devOptions['notikumiWP_tiempo'])){
					$id .= $devOptions['notikumiWP_tiempo'];
				}
			
				$id = trim($id);
			}
			else {
				$type = 2;
				$id = ntk_cleanUrl($devOptions['notikumiWP_urlEvento']);
			}
		}
	
		//echo "".$devOptions['apikey']."_".$id."_".$type."_".$devOptions['secret']."<br />	";
		$signature = sha1($devOptions['apikey'].$id.$type.$devOptions['secret']);
		//echo "signature:".$devOptions['notikumiWP_signature'];
	}
	else {
		return "";
	}
	
	return $signature;
	
}
?>
