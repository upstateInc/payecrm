/*https://github.com/skidding/dragdealer*/
    (function(root,factory){if(typeof define==="function"&&define.amd){define(factory)}else{root.Dragdealer=factory()}})(this,function(){var Dragdealer=function(wrapper,options){this.bindMethods();this.options=this.applyDefaults(options||{});this.wrapper=this.getWrapperElement(wrapper);if(!this.wrapper){return}this.handle=this.getHandleElement(this.wrapper,this.options.handleClass);if(!this.handle){return}this.init();this.bindEventListeners()};Dragdealer.prototype={defaults:{disabled:false,horizontal:true,vertical:false,slide:true,steps:0,snap:false,loose:false,speed:.1,xPrecision:0,yPrecision:0,handleClass:"handle"},init:function(){this.value={prev:[-1,-1],current:[this.options.x||0,this.options.y||0],target:[this.options.x||0,this.options.y||0]};this.offset={wrapper:[0,0],mouse:[0,0],prev:[-999999,-999999],current:[0,0],target:[0,0]};this.change=[0,0];this.stepRatios=this.calculateStepRatios();this.activity=false;this.dragging=false;this.tapping=false;this.reflow();if(this.options.disabled){this.disable()}},applyDefaults:function(options){for(var k in this.defaults){if(!options.hasOwnProperty(k)){options[k]=this.defaults[k]}}return options},getWrapperElement:function(wrapper){if(typeof wrapper=="string"){return document.getElementById(wrapper)}else{return wrapper}},getHandleElement:function(wrapper,handleClass){var childElements=wrapper.getElementsByTagName("div"),handleClassMatcher=new RegExp("(^|\\s)"+handleClass+"(\\s|$)"),i;for(i=0;i<childElements.length;i++){if(handleClassMatcher.test(childElements[i].className)){return childElements[i]}}},calculateStepRatios:function(){var stepRatios=[];if(this.options.steps>1){for(var i=0;i<=this.options.steps-1;i++){stepRatios[i]=i/(this.options.steps-1)}}return stepRatios},setWrapperOffset:function(){this.offset.wrapper=Position.get(this.wrapper)},calculateBounds:function(){var bounds={top:this.options.top||0,bottom:-(this.options.bottom||0)+this.wrapper.offsetHeight,left:this.options.left||0,right:-(this.options.right||0)+this.wrapper.offsetWidth};bounds.availWidth=bounds.right-bounds.left-this.handle.offsetWidth;bounds.availHeight=bounds.bottom-bounds.top-this.handle.offsetHeight;return bounds},calculateValuePrecision:function(){var xPrecision=this.options.xPrecision||Math.abs(this.bounds.availWidth),yPrecision=this.options.yPrecision||Math.abs(this.bounds.availHeight);return[xPrecision?1/xPrecision:0,yPrecision?1/yPrecision:0]},bindMethods:function(){this.onHandleMouseDown=bind(this.onHandleMouseDown,this);this.onHandleTouchStart=bind(this.onHandleTouchStart,this);this.onDocumentMouseMove=bind(this.onDocumentMouseMove,this);this.onWrapperTouchMove=bind(this.onWrapperTouchMove,this);this.onWrapperMouseDown=bind(this.onWrapperMouseDown,this);this.onWrapperTouchStart=bind(this.onWrapperTouchStart,this);this.onDocumentMouseUp=bind(this.onDocumentMouseUp,this);this.onDocumentTouchEnd=bind(this.onDocumentTouchEnd,this);this.onHandleClick=bind(this.onHandleClick,this);this.onWindowResize=bind(this.onWindowResize,this)},bindEventListeners:function(){addEventListener(this.handle,"mousedown",this.onHandleMouseDown);addEventListener(this.handle,"touchstart",this.onHandleTouchStart);addEventListener(document,"mousemove",this.onDocumentMouseMove);addEventListener(this.wrapper,"touchmove",this.onWrapperTouchMove);addEventListener(this.wrapper,"mousedown",this.onWrapperMouseDown);addEventListener(this.wrapper,"touchstart",this.onWrapperTouchStart);addEventListener(document,"mouseup",this.onDocumentMouseUp);addEventListener(document,"touchend",this.onDocumentTouchEnd);addEventListener(this.handle,"click",this.onHandleClick);addEventListener(window,"resize",this.onWindowResize);var _this=this;this.interval=setInterval(function(){_this.animate()},25);this.animate(false,true)},unbindEventListeners:function(){removeEventListener(this.handle,"mousedown",this.onHandleMouseDown);removeEventListener(this.handle,"touchstart",this.onHandleTouchStart);removeEventListener(document,"mousemove",this.onDocumentMouseMove);removeEventListener(this.wrapper,"touchmove",this.onWrapperTouchMove);removeEventListener(this.wrapper,"mousedown",this.onWrapperMouseDown);removeEventListener(this.wrapper,"touchstart",this.onWrapperTouchStart);removeEventListener(document,"mouseup",this.onDocumentMouseUp);removeEventListener(document,"touchend",this.onDocumentTouchEnd);removeEventListener(this.handle,"click",this.onHandleClick);removeEventListener(window,"resize",this.onWindowResize);clearInterval(this.interval)},onHandleMouseDown:function(e){Cursor.refresh(e);preventEventDefaults(e);stopEventPropagation(e);this.activity=false;this.startDrag()},onHandleTouchStart:function(e){Cursor.refresh(e);stopEventPropagation(e);this.activity=false;this.startDrag()},onDocumentMouseMove:function(e){Cursor.refresh(e);if(this.dragging){this.activity=true}},onWrapperTouchMove:function(e){Cursor.refresh(e);if(!this.activity&&this.draggingOnDisabledAxis()){if(this.dragging){this.stopDrag()}return}preventEventDefaults(e);this.activity=true},onWrapperMouseDown:function(e){Cursor.refresh(e);preventEventDefaults(e);this.startTap()},onWrapperTouchStart:function(e){Cursor.refresh(e);preventEventDefaults(e);this.startTap()},onDocumentMouseUp:function(e){this.stopDrag();this.stopTap()},onDocumentTouchEnd:function(e){this.stopDrag();this.stopTap()},onHandleClick:function(e){if(this.activity){preventEventDefaults(e);stopEventPropagation(e)}},onWindowResize:function(e){this.reflow()},enable:function(){this.disabled=false;this.handle.className=this.handle.className.replace(/\s?disabled/g,"")},disable:function(){this.disabled=true;this.handle.className+=" disabled"},reflow:function(){this.setWrapperOffset();this.bounds=this.calculateBounds();this.valuePrecision=this.calculateValuePrecision();this.updateOffsetFromValue()},getStep:function(){return[this.getStepNumber(this.value.target[0]),this.getStepNumber(this.value.target[1])]},getValue:function(){return this.value.target},setStep:function(x,y,snap){this.setValue(this.options.steps&&x>1?(x-1)/(this.options.steps-1):0,this.options.steps&&y>1?(y-1)/(this.options.steps-1):0,snap)},setValue:function(x,y,snap){this.setTargetValue([x,y||0]);if(snap){this.groupCopy(this.value.current,this.value.target);this.updateOffsetFromValue();this.callAnimationCallback()}},startTap:function(){if(this.disabled){return}this.tapping=true;this.setWrapperOffset();this.setTargetValueByOffset([Cursor.x-this.offset.wrapper[0]-this.handle.offsetWidth/2,Cursor.y-this.offset.wrapper[1]-this.handle.offsetHeight/2])},stopTap:function(){if(this.disabled||!this.tapping){return}this.tapping=false;this.setTargetValue(this.value.current)},startDrag:function(){if(this.disabled){return}this.dragging=true;this.setWrapperOffset();this.offset.mouse=[Cursor.x-Position.get(this.handle)[0],Cursor.y-Position.get(this.handle)[1]]},stopDrag:function(){if(this.disabled||!this.dragging){return}this.dragging=false;var target=this.groupClone(this.value.current);if(this.options.slide){var ratioChange=this.change;target[0]+=ratioChange[0]*4;target[1]+=ratioChange[1]*4}this.setTargetValue(target)},callAnimationCallback:function(){var value=this.value.current;if(this.options.snap&&this.options.steps>1){value=this.getClosestSteps(value)}if(!this.groupCompare(value,this.value.prev)){if(typeof this.options.animationCallback=="function"){this.options.animationCallback.call(this,value[0],value[1])}this.groupCopy(this.value.prev,value)}},callTargetCallback:function(){if(typeof this.options.callback=="function"){this.options.callback.call(this,this.value.target[0],this.value.target[1])}},animate:function(direct,first){if(direct&&!this.dragging){return}if(this.dragging){var prevTarget=this.groupClone(this.value.target);var offset=[Cursor.x-this.offset.wrapper[0]-this.offset.mouse[0],Cursor.y-this.offset.wrapper[1]-this.offset.mouse[1]];this.setTargetValueByOffset(offset,this.options.loose);this.change=[this.value.target[0]-prevTarget[0],this.value.target[1]-prevTarget[1]]}if(this.dragging||first){this.groupCopy(this.value.current,this.value.target)}if(this.dragging||this.glide()||first){this.updateOffsetFromValue();this.callAnimationCallback()}},glide:function(){var diff=[this.value.target[0]-this.value.current[0],this.value.target[1]-this.value.current[1]];if(!diff[0]&&!diff[1]){return false}if(Math.abs(diff[0])>this.valuePrecision[0]||Math.abs(diff[1])>this.valuePrecision[1]){this.value.current[0]+=diff[0]*this.options.speed;this.value.current[1]+=diff[1]*this.options.speed}else{this.groupCopy(this.value.current,this.value.target)}return true},updateOffsetFromValue:function(){if(!this.options.snap){this.offset.current=this.getOffsetsByRatios(this.value.current)}else{this.offset.current=this.getOffsetsByRatios(this.getClosestSteps(this.value.current))}if(!this.groupCompare(this.offset.current,this.offset.prev)){this.renderHandlePosition();this.groupCopy(this.offset.prev,this.offset.current)}},renderHandlePosition:function(){if(this.options.horizontal){this.handle.style.left=String(this.offset.current[0])+"px"}if(this.options.vertical){this.handle.style.top=String(this.offset.current[1])+"px"}},setTargetValue:function(value,loose){var target=loose?this.getLooseValue(value):this.getProperValue(value);this.groupCopy(this.value.target,target);this.offset.target=this.getOffsetsByRatios(target);this.callTargetCallback()},setTargetValueByOffset:function(offset,loose){var value=this.getRatiosByOffsets(offset);var target=loose?this.getLooseValue(value):this.getProperValue(value);this.groupCopy(this.value.target,target);this.offset.target=this.getOffsetsByRatios(target)},getLooseValue:function(value){var proper=this.getProperValue(value);return[proper[0]+(value[0]-proper[0])/4,proper[1]+(value[1]-proper[1])/4]},getProperValue:function(value){var proper=this.groupClone(value);proper[0]=Math.max(proper[0],0);proper[1]=Math.max(proper[1],0);proper[0]=Math.min(proper[0],1);proper[1]=Math.min(proper[1],1);if(!this.dragging&&!this.tapping||this.options.snap){if(this.options.steps>1){proper=this.getClosestSteps(proper)}}return proper},getRatiosByOffsets:function(group){return[this.getRatioByOffset(group[0],this.bounds.availWidth,this.bounds.left),this.getRatioByOffset(group[1],this.bounds.availHeight,this.bounds.top)]},getRatioByOffset:function(offset,range,padding){return range?(offset-padding)/range:0},getOffsetsByRatios:function(group){return[this.getOffsetByRatio(group[0],this.bounds.availWidth,this.bounds.left),this.getOffsetByRatio(group[1],this.bounds.availHeight,this.bounds.top)]},getOffsetByRatio:function(ratio,range,padding){return Math.round(ratio*range)+padding},getStepNumber:function(value){return this.getClosestStep(value)*(this.options.steps-1)+1},getClosestSteps:function(group){return[this.getClosestStep(group[0]),this.getClosestStep(group[1])]},getClosestStep:function(value){var k=0;var min=1;for(var i=0;i<=this.options.steps-1;i++){if(Math.abs(this.stepRatios[i]-value)<min){min=Math.abs(this.stepRatios[i]-value);k=i}}return this.stepRatios[k]},groupCompare:function(a,b){return a[0]==b[0]&&a[1]==b[1]},groupCopy:function(a,b){a[0]=b[0];a[1]=b[1]},groupClone:function(a){return[a[0],a[1]]},draggingOnDisabledAxis:function(){return!this.options.horizontal&&Cursor.xDiff>Cursor.yDiff||!this.options.vertical&&Cursor.yDiff>Cursor.xDiff}};var bind=function(fn,context){return function(){return fn.apply(context,arguments)}};var addEventListener=function(element,type,callback){if(element.addEventListener){element.addEventListener(type,callback,false)}else if(element.attachEvent){element.attachEvent("on"+type,callback)}};var removeEventListener=function(element,type,callback){if(element.removeEventListener){element.removeEventListener(type,callback,false)}else if(element.detachEvent){element.detachEvent("on"+type,callback)}};var preventEventDefaults=function(e){if(!e){e=window.event}if(e.preventDefault){e.preventDefault()}e.returnValue=false};var stopEventPropagation=function(e){if(!e){e=window.event}if(e.stopPropagation){e.stopPropagation()}e.cancelBubble=true};var Cursor={x:0,y:0,xDiff:0,yDiff:0,refresh:function(e){if(!e){e=window.event}if(e.type=="mousemove"){this.set(e)}else if(e.touches){this.set(e.touches[0])}},set:function(e){var lastX=this.x,lastY=this.y;if(e.pageX||e.pageY){this.x=e.pageX;this.y=e.pageY}else if(e.clientX||e.clientY){this.x=e.clientX+document.body.scrollLeft+document.documentElement.scrollLeft;this.y=e.clientY+document.body.scrollTop+document.documentElement.scrollTop}this.xDiff=Math.abs(this.x-lastX);this.yDiff=Math.abs(this.y-lastY)}};var Position={get:function(obj){var curleft=0,curtop=0;if(obj.offsetParent){do{curleft+=obj.offsetLeft;curtop+=obj.offsetTop}while(obj=obj.offsetParent)}return[curleft,curtop]}};return Dragdealer});
    
    
