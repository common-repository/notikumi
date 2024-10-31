function calculaHash(){
	return "widgetCreator";
}
function cleanUrl(url){
	if(url == undefined || url == null || url == "") return null;
	url = url.replace("http://www.notikumi.com/","");
	url = url.replace("http://notikumi.com/","");
	url = url.replace("https://www.notikumi.com/","");
	url = url.replace("https://notikumi.com/","");
	url = url.replace("www.notikumi.com/","");
	url = url.replace("notikumi.com/","");
	url = url.replace("?","");
	return url;
}

var renderDondeNtk = function $renderDondeNtk$(ul,item){	
	var itemA=item.result.split(",");
	var result = new Array;
	
	jQuery.each(itemA,function(i,v){
		result[i]=jQuery.trim(v);
		
		if(i>4 && i<8 && result[i]!="") {
			result[i]=", "+result[i];
		}
	});
	
	
	return jQuery("<li style='font-size:12px'></li>")
		.data("item.autocomplete",result)
		.append("<a href=\"#\">"+result[0]+"<span style='display:block; font-size:9px;'>"+result[4]+result[5]+result[6]+result[7]+"</span></a>")
		.appendTo(ul);
}


function getScriptCode(script){
	var box = "";
	if(script.outerHTML){
		box = script.outerHTML;	
	}
    else {
        var documentFragment = document.createDocumentFragment();            
        if (script.cloneNode)
          	box = documentFragment.appendChild(script.cloneNode(true)).innerHTML;
        else 
			box = jQuery(document.createElement("div")).append(jQuery(script).clone()).html();				
    }	
	
	box += jQuery('<div style="text-align:center">Powered by <a class="ntk_foot"  href="http://www.notikumi.com" target="_blank">notikumi</a></div>').html();
	return box;
} 


function updateWidgetBox(){
	
	var urlWidget = 'http://www.notikumi.com/js/widget/widget.js';
	//var urlWidget = 'http://media.notikumi.com/js/widget/widget.min.js';
	//var urlWidget = 'http://localhost:8080/NotikumiWeb/js/widget/widget.js';

	var params = {};
	
	var key = jQuery("#key").val();
	var hash = calculaHash();
	var type = "";
	
	
	// para evento
	var purl = "";		
	var parametros = {};
	var parametrosAppend = "";
	var id = {};
	
	jQuery("#codigo").val("");
	
	// evento
	if(jQuery("input:radio[name=notikumiWP_tipo]:checked").val()==2){
		type = '2';
		
		var urlEvento = jQuery("#urlEvento").val();
		
		if(urlEvento.indexOf("?") > -1){
			urlEvento = urlEvento.substring(0,urlEvento.indexOf("?"));
		}
		urlEvento = urlEvento.replace("?","");
		
		purl = cleanUrl(urlEvento);
		// limpiar de variables y de #
		if(purl != null){
			purl = purl.replace(/\//g,"-");
			id = {'purl':purl};
		}
		else {
			// no hace nada
			return;
		}
	}
	
	// agenda
	else if(jQuery("input:radio[name=notikumiWP_tipo]:checked").val()==1){
		type = '3';
		
		if(jQuery("input[name=notikumiWP_busquedaTipo]:checked").val()=="url"){
			// limpiar de variables y de #		
			parametrosAppend = cleanUrl(jQuery("#busquedaInput").val());
		}
		else if(jQuery("input[name=notikumiWP_busquedaTipo]:checked").val()=="custom") {
			if(jQuery("#placeDonde").val() != ""){
				jQuery.extend(parametros,{'c':jQuery("input[name=notikumiWP_purlPlaceSelector]").val()});
			}
			
			if(jQuery("#customAgenda select[name=notikumiWP_tiempo]").val() != ""){
				jQuery.extend(parametros,{'ft':jQuery("#customAgenda select[name=notikumiWP_tiempo]").val()});
			}
			
			if(jQuery("select[name=notikumiWP_tematic]").val() != "" && jQuery("select[name=notikumiWP_tematic]").val() != "-1" ){
				jQuery.extend(parametros,{'t':jQuery("select[name=notikumiWP_tematic]").val()});
			}
			if(jQuery("#queInput").val() != ""){
				jQuery.extend(parametros,{'t':jQuery("#queInput").val()});
			}
		}
	}
	else {
		return;
	}
	
	
	var signature = "";
	// get signature from server
	
	// get script ? 
	/* is not necessary, we dont have an ajaxable form here.
	 * we can build signature in backend
	jQuery.ajax("./widget",{
		"async":false, 
		"data":jQuery.extend({"ajax":true},{'type':type},id,parametros),
		"success":function(data){
			//console.log(data);
			signature = data;
		},
		"datatype":"json"
	});
	*/
	
	
	var sizeA = {};
	var size = jQuery("input[name=size]:checked").val();
	var w = jQuery("input[name=width]").val();
	var h = jQuery("input[name=height]").val();
	var wm = jQuery("select[name=widthM]").val();
	var hm = jQuery("select[name=heightM]").val();
	
	if(size == 'all'){
		sizeA = {'size':size};	
	}
	else {
		sizeA = {'size':size,'w':w,'h':h,'wm':wm,'hm':hm};
	}
		

	
	var shB = jQuery("input[name=compartir]").is(":checked");
	var sh = {};
	if(shB){
		sh = {'sh':1}
	}
	
	var mB = jQuery("input[name=mapa]").is(":checked");
	var m = {};
	if(mB){
		m = {'map':1}
	}
	
	var deB = jQuery("input[name=description]").is(":checked");
	var de = {};
	if(deB){
		de = {'desc':1}
	}
	
	/*
	var col = {};
	var tCol = jQuery("input[name=textColor]").val(); 
	var lCol = jQuery("input[name=linkColor]").val();
	var bCol = jQuery("input[name=backColor]").val();
	var boCol = jQuery("input[name=borderColor]").val();
	
	if(tCol != ""){
		col = jQuery.extend(col,{'tCol':tCol}); 
	}
	if(lCol != ""){
		col = jQuery.extend(col,{'lCol':lCol});
	}
	if(bCol != ""){
		col = jQuery.extend(col,{'bCol':bCol});
	}
	if(boCol != ""){
		col = jQuery.extend(col,{'boCol':boCol});
	}	
	*/
	
	//console.log(col);
	
	//var t = new Date();	
	//{'time':t.getTime()}
	/*
	var params = jQuery.extend(params,{'key':key,'type':type,'hash':hash},parametros, id, sizeA, sh, m, de, col, signature);	
	
	var finalUrlWidget = urlWidget+'?'+jQuery.param(params);
	if(parametrosAppend != "") {
		finalUrlWidget += "&"+parametrosAppend;
	}*/
	
	/*var script = document.createElement("script");
	script.src = finalUrlWidget;
	script.type = 'text/javascript'
	script.charset = 'UTF-8';

	var box = getScriptCode(script);	
	jQuery("textarea#codigo").val(box.replace(/\&amp;/g,'&'));
	
	//jQuery("#widgetTarget").empty();
	var wt = document.getElementById('widgetTarget');
	wt.appendChild(script);*/
}