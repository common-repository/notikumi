jQuery(document).ready(function(){
	
	jQuery("input[name=notikumiWP_tipo]").change(function(){
		if (jQuery(this).val()==1){
			jQuery("#tipoEvento").hide();
			jQuery("#tipoAgenda").fadeIn();
			jQuery("input[name=notikumiWP_mapa]").attr("checked","").removeAttr("checked");
			jQuery("input[name=notikumiWP_description]").attr("checked","").removeAttr("checked").attr("disabled","disabled");
		}
		else {
			jQuery("#tipoAgenda").hide();
			jQuery("#tipoEvento").fadeIn();
			jQuery("input[name=notikumiWP_mapa]").attr("checked","checked");
			jQuery("input[name=notikumiWP_description]").removeAttr("disabled").attr("checked","checked");
		}
	});
	
	
	jQuery("input[name=notikumiWP_size]").change(function(){
		if (jQuery(this).val()=='custom'){
			jQuery("#customSize").show();
		}
		else {
			jQuery("#customSize").hide();			
		}
		updateWidgetBox();
	});
	
	jQuery("input[name=notikumiWP_busquedaTipo]").change(function(){
		if (jQuery(this).val()=='custom'){
			jQuery("#tipoAgenda input[name=notikumiWP_urlBusqueda]").hide();
			jQuery("#customAgenda").show();
		}
		else if(jQuery(this).val()=='url') {
			jQuery("#customAgenda").hide();
			jQuery("#tipoAgenda input[name=notikumiWP_urlBusqueda]").hide();
			jQuery(this).siblings("input[type=text]").show();
		}
		else if(jQuery(this).val()=='current') {
			jQuery("#tipoAgenda input[name=notikumiWP_urlBusqueda]").hide();
			jQuery("#customAgenda").hide();
			jQuery(this).siblings("input[type=text]").show();
			
			// calcula su propia URL
			var params = jQuery.param(parseCookieParams());
			jQuery(this).siblings("input[type=text]").val("http://www.notikumi.com/?"+params);
			updateWidgetBox();
		}
	});
	
	
	jQuery("select[name=notikumiWP_tematic]").change(function(){
		if(jQuery(this).val() == "-1"){
			jQuery(this).siblings("div").fadeIn();
		}
		else {
			jQuery(this).siblings("div").hide();
			updateWidgetBox();
		}
		return true;
	});
	jQuery("#customAgenda select[name=notikumiWP_tiempo]").change(function(){
		updateWidgetBox();
		return true;
	});
	
	jQuery("#urlEvento,#busquedaInput").blur(function(){
		updateWidgetBox();
	});
	jQuery("#generarWidget").click(function(){
		updateWidgetBox();
	});
	jQuery("#codigo").click(function(){
		jQuery(this).select();
	});
	jQuery("#codigo").mouseup(function(e){
	    e.preventDefault();
	});
	
	
	
	jQuery("input[name=notikumiWP_eliminarPatrocinados]").change(function(){
		if (jQuery(this).is(":checked")){
			jQuery("#notikumiWP_patrocinadosExplicacion").show("slow");
		}
		else {
			jQuery("#notikumiWP_patrocinadosExplicacion").hide("slow");
		}
	});
	
	jQuery(".incluirEventoEnWidget").live('click',function(){
		var purl = jQuery(this).parent().parent().find(".purl").text();
		jQuery("#urlEvento").val("http://www.notikumi.com/"+purl).blur();
		jQuery(this).parent().parent().fadeOut('slow');
		return false;
	});
	
	jQuery(".cleanEventosHolder").click(function(){
		jQuery("#eventosHolder").empty(true);
		return false;
	});
	
	jQuery("input[name=notikumiWP_compartir]").change(function(){
		updateWidgetBox();
		return true;
	});
	jQuery("input[name=notikumiWP_mapa]").change(function(){
		updateWidgetBox();
		return true;
	});
	
	jQuery("input[name=notikumiWP_description]").change(function(){
		updateWidgetBox();
		return true;
	});
	jQuery("input[name=notikumiWP_color]").change(function(){
		if(jQuery(this).is(":checked")){
			jQuery("div.colores").show();
		}
		else {
			jQuery("div.colores").hide();
		}
		return true;
	});
	jQuery("input[name=notikumiWP_eliminarPatrocinados]").change(function(){
		if(jQuery(this).is(":checked")){
			jQuery("#notikumiWP_patrocinadosExplicacion").show();
		}
		else {
			jQuery("#notikumiWP_patrocinadosExplicacion").hide();
		}
		return true;
	});
	
	
	//console.log(jQuery("input[name=textColor], input[name=linkColor], input[name=backColor], input[name=borderColor]").size());
	jQuery("input[name=notikumiWP_textColor], input[name=notikumiWP_linkColor], input[name=notikumiWP_backColor], input[name=notikumiWP_borderColor]").ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
			updateWidgetBox();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	
	
	
	
	
	if(jQuery("#notikumiWP_city").length > 0){
		
		jQuery("#notikumiWP_city").autocomplete({
			delay:500,
			minLength:2,
			autoFocus : true, // The first item will be automatically focused
			selectFirst: true,
			/*
			 * one way, does not work
			 * XMLHttpRequest cannot load http://api.notikumi.com/autocompleter-localidad/.jsonp?term=valencia. 
			 * Origin http://www.david-canos.net is not allowed by Access-Control-Allow-Origin.
			 * 
			 
			source:"http://api.notikumi.com/autocompleter-localidad/undefined.jsonp",
			dataType: "jsonp",
			extraParams: {
				key:jQuery("#notikumiWP_apikey").val()
			},			
			parse: function(data) {
				console.log(data);
				var rows = new Array();
				data = data.geonames;
				for(var i=0; i<data.length; i++){
					rows[i] = { data:data[i], value:data[i].name, result:data[i].name };
				}
				return rows;
			},
			*/
			/*
			 * another way 
			 * */
			source:function(request, response){
				jQuery.ajax({
				     url: "http://api.notikumi.com/autocompleter-localidad/"+encodeURI(request.term)+".jsonp",
				     dataType: "jsonp",
				     data: {
				    	 key:jQuery("#notikumiWP_apikey").val()
				     },
				     json:false,
				     complete: function( ) {
				    	 if(typeof __notikumi.objectDTO != "undefined"  && typeof __notikumi.objectDTO.lDonde != "undefined"){
				    		
				    		var rows = new Array();
				    		var data = __notikumi.objectDTO.lDonde;
				    		for(var i=0; i<data.length; i++){
								rows[i] = { data:data[i], value:data[i].purl, result:data[i].nameShow };
							}
				    		response(rows);
				    	 }
				     },
				     crossDomain : true,
				     scriptCharset: "UTF-8"
				});
			},
			
			
			select:function(event, ui){
				// asigna su name
				jQuery("#notikumiWP_city").val(ui.item[0]);
				// asigno la purl al selector oculto de donde
				jQuery("#notikumiWP_purlPlaceSelector").val(ui.item[10]);
				return false;
			}
		}).data( "autocomplete" )._renderItem = renderDondeNtk;
	}
	
	
	
	
	if(jQuery("#notikumiWP_tematicInput").length > 0){
		jQuery("#notikumiWP_tematicInput").autocomplete({
			delay:500,
			minLength:2,
			autoFocus : true,
			selectFirst: true,
			source:function(request, response){
				jQuery.ajax({
				     url: "http://api.notikumi.com/autocompleter-que/"+encodeURI(request.term)+".jsonp",
				     dataType: "jsonp",
				     data: {
				    	 key:jQuery("#notikumiWP_apikey").val()
				     },
				     json:false,
				     complete: function( ) {
				    	 //console.log(__notikumi);
				    	 if(typeof __notikumi.objectDTO != "undefined"  && typeof __notikumi.objectDTO.lQue != "undefined"){
				    		
				    		var rows = new Array();
				    		var data = __notikumi.objectDTO.lQue;
				    		for(var i=0; i<data.length; i++){
								rows[i] = { data:data[i], value:data[i].purl, result:data[i].label };
							}
				    		response(rows);
				    	 }
				     },
				     crossDomain : true,
				     scriptCharset: "UTF-8"
				});
			},
			select:function(event, ui){
				//console.log(ui);
				jQuery("#notikumiWP_tematicInput").val(ui.item.label);
				jQuery("#notikumiWP_tematicPurl").val(ui.item.purl);				
				return false;
			}
			
		}).data( "autocomplete" )._renderItem = function( ul, item ) {
			// lo que pongas en data lo recibirán los otros eventos
			return jQuery( "<li></li>" ) .data( "item.autocomplete", item.data )
									.append( "<a>" + item.data.label + "</a>" )
									.appendTo( ul );
		};
		
	}

});