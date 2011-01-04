/*
		MAPAPI MODIFIED FOR OPENSIM WEBINTERFACE USING PROTOTYPE AND SCRIPTACOLOUS EFFECTS HANDLER
*/

var SERVICES_URL = "";
var X_MIN = "200";
var X_MAX = "70";
var Y_MIN = "0";
var Y_MAX = "200";


function MAP_JS($0h,$0i,$0j,$0k,$0l){
	function $SetZoomSize($newSize){
		$ImageSize = $newSize;
	}
	
	function $a($0m,$0n){
		this.$3n=function(){
			return $G();
		};
		
		this.$3o=function(){
			var $0o=$0p.x-($0q.width/2);
			var $0r=$0p.x+($0q.width/2);
			var $0s=$0p.y+($0q.height/2);
			var $0t=$0p.y-($0q.height/2);
			var $0u=$0v.$3p(new $01($0o,$0s),$0w);
			var $0x=$0v.$3p(new $01($0r,$0t),$0w);
			return new $02($0u.x,$0x.x,$0u.y,$0x.y);
		};
			
		this.$3q=function($0y,$0z){
			var $0A=this.$3o();
			
			if($0A.isInRange($0y)){
				if($0z){
					var $0B=$0v.$3r($0y,$0w);
					var $0C=$0p.x-$0B.x;
					var $0D=$0p.y-$0B.y;$0E.$3s($0F,$0D,$0C);
				}
			}else{
				this.$3t($0y,$0w);}
		};
		
		this.$3u=function($0G,$0y){
			var $0H=$b($0y);
			$0G.simpleWindow=new $M($0I,$0H.top,$0H.left,$0G.text,$0G.options);
			$0G.simpleWindow.$3v();
			$0G.slCoord=$0y;
			$0J.push($0G);
		};
		
		this.$3w=function($0G){
			if($0G.simpleWindow){
				$0G.simpleWindow.$3x();
			}
		};
		
		function $b($0y){
			var $0B=$0v.$3r($0y,$0w);
			var $0K=$0v.$3y();
			var $0L=$0M.$3z(0,0).img;
			var $0N=$0B.x-($0O.x*$0K)+$0L.tileLeft;
			var top=$0B.y-($0O.y*$0K)+$0L.tileTop;
			return new $03(top,$0N);
		};
		
		function $c($0P){
			var $0Q=$0P.target.marker;$0Q.options.onMouseOverHandler($0Q);
		};
		
		function $d($0P){
			var $0Q=$0P.target.marker;$0Q.options.onMouseOutHandler($0Q);
		};
		
		function $e($0P,$0R){
			function $f(){
				if($0Q.view){
					$0Q.view.$3A($0Q.top,$0Q.left);
					$0Q.view.$3v();
				}else{
					$0Q.view=new $M($0I,$0Q.top,$0Q.left,$0G.text,$0G.options);
					$0Q.view.$3v();
				};
				
				if($0Q.view.$3B().onlyOneOpen){
					for(var i=0;i<$0J.length;i++){
						v=$0J[i];
						
						if(v.simpleWindow!=$0Q.view){
							if(v.simpleWindow.$3B().windowClass==$0G.options.windowClass){
								v.simpleWindow.$3C();
							}
						}
					};
					
					for(var i=0;i<$0S.length;i++){
						m=$0S[i];
						if(m.view){
							if(m.view!=$0Q.view){
								if(m.view.$3B().windowClass==$0G.options.windowClass){
									m.view.$3C();
								}
							}
						}
					}
				}
			};
			
			var $0Q=$0R?$0R:$0P.target.marker;
			
			if($0Q.options.clickHandler){
				$0E.$3D($0P);
				$0Q.options.clickHandler($0Q);
				return;
			};
			
			var $0G=$0Q.mapWindow;
				
			if($0Q.options.centerOnClick){
				$0C=$0p.x-$0Q.x-$0G.options.width/2;
				$0D=$0p.y-$0Q.y-$0G.options.height/2;
				new $0E.$3s($0F,$0D,$0C,$f.bindAsEventListener(this));
			}else if($0Q.options.autopanOnClick){
				var $0T=$0Q.options.autopanPadding;
				$0U=$0Q.x+$0G.options.width+$0T;
				$0V=$0Q.y+$0G.options.height+$0T;
				$0W=$0p.x+($0q.width/2);
				$0X=$0p.y+($0q.height/2);
				$0Y=$0p.x-($0q.width/2)+$0T;
				$0Z=$0p.y-($0q.height/2)+$0T;
				
				if(($0U>$0W)&&($0V>$0X)){
					new $0E.$3s($0F,$0X-$0V,$0W-$0U,$f.bindAsEventListener(this));
				}else if(($0Q.x<$0Y)&&($0Q.y<$0Z)){
					new $0E.$3s($0F,$0Z-$0Q.y,$0Y-$0Q.x,$f.bindAsEventListener(this));
				}else if(($0U>$0W)&&($0Q.y<$0Z)){
					new $0E.$3s($0F,$0Z-$0Q.y,$0W-$0U,$f.bindAsEventListener(this));
				}else if(($0Q.x<$0Y)&&($0V>$0X)){
					new $0E.$3s($0F,$0X-$0V,$0Y-$0Q.x,$f.bindAsEventListener(this));
				}else if($0U>$0W){
					new $0E.$3s($0F,0,$0W-$0U,$f.bindAsEventListener(this));
				}else if($0V>$0X){
					new $0E.$3s($0F,$0X-$0V,0,$f.bindAsEventListener(this));
				}else if($0Q.x<$0Y){
					new $0E.$3s($0F,0,$0Y-$0Q.x,$f.bindAsEventListener(this));
				}else if($0Q.y<$0Z){
					new $0E.$3s($0F,$0Z-$0Q.y,0,$f.bindAsEventListener(this));
				}else{$f();}
				
			}else{
				$f();
			}
		};
		
		this.$3E=function($0Q){
			this.$3q($0Q.slCoord);
			$e(null,$0Q);
		};
		
		this.$3F=function($0Q,$0G){
			var $10=$0S;
			var $0B=$0v.$3r($0Q.slCoord,$0w);
			$0Q.x=$0B.x;
			$0Q.y=$0B.y;
			var $11=$0Q.icons[$0w-1];
			var $0L=$0M.$3z(0,0).img;
			var $0K=$0v.$3y();
			$0Q.left=$0Q.x-($0O.x*$0K)+$0L.tileLeft;
			$0Q.top=$0Q.y-($0O.y*$0K)+$0L.tileTop;
			
			if($0Q.options.horizontalAlign=="center"){
				$12=-$11.mainImg.width/2;
			}else if($0Q.options.horizontalAlign=="right"){
				$12=-$11.mainImg.width;
			}else{$12=0;}if($0Q.options.verticalAlign=="middle"){
				$13=-$11.mainImg.height/2;
			}else if($0Q.options.verticalAlign=="bottom"){
				$13=-$11.mainImg.height;
			}else{
				$13=0;
			};
			
			var $14=$0E.$3G($11.mainImg.URL,$11.mainImg.width,$11.mainImg.height,null,null,null,$11.mainImg.isAlpha());
			$14.marker=$0Q;
			
			var $15=document.createElement("a");
			$15.style.zIndex=5000+$0Q.options.zLayer;
			$15.onmousedown=function(){return false;};
			$15.style.position="absolute";
			$15.style.left=$0E.$3H($0Q.left+$12);
			$15.style.top=$0E.$3H($0Q.top+$13);
			$15.appendChild($14);
		
			if($0G||$0Q.options.clickHandler){
				$0Q.mapWindow=$0G;
				
				if($16.$3I('ie')){
					$0E.$3J($15,"hand");
				}else{
					$15.href="javascript:void(0)";
				};
				
				Event.observe($15,"click",$e.bindAsEventListener(this));
				Event.observe($15,"mousedown",function($0P){$0E.$3D($0P);return false;});
			};
		
			if($0Q.options.onMouseOutHandler){
				Event.observe($15,"mouseout",$d.bindAsEventListener(this));
			};
		
			if($0Q.options.onMouseOverHandler){
				Event.observe($15,"mouseover",$c.bindAsEventListener(this));
			};
			
			$0I.appendChild($15);
		
		if($11.hasShadow()){
			var $17=$0E.$3G($11.shadowImg.URL,$11.shadowImg.width,$11.shadowImg.height,$0Q.left+$12,$0Q.top+$13,4000,$11.shadowImg.isAlpha());
			
			$17.onmousedown=function(){
				return false;
			};
			
			$0I.appendChild($17);
			$0Q.shadowImg=$17;
		}else{
			$0Q.shadowImg=null;
		};
		
		$0Q.img=$15;$10.push($0Q);};

		this.$3L=function($0Q){
			var $10=$0S;
			
			for(var i=0;i<$10.length;i++){
				m=$10[i];
				
				if(m==$0Q){
					if(m.view){
						m.view.$3x();
					}try{
					$0I.removeChild(m.img);
					
					if(m.shadowImg){
						$0I.removeChild(m.shadowImg);
					}
					
					$10.splice(i,1);
					}catch(e){
						alert("couldn't remove "+id);
					}
				}
			}
		};
		
		this.$3M=function(){
			var $10=$0S;
			for(var i=0;i<$10.length;i++){
				m=$10[i];
				if(m.view){
					m.view.$3x();
				}try{
					$0I.removeChild(m.img);
					if(m.shadowImg){
						$0I.removeChild(m.shadowImg);
					}
				}catch(e){
					alert("couldn't remove "+id);
				}
			}
			
			$0S=new Array();
		};
		
		this.$3t=function($0y,$18){
			$19=new $01($0y.x,$0y.y);
			$k($18);
			var $1a=$0v.$3r($19,$0w);
			$E($1a);
			$1b=true;
			$s();
		};
		
		this.$3N=function(){
			$0F.$3O();
		};
		
		this.$3P=function(){
			$0F.$3Q();
		};
		
		this.$3R=function(){
			this.$3S($0w-1);
		};
		
		this.$3T=function(){
			this.$3S($0w+1);
		};
		
		this.$3S=function($18){
			var $1c=$G();
			$k($18);
			self.$3t($1c,$18);
		};
		
		this.$3U=function(){
			return $0w;
		};
		
		this.$3V=function(){
			$0E.$3s($0F,0,Math.floor($0q.width/2));
		};
		
		this.$3W=function(){
			$0E.$3s($0F,0,-Math.floor($0q.width/2));
		};
		
		this.$3X=function(){
			$0E.$3s($0F,Math.floor($0q.height/2),0);
		};
		
		this.$3Y=function(){
			$0E.$3s($0F,-Math.floor($0q.height/2),0);
		};

		function $h(){
			$1d--;
			if($1d==0){
				Element.hide($1e);
			}
		};
		
		function $i(){
			$1d++;
			if($1d==1){
				Element.show($1e);
			}
		};
		
		function $j(){
			if($1d==0){
				return false;
			}else{
				return true;
			}
		};
		
		function $k($1f){
			if(($1g<=$1f)&&($1f<=$1h)){
				$0w=$1f;
				if($1i.hasZoomControls){
					if($0w==$1h){
						$1j.removeChild($1j.firstChild);
						$1j.appendChild($1j.disabled_img);
					}
					if($0w==$1g){
						$1k.removeChild($1k.firstChild);
						$1k.appendChild($1k.disabled_img);
					}
					if($0w!=$1h){
						$1j.removeChild($1j.firstChild);
						$1j.appendChild($1j.active_img);
					}
					if($0w!=$1g){
						$1k.removeChild($1k.firstChild);
						$1k.appendChild($1k.active_img);
					}
				}
			}
		}
		
		function $l($1l){
			var $0K=$0v.$3y();
			$1l.img=$0E.$3G(null,$0K,$0K,null,null,1000);
			$1l.img.style.position="absolute";
			$0I.appendChild($1l.img);
			$C($1l.img,$1l.x,$1l.y);
			if($1i.overlaySpec){
				$1l.img.overlay=$0E.$3G(null,$0K,$0K,null,null,1001,$1i.overlaySpec.usePNG);
				$1l.img.overlay.style.position="absolute";
				$0I.appendChild($1l.img.overlay);
				$C($1l.img.overlay,$1l.x,$1l.y,true);
			}
		};
		
		function $m($1l){
			$0I.removeChild($1l.img);
			if($1i.overlaySpec){
				$0I.removeChild($1l.img.overlay)
			}
		};
		
		function $n($1l){
			$0I.removeChild($1l.img);
			$C($1l.img,$1l.x,$1l.y);
			$0I.appendChild($1l.img);
			if($1i.overlaySpec){
				$0I.removeChild($1l.img.overlay);
				$C($1l.img.overlay,$1l.x,$1l.y,true);
				$0I.appendChild($1l.img.overlay);
			}
		};

		function $o(){
			if($0q.width!=$1m.offsetWidth||$0q.height!=$1m.offsetHeight){
				$w();
				$0M.$3Z($1n);
				$E($0p);
				if($1i.hasPanningControls){
					$A();
				}
				$s();
			}
		};

		function $p($0P){
			if($1i.singleClickHandler){
				var $1c=$r($0P);
				$1i.singleClickHandler($1c.x,$1c.y);
			}
		};

		function $q($0P){
			if($1i.doubleClickHandler){
				var $1c=$r($0P);$1i.doubleClickHandler($1c.x,$1c.y);
			}
		};

		function $r($0P){
			var $1a=new $01();
			var $1o=new $01();
			if($16.$3I('ie')){
				var $1p=$0P.target||$0P.srcElement;
				var $1q=$0E.$40($1p,$1m);
				$1o.x=$0P.offsetX+$1q.x;
				$1o.y=$0P.offsetY+$1q.y;
			}else{
				var $1q=$0E.$41($1m);
				$1o.x=$0P.pageX-$1q.x;
				$1o.y=$0P.pageY-$1q.y;
			}
			$1a.x=$0p.x-($0q.width/2)+$1o.x;
			$1a.y=$0p.y-($0q.height/2)+$1o.y;
			return 
			$0v.$3p($1a,$0w);
		}
		
		function $s(){
			if($1i.onStateChangedHandler){
				$1i.onStateChangedHandler();
			}
		};
		
		function $t(){
			if($1b){
				$19=null;
				var $0K=$0v.$3y();
				$0p.x=($0O.x*$0K)+Math.floor($0q.width/2)+$1r.width-$D().width;
				$0p.y=($0O.y*$0K)+Math.floor($0q.height/2)+$1r.height-$D().height;
				
				while($D().width<-$1r.width/2){
					$1s.width++;$0O.x++;$0M.$42();
				};
					
				while($D().width>$1r.width/2){
					$1s.width--;$0O.x--;$0M.$43();
				}
				
				while($D().height<-$1r.height/2){
					$1s.height++;$0O.y++;$0M.$44();
				};
		
				while($D().height>$1r.height/2){
					$1s.height--;$0O.y--;$0M.$45();
				}
			}
		};

		function $u(){
			for(var i=0;i<$0J.length;i++){
				v=$0J[i];
				v.simpleWindow.$46();
			}
			
			for(var i=0;i<$0S.length;i++){
				m=$0S[i];
				if(m.view){
					m.view.$46();
				}
			}
		};

		function $v(){
			$s();
		};

		function $w(){
			var $0K=$0v.$3y();
			$0q.width=$1m.offsetWidth,$0q.height=$1m.offsetHeight;
			$1n.width=3+Math.ceil($0q.width/$0K);
			$1n.height=3+Math.ceil($0q.height/$0K);
			$1r.width=Math.floor(($1n.width*$0K-$0q.width)/2);
			$1r.height=Math.floor(($1n.height*$0K-$0q.height)/2);
		};

		function $x(){
			$1t=document.createElement("div");
			$1t.style.zIndex=7000;$1t.style.position="absolute";
			$1t.style.margin="5px";
			$1t.style.padding="5px";
			$1t.style.bottom=$0E.$3H(10);
			$1t.style.left=$0E.$3H(10);
			$1t.style.backgroundColor="#D8E8ED";
			$1t.style.fontSize=$0E.$3H(11);
			$1t.style.fontWeight="bold";
			$1t.unselectable="on";
			$1t.style.MozUserSelect="none";
			$1u=document.createElement("img");
			$1u.src=$0h+"images/loading.gif";
			$1u.style.marginRight=$0E.$3H(5);
			$1v=document.createElement("span");
			$1v.innerHTML="Loading";$1t.appendChild($1u);
			$1t.appendChild($1v);$1e=$1t;
			$1m.appendChild($1t);$1d=1;$h();
		};
		
		function $y($0P){
			$0E.$3D($0P);
			return false;
		};
		
		function $z(){
			$1w=$0E.$3G($0h+"images/b_pan_l.png",17,17,null,null,null,true);
			$1x=$0E.$3G($0h+"images/b_pan_r.png",17,17,null,null,null,true);
			$1y=$0E.$3G($0h+"images/b_pan_u.png",17,17,null,null,null,true);
			$1z=$0E.$3G($0h+"images/b_pan_d.png",17,17,null,null,null,true);
			$1z.style.position="relative";
			$1y.style.position="relative";
			$1w.style.position="relative";
			$1x.style.position="relative";
			$1A=document.createElement("a");
			$1B=document.createElement("a");
			$1C=document.createElement("a");
			$1D=document.createElement("a");
			$1A.href="javascript:void(0)";
			$1B.href="javascript:void(0)";
			$1C.href="javascript:void(0)";
			$1D.href="javascript:void(0)";
			$1A.appendChild($1w);
			$1B.appendChild($1x);
			$1C.appendChild($1y);
			$1D.appendChild($1z);
			$A();
			
			if($16.$3I('ie')){
				$0E.$3J($1w,"hand");
				Event.observe($1A,"click",$y);$0E.$3J($1x,"hand");
				Event.observe($1B,"click",$y);$0E.$3J($1y,"hand");
				Event.observe($1C,"click",$y);$0E.$3J($1z,"hand");
				Event.observe($1D,"click",$y);
			}
			
			Event.observe($1A,"click",self.$3V.bindAsEventListener(self));
			Event.observe($1B,"click",self.$3W.bindAsEventListener(self));
			Event.observe($1C,"click",self.$3X.bindAsEventListener(self));
			Event.observe($1D,"click",self.$3Y.bindAsEventListener(self));
			
			$1m.appendChild($1A);
			$1m.appendChild($1B);
			$1m.appendChild($1C);
			$1m.appendChild($1D);
		};
		
		function $A(){
			$1A.style.position="absolute";
			$1A.style.zIndex=8000;
			$1A.style.top=$0E.$3H(Math.floor($0q.height/2));
			$1A.style.left=$0E.$3H(10);
			$1B.style.position="absolute";$1B.style.zIndex=8000;
			$1B.style.top=$0E.$3H(Math.floor($0q.height/2));
			$1B.style.right=$0E.$3H(10);
			$1C.style.position="absolute";
			$1C.style.zIndex=8000;
			$1C.style.top=$0E.$3H(10);
			$1C.style.left=$0E.$3H(Math.floor($0q.width/2));
			$1D.style.position="absolute";
			$1D.style.zIndex=8000;
			$1D.style.bottom=$0E.$3H(10);
			$1D.style.left=$0E.$3H(Math.floor($0q.width/2));
		}
		
		function $B(){
			$1E=document.createElement("div");
			$1E.style.zIndex=8000;
			$1E.style.position="absolute";
			$1E.style.bottom=$0E.$3H(10);
			$1E.style.right=$0E.$3H(10);
			$1E.style.margin=$0E.$3H(0);
			$1E.style.padding=$0E.$3H(0);
			$1E.style.textAlign="center";
			$1k=document.createElement("a");
			$1k.href="javascript:void(0)";
			$1k.style.textDecoration="none";
			$1k.style.marginRight="5px";
			$1k.active_img=$0E.$3G($0h+"images/b_zoom_in.png",17,17,null,null,null,true);
			$1k.active_img.style.position="relative";
			$1k.active_img.style.padding="0px";
			$1k.active_img.style.margin="0px";
			$1k.disabled_img=$0E.$3G($0h+"images/b_zoom_in_gray.png",17,17,null,null,null,true);
			$1k.disabled_img.style.position="relative";
			$1k.disabled_img.style.padding="0px";
			$1k.disabled_img.style.margin="0px";
			$1j=document.createElement("a");
			$1j.href="javascript:void(0)";
			$1j.style.textDecoration="none";
			$1j.style.marginLeft="5px";
			$1j.active_img=$0E.$3G($0h+"images/b_zoom_out.png",17,17,null,null,null,true);
			$1j.active_img.style.position="relative";$1j.active_img.style.padding="0px";
			$1j.active_img.style.margin="0px";
			$1j.disabled_img=$0E.$3G($0h+"images/b_zoom_out_gray.png",17,17,null,null,null,true);
			$1j.disabled_img.style.position="relative";
			$1j.disabled_img.style.padding="0px";
			$1j.disabled_img.style.margin="0px";
			$1k.appendChild($1k.active_img);
			$1j.appendChild($1j.active_img);
			
			if($16.$3I('ie')){
				$0E.$3J($1k.active_img,"hand");
				Event.observe($1k,"click",$y);$0E.$3J($1j.active_img,"hand");
				Event.observe($1j,"click",$y);
			}
			
			Event.observe($1k,"click",self.$3R.bindAsEventListener(self));
			Event.observe($1j,"click",self.$3T.bindAsEventListener(self));
			$1E.appendChild($1k);
			$1E.appendChild($1j);
			$1m.appendChild($1E);
		};
		
		function $C($1F,x,y,$1G){
			var $1H=$1G?$1i.overlaySpec:
			$0v;
			
			if(!$0O){
				$1F.src=$0v.$47();
			}else{
				var $1I=$0O.x+x;
				var $1J=$0O.y+y;
				
				if($1H.isTileWithinRange($0v.$48($1I,$1J,$0w))){
					var $1K=$1H.getTileURL($1I,$1J,$0w);
					if($16.$3I('ie')&&$1H.usePNG){
						$1F.style.filter='';
						$1F.loader.src=$1K;
					}else{
						$1F.src=$1H.getEmptyTileUrl();
						$1F.src=$1K;
					}
				}else{
					$1F.src=$1H.getOutOfBoundsTileUrl($1I,$1J,$0w);
				}
			}
			
			var $0K=$0v.$3y();
			var top=($1s.height+y)*$0K-$1r.height;
			var $0N=($1s.width+x)*$0K-$1r.width;
			$1F.onmousedown=function(){return false};
			$1F.style.top=$0E.$3H(top);
			$1F.style.left=$0E.$3H($0N);
			$1F.tileTop=top;$1F.tileLeft=$0N;
		};
		
		function $D(){
			var $0K=$0v.$3y();
			return new $04($0F.$49()+$1s.width*$0K,$0F.$4a()+$1s.height*$0K);
		};
		
		function $E($0y){
			$0p.x=$0y.x;
			$0p.y=$0y.y;
			
			if(!$0O){
				$0O=new $01();
			}
			
			var $1L=$0y.x-($1r.width+Math.floor($0q.width/2));
			var $1M=$0y.y-($1r.height+Math.floor($0q.height/2));
			var $0K=$0v.$3y();
			$0O.x=Math.floor($1L/$0K);
			$0O.y=Math.floor($1M/$0K);
			var $1N=($0O.x*$0K)-$1L;
			var $1O=($0O.y*$0K)-$1M;
			
			if($1N<-$1r.width/2){
				$0O.x++;
				$1N+=$0K
			}else if($1N>$1r.width/2){
				$0O.x;
				$1N-=$0K
			}
			
			if($1O<-$1r.height/2){
				$0O.y++;
				$1O+=$0K
			}else if($1O>$1r.height/2){
				$0O.y--;
				$1O-=$0K
			}
			$1s.width=0;
			$1s.height=0;$F();$J();$0F.$4b($1O,$1N);
		};
		
		function $F(){
			if($0M.$4c()){
				return
			}
			var $1P=$0M.$4d();
			var $1Q=$0M.$4e();
			var $1R=new Array();
			
			for(var x=0;x<$1P;x++){
				for(var y=0;y<$1Q;y++){
					$1S=$0M.$3z(x,y).img;
					$1S.coordX=x;
					$1S.coordY=y;
					
					var $1T=Math.min(x,$1P-x-1);
					var $1U=Math.min(y,$1Q-y-1);
					
					if($1T==0||$1U==0){
						$1S.priority=0
					}else{
						$1S.priority=$1T+$1U
					}
					$1R.push($1S)
				}
			}
			
			$1R.sort(function(a,b){
				return b.priority-a.priority
			});
			
			for(var i=0;i<$1R.length;i++){
				var $1S=$1R[i];
				
				if($16.$3I('ie')){
					$0I.removeChild($1S)
				}
				
				$C($1S,$1S.coordX,$1S.coordY);
				
				if($16.$3I('ie')){
					$0I.appendChild($1S)
				}
				
				if($1i.overlaySpec){
					if($16.$3I('ie')){
						$0I.removeChild($1S.overlay)
					}
					
					$C($1S.overlay,$1S.coordX,$1S.coordY,true);
					
					if($16.$3I('ie')){
						$0I.appendChild($1S.overlay)
					}
				}
			}
		};
		
		function $G(){
			if($19){
				return $19
			}else{
				return $0v.$3p($0p,$0w)
			}
		};
		
		function $H($1V){
			if($1V){
				for(var i=0;i<$1V.length;i++){
					m=$1V[i];
					$0I.removeChild(m.img);
					
					if(m.shadowImg){
						$0I.removeChild(m.shadowImg);
					}
				}
			}
		};
		
		function $I(){
			for(var j=0;j<$0J.length;j++){
				$0J[j].simpleWindow.$3x();
			}
		}
		
		function $J(){
			var $1W=$0S;
			var $1X=$0J;$H($0S);
			$0S=new Array();
			
			for(var i=0;i<$1W.length;i++){
				m=$1W[i];
					if(m.mapWindow){
						self.$3F(m,m.mapWindow);
					}else{
						self.$3F(m);
					}
					
					if(m.view){
						m.view.$3A(m.top,m.left);
					}
			}
			
			for(var j=0;j<$1X.length;j++){
				v=$1X[j];
				$0H=$b(v.slCoord);
				v.simpleWindow.$3A($0H.top,$0H.left);
			}
		};
		
		var self=this;
		var $1b=false;
		var $1m=$0m;
		$1m.style.padding=$0E.$3H(0);
		
		if($1m.style.position!="absolute"){
			$1m.style.position="relative"
		};
		$1m.style.overflow="hidden";
		
		var $0I=document.createElement("div");
		$1m.appendChild($0I);
		$1m.align="left";
		$0I.id="map";
		$0I.style.position="absolute";
		$0I.style.top="0px";
		$0I.style.left="0px";
		$0I.zIndex=1000;
		
		var $0S=new Array();
		var $1Y=new Array();
		var $0J=new Array();
		var $0v=new $S();
		var $1s=new $04();
		var $0p=new $01();
		var $1n=new $04();
		var $1r=new $04();
		var $0q=new $04();
		var $0O=null;
		var $19=null;
		var $1d,$1e;
		
		var $0F=new 
		
		$V($0I,$t.bindAsEventListener(this),
		$u.bindAsEventListener(this),
		$v.bindAsEventListener(this),
		$p.bindAsEventListener(this));
		$w();
		
		var $1i=new $0a($0n);
		var $1A,$1B,$1D,$1C;
		var $1k,$1j;
		var $0w=1;
		var $1g=($1i.zoomMax<$0v.zoomMax)?$0v.zoomMax:$1i.zoomMax;
		var $1h=($1i.zoomMin>$0v.zoomMin)?$0v.zoomMin:$1i.zoomMin;
		
		if($1i.hasZoomControls){$B();}
		if($1i.hasPanningControls){$z();}
		var $0M=new $0f($1n,$l.bindAsEventListener(this),$m.bindAsEventListener(this),$n.bindAsEventListener(this));
		if($1i.doubleClickHandler){$0I.ondblclick=$q.bindAsEventListener(this);}
		
		Event.observe(window,"resize",$o.bindAsEventListener(this));
		
		this.centerAndZoomAtWORLDCoord=this.$3t;
		this.addMarker=this.$3F;
		this.removeMarker=this.$3L;
		this.removeMapWindow=this.$3w;
		this.removeAllMarkers=this.$3M;
		this.addMapWindow=this.$3u;
		this.setCurrentZoomLevel=this.$3S;
		this.getCurrentZoomLevel=this.$3U;
		this.zoomIn=this.$3R;
		this.zoomOut=this.$3T;
		this.panLeft=this.$3V;
		this.panRight=this.$3W;
		this.panUp=this.$3X;
		this.panDown=this.$3Y;
		this.disableDragging=this.$3N;
		this.enableDragging=this.$3P;
		this.getViewportBounds=this.$3o;
		this.panOrRecenterToWORLDCoord=this.$3q;
		this.getMapCenter=this.$3n;
		this.clickMarker=this.$3E;
		this.notifyResize=$o;
	};

		function $M($0m,top,$0N,$1Z,$20){
			this.$3A=function(top,$0N){
				$21.style.top=$0E.$3H(top);
				$21.style.left=$0E.$3H($0N);
				$22.style.top=$0E.$3H(top);
				$22.style.left=$0E.$3H($0N);
			};
			
			this.$3B=function(){
				return $23;
			};
			
			this.$3v=function(){
				$R();$Q();
				
				if($23.noEffect){
					Element.show($21);
					Element.show($22);
				}else{
					$0E.$4h($21);
					$0E.$4h($22);
				}
			};

			function $N(){
				if($23.noEffect){
					Element.hide($21);
					Element.hide($22);
					$R();
					$Q();
				}else{
					$0E.$4i($21);
					$0E.$4i($22);
				}
			};
			
			this.$46=function(){
				if($23.closeOnMove){
					this.$3C();
				}
			};
			
			this.$3C=function($0P){
				$N();
			};
			
			this.$3x=function(){
				$R();
			};

			function $O($0P){
				$0E.$3D($0P);
			};
			
			function $P($0P){
				if($23.bringToTop){
					$R();
					$Q();
				}
				
				if($23.closeOnClick){
					$N();
				}
			};
			
			function $Q(){
				$1m.appendChild($21);
				$1m.appendChild($22);
			};
			
			function $R(){
				$1m.removeChild($21);
				$1m.removeChild($22);
			};
			
			var self=this;
			var $1m=$0m;
			var $21=document.createElement("div");
			
			if($20){
				var $23=$20;
			}else{
				var $23=new $09();
			}
			
			if($23.alwaysOnTop){
				var $24=7000;
			}else{
				var $24=6000;
			}
			
			$21.style.zIndex=$24;
			$21.style.width=$0E.$3H($23.width);
			$21.style.height=$0E.$3H($23.height);
			$21.style.border=" 1px solid black";
			$21.style.backgroundColor="white";
			$21.style.position="absolute";
			$21.style.margin=$0E.$3H(0);
			$21.style.marginTop=$0E.$3H(9);
			$21.style.padding=$0E.$3H(0);
			$21.unselectable="on";
			$21.style.MozUserSelect="none";
			
			var $22=document.createElement("img");
			$22.style.zIndex=$24;$22.src=$0h+"images/corner_vert.gif";
			$22.style.position="absolute";
			$22.style.padding=$0E.$3H(0);
			$22.style.margin=$0E.$3H(0);
			$22.width=10;
			$22.height=10;
			
			var $25=document.createElement("img");
			$25.src=$0h+"images/close_new.gif";
			$25.style.border=$0E.$3H(0);
			$25.width=9;
			$25.height=9;
			
			var $26=document.createElement("a");
			$26.href="javascript:void(0)";
			$26.style.textDecoration="none";
			$26.appendChild($25);
			$26.style.position="absolute";
			$26.style.right=$0E.$3H(5);
			$26.style.top=$0E.$3H(5);
			
			if($23.allowGoThere==true){
				var $27=document.createElement("img");
				$27.src=$0h+"images/go_there.gif";
				$27.style.border=$0E.$3H(0);
				
				var $28=document.createElement("a");
				$28.href="javascript:void(0)";
				$28.style.textDecoration="none";
				$28.appendChild($27);
				$28.style.position="absolute";
				$28.style.right=$0E.$3H(18);
				$28.style.top=$0E.$3H(5);
				$21.appendChild($28);
			}
			Event.observe($26,"click",this.$3C.bindAsEventListener(this));
			Event.observe($21,"mousedown",$O.bindAsEventListener(this));
			Event.observe($21,"click",$P.bindAsEventListener(this));
			
			var $29=document.createElement("div");
			$29.style.padding=$0E.$3H($23.padding);
			$29.style.margin=$0E.$3H(0);
			Element.update($29,$1Z);
			$21.appendChild($29);
			$21.appendChild($26);
			$1m.appendChild($21);
			$1m.appendChild($22);
			
			this.$3A(top,$0N);
			Element.hide($21);
			Element.hide($22);
		};

		function $S(){
			function $T($18){
				return $ImageSize*2/Math.pow(2,$18);
			};
			
			function $U($18){
				return Math.pow(2,$18-1);
			};
			
			this.$48=function(x,y,$18){
				var $2b=$U($18);
				var $2c=x*$2b;
				var $2d=$2c+($2b-1);
				var $2e=$2f-y*$2b;
				var $2g=$2e-($2b-1);
				return new $02($2c,$2d,$2g,$2e);
			};
			
			this.$4j=function($0A){
				if(((($0i<=$0A.xMin)&&($0A.xMin<=$0j))||
				(($0i<=$0A.xMax)&&($0A.xMax<=$0j)))&&
				((($0k<=$0A.yMin)&&($0A.yMin<=$0l))||
				(($0k<=$0A.yMax)&&($0A.yMax<=$0l)))){
					return true;
				}else{
					return false;
				};
			};
			
			this.$47=function(){
				return $2h.src;
			};
			
			this.$4k=function(x,y,$18){
				return $2i.src;
			};
			
			this.$3y=function(){
				return $2a;
			};
			
			this.$3r=function($0y,$18){
				var $2j=$T($18);
				var x=$0y.x*$2j;
				var y=($2f-$0y.y)*$2j;
				return new $01(x,y);
			};
			
			this.$3p=function($0y,$18){
				var $2j=$T($18);
				var x=$0y.x/$2j;
				var y=(-$0y.y/$2j)+$2f;
				return new $01(x,y);
			};
			
			this.$4l=function(x,y,$18){
				return $2k+"/"+x+"-"+y+"-"+$18+"-0";
			};
			
			this.$4g=function(){
				return $2l;
			};
			
			var $2a=256; 
			var $2k=$0h+"grab_img.php?asset=";//Image Handle.
			var $2f=1280;
			var $2m=1100;
			var $2n=960;
			var $2o=1100;
			var $2p=945;
			var $2h=new Image(256,256);
			$2h.src=$0h+"images/white.jpg";
			var $2i=new Image(256,256);
			$2i.src=$0h+"images/water.jpg";
			this.usePNG=false;
			this.getTileURL=this.$4l;
			this.isTileWithinRange=this.$4j;
			this.getEmptyTileUrl=this.$47;
			this.getOutOfBoundsTileUrl=this.$4k;
			this.zoomMax=1;
			this.zoomMin=1;
		};

		function $V(element,$2q,$2r,$2s,$2t){
			this.$49=function(){
				return this.left;
			};
			
			this.$4a=function(){
			return this.top;
			};
			
			this.$3O=function(){
				$2u=true;
			};
			
			this.$3Q=function(){
				$2u=false;
			};
			
			this.$4b=function(top,$0N){
				this.left=$0N;
				this.top=top;
				$21.style.left=$0E.$3H(this.left);
				$21.style.top=$0E.$3H(this.top);
				
				if(this.$4m){
					this.$4m();
				}
			};

			function $O($0P){
				if(!$2u){
					$2v=true;
					$2w.x=$0P.screenX;
					$2w.y=$0P.screenY;
					Event.observe($2x,"mousemove",$2y);
					Event.observe($2x,"mouseup",$2z);
						
					if($21.setCapture){
						$21.setCapture()
					}
					
					$2A.x=$0P.screenX;
					$2A.y=$0P.screenY;
					
					if(self.$4n){
						self.$4n($0P);
					}
					
					return false;
				}
			};
			
			function $W($0P){
				if(!$2u){
					if($21.style.cursor!="move"){
						$0E.$3J($21,"move");
					}
					
					var $2B=self.left+($0P.screenX-$2w.x);
					var $2C=self.top+($0P.screenY-$2w.y);
					$2w.x=$0P.screenX;
					$2w.y=$0P.screenY;
					self.$4b($2C,$2B);return false;
				}
			};
			
			function $X($0P){
				if(!$2u&&$2v){
					Event.stopObserving($2x,"mousemove",$2y);
					Event.stopObserving($2x,"mouseup",$2z);
					$0E.$3J($21,"");
					
					if(document.releaseCapture){
						document.releaseCapture()
					}
					
					if(!($2A.x==$0P.screenX&&$2A.y==$0P.screenY)){
						if(self.$4o){
							self.$4o($0P);
						}
					}else{
						self.$4p($0P);
					}
					
					$2v=false;
					return false;
				}else if($2v){
					self.$4p($0P);
				}
			};
			
			function $Y($0P){
				if(!$2u){
					if(!$0P.relatedTarget){
						$2z($0P)
					}
				}
			};
			
			var self=this;
			var $21=element;
			var $2w=new $01();
			var $2A=new $01();
			var $2u=false;
			var $2v=false;
			this.$4b(0,0);
			var $2D=$O.bindAsEventListener(this);
			var $2y=$W.bindAsEventListener(this);
			var $2z=$X.bindAsEventListener(this);
			var $2E=$Y.bindAsEventListener(this);
			this.$4m=$2q;
			this.$4o=$2s;
			this.$4n=$2r;
			this.$4p=$2t;
			var $2x=$21.setCapture?$21:window;
			
			if($16.$3I('gecko')){
				Event.observe(window,"mouseout",$Y.bindAsEventListener(this))
			}
			
			Event.observe($21,"mousedown",$O.bindAsEventListener(this));
		}

		var $2F=new Array();
		var $2G=false;

		function $01(x,y){
			if(x){
				this.x=x;
			}else{
				this.x=0;
			};
			
			if(y){
				this.y=y;
			}else{
				this.y=0;
			}
		};

		function $02($0o,$0r,$0s,$0t){
			this.isInRange=function($0y){
				if(($0o<=$0y.x)&&($0y.x<=$0r)&&($0s<=$0y.y)&&($0y.y<=$0t)){
					return true;
				}else{
					return false;
				}
			};
			
			this.xMin=$0o;
			this.xMax=$0r;
			this.yMin=$0s;
			this.yMax=$0t;
		};

		function $03(top,$0N){
			this.top=top;
			this.left=$0N;
		};
		
		function $04($2H,$2I){
			if($2H){
				this.width=$2H;
			}else{
				this.width=0;
			};
			
			if($2I){
				this.height=$2I;
			}else{
				this.height=0;
			}
		};

		function $05($2J,$1c,$2K,id,$20){
			this.icons=$2J;
			this.slCoord=$1c;
			this.URL=$2K;
			this.id=id;
			
			if($20){
				this.windowOptions=$20;
			}else{
				this.windowOptions=new $09();
			}
		};
		
		function $06($2J,$1c,$2L){
			this.icons=$2J;
			this.slCoord=$1c;
			this.options=new $08($2L);
		};
		
		function $07($2M,$2L){
			this.text=$2M;
			this.options=new $09($2L);
		};
		
		function $08($2L){
			this.clickHandler=false;
			this.onMouseOverHandler=false;
			this.onMouseOutHandler=false;
			this.centerOnClick=false;
			this.autopanOnClick=true;
			this.autopanPadding=45;
			this.verticalAlign="middle";
			this.horizontalAlign="center";
			this.zLayer=0;
			Object.extend(this,$2L);
		};
		
		function $09($2L){
			this.windowClass='GENERAL';
			this.alwaysOnTop=false;
			this.noEffect=false;
			this.onlyOneOpen=false;
			this.closeOnMove=false;
			this.bringToTop=false;
			this.closeOnClick=false;
			this.allowGoThere=false;
			this.doNothing=false;
			this.width=252;
			this.height=236;
			this.padding=10;
			Object.extend(this,$2L);
		};
		
		function $0a($2L){
			this.doubleClickHandler=null;
			this.hasZoomControls=true;
			this.hasPanningControls=true;
			this.onStateChangedHandler=null;
			this.overlaySpec=null;
			this.zoomMax=1;
			this.zoomMin=1;
			Object.extend(this,$2L);
		};
		
		function $0b($2N,$2O){
			this.hasShadow=function(){
				if(this.shadowImg){
					return true;
				}else{
					return false;
				}
			};
			
			this.mainImg=$2N;
			
			if($2O){
				this.shadowImg=$2O;
			}
		};
		
		function $0c($2K,$2H,$2I,$2P){
			this.isAlpha=function(){
				return this.alpha
			};
			
			this.URL=$2K;
			this.width=$2H;
			this.height=$2I;
			
			if($2P){
				this.alpha=true;
			}else{
				this.alpha=false;
			}
		};
		
		function $0d(){
			this.$3I=function($2Q){
				return($2Q==$2R)
			};
			
			$2S=navigator.userAgent.toLowerCase();
			
			if($2S.indexOf("msie")!=-1){
				var $2R='ie'
			}else if($2S.indexOf("mozilla")!=-1){
				var $2R='gecko'
			}
		};
		
		$16=new $0d();
		
		function $0e(x,y){
			this.x=x;this.y=y;
		};
		
		function $0f($2T,$2U,$2V,$2W){
			this.$3Z=function($2T){
				var $2X=$2T.width;
				var $2Y=$2T.height;
				
				while($2Z.length<$2X){
					$30=new Array();
					$2Z.push($30);
					x=$2Z.length-1;
					
					for(y=0;y<$2Y;y++){
						$1l=new $0e(x,y);
						$30.push($1l);
						
						if($2U){
							$2U($1l);
						}
					}
				};
				
				while($2Z.length>$2X){
					$31=$2Z.pop();
					
					for(y=0;y<$31.length;y++){
						if($2V){
							$2V($31[y])
						}
					}
				};
				
				for(c=0;c<$2Z.length;c++){
					$31=$2Z[c];
					
					while($31.length<$2Y){
						var $32=new $0e(c,$31.length-1);
						$31.push($32);
						
						if($2U){$2U($32);}
					};
					
					while($31.length>$2Y){
						$1l=$31.pop();
						
						if($2V){
							$2V($1l);
						}
					}
				}
			};
			
			this.$4c=function(){
				if($2Z.length==0){
					return true;
				}else{
					return false;
				}
			};
			
			this.$4e=function(){
				return $2Z[0].length;
			};
			
			this.$4d=function(){
				return $2Z.length;
			};
			
			this.$43=function(){
				var $33=$2Z.pop();
				$2Z.unshift($33);
				
				for(y=0;y<$33.length;y++){
					$1l=$33[y];$1l.x=0;
					$1l.y=y;
					
					if($2W){
						$2W($1l);
					}
				}
			};
			
			this.$42=function(){
				var $34=$2Z.shift();
				$2Z.push($34);
				
				for(y=0;y<$34.length;y++){
					$1l=$34[y];
					$1l.x=$2Z.length-1;
					$1l.y=y;
					
					if($2W){
						$2W($1l);
					}
				}
			};
			
			this.$45=function(){
				for(x=0;x<$2Z.length;x++){
					$35=$2Z[x].pop();
					$2Z[x].unshift($35);
					$35.x=x;
					$35.y=0;
					
					if($2W){
						$2W($35);
					}
				}
			};
			
			this.$44=function(){
				for(x=0;x<$2Z.length;x++){
					$36=$2Z[x].shift();
					$2Z[x].push($36);
					$36.x=x;
					$36.y=$2Z[x].length-1;
					
					if($2W){
						$2W($36);
					}
				}
			};
			
			this.$3z=function(x,y){
				return $2Z[x][y];
			};
			
			var self=this;
			var $2Z=new Array();
			this.$3Z($2T);
		};
		
		var $0E=new Object();
		$0E.$3J=function(element,style){
			element.style.cursor=style
		};
		
		$0E.$3H=function(x){
			return x+"px";
		};
		
		$0E.$41=function($37){
			var $38=new $01();
			
			while($37){
				$38.x+=$37.offsetLeft;
				$38.y+=$37.offsetTop;
				$37=$37.offsetParent
			};
			
			return $38;
		};
		
		$0E.$40=function($37,$39){
			var $38=new $01();
			while($37&&$37!=$39){
				$38.x+=$37.offsetLeft;
				$38.y+=$37.offsetTop;
				$37=$37.offsetParent
			};
			return $38;
		};
		
		$0E.$3G=function($3a,$2H,$2I,$0N,top,$3b,$3c){
			var $3d;
			
			if(($3c)&&($16.$3I('ie'))){
				$3d=document.createElement("span");
				$3d.loader=document.createElement("img");
				$3d.loader.style.visibility="hidden";
				$3d.loader.onload=function(){
					$3d.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+$3a+"',sizingMethod='crop')";
					$3d.src=this.src;
				};
				
				if($3a){
					$3d.loader.src=$3a;
				}
			}else{
				$3d=document.createElement("img");
				
				if($3a){
					$3d.src=$3a;
				}
			};
			
			$3d.style.border=$0E.$3H(0);
			$3d.style.position="absolute";
			
			if($2H){
				$3d.style.width=$0E.$3H($2H);
				$3d.width=$2H
			};
			
			if($2I){
				$3d.style.height=$0E.$3H($2I);
				$3d.height=$2I
			};
			
			if(top||top==0){
				$3d.style.top=$0E.$3H(top)
			};
			
			if($0N||$0N==0){
				$3d.style.left=$0E.$3H($0N)
			};
			
			if($3b||$3b==0){
				$3d.style.zIndex=$3b
			};
			
			$3d.oncontextmenu=function(){
				return false
			};
			
			if($16.$3I('ie')){
				if(!$3c){
					$3d.unselectable="on";
					$3d.galleryimg="no";
				}
			};
			
			if($16.$3I('gecko')){
				$3d.style.MozUserSelect="none"
			};
			return $3d;
		};
		
		$0E.$4i=function(element,$2L){
			new Effect.Fade(element,Object.extend({duration:.4},$2L));
		};
		
		$0E.$4h=function(element,$2L){
			new Effect.Appear(element,Object.extend({duration:.2},$2L));
		};
		
		$0E.$3D=function($0P){
			if($16.$3I('ie')){
				$0P.cancelBubble=true;
			}else{
				$0P.stopPropagation();
			}
		};
		
		$0E.$3s=function($3e,$3f,$3g,$3h){
			this.update=function($3i){
				var $0D=$3j*$3i+$3k;
				var $0C=$3l*$3i+$3m;$0g($0D,$0C);
			};
		
			this.before=function(){
				if($0F.$4n){
					$0F.$4n()
				}
			};
			
			this.finish=function(){
				if($0F.$4o){
					$0F.$4o()
				};
				
				if($3h){
					$3h();
				}
			};
			
			function $0g($0D,$0C){
				$0F.$4b($0D,$0C);
			};
			
			var $0F=$3e;
			var $3k=$0F.$4a();
			var $3m=$0F.$49();
			var $3j=$3f;
			var $3l=$3g;
			
			Object.extend(this,Effect.Base.prototype);
			this.before();
			this.start(arguments[3]);
		};

window.ZoomSize=$SetZoomSize;
window.WORLDMap=$a;
window.Marker=$06;
window.Icon=$0b;
window.Img=$0c;
window.XYPoint=$01;
window.WindowOptions=$09;
window.MapWindow=$07;
window.MapOptions=$0a;
window.Bounds=$02;
window.createImage=$0E.$3G;
window.isBrowser=$16.$3I;
};

MAP_JS(SERVICES_URL,X_MIN,X_MAX,Y_MIN,Y_MAX);


var lh = new Object(); 
var rlh = new Object(); 
var o;

function WORLDPoint (name, local_x, local_y) {
  if(!local_x) { local_x = 0; }
  if(!local_y) { local_y = 0; }
  var downcased_name = name.toLowerCase();
  this.x = lh[downcased_name].x + (local_x / $ImageSize);
  this.y = lh[downcased_name].y + (local_y / $ImageSize);
}

function gotoWORLDURL(x,y) {
  //alert($SERVICES_URL + "asset/link?x=" + x + "&y=" + y);
  //$('ifrmxxx').src = $SERVICES_URL + "asset/link?x=" + x + "&y=" + y;
  var int_x = Math.floor(x);
  var int_y = Math.floor(y);
  
  var local_x = Math.round((x - int_x) * $ImageSize);
  var local_y = Math.round((y - int_y) * $ImageSize);

  var url = "secondlife://" + rlh[int_x + "-" + int_y].replace(/\s/, "_") + "/" + local_x + "/" + local_y;
  document.location = url;
}

function getRegionName(x,y) {
  return rlh[Math.floor(x)+"-"+Math.floor(y)];
  
}