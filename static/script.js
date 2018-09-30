
window.onload = function(e){

	sheath();


}

function sheath(){
	var c3 = document.getElementsByClassName("content3")[0];
	var c2 = document.getElementsByClassName("content2")[0];
	var lb = document.getElementsByClassName("lilBox")[0];
	var hd = document.getElementsByClassName("header")[0];

	var id = setInterval(frame,1000/60);
	var frame = 0
	
	function frame() {
	    
	    if (frame==50) {
		
	        clearInterval(id);
	    } else {
	    	frame++;
	    	if(typeof c3 !=='undefined')c3.style.top=-200+7.68*(frame*Math.sin(frame*0.01+2.094));
	    	if(typeof c2 !=='undefined')c2.style.top=-200+7.68*(frame*Math.sin(frame*0.01+2.094));
	    	if(typeof lb !=='undefined')lb.style.top=-150+5.7*(frame*Math.sin(frame*0.01+2.094));
	    	if(typeof hd !=='undefined')hd.style.top=-100+3.85*(frame*Math.sin(frame*0.01+2.094));
		if (frame==1){
			if(typeof c3 !=='undefined')c3.style.opacity=1;
			if(typeof c2 !=='undefined')c2.style.opacity=1;
			if(typeof lb !=='undefined')lb.style.opacity=1;
			if(typeof hd !=='undefined')hd.style.opacity=1;
	    	}

	    }
	}

}