$(document).ready(function(){

	//set defaults
	$("#plan-holder").text('Personal Plan:');
	$("#device-holder").text('Base+ 1 Person');
	$(".info-price").html('Base+ 1 Person');
	$(".annual-price").html('$ 99');
    
    new Dragdealer('pr-slider', {
    	animationCallback: function(x, y) {
			
      		var slider_value = ((Math.round(x * 100)));
      		//$("#pr-slider .value").text(slider_value);
      		var stripe_width = slider_value+1;
      		$(".stripe").css("width", ""+stripe_width+"%");
      		
			/*var person = 1;
			var price = 99;
			var increment = 5;*/
	  		
			if(slider_value  == 0)
			{
				console.log("000");
			}
			else if(slider_value == 100)
			{
				console.log("100");
				$(".info-price").html('<span style="font-size:12px; line-height:15px;">100+ people<br> Contact us and see if Payehub is right for you.<span>'); 
	    		$(".annual-price").html('');
	    		$("#device-holder").text('Unlimited Devices');
			}
			else
			{	
				console.log(slider_value);				
				$(".info-price").html('Base + '+slider_value+' Person'); 
	      		$(".annual-price").html('$ '+(94+(slider_value*5)) ); 	
			}
      //set personal
     // if(slider_value > 0 && slider_value < 6){
	    // $("#plan-holder").text('Personal Plan:');
		// $("#device-holder").text('0-3 Devices');
	    // $(".info-price").html('$ 0 / month');
	     
	    // $("#green-highlight").hide(); 
     // }
      
      //set basic
	  /*
      if(slider_value > 1 && slider_value < 100){
	      $("#plan-holder").text('Basic Plan:');
		  
		  $("#green-highlight").css("width", "100%");
	      $("#orange-highlight").show();
	      $("#blue-highlight").hide();
	      
	      //$("#orange-highlight").hide();
	     // $("#green-highlight").show();
	      //$("#green-highlight").css("width", ""+(slider_value+40.5)+"%");
		  
	      //if(slider_value > 1){ 
	      	//$(".info-price").html('1 Person'); 
	      	//$(".annual-price").html('$ 99'); 
	      //}	
	      if(slider_value > 2){
	      	$(".info-price").html('2 Person'); 
	      	$(".annual-price").html('$ 104'); 
	      	//$("#device-holder").text('Up to 20 Devices');
	      }	
	      if(slider_value > 3){
	      	$(".info-price").html('3 Person'); 
	      	$(".annual-price").html('$ 109'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 4){
	      	$(".info-price").html('4 Person'); 
	      	$(".annual-price").html('$ 114'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 5){
	      	$(".info-price").html('5 Person'); 
	      	$(".annual-price").html('$ 119'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 6){
	      	$(".info-price").html('6 Person'); 
	      	$(".annual-price").html('$ 124'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 7){
	      	$(".info-price").html('7 Person'); 
	      	$(".annual-price").html('$ 129'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 8){
	      	$(".info-price").html('8 Person'); 
	      	$(".annual-price").html('$ 134'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 9){
	      	$(".info-price").html('9 Person'); 
	      	$(".annual-price").html('$ 139'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 10){
	      	$(".info-price").html('10 Person'); 
	      	$(".annual-price").html('$ 144'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 11){
	      	$(".info-price").html('11 Person'); 
	      	$(".annual-price").html('$ 149'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 12){
	      	$(".info-price").html('12 Person'); 
	      	$(".annual-price").html('$ 154'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 13){
	      	$(".info-price").html('13 Person'); 
	      	$(".annual-price").html('$ 159'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 14){
	      	$(".info-price").html('14 Person'); 
	      	$(".annual-price").html('$ 164'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 15){
	      	$(".info-price").html('15 Person'); 
	      	$(".annual-price").html('$ 169'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 16){
	      	$(".info-price").html('16 Person'); 
	      	$(".annual-price").html('$ 174'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 17){
	      	$(".info-price").html('17 Person'); 
	      	$(".annual-price").html('$ 179'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 18){
	      	$(".info-price").html('18 Person'); 
	      	$(".annual-price").html('$ 184'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 19){
	      	$(".info-price").html('19 Person'); 
	      	$(".annual-price").html('$ 189'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 20){
	      	$(".info-price").html('20 Person'); 
	      	$(".annual-price").html('$ 194'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 21){
	      	$(".info-price").html('21 Person'); 
	      	$(".annual-price").html('$ 199'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 22){
	      	$(".info-price").html('22 Person'); 
	      	$(".annual-price").html('$ 204'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 23){
	      	$(".info-price").html('23 Person'); 
	      	$(".annual-price").html('$ 209'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 24){
	      	$(".info-price").html('24 Person'); 
	      	$(".annual-price").html('$ 214'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
	      if(slider_value > 25){
	      	$(".info-price").html('25 Person'); 
	      	$(".annual-price").html('$ 219'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 26){
	      	$(".info-price").html('26 Person'); 
	      	$(".annual-price").html('$ 224'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 27){
	      	$(".info-price").html('27 Person'); 
	      	$(".annual-price").html('$ 229'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 28){
	      	$(".info-price").html('28 Person'); 
	      	$(".annual-price").html('$ 234'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 29){
	      	$(".info-price").html('29 Person'); 
	      	$(".annual-price").html('$ 239'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 30){
	      	$(".info-price").html('30 Person'); 
	      	$(".annual-price").html('$ 244'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 31){
	      	$(".info-price").html('31 Person'); 
	      	$(".annual-price").html('$ 249'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 32){
	      	$(".info-price").html('32 Person'); 
	      	$(".annual-price").html('$ 254'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 33){
	      	$(".info-price").html('33 Person'); 
	      	$(".annual-price").html('$ 259'); 
	      	//$("#device-holder").text('Up to 30 Devices');
	      }
		  if(slider_value > 34){
	      	$(".info-price").html('34 Person'); 
	      	$(".annual-price").html('$ 264'); 
	      	
	      }
		  if(slider_value > 35){
	      	$(".info-price").html('35 Person'); 
	      	$(".annual-price").html('$ 269'); 
	      	
	      }
		  if(slider_value > 36){
	      	$(".info-price").html('36 Person'); 
	      	$(".annual-price").html('$ 274'); 
	      	
	      }
		  if(slider_value > 37){
	      	$(".info-price").html('37 Person'); 
	      	$(".annual-price").html('$ 279'); 
	      	
	      }
		  if(slider_value > 38){
	      	$(".info-price").html('38 Person'); 
	      	$(".annual-price").html('$ 284'); 
	      	
	      }
		  if(slider_value > 39){
	      	$(".info-price").html('39 Person'); 
	      	$(".annual-price").html('$ 289'); 
	      	
	      }
		  if(slider_value > 40){
	      	$(".info-price").html('40 Person'); 
	      	$(".annual-price").html('$ 294'); 
	      	
	      }
		  if(slider_value > 41){
	      	$(".info-price").html('41 Person'); 
	      	$(".annual-price").html('$ 299'); 
	      	
	      }
		  if(slider_value > 42){
	      	$(".info-price").html('42 Person'); 
	      	$(".annual-price").html('$ 304'); 
	      	
	      }
		  if(slider_value > 43){
	      	$(".info-price").html('43 Person'); 
	      	$(".annual-price").html('$ 309'); 
	      	
	      }
		  if(slider_value > 44){
	      	$(".info-price").html('44 Person'); 
	      	$(".annual-price").html('$ 314'); 
	      	
	      }
		  if(slider_value > 45){
	      	$(".info-price").html('45 Person'); 
	      	$(".annual-price").html('$ 319'); 
	      	
	      }
		  if(slider_value > 46){
	      	$(".info-price").html('46 Person'); 
	      	$(".annual-price").html('$ 324'); 
	      	
	      }
		  if(slider_value > 47){
	      	$(".info-price").html('47 Person'); 
	      	$(".annual-price").html('$ 329'); 
	      	
	      }
		  if(slider_value > 48){
	      	$(".info-price").html('48 Person'); 
	      	$(".annual-price").html('$ 334'); 
	      	
	      }
		  if(slider_value > 49){
	      	$(".info-price").html('49 Person'); 
	      	$(".annual-price").html('$ 339'); 
	      	
	      }
		  if(slider_value > 50){
	      	$(".info-price").html('50 Person'); 
	      	$(".annual-price").html('$ 344'); 
	      	
	      }
		  if(slider_value > 51){
	      	$(".info-price").html('51 Person'); 
	      	$(".annual-price").html('$ 349'); 
	      	
	      }
		  if(slider_value > 52){
	      	$(".info-price").html('52 Person'); 
	      	$(".annual-price").html('$ 354'); 
	      	
	      }
		  if(slider_value > 53){
	      	$(".info-price").html('53 Person'); 
	      	$(".annual-price").html('$ 359'); 
	      	
	      }
		  if(slider_value > 54){
	      	$(".info-price").html('54 Person'); 
	      	$(".annual-price").html('$ 364'); 
	      	
	      }
		  if(slider_value > 55){
	      	$(".info-price").html('55 Person'); 
	      	$(".annual-price").html('$ 369'); 
	      	
	      }
		  if(slider_value > 56){
	      	$(".info-price").html('56 Person'); 
	      	$(".annual-price").html('$ 374'); 
	      	
	      }
		  if(slider_value > 57){
	      	$(".info-price").html('57 Person'); 
	      	$(".annual-price").html('$ 379'); 
	      	
	      }
		  if(slider_value > 58){
	      	$(".info-price").html('58 Person'); 
	      	$(".annual-price").html('$ 384'); 
	      	
	      }
		  if(slider_value > 59){
	      	$(".info-price").html('59 Person'); 
	      	$(".annual-price").html('$ 389'); 
	      	
	      }
		  if(slider_value > 60){
	      	$(".info-price").html('60 Person'); 
	      	$(".annual-price").html('$ 394'); 
	      	
	      }
		  if(slider_value > 61){
	      	$(".info-price").html('61 Person'); 
	      	$(".annual-price").html('$ 399'); 
	      	
	      }
		  if(slider_value > 62){
	      	$(".info-price").html('62 Person'); 
	      	$(".annual-price").html('$ 404'); 
	      	
	      }
		  if(slider_value > 63){
	      	$(".info-price").html('63 Person'); 
	      	$(".annual-price").html('$ 409'); 
	      	
	      }
		  if(slider_value > 64){
	      	$(".info-price").html('64 Person'); 
	      	$(".annual-price").html('$ 414'); 
	      	
	      }
		  if(slider_value > 65){
	      	$(".info-price").html('65 Person'); 
	      	$(".annual-price").html('$ 419'); 
	      	
	      }
		  if(slider_value > 66){
	      	$(".info-price").html('66 Person'); 
	      	$(".annual-price").html('$ 424'); 
	      	
	      }
		  if(slider_value > 67){
	      	$(".info-price").html('67 Person'); 
	      	$(".annual-price").html('$ 429'); 
	      	
	      }
		  if(slider_value > 68){
	      	$(".info-price").html('68 Person'); 
	      	$(".annual-price").html('$ 434'); 
	      	
	      }
		  if(slider_value > 69){
	      	$(".info-price").html('69 Person'); 
	      	$(".annual-price").html('$ 439'); 
	      	
	      }
		  if(slider_value > 70){
	      	$(".info-price").html('70 Person'); 
	      	$(".annual-price").html('$ 444'); 
	      	
	      }
		  if(slider_value > 71){
	      	$(".info-price").html('71 Person'); 
	      	$(".annual-price").html('$ 449'); 
	      	
	      }
		  if(slider_value > 72){
	      	$(".info-price").html('72 Person'); 
	      	$(".annual-price").html('$ 454'); 
	      	
	      }
		  if(slider_value > 73){
	      	$(".info-price").html('73 Person'); 
	      	$(".annual-price").html('$ 459'); 
	      	
	      }
		  if(slider_value > 74){
	      	$(".info-price").html('74 Person'); 
	      	$(".annual-price").html('$ 464'); 
	      	
	      }
		  if(slider_value > 75){
	      	$(".info-price").html('75 Person'); 
	      	$(".annual-price").html('$ 469'); 
	      	
	      }
		  if(slider_value > 76){
	      	$(".info-price").html('76 Person'); 
	      	$(".annual-price").html('$ 474'); 
	      	
	      }
		  if(slider_value > 77){
	      	$(".info-price").html('77 Person'); 
	      	$(".annual-price").html('$ 479'); 
	      	
	      }
		  if(slider_value > 78){
	      	$(".info-price").html('78 Person'); 
	      	$(".annual-price").html('$ 484'); 
	      	
	      }
		  if(slider_value > 79){
	      	$(".info-price").html('79 Person'); 
	      	$(".annual-price").html('$ 489'); 
	      	
	      }
		  if(slider_value > 80){
	      	$(".info-price").html('80 Person'); 
	      	$(".annual-price").html('$ 494'); 
	      	
	      }
		  if(slider_value > 81){
	      	$(".info-price").html('81 Person'); 
	      	$(".annual-price").html('$ 499'); 
	      	
	      }
		  if(slider_value > 82){
	      	$(".info-price").html('82 Person'); 
	      	$(".annual-price").html('$ 504'); 
	      	
	      }
		  if(slider_value > 83){
	      	$(".info-price").html('83 Person'); 
	      	$(".annual-price").html('$ 519'); 
	      	
	      }
		  if(slider_value > 84){
	      	$(".info-price").html('84 Person'); 
	      	$(".annual-price").html('$ 524'); 
	      	
	      }
		  if(slider_value > 85){
	      	$(".info-price").html('85 Person'); 
	      	$(".annual-price").html('$ 529'); 
	      	
	      }
		  if(slider_value > 86){
	      	$(".info-price").html('86 Person'); 
	      	$(".annual-price").html('$ 534'); 
	      	
	      }
		  if(slider_value > 87){
	      	$(".info-price").html('87 Person'); 
	      	$(".annual-price").html('$ 539'); 
	      	
	      }
		  if(slider_value > 88){
	      	$(".info-price").html('88 Person'); 
	      	$(".annual-price").html('$ 544'); 
	      	
	      }
		  if(slider_value > 89){
	      	$(".info-price").html('89 Person'); 
	      	$(".annual-price").html('$ 549'); 
	      	
	      }
		  if(slider_value > 90){
	      	$(".info-price").html('90 Person'); 
	      	$(".annual-price").html('$ 554'); 
	      	
	      }
		  if(slider_value > 91){
	      	$(".info-price").html('91 Person'); 
	      	$(".annual-price").html('$ 559'); 
	      	
	      }
		  if(slider_value > 92){
	      	$(".info-price").html('92 Person'); 
	      	$(".annual-price").html('$ 564'); 
	      	
	      }
		  if(slider_value > 93){
	      	$(".info-price").html('93 Person'); 
	      	$(".annual-price").html('$ 569'); 
	      	
	      }
		  if(slider_value > 94){
	      	$(".info-price").html('94 Person'); 
	      	$(".annual-price").html('$ 574'); 
	      	
	      }
		  if(slider_value > 95){
	      	$(".info-price").html('95 Person'); 
	      	$(".annual-price").html('$ 579'); 
	      	
	      }
		  if(slider_value > 96){
	      	$(".info-price").html('96 Person'); 
	      	$(".annual-price").html('$ 584'); 
	      	
	      }
		  if(slider_value > 97){
	      	$(".info-price").html('97 Person'); 
	      	$(".annual-price").html('$ 589'); 
	      	
	      }
		  if(slider_value > 98){
	      	$(".info-price").html('98 Person'); 
	      	$(".annual-price").html('$ 594'); 
	      	
	      }
		  if(slider_value > 99){
	      	$(".info-price").html('99 Person'); 
	      	$(".annual-price").html('$ 599'); 
	      	
	      }
		  if(slider_value > 100){
	      	$(".info-price").html('100 Person'); 
	      	$(".annual-price").html('$ 604'); 
	      	
	      }
		  	
	      
      }
      
      //set business
      //if(slider_value > 34 && slider_value < 64){
	      //$("#plan-holder").text('Business Plan:');
	      
	      //$("#green-highlight").css("width", "314px");
	      //$("#orange-highlight").show();
	      //$("#blue-highlight").hide();
	      
	      /*
	      if(slider_value > 38){ 
	      	$(".info-price").html('$ 249 / month'); 
	      	$(".annual-price").html('$ 2490');
	      	$("#device-holder").text('Up to 50 Devices');
	      }*/
		  
		  
	      
		  
	      
	      //if(slider_value < 40){ $("#orange-highlight").hide(); }
	      //if(slider_value > 40){ $("#orange-highlight").css("width", ""+(slider_value/4.8)+"%"); }
	      
	      //if(slider_value > 44){
	      	//$(".info-price").html('$ 579 / month'); 
	      	//$(".annual-price").html('$ 5790'); 
	      	//$("#device-holder").text('Up to 125 Devices');
	      	
	      	//$("#orange-highlight").css("width", ""+(slider_value/2.5)+"%");
	      //}
	      
	      //if(slider_value > 50){ $("#orange-highlight").css("width", ""+(slider_value/1.7)+"%"); }
	      
	      //if(slider_value > 57){
	      	//$(".info-price").html('$ 799 / month'); 
	      	//$(".annual-price").html('$ 7990'); 
		  	//$("#device-holder").text('Up to 175 Devices');
	      //}
	      
	      //if(slider_value > 68){ $("#orange-highlight").css("width", ""+(slider_value/1.6)+"%"); }
	      
	      //if(slider_value > 70){
	      	//$(".info-price").html('$ 999 / month'); 
	      	//$(".annual-price").html('$ 9990'); 
	      	//$("#device-holder").text('Up to 225 Devices');
	      //}
      //}
      
      //set enterprise
      //if(slider_value > 65 && slider_value < 100){
	      //$("#plan-holder").text('Enterprise Plan:');
	      
	     // $("#green-highlight").css("width", "433px");
	      //$("#orange-highlight").show();
	      //$("#blue-highlight").hide();
		  
		  
		  //}	
      
    	}
	});
    
});