     <hr>
                    <div class="copyright-info">
                         <p class="text-center">
                            <span>Copyright © 2015, PayeHub high risk and offshore merchant accounts</span>
                        </p>
                    </div>

                </div>
                <!-- /content wrapper -->
                <a class="exit-offscreen"></a>

		    </div></div></div></section>
            <!-- /main content -->
        </section>

    </div>
    

        
    

<!-- /inner content wrapper -->
<script language="JavaScript">
	function Prev1(){
		window.history.back();
	}
	function Prev(location){
		window.location = location;
	}
	function showHidePannel(id){
		if(document.getElementById(id).style.display == "none"){
			document.getElementById(id).style.display = "block";
		}else{
			document.getElementById(id).style.display = "none";
		}
	}
	
		jQuery(function(){
		        if ($.isFunction($.fn.chosen)) {
		            $(".chosen").chosen();
		        }
		
				/**
				 * For disabling form when the merchant form is locked
				 */
        		var notDisClasses = ["button-1","button-2","phub-merchant-form-na"];
				if( typeof (merchantFormLocked) !== "undefined" && merchantFormLocked === true){
					var phubForm = jQuery(".phub-merchant-form");
					var formElms = phubForm.find("select,input");
					
					formElms.each(function(idx,elm){
						var elmDis = true;
						var jElm = jQuery(elm);
						for(var idx in notDisClasses){
							
							if (jElm.hasClass(notDisClasses[idx])){
								console.log(elm.getAttribute("name"),notDisClasses[idx]);
								elmDis = false;
								break;
							}
						}
						if(elmDis){
							elm.setAttribute("readonly","true");
							//console.log("disabled element name:" + elm.getAttribute("name"));
						}else{
							//console.log("ignore element name:" + elm.getAttribute("name"));
						}
						
						
						
					});
				}
				
				/**
				 * For showing/ hiding form elements based on the click
				 */
				 
				 var jCombineFields = jQuery(".combine-field");
				 var processCombineField = function(processFieldClass,op){
				 	//console.log("processCombineField [processFieldClass:" + processFieldClass + ", op:" + op + "]");
				 	var jOpFields = jQuery(jQuery(".combine-field." + processFieldClass)); 
				 	if(op === true){
				 		//console.log("Show : ", jOpFields);
				 		jOpFields.show();
				 	}else{
				 		//console.log("Hide : ", jOpFields);
				 		jOpFields.hide();
				 	}
				 }
				 
				 var clearCombineFields = function(processFieldClass){
				 	var jOpFields = jQuery(jQuery(".combine-field." + processFieldClass + " input[type='text']"));
				 	//console.log("clearCombineFields: clearing the fields",jOpFields);
				 	
				 	jOpFields.val("");
				 }
				 
				 window.showCombineField = function(showFieldClass, clearFields){
				 	clearFields = ( typeof (clearFields) !== "undefined" && clearFields === true) ? true : false;
				 	if(clearFields){
				 		//console.log("clearing the fields");
				 		clearCombineFields(showFieldClass);
				 	}
				 	processCombineField(showFieldClass,true);
				 }
				 
				 window.hideCombineField = function(hideFieldClass,clearFields){
				 	clearFields = ( typeof (clearFields) !== "undefined" && clearFields === true) ? true : false;
				 	if(clearFields){
				 		clearCombineFields(hideFieldClass);
				 	}
				 	processCombineField(hideFieldClass,false);
				 }
				 
				 // set default combine field
				 var setDefaultCombineField = function(){
				 	//console.log("set default combine field");
				 	var combineFields = getFormMetaVal("combineFieldProcess");
				 	for(var fieldKey in combineFields){
				 		var fieldVal = combineFields[fieldKey];
				 		//console.log("[fieldKey:" + fieldKey + ", fieldVal:" + fieldVal + "]");
				 		if(fieldVal){
				 			showCombineField(fieldKey);
				 		}else{
				 			hideCombineField(fieldKey);
				 		}
				 	}
				 }
				 setDefaultCombineField();
				 
				 jQuery(".default-cb-val-y input[type='checkbox']").each(function(idx,elm){
				 	var jElm = jQuery(elm);
				 	var jElmName= jElm.attr("name");
				 	jQuery('<input type="hidden" name="' + jElmName + '" value="' + jElm.val() + '" />').insertBefore(jElm);
				 	
				 	jElm.attr("name",jElmName + "_cb");
				 	jElm.attr("data-hidden-elm",jElmName);
				 });
				 jQuery(".default-cb-val-y input[type='checkbox']").on("change",function(){
				 	//console.log("change",this);
				 	var jCbObj = jQuery(this);
				 	var trueVal = "Y";
				 	var falseVal = "N";
				 	if(jCbObj.attr("data-true-val")){
				 		trueVal = jCbObj.attr("data-true-val");
				 	}
				 	if(jCbObj.attr("data-false-val")){
				 		falseVal = jCbObj.attr("data-false-val");
				 	}
				 	var cbVal = falseVal;
				 	if (jCbObj.is(":checked")){
				 		cbVal = trueVal;
				 	}
				 	jQuery("input[name=" + jCbObj.attr("data-hidden-elm") + "]").val(cbVal);
				 	
				 });
			});
			
</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-29717607-1', 'auto');
  ga('send', 'pageview');
</script>
	 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("[type='button']").click();
    }
});
</script>

</body></html>