var __items;
function load(){
	if (GBrowserIsCompatible()){
		var div = document.getElementById("map");
		if(div==null){return;}
		if(window.innerWidth){
			div.style.width  = (window.innerWidth - 20) + "px";
			div.style.height = (window.innerHeight - 30) + "px";
		}else{
			div.style.width  = (document.documentElement.clientWidth - 20) + "px";
			div.style.height = (document.documentElement.clientHeight - 30) + "px";			
		}
		var copyCollection = new GCopyrightCollection('<span class="cpy">OSgrid Map</span>');
		var copyright = new GCopyright(1, new GLatLngBounds(new GLatLng(0, 0), new GLatLng(20, 10)), 0, "<span class='cpy'>&copy; 2008 Osgrid.org</span>");
		copyCollection.addCopyright(copyright);
		var tilelayers = [new GTileLayer(copyCollection, 5, 9)];
		tilelayers[0].getTileUrl = function CustomGetTileUrl(a,b){
			return "default.jpg";
		}
		var custommap = new GMapType(tilelayers, new GMercatorProjection(10), "OSGrid Map", {errorMessage:"no data"});
		var map = new GMap2(div)
		map.addControl(new GLargeMapControl());
		map.enableScrollWheelZoom(); 
		map.addMapType(custommap);
		map.removeMapType(G_NORMAL_MAP); 
		map.removeMapType(G_SATELLITE_MAP); 
		map.removeMapType(G_HYBRID_MAP); 
		map.setCenter(new GLatLng(10,10),6);
		GEvent.addListener(map,"click", function(overlay,point){   
				if(overlay){return;}
				var x = point.lng();			
				if(x < 0) x--;		
				var str = x.toString();		
				str = str.substring(0, str.indexOf(".", 0));
				x = 990 + parseInt(str);
				var y = point.lat();			
				if(y < 0) y--;	
				str = y.toString();
				str = str.substring(0, str.indexOf(".", 0));
				y = 990 + parseInt(str);	
				if(isOutOfBounds(x,y)){return;}
				//show info popup if a region exist
				var content = getRegionInfos(x,y);
				if(content!=""){
					msg = content;	
					map.openInfoWindowHtml(point, msg);
				}						 		
			}
		);
		var request = getHTTPObject();	
		if(request){		
			request.onreadystatechange = function(){			
				parseMapResponse(request,map);		
			};		
			request.open("GET","data/map.php",true);	
			request.send(null);	
		}
	}
}
function parseMapResponse(request,map){	
	if(request.readyState == 4){
		if(request.status == 200 || request.status == 304){			
			var data=parseIEBug(request);
			var root=data.getElementsByTagName('Map')[0];
			if(root==null){return;}
			__items=root.getElementsByTagName("Grid");	
			if(__items==null){return;}
			for(var i=0;i<__items.length;i++){		
				if(__items[i].nodeType == 1){
					var xmluuid=__items[i].getElementsByTagName("Uuid")[0].firstChild.nodeValue;
					var xmlregionname=__items[i].getElementsByTagName("RegionName")[0].firstChild.nodeValue;
					var xmllocX=__items[i].getElementsByTagName("LocX")[0].firstChild.nodeValue;
					var xmllocY=__items[i].getElementsByTagName("LocY")[0].firstChild.nodeValue;
					xmllocX=xmllocX - 990;
					xmllocY=xmllocY - 990;
					boundaries=new GLatLngBounds(new GLatLng(xmllocY,xmllocX), new GLatLng(xmllocY+1,xmllocX+1)); 		
					var rx=new RegExp("(-)", "g");
					xmluuid = xmluuid.replace(rx,"");		
					layer=new GGroundOverlay('data/regions/' + xmluuid + '.jpg', boundaries);
					map.addOverlay(layer);
				}
			}	
		}
	}
}
function getRegionInfos(x,y){
	if(__items==null){return;}
	var response="";
	for(var i=0;i<__items.length;i++){		
		if(__items[i].nodeType == 1){
			var xmllocX=__items[i].getElementsByTagName("LocX")[0].firstChild.nodeValue;
			var xmllocY=__items[i].getElementsByTagName("LocY")[0].firstChild.nodeValue;			
			if(xmllocX==x&&xmllocY==y){
				var xmluuid=__items[i].getElementsByTagName("Uuid")[0].firstChild.nodeValue;				
				var xmlregionname=__items[i].getElementsByTagName("RegionName")[0].firstChild.nodeValue;	
				var rx=new RegExp("(-)", "g");
				xmluuid = xmluuid.replace(rx,"");
				response="<table>";
				response+="<tr><td><span id='name'><b>" + xmlregionname + "</b></span><br /></td></tr>";
				response+="<tr><td><span id='loc'>" + xmllocX + " / " + xmllocY + "</span></td></tr>";
   			    response+="<tr><td><a class=\"add\" href=\"opensim://osgrid.org:8002/"+xmlregionname+"/"+xmllocX+"/"+xmllocY+"/\">Teleport to this location</a><br /></td></tr>";
			}
		}	
	}	
	return response;
}
function isOutOfBounds(x,y){
if(x<970||x>1030){return true;}
if(y<970||y>1030){return true;}
return false;
}
function parseIEBug(request){	
if (document.implementation && document.implementation.createDocument){
xmlDoc = request.responseXML;
}else if (window.ActiveXObject){
var testandoAppend = document.createElement('xml');
testandoAppend.setAttribute('innerHTML',request.responseText);
testandoAppend.setAttribute('id','_formjAjaxRetornoXML');
document.body.appendChild(testandoAppend);
document.getElementById('_formjAjaxRetornoXML').innerHTML = request.responseText;
xmlDoc = document.getElementById('_formjAjaxRetornoXML');
}
return xmlDoc;
}
function getHTTPObject(){
var xhr = false;
if(window.XMLHttpRequest){
var xhr = new XMLHttpRequest();
}else if(window.ActiveXObject) {
try{
var xhr = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
try{
var xhr = new ActiveXObject("Microsoft.XMLHTTP");
}catch(e){xhr=false;}
}
}
return xhr;
}
