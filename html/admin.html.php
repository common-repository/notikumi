<?php
/*
 * HTML del back-end, admin del plugin
 */
?>

<form id="searchEvents" action="../" method="post" class="hidden">
	<input type="hidden" name="ajax" value="true">
	<input type="text" name="q" id="q">
</form>

<div id="ntk_form" class=wrap>

	<h2>notikumi admin panel</h2>

	<div class="fr" style="width:48%">
		<h3>Previsualización</h3>
		<div id="widgetTarget">
			<?php 
			if(isset($devOptions['secret']) && isset($devOptions['apikey']) &&  $devOptions['apikey'] != "" && $devOptions['secret'] != "") {
			 	echo ntk_getEmbedCode($devOptions);
			} 
			else {
			?>
			<p>Hasta que no pongas tu clave de API y tu clave secreta no podrás ver la previsualización.</p>
			<?php	
			} 
			?>
		</div>
	</div>
	
	
	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" style="float: left;width: 50%;">
		
		
		<?php if(!isset($devOptions['secret']) || $devOptions['secret']=="") { ?>
		<h3>Instrucciones</h3>
		<ol>
			<li>Introduce tus claves</li>
			<li>Configura qué y cómo quieres mostrar</li>
			<li>Crea una página o post con el contenido: <span style="background-color:#dedede;padding:1px 5px 3px 5px;">[NTK]</span></li>
		</ol>
		<?php } ?>
		
		<div class="h bt1">
			<h3>Claves</h3>
			<p>Estas claves las puedes conseguir en tu <a href="https://www.notikumi.com/users" target="_blank">perfil privado de notikumi</a> sección Claves de API. <br />Si todavía no estás registrado <a href="http://www.notikumi.com/users/register" target="_blank">ahora</a> puede ser un buen momento.</p> 
			<p>
				<label>Clave de API</label>
				<input type="text" id="notikumiWP_apikey" name="notikumiWP_apikey" value="<?php echo $devOptions['apikey']; ?>" style="width:300px" />
			</p>
			<p>
				<label>Clave Secreta</label>
				<input type="text" id="notikumiWP_secret" name="notikumiWP_secret" value="<?php echo $devOptions['secret']; ?>" style="width:300px" />
			</p>
		</div>
		
		
		<div  class="h bt1">
			<h3>Qué contenido quieres</h3>
			
			<div class="h">
				<div style="float:left;width:250px;overflow:hidden">
					<p class="check tp">
						<input type="radio" name="notikumiWP_tipo" value="1" <?php if($devOptions['notikumiWP_tipo']=="1") {echo "checked=checked"; }?>>
						<label>Múltiples eventos</label>
					</p>
				</div>
				<div style="float:left;width:250px;overflow:hidden">	
					<p class="check tp">
						<input type="radio" name="notikumiWP_tipo" value="2" <?php if($devOptions['notikumiWP_tipo']=="2") {echo "checked=checked"; }?>>
						<label>Un único evento</label>
					</p>
				</div>
			</div>
	
	
			<div  class="h" id="tipoAgenda" style="<?php if($devOptions['notikumiWP_tipo']!="1") echo "display:none;";?> clear:both; padding:0 1em;">
				<p class="h3">¿Qué contenido quieres incluir?</p>
				<div id="customAgenda">
					<p class="fld ">
						<label>Ciudad</label>
						<input type="text" name="notikumiWP_city" class="medgrn" id="notikumiWP_city" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" value="<?php echo $devOptions['notikumiWP_city']; ?>">
						<i class="fs90" style="padding-top:5px; padding-left:10px; display:inline-block;">selecciona de la lista que aparezca</i> 
						<input type="hidden" name="notikumiWP_purlPlaceSelector" id="notikumiWP_purlPlaceSelector" value="<?php echo $devOptions['notikumiWP_purlPlaceSelector']; ?>">
					</p>
					<p class="fld ">
						<label>Provincia</label>
						<select name="notikumiWP_purlProvincSelector" id="notikumiWP_purlProvincSelector">
						<option value="">Elige la provincia</option>
						<option value="Alava-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Alava") !== false) echo "selected=selected"; ?>>Álava</option>
						<option value="Albacete" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Albacete") !== false) echo "selected=selected"; ?>>Albacete</option>
						<option value="Alicante-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Alicante") !== false) echo "selected=selected"; ?>>Alicante</option>
						<option value="Almeria-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Almeria") !== false) echo "selected=selected"; ?>>Almeria</option>
						<option value="Asturias-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Asturias") !== false) echo "selected=selected"; ?>>Asturias</option>
						<option value="Avila-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Avila") !== false) echo "selected=selected"; ?>>Avila</option>
						<option value="Badajoz-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Badajoz") !== false) echo "selected=selected"; ?>>Badajoz</option>
						<option value="Illes-Balears-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Balears") !== false) echo "selected=selected"; ?>>Baleares</option>
						<option value="Barcelona-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Barcelona") !== false) echo "selected=selected"; ?>>Barcelona</option>
						<option value="Burgos-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Burgos") !== false) echo "selected=selected"; ?>>Burgos</option>
						<option value="Caceres-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Caceres") !== false) echo "selected=selected"; ?>>Caceres</option>
						<option value="Cadiz-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Cadiz") !== false) echo "selected=selected"; ?>>Cadiz</option>
						<option value="Cantabria" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Cantabria") !== false) echo "selected=selected"; ?>>Cantabria</option>
						<option value="Castello" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Castello") !== false) echo "selected=selected"; ?>>Castellon</option>
						<option value="Ciudad-Real-Castilla-La-Mancha-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Ciudad-Real") !== false) echo "selected=selected"; ?>>Ciudad Real</option>
						<option value="Cordoba-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Cordoba") !== false) echo "selected=selected"; ?>>Cordoba</option>
						<option value="A-Coruna-Galicia" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"A-Coruna") !== false) echo "selected=selected"; ?>>A Coruña</option>
						<option value="Cuenca-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Cuenca") !== false) echo "selected=selected"; ?>>Cuenca</option>
						<option value="Girona-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Girona") !== false) echo "selected=selected"; ?>>Girona</option>
						<option value="Granada-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Granada") !== false) echo "selected=selected"; ?>>Granada</option>
						<option value="Guadalajara-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Guadalajara") !== false) echo "selected=selected"; ?>>Guadalajara</option>
						<option value="Gipuzkoa" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Gipuzkoa") !== false) echo "selected=selected"; ?>>Guipuzkoa</option>
						<option value="Huelva-Andalucia" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Huelva") !== false) echo "selected=selected"; ?>>Huelva</option>
						<option value="Huesca-Aragon" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Huesca") !== false) echo "selected=selected"; ?>>Huesca</option>
						<option value="Jaen-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Jaen") !== false) echo "selected=selected"; ?>>Jaen</option>
						<option value="Las-Palmas" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Las-Palmas") !== false) echo "selected=selected"; ?>>Las Palmas</option>
						<option value="Leon-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Leon") !== false) echo "selected=selected"; ?>>Leon</option>
						<option value="Lleida-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Lleida") !== false) echo "selected=selected"; ?>>Lleida</option>
						<option value="Lugo-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Lugo") !== false) echo "selected=selected"; ?>>Lugo</option>
						<option value="Madrid-Madrid-Madrid-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Madrid") !== false) echo "selected=selected"; ?>>Madrid</option>
						<option value="Malaga-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Malaga") !== false) echo "selected=selected"; ?>>Malaga</option>
						<option value="Murcia-Region-de-Murcia-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Murcia") !== false) echo "selected=selected"; ?>>Murcia</option>
						<option value="Navarra-Navarra-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Navarra") !== false) echo "selected=selected"; ?>>Navarra</option>
						<option value="Ourense-Galicia" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Ourense") !== false) echo "selected=selected"; ?>>Ourense</option>
						<option value="Palencia-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Palencia") !== false) echo "selected=selected"; ?>>Palencia</option>
						<option value="Las-Palmas-de-Gran-Canaria" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Palmas") !== false) echo "selected=selected"; ?>>Las Palmas</option>
						<option value="Pontevedra-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Pontevedra") !== false) echo "selected=selected"; ?>>Pontevedra</option>
						<option value="La-Rioja-La-Rioja-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Rioja") !== false) echo "selected=selected"; ?>>La Rioja</option>
						<option value="Salamanca-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Salamanca") !== false) echo "selected=selected"; ?>>Salamanca</option>
						<option value="Segovia-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Segovia") !== false) echo "selected=selected"; ?>>Segovia</option>
						<option value="Sevilla-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Sevilla") !== false) echo "selected=selected"; ?>>Sevilla</option>
						<option value="Soria-Castilla-y-Leon-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Soria") !== false) echo "selected=selected"; ?>>Soria</option>
						<option value="Tarragona-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Tarragona") !== false) echo "selected=selected"; ?>>Tarragona</option>
						<option value="Santa-Cruz-de-Tenerife-Islas-Canarias" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Santa-Cruz") !== false) echo "selected=selected"; ?>>Tenerife</option>
						<option value="Teruel-Aragon" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Teruel") !== false) echo "selected=selected"; ?>>Teruel</option>
						<option value="Toledo-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Toledo") !== false) echo "selected=selected"; ?>>Toledo</option>
						<option value="Valencia-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Valencia") !== false) echo "selected=selected"; ?>>Valencia</option>
						<option value="Valladolid-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Valladolid") !== false) echo "selected=selected"; ?>>Valladolid</option>
						<option value="Vizcaya-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Vizcaya") !== false) echo "selected=selected"; ?>>Vizcaya</option>
						<option value="Zamora-Castilla-y-Leon-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Zamora") !== false) echo "selected=selected"; ?>>Zamora</option>
						<option value="Zaragoza-Spain" <?php if(strpos($devOptions['notikumiWP_purlProvincSelector'],"Zaragoza") !== false) echo "selected=selected"; ?>>Zaragoza</option></select>
					</p>
					<div class="fld">
						<label>Temática</label>
						<select name="notikumiWP_tematic">
							<option value=""  			<?php if(!isset($devOptions['notikumiWP_tematic'])) echo "selected=selected"; ?>>Selecciona temática</option>
							<option value="conciertos" 	<?php if($devOptions['notikumiWP_tematic'] == "conciertos") echo "selected=selected"; ?>>Conciertos</option>
							<option value="deportes"	<?php if($devOptions['notikumiWP_tematic'] == "deportes") echo "selected=selected"; ?>>Deportes</option>
							<option value="obras-de-teatro" <?php if($devOptions['notikumiWP_tematic'] == "obras-de-teatro") echo "selected=selected"; ?>>Teatro</option>
							<option value="cartelera-de-cine" <?php if($devOptions['notikumiWP_tematic'] == "cartelera-de-cine") echo "selected=selected"; ?>>Cine</option>
							<option value="exposiciones" 	<?php if($devOptions['notikumiWP_tematic'] == "exposiciones") echo "selected=selected"; ?>>Exposiciones</option>
							<option value="-1" 				<?php if($devOptions['notikumiWP_tematic'] == "-1") echo "selected=selected"; ?>>Escribe la que tú quieras</option>
						</select>
						<div class="fld <?php if($devOptions['notikumiWP_tematic'] != "-1"){ ?>hidden<?php } ?> cb">
							<label>&nbsp;</label>
							<input type="text" id="notikumiWP_tematicInput"  class="medgrn" name="notikumiWP_tematicInput" id="notikumiWP_tematicInput" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" value="<?php echo $devOptions['notikumiWP_tematicInput']; ?>">
							<i class="fs90" style="padding-top:5px; padding-left:10px; display:inline-block;">selecciona de la lista que aparezca</i>
							<input type="hidden" name="notikumiWP_tematicPurl" id="notikumiWP_tematicPurl" value="<?php echo $devOptions['notikumiWP_tematicPurl']; ?>">
						</div>
					</div>
					<p class="fld mingap">
						<label>Artista</label>
						<input type="text" disabled="disabled" name="notikumiWP_artistas" value="Todavía no disponible">
					</p>
					<p class="fld mingap">
						<label>Sala</label>
						<input type="text" disabled="disabled" name="notikumiWP_salas" value="Todavía no disponible">
					</p>
					<p class="fld mingap">
						<label>Tiempo</label>
						<select name="notikumiWP_tiempo">
							<option value=""  <?php if(!isset($devOptions['notikumiWP_tiempo'])) echo "selected=selected"; ?>>Selecciona filtro de tiempo</option>
							<option value="1" <?php if($devOptions['notikumiWP_tiempo'] == "1") echo "selected=selected"; ?>>Hoy</option>
							<option value="2" <?php if($devOptions['notikumiWP_tiempo'] == "2") echo "selected=selected"; ?>>Hoy y mañana</option>
							<option value="3" <?php if($devOptions['notikumiWP_tiempo'] == "3") echo "selected=selected"; ?>>Esta semana</option>
							<option value="4" <?php if($devOptions['notikumiWP_tiempo'] == "4") echo "selected=selected"; ?>>Próximo finde</option>
							<option value="6" <?php if($devOptions['notikumiWP_tiempo'] == "6") echo "selected=selected"; ?>>Próximos 30 días</option>
							<option value=""  <?php if($devOptions['notikumiWP_tiempo'] == "")  echo "selected=selected"; ?>>Sin filtro de tiempo</option>
						</select>
					</p>
				</div>
			</div>
	
	
	
			<div  class="h" id="tipoEvento" style="<?php if($devOptions['notikumiWP_tipo']!="2") echo "display:none;";?> clear:both; padding:0 1em;">
				<p class="fld tp cb">
					<label>URL del evento</label>
					<input type="text" id="urlEvento" name="notikumiWP_urlEvento" style="width:200px" value="<?php echo $devOptions['notikumiWP_urlEvento']; ?>">
				</p>
				
				<div class="">								
					<label>Buscar evento</label>
					<input type="text" id="buscadorEventos" autocomplete="off" name="notikumiWP_q" style="margin-left: 20px;width:250px">
					<p><a href="#" class="cleanEventosHolder">Limpiar</a></p>
					<span id="loadingBuscadorEvs" class="editableLoading" style="display:none">
						<img src="http://media.notikumi.com/img/iban/ajax-loader.gif" height="15">
					</span>
				</div>
				
				<div id="eventosHolder" style="padding: 7px 5px;margin-right: 12px;"></div>
			</div>
		</div>
		
		
		
		<div  class="h bt1">
			<h3>Cómo lo quieres</h3>
	
			<p style="clear:both" class="h tp">Tamaño</p>
			<div class="h" style="padding: 0 1em;">
				<div class="fl" style="width:250px">
					<p class="fld check tp">
						<input type="radio" name="notikumiWP_size" value="all" <?php if($devOptions['notikumiWP_size'] == "all") echo "checked=checked"; ?>>
						<label>100% del ancho disponible</label>
					</p>
				</div>
				<div class="fl" style="width:250px">
					<p class="fld check tp">
						<input type="radio" name="notikumiWP_size" value="custom" <?php if($devOptions['notikumiWP_size'] == "custom") echo "checked=checked"; ?>>
						<label>personalizable</label>
					</p>
				</div>
			</div>	
			<div id="customSize" style="<?php if($devOptions['notikumiWP_size'] != "custom") echo "display: none;";?> clear:both; ">			
				<p class="fld tp">
					<label>Anchura</label>
					<input type="text" name="notikumiWP_width" value="<?php if($devOptions['notikumiWP_width'] != "") echo $devOptions['notikumiWP_width']; else {echo "600";} ?>"" style="width:50px">
					<select name="notikumiWP_widthM">
						<option value="px" <?php if($devOptions['notikumiWP_widthM'] == "px") echo "selected=selected"; ?>>px</option>
						<option value="percent" <?php if($devOptions['notikumiWP_widthM'] == "percent") echo "selected=selected"; ?>>%</option>
					</select>
				</p>
				<p class="fld tp">
					<label>Altura</label>
					<input type="text" name="notikumiWP_height" value=" <?php if($devOptions['notikumiWP_height'] != "") echo $devOptions['notikumiWP_height']; else {echo "400";} ?>" style="width:50px">
					<select name="notikumiWP_heightM">
						<option value="px" <?php if($devOptions['notikumiWP_heightM'] == "px") echo "selected=selected"; ?>>px</option>
						<option value="percent" <?php if($devOptions['notikumiWP_heightM'] == "percent") echo "selected=selected"; ?>>%</option>
					</select>
				</p>
			</div>
	
			<p class="fld cb check">
				<input type="checkbox" name="notikumiWP_compartir" <?php if($devOptions['notikumiWP_compartir'] == "1") echo "checked=checked"; ?>  value="on">
				<label>Incluir compartir</label>
			</p>
			<p class="fld cb check">
				<input type="checkbox" name="notikumiWP_mapa" <?php if($devOptions['notikumiWP_mapa'] == "1") echo "checked=checked"; ?>  value="on">
				<label>Incluir mapa <br /><span class="fs80">Sólo disponible en modo un único evento.</span></label>
			</p>
			<p class="fld cb check">
				<input type="checkbox" name="notikumiWP_description" <?php if($devOptions['notikumiWP_description'] == "1") echo "checked=checked"; ?>  value="on">
				<label>Incluir descripción <br /><span class="fs80">Sólo disponible en modo un único evento.</span></label>
			</p>

			<p class="fld cb check">
				<input type="checkbox" name="notikumiWP_color" value="on" <?php if($devOptions['notikumiWP_color'] == "1") echo "checked=checked"; ?> />
				<label>Colores</label>
			</p>
			<div class="<?php if($devOptions['notikumiWP_color'] != "1") { ?>hidden<?php } ?> colores">
				<p>
					La personalización de colores solo está disponible para usuarios premium. 
					<br />Puedes hacerte premium desde tu <a href="http://www.notikumi.com/users" target="_blank">perfil de notikumi</a> sección "Hazte premium". ¿Te animas?.
				</p>
				<p class="fld cb">
					<label>Color de link</label>
					<input type="text" name="notikumiWP_linkColor" value="<?php echo $devOptions['notikumiWP_linkColor']; ?>">
				</p>
				<p class="fld cb">
					<label>Color de texto</label>
					<input type="text" name="notikumiWP_textColor" value="<?php echo $devOptions['notikumiWP_textColor']; ?>">
				</p>
				<p class="fld cb">
					<label>Color de fondo</label>
					<input type="text" name="notikumiWP_backColor" value="<?php echo $devOptions['notikumiWP_backColor']; ?>">
				</p>
				<p class="fld cb">
					<label>Color de borde</label>
					<input type="text" name="notikumiWP_borderColor" value="<?php echo $devOptions['notikumiWP_borderColor']; ?>">
				</p>
				
				
			</div>
			<p class="fld cb check">
				<input type="checkbox" name="notikumiWP_eliminarPatrocinados" value="on" />
				<label>Eliminar patrocinados</label>
			</p>
			<p id="notikumiWP_patrocinadosExplicacion" style="display:none">
				Para eliminar los eventos que aparecen como patrocinados, debes ser usuario premium. 
				<br />Puedes hacerte premium desde tu <a href="http://www.notikumi.com/users" target="_blank">perfil de notikumi</a> sección "Hazte premium".
			</p>
			
			<?php 
			/*
			<p class="fld">
				<label>Borde</label>
				<select name="notikumiWP_border">
					<option value="sin">sin borde</option>
					<option value="con">con borde</option>
				</select>
			</p>
			
			 
			<p class="fld">
				<label>Analytics
				<br />
				<span class="fs80">Si pones tu código de analytics, podremos utilizar</span></label>
				<input type="text" class="min" value="" />
			</p> 
			*/ 
			?> 
			<div class="submit" style="text-align: right;padding-right:3em;">
			<input type="submit" name="update_notikumiWPSettings" value="Actualizar plugin" style="padding: 1em;" />
			</div>
		</div>
		<div  class="h">
			<h3>Utilización</h3>
			<p>Crea la página o post que albergará el contenido. Escribe <span style="background-color:#dedede;padding:1px 5px 3px 5px;">[NTK]</span> y dale a guardar!</p>
			<p>¡Ya está!</p>
		</div>
	</form>
	
	
</div>
