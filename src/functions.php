<?php 
/*
 * Funciones del plugin
 * Se pueden usar tanto en admin como en frontend.
 *  
 * No dependen de ninguna variable de otro ámbit
 */

function ntk_displayNotikumiScript($atts){
	global $NotikumiWPimpl;
	$devOptions = $NotikumiWPimpl->getAdminOptions();
	if(empty($devOptions['secret']) || empty($devOptions['apikey'])){
		return "<h2>Plugin de notikumi no configurado.</h2>
		<p>Para configurar el widget debes acceder al panel privado y rellenar las claves.</p>
		<p>Ver <a href=\"http://www.notikumi.com/static/resources/wordpress\" target=\"_blank\">documentación completa</a></p>";
	}
	else {
		return ntk_getEmbedCode($devOptions);
	}

}

function ntk_getEmbedCode($options){
	$output = '<script src="http://www.notikumi.com/js/widget/widget.js?';
	if(!empty($options['apikey'])){
		$output .= 'key='.$options['apikey'];
	}
	if(!empty($options['notikumiWP_tipo'])){
		if($options['notikumiWP_tipo']==1){
			$output .= '&type=3';


			if(!empty($options['notikumiWP_purlPlaceSelector'])){
				$output .= '&c='.$options['notikumiWP_purlPlaceSelector'];
			}
			
			if(!empty($options['notikumiWP_purlProvincSelector'])){
				$output .= '&p='.$options['notikumiWP_purlProvincSelector'];
			}
			
			if(!empty($options['notikumiWP_tematic'])){
				if($options['notikumiWP_tematic'] != -1){
					$output .= '&t='.$options['notikumiWP_tematic'];
				}
				else if(!empty($options['notikumiWP_tematicPurl'])){
					$output .= '&t='.$options['notikumiWP_tematicPurl'];
				}
				
			}
			if(!empty($options['notikumiWP_tiempo'])){
				$output .= '&ft='.$options['notikumiWP_tiempo'];
			}
		}
		else {
			$output .= '&type=2';
			if(!empty($options['notikumiWP_urlEvento'])){
				$output .= '&purl='.ntk_cleanUrl($options['notikumiWP_urlEvento']);
			}
			if(!empty($options['notikumiWP_description'])){
				$output .= '&desc='.$options['notikumiWP_description'];
			}
		}
	}


	if(!empty($options['notikumiWP_compartir'])){
		$output .= '&sh='.$options['notikumiWP_compartir'];
	}
	if(!empty($options['notikumiWP_mapa'])){
		$output .= '&map='.$options['notikumiWP_mapa'];
	}
	
	
	if(!empty($options['notikumiWP_size'])){
		$output .= '&size='.$options['notikumiWP_size'];
		
		if($options['notikumiWP_size']=="custom"){
			if(!empty($options['notikumiWP_width'])){
				$output .= '&w='.$options['notikumiWP_width'];
			}
			if(!empty($options['notikumiWP_widthM'])){
				$output .= '&wm='.$options['notikumiWP_widthM'];
			}
			if(!empty($options['notikumiWP_height'])){
				$output .= '&h='.$options['notikumiWP_height'];
			}
			if(!empty($options['notikumiWP_heightM'])){
				$output .= '&hm='.$options['notikumiWP_heightM'];
			}
		}
	}
	else {
		
	}
	
	/**
	 * TODO añadir soporte para color
	 * comprobar que es premium
	 */
	if(!empty($options['notikumiWP_linkColor'])){
		$output .= '&lCol='.$options['notikumiWP_linkColor'];
	}
	if(!empty($options['notikumiWP_textColor'])){
		$output .= '&tCol='.$options['notikumiWP_textColor'];
	}
	if(!empty($options['notikumiWP_backColor'])){
		$output .= '&bCol='.$options['notikumiWP_backColor'];
	}
	if(!empty($options['notikumiWP_borderColor'])){
		$output .= '&boCol='.$options['notikumiWP_borderColor'];
	}
	

	if(!empty($options['notikumiWP_signature'])){
		$output .= '&signature='.$options['notikumiWP_signature'];
	}

	$output .= '" type="text/javascript" charset="UTF-8"></script>';
	$output .= 'Powered by <a class="ntk_foot" href="http://www.notikumi.com" target="_blank">notikumi</a>';

	return $output;
}

function ntk_cleanUrl($url){
	if(empty($url)) return null;
	$url = str_replace("http://www.notikumi.com/","",$url);
	$url = str_replace("http://notikumi.com/","",$url);
	$url = str_replace("https://www.notikumi.com/","",$url);
	$url = str_replace("https://notikumi.com/","",$url);
	$url = str_replace("www.notikumi.com/","",$url);
	$url = str_replace("notikumi.com/","",$url);
	$url = str_replace("?","",$url);
	$count = 3;
	$url = str_replace("/","-",$url,$count);
	return $url;
}
?>