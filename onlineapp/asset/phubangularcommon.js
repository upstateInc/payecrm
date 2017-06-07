if($ && $.fn && $.fn.datepicker && $.fn.datepicker.noConflict){
		var datepicker = $.fn.datepicker.noConflict();
		$.fn.bootstrapDP = datepicker;
}
var isDefined = function(arg1){
	return (typeof(arg1) !== "undefined");
}
angular.module('initFromForm', [])

/* Directive to catch the change/loading of values the first time and then execute the expression stored in the value part of the directive's attribute */
.directive("fnFirstChange",["$parse", function($parse){
	return {
		require : 'ngModel',
		link : function (scope, element, attrs, ngModel){
			var bindWatchCount = 0;
		   var unbindObserve = attrs.$observe('ngModel', function(value){ // Got ng-model bind path here
              var unbindWatch = scope.$watch(value,function(newValue){ // Watch given path for changes
            	  if(attrs.fnFirstChange){
            		  scope.$eval(attrs.fnFirstChange);
            	  }
            	  unbindObserve();
        		  unbindWatch();
              });
		   });
		}
	}
}])

/* Directive to catch the change/loading of values and then execute the expression stored in the value part of the directive's attribute */
.directive("fnBindValueChange", ["$parse", function($parse){
	return {
		require : 'ngModel',
		link : function (scope, element, attrs, ngModel){
			var bindWatchCount = 0;
		   var unbindObserve = attrs.$observe('ngModel', function(value){ // Got ng-model bind path here
              var unbindWatch = scope.$watch(value,function(newValue){ // Watch given path for changes
                  //console.log(newValue);
            	  var runFn = true;
            	  
            	  //Checking if fn-bind-value-no-first-change is set
            	  //If its set, then the function should not run for the first time, the value changed
            	  if(!angular.isUndefined(attrs.fnBindValueNoFirstChange) && bindWatchCount === 0){
            		  runFn = false;
            	  }
            	  if(runFn){
            		  scope.$eval(attrs.fnBindValueChange);
            	  }
                  
            	  bindWatchCount++;

              });
           });
		}
	}
}])

/* Used only for the Dynamic report - edit mode, where in we need to group the data in the criteria with brackets as per the criteria required 
 * This will be used to validate the groupingCriteria field
 * 
 * */
.directive("validateDynamicReportCriteria", ["$parse", function ($parse) {
	/*
	return {
	      require: 'ngModel',
	      link: function(scope, elem, attr, ngModel) {
	          var blacklist = attr.blacklist.split(',');

	          //For DOM -> model validation
	          ngModel.$parsers.unshift(function(value) {
	             var valid = blacklist.indexOf(value) === -1;
	             ngModel.$setValidity('blacklist', valid);
	             return valid ? value : undefined;
	          });

	          //For model -> DOM validation
	          ngModel.$formatters.unshift(function(value) {
	             ngModel.$setValidity('blacklist', blacklist.indexOf(value) === -1);
	             return value;
	          });
	      }
	};
	*/
	
	var verifyBrackets = function(strArr){
		var brCnt = 0;
		for(var i in strArr){
			if(strArr[i] === '('){
				brCnt++;
			}else if(strArr[i] === ')'){
		    	brCnt--;
			}
		}
		return (brCnt === 0);
	}
	
	var validOnOperators = {"(":1,")":1};
	
	var verifyOperators = function(strArr){
		return true;
		/*
		var brCnt = 0;
		var lastElm = "";
		var nextElm = "";
		for(var i in strArr){
			nextElm = (typeof strArr[i+1]!== "undefined")?strArr[i+1]:"";
			
			if(strArr[i] === 'AND' || strArr[i] === 'OR'){
				if(! ( (validOnOperators[lastElm] || !isNaN(lastElm)) && ( validOnOperators[nextElm] || isNaN(nextElm)) ) ){
					console.log("lastElm:" + lastElm, ", current:" + strArr[i] + ", next:" + nextElm);
					brCnt++;
				}
			}
			
			lastElm = strArr[i];
		}
		return (brCnt === 0);
		*/
	}
	
	return {
        // restrict to an attribute type.
		restrict: 'A',
		// element must have ng-model attribute.
        require: 'ngModel',
        link: function(scope, ele, attrs, ctrl){
     	  
           // add a parser that will process each time the value is
           // parsed into the model when the user updates it.
        	ctrl.$parsers.unshift(function(value) {
        		
        		if(value){
             	
		         	var separators = ['(\\\()','(\\\))' ,'(OR)', '(AND)' ];
		         	console.log(separators.join('|'));
		         	var tokens = value.split(new RegExp(separators.join('|'),'g'));
		         	var validBr = verifyBrackets(tokens);
		         	//validOp = verifyOperators(tokens);
		         	if(validBr === true){
		         		ctrl.$setValidity('validateDynamicReportCriteria', true);
		         		return value;
		         	}else{
		         		ctrl.$setValidity('validateDynamicReportCriteria', false);
		         		return undefined;
		         	}
        		}

	             // if it's valid, return the value to the model,
	             // otherwise return undefined.
        		return undefined;
           });

        }
       }
}])

/* Directive to load the value to the ngModel from the value attribute in the element */
.directive("initFromForm", ["$parse", function ($parse) {
  return {
    link: function (scope, element, attrs) {
      var attr = attrs.initFromForm || attrs.ngModel || (attrs['name']?attrs['name']+"Model":null),
      val = attrs.value;
      if(attr){
	      if(typeof attrs.origVal !== "undefined"){
	    	  val = attrs.origVal;
	      }
	
	      if(attrs.type === 'radio' && attrs.origVal){
	    	  //console.log(attr,attrs.origVal);
	    	  $parse(attr).assign(scope, attrs.origVal);
	      }else if(attrs.type === 'checkbox' && attrs.origVal){
	    	  //console.log(attr,attrs.origVal);
	    	  var val = false;
	    	  if(attrs.origVal === attrs.value){
	    		  val = true;
	    	  }
	    	  $parse(attr).assign(scope, attrs.origVal);
	      }else if(element[0].tagName === 'SELECT' && ( attrs.origVal || element.val() ) ){
	    	  val = attrs.origVal || element.val();
	    	  
	    	  //checking for null/undefined values in SELECT fields
	    	  if(val.indexOf("string:") != -1){
	    		  val = "";
	    	  }
	    	  if(!val && element.val()){
	    		  val = element.val();
	    	  }
	    	  $parse(attr).assign(scope, val);
	    	  scope[attr] = val;
	    	  //console.log("attr",attr,"::",val);
	      }else{
	    	  if(attrs.type === 'number'){
	    		  val = val.replace(/([^0-9\.])/g, '');
	    		  if(val){
	    			  val = parseFloat(val);
	    		  }else{
	    			  val = undefined;
	    		  }
	    		  element.attr("step","any");
	    		  //console.log(attrs.type,val);
	    	  }
	    	  //console.log(element[0].tagName ,attrs.name, val);
	    	  $parse(attr).assign(scope, val);
	      }
      }
      
    }
  };
}])

.directive("datePicker",["$parse", function($parse){
	return{
		link:function(scope, element, attrs){
			//console.log("inside directive DateFormat's link function:", element, attrs);
			//vaattr = attrs.ngModel;
			var showFormat = attrs.showFormat;
			var valueFormat = attrs.valueFormat;
			var timeFormat = attrs.timeFormat;
			var showTimeFormat = attrs.showTimeFormat?attrs.showTimeFormat:timeFormat;
			var valueDate = attrs.value;
			//console.log("Trying to parse date [", attrs.name, "] [valueFormat:", valueFormat + ", valueDate:", valueDate + "]", attrs.timePicker);
			var newDate = null;
			var showTime = null;
			if(typeof attrs.timePicker !== "undefined"){
				//console.log("newDate:", "111");
				newDate = $.datepicker.parseDateTime( valueFormat, timeFormat , valueDate);
				if(newDate){
					showTime = $.datepicker.formatTime( showTimeFormat, {hour:newDate.getHours(), minute:newDate.getMinutes(), second:newDate.getSeconds(), millisecond:newDate.getMilliseconds()});
				}
				//console.log("newDate:", newDate);
			}else{
				newDate = $.datepicker.parseDate( valueFormat, valueDate);
			}
			
			var showDate = $.datepicker.formatDate( showFormat, newDate);
			//console.log("Date parsed", showDate, showTime);
			var origId = attrs.id?attrs.id:attrs.name;
			var origName = attrs.name;
			
			var enableChangeDate = true;
			if(typeof attrs.noChangeDate !== "undefined"){
				enableChangeDate = false;
				//console.log("ChangeDate")
			}
			//console.log("origId",origId,", valueDate:",valueDate,", showDate:",showDate, typeof showDate);
			//var origElm = jQuery("<input />").attr("type","text").attr("name",origName).attr("id",origId).attr("value",showDate);
			
			//Renaming current element to a temp
			element.attr("name", origName + "Temp");
			
			//var newElement = element.parent().append(origElm);
			var parentElm = null;
			if(typeof attrs.formName !== "undefined" && jQuery("form[name=" + attrs.formName + "]")){
				parentElm = jQuery("form[name=" + attrs.formName + "]");
				
				//Searching for existing field with same name
				var jExistingRedundantElm = jQuery("form[name=" + attrs.formName + "] [name=" + origName + "]");
				if(jExistingRedundantElm != null){
					//console.log(jExistingRedundantElm, "Element of DATE type removed having same name!");
					jExistingRedundantElm.remove();
					
				}
			}else{
				parentElm = element.parent();
			}
			var attrsRequired = "";
			if(typeof attrs.required !== "undefined"){
				attrsRequired = " required='required' ";
			}
			
			//Renaming current element to a original Name
			element.attr("name", origName);
			
			var newElement = parentElm.append("<input " + attrsRequired + " type='hidden' name='" + origName + "' id='" + origId + "' value='" + valueDate + "' />");
			//console.log("parentElm",parentElm);
			element.attr('id',origId + 'Ng');
			element.attr("value",showDate);
			//console.log("origId",origId);
			element.attr('name',origName + 'Ng');
			//console.log("#" + origId);
			//console.log("[name:", origName, ", showDate:" + showDate + ", showFormat:",showFormat, ", valueDate:", valueDate ,", valueFormat:", valueFormat , "]");
			var datepickerParams = {
					changeMonth: enableChangeDate,
					changeYear: enableChangeDate,
					changeDate: enableChangeDate,
					dateFormat: showFormat,
					altField: "#" + origId,
				    altFormat: valueFormat,
				    constrainInput:true,
				    yearRange:"c-100:c+50"
			};
			
			
			
			if(typeof attrs['dateDob'] !== "undefined"){
				datepickerParams.minDate = -365*100;
				datepickerParams.maxDate = (-365.25*15 + daysLeftInCurrentYear);
				//console.log("Added DOB to ",attrs.name);
			}
			
			if(typeof attrs['minDateInString'] !== "undefined"){
				datepickerParams.minDate = new Date(attrs['minDateInString']);
			}
			
			jQuery(function(){
				//console.log("Initing date",datepickerParams);
				if(typeof attrs.timePicker !== "undefined"){
					var timePickerParams = {
							showSecond: true,
							timeFormat: showTimeFormat,
							altTimeFormat : timeFormat,
							altTime: "#" + origId + "Time",
							stepHour: 1,
							stepMinute: 1,
							stepSecond: 1,
							showMillisec:false,
							showMicrosec:false,
							altFieldTimeOnly:false							
					};
					jQuery.extend( timePickerParams, datepickerParams );
					jQuery( element ).datetimepicker(timePickerParams).datepicker("setDate", newDate);
				}else{
					jQuery( element ).datepicker(datepickerParams).datepicker("setDate", newDate);
				}
				
				if(!enableChangeDate){
					jQuery( element ).datepicker("destroy");
				}
				jQuery("[data-clear-button=" + attrs.name + "]").click(function(e) {
				    $.datepicker._clearDate(element);
				});
				//jQuery( element ).datepicker( "setDate", showDate );
			})
			
			
		}
	}
}])

.directive("matchVal", [ "$parse", function(){
          // requires an isloated model
          return {
           // restrict to an attribute type.
           restrict: 'A',
          // element must have ng-model attribute.
           require: 'ngModel',
           scope:{
        	   'matchVal':"="
           },
           link: function(scope, ele, attrs, ctrl){
        	  
              // add a parser that will process each time the value is
              // parsed into the model when the user updates it.
              ctrl.$parsers.unshift(function(value) {
            	  var valid = undefined;
                if(value){
                	//console.log("scope.matchVal:",scope.matchVal);
                	
                  //console.log(value)// test and set the validity after update.
                  if(scope.matchVal===value){
                	  ctrl.$setValidity('matchVal', true);
                	  valid = true;
                  }else{
                	  valid=false;
                	  ctrl.$setValidity('matchVal', false);
                  }
                  
                }

                // if it's valid, return the value to the model,
                // otherwise return undefined.
                return valid;
              });

           }
          }
}] )

.filter("selectFirstOptionOther", function() {
    return function(obj) {
        var result = [];
        angular.forEach(obj, function(val){
        	result.push(val);
        });
        var field = 'industryName';
        result.sort(function (a, b) {
        	if (a[field] < b[field])
        	     return -1;
        	  if (a[field] > b[field])
        	    return 1;
        	  return 0;
        });
        newResult = [];
        angular.forEach(result, function(val){
        	if(val[field] === 'Other'){
        		newResult.push(val);
        	}
        });
        angular.forEach(result, function(val){
        	if(val[field] !== 'Other'){
        		newResult.push(val);
        	}
        });
        
        return newResult;
    }
})

/* Directive to load the data as constant accessible via factory "CONS" defined in the next part */
.directive("createConstant",["CONS","$http","$interval", function(CONS, $http, $interval){
	var jsonEscape = function (str)  {
		return str;//.replace(/(?:\\r\\n|\\r|\\n)/gm, '<br />');
	    //return str.replace(/\\n/gm, "\n").replace(/\\r/gm, "\r").replace(/\\t/gm, "\t").replace(/\\f/gm, "\f");
	}
	return{
		link:function(scope, element, attrs){
			//console.log(attrs.name,attrs.value);
			var val = attrs.value;
			if(attrs.type && attrs.type === "json"){
				//console.log(val);
				/*window.newval = val;
				console.log(val);
				console.log(jsonEscape(val));
				val = jsonEscape(val);
				JSON.parse(val);*/
				val = angular.fromJson(val);
			}
			var primaryKey = null;
			if(attrs.primaryKey){
				primaryKey = attrs.primaryKey; 
			}
			
			var appendData = false;
			if(attrs.append && attrs.append ==="append"){
				appendData = true; 
			}
			
			if(attrs.url){
				var makeRequest = function(){
					var httpReq = {};
					httpReq.method = "GET";
					httpReq.url = attrs.url;
					if(attrs.value){
						httpReq.method = "POST";
						httpReq.data = $.param(val);
						httpReq.headers = {'Content-Type': 'application/x-www-form-urlencoded'};
					}
					$http(httpReq).
			        success(function(data, status) {
			        	//console.log("Success:", data, status);
			        	if(data && data[attrs.name]){
			        		CONS.createConstant(attrs.name, data[attrs.name], primaryKey);
			        	}//$scope.data = data;
			        }).
			        error(function(data, status) {
			        	console.log("Error:", data, status);
			        	//$scope.data = data || "Request failed";
			        	//$scope.status = status;
			      });
				};
				makeRequest();
				if(attrs.repeatHttpRequest){
					//$timeout(makeRequest)
					var interv = parseInt(attrs.repeatHttpRequest)?parseInt(attrs.repeatHttpRequest):60000;
					$interval(makeRequest, interv);
				}
				/*
				var tempAttrs = {};
				angular.forEach(attrs, function(attVal, attKey){
					tempAttrs[attKey] = attVal;
				});
				tempAttrs.val = val;
				tempAttrs.primaryKey = primaryKey;
				tempAttrs.$http = $http;
				makeRequest(tempAttrs);
				if(attrs.repeatHttpRequest){
					var interv = parseInt(attrs.repeatHttpRequest)?parseInt(attrs.repeatHttpRequest):60000;
					$interval(makeRequest, interv, true, tempAttrs);
				}*/
			}else{
				CONS.createConstant(attrs.name, val, primaryKey, appendData);
			}
			
		}
	};
}])

.directive("typeAhead", ["$http", "$compile","$q", function($http, $compile, $q){
	
	return {
		restrict : "A",
		require : 'ngModel',
		scope:{value:"@",writeModel:'=',ngModel:'='},
		//transclude:true,
		//replace:true,
		//template:"<div><input type='text' ng-model='{{ngModel}}' class='form-control form-1' /><ul><li data-ng-repeat='row in resultData'>{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</li><ul></div>",
		link: function(scope, element, attrs, ctrl){
			console.log("linking typeAhead");
			scope.deferredObj = null;
			    /*element.append(clone);
			    element.append(clone);*/
			//var jParent = element.parent();
			//element.after($compile("<input name='" + attrs.name + "' value='{{" + attrs.writeModel + "}}' /> <ul class='ajax-json-ul'><li data-ng-repeat='row in resultData'><a ng-click='$parent." + attrs.writeModel + "=row." + attrs.jsonKey + ";" + attrs.ngModel + "=row." + attrs.jsonKey + "' >{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</a></li></ul>")(scope));
			//element.after($compile("<ul class='ajax-json-ul'><li data-ng-repeat='row in resultData'><a ng-click='$parent.updateDataModel" + "({\"modelName\":\"task\",\"modelSubName\":\"relatedTo\",\"modelValue\":row." + attrs.jsonKey + "});' >{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</a></li></ul>")(scope));
			element.after($compile("<ul data-ng-hide='!showList || !resultData' class='ajax-json-ul'><li data-ng-repeat='row in resultData'><a ng-click='$parent.writeModel=row." + attrs.jsonKey + ";$parent.ngModel=row." + attrs.jsonShow + ";$parent.showList=false;' >{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</a></li></ul>")(scope));
			//element.attr("name", element.attr("name") + "Ng");
			ctrl.$parsers.unshift(function(value) {
				scope.showList = true;
            	console.log("scope.matchVal:",value);
            	if(scope.defferedObj){
            		scope.defferedObj.abort();	
            	}
            	scope.deferredObj = $q.defer();
            	if(value && value.length > 0){
            		var httpReq = {
            			"url":attrs.typeAhead,
						"method":"POST",
						"data":jQuery.param({"searchStr":value}),
						"headers":{'Content-Type': 'application/x-www-form-urlencoded'},
						"timeout": scope.deferredObj.promise
					}
					//}
					$http(httpReq).
			        success(function(data, status) {
			        	//console.log("Success:", data, status);
			        	if(data && data[attrs.jsonName]){
			        		scope.resultData = data[attrs.jsonName];
			        		
			        		//console.log("dCONS.createConstant(attrs.name, data[attrs.name], primaryKey);
			        	}//$scope.data = data;
			        	scope.deferredObj.resolve();
			        }).
			        error(function(data, status) {
			        	console.log("Error:", data, status);
			        	//$scope.data = data || "Request failed";
			        	//$scope.status = status;
			        	scope.deferredObj.reject();
			      });
					
            	}
            	if(!scope.showList){
            		return true;
            	}
          });
          
		}
	}
}])

.directive("typeAheadGeneric", ["$http", "$compile","$q", function($http, $compile, $q){
	
	return {
		restrict : "A",
		require : 'ngModel',
		scope:{value:"@",writeModel:'=',ngModel:'=',jsonParams:"=",jsonShow:"@",loadingInProgress:'='},
		//transclude:true,
		//replace:true,
		//template:"<div><input type='text' ng-model='{{ngModel}}' class='form-control form-1' /><ul><li data-ng-repeat='row in resultData'>{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</li><ul></div>",
		link: function(scope, element, attrs, ctrl){
			console.log("linking typeAhead");
			scope.deferredObj = null;
			    /*element.append(clone);
			    element.append(clone);*/
			//var jParent = element.parent();
			//element.after($compile("<input name='" + attrs.name + "' value='{{" + attrs.writeModel + "}}' /> <ul class='ajax-json-ul'><li data-ng-repeat='row in resultData'><a ng-click='$parent." + attrs.writeModel + "=row." + attrs.jsonKey + ";" + attrs.ngModel + "=row." + attrs.jsonKey + "' >{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</a></li></ul>")(scope));
			//element.after($compile("<ul class='ajax-json-ul'><li data-ng-repeat='row in resultData'><a ng-click='$parent.updateDataModel" + "({\"modelName\":\"task\",\"modelSubName\":\"relatedTo\",\"modelValue\":row." + attrs.jsonKey + "});' >{{row.firstName}} {{row.lastName}} - {{row.dbaName}} [{{row.merchantFormId}}]</a></li></ul>")(scope));
			element.after($compile("<ul data-ng-hide='!showList || !resultData' class='ajax-json-ul'><li data-ng-repeat='row in resultData'><a ng-click='$parent.writeModel=row[\"" + attrs.jsonKey + "\"];$parent.ngModel=row[\"" + attrs.jsonShow + "\"];$parent.showList=false;' >--{{row['" + attrs.jsonShow + "']}}</a></li></ul>")(scope));
			//element.attr("name", element.attr("name") + "Ng");
			ctrl.$parsers.unshift(function(value) {
				scope.showList = true;
            	//console.log("scope.matchVal:",value);
            	//console.log("scope.jsonParams:",scope.jsonParams);
            	if(scope.defferedObj){
            		scope.defferedObj.abort();	
            	}
            	scope.deferredObj = $q.defer();
            	if(value && value.length > 0){
            		var urlParams = jQuery.extend({"searchStr":value}, scope.jsonParams);;
            		scope.loadingInProgress = true;
            		var httpReq = {
            			"url":attrs.typeAheadGeneric,
						"method":"POST",
						"data":jQuery.param(urlParams),
						"headers":{'Content-Type': 'application/x-www-form-urlencoded'},
						"timeout": scope.deferredObj.promise
					}
					//}
					$http(httpReq).
			        success(function(data, status) {
			        	//console.log("Success:", data, status);
			        	scope.loadingInProgress = false;
			        	if(data && data[attrs.jsonName]){
			        		scope.resultData = data[attrs.jsonName];
			        		
			        		//console.log("dCONS.createConstant(attrs.name, data[attrs.name], primaryKey);
			        	}//$scope.data = data;
			        	scope.deferredObj.resolve();
			        }).
			        error(function(data, status) {
			        	scope.loadingInProgress = false;
			        	console.log("Error:", data, status);
			        	//$scope.data = data || "Request failed";
			        	//$scope.status = status;
			        	scope.deferredObj.reject();
			      });
					
            	}
            	if(!scope.showList){
            		return true;
            	}
          });
          
		}
	}
}])

.filter("orderByObject", function() {
    return function(obj, sortOn) {
    	//console.log("orderByObject", arguments);
    	
        var result = [];
        angular.forEach(obj, function(val){
        	result.push(val);
        });
        
        var field = null;
        if(sortOn){
        	field = sortOn;
        }
        result.sort(function (a, b) {
        	if (a[field] < b[field])
        	     return -1;
        	  if (a[field] > b[field])
        	    return 1;
        	  return 0;
        });
        return result;
    }
})

/* Factory to save the data accessed by the above defined directive "createConstant" */
.factory("CONS",["$rootScope", "$window", function($rootScope, $window){
	var r = {};
	
	r.data = {};
	r.data.window = $window;
	r.createConstant = function(constantName,constantData, constantPrimaryKey, shouldAppendData){
		if (constantName && constantData){
			
			if( constantPrimaryKey && typeof constantData[0] !== "undefined" && typeof constantData[0][constantPrimaryKey] !== "undefined"){
				//Its a list
				
				if(!shouldAppendData || typeof r.data[constantName + "Idx"] === "undefined"){
					r.data[constantName + "Idx"] = {};
				}
				
				angular.forEach(constantData, function(obj){
					if(typeof (obj[constantPrimaryKey]) !== "undefined"){
						r.data[constantName + "Idx"][obj[constantPrimaryKey]] = obj;
					}
				});
				
				var newList = [];
				if(shouldAppendData){
					angular.forEach(r.data[constantName + "Idx"], function(conObj, k){
						newList.push(conObj);
					});
				}else{
					newList = constantData;
				}
				
				r.data[constantName] = newList;
				
				
				
			}else{
				//Assuming its a map
				//console.log("constantName:",constantName,", typeOf:",typeof r.data[constantName], ", data:",constantData);
				if(shouldAppendData && typeof r.data[constantName] === "object"){
					//console.log("Appending data to " , r.data[constantName], " with:", constantData);
					angular.forEach(constantData, function(obj, k){
						r.data[constantName][k] = obj;
					});
					r.data[constantName + "Idx"] = r.data[constantName];
				}else{
					r.data[constantName] = constantData;
					r.data[constantName + "Idx"] = constantData;
				}
				
			}
			//console.log("constantLoaded:" + constantName , r.data[constantName], ", Idx:",r.data[constantName + "Idx"], constantPrimaryKey, constantData);
			$rootScope.$emit("constant_updated",{"constant_name":constantName, "constant_data": r.data[constantName]});
		}
	};
	return r;
}])


.filter('convertBreaks', ["$sce", function($sce) {
    return function(input) {
    	var returnStr = "";
    	if(input){
    		//console.log("input", input);
    		returnStr = $sce.trustAsHtml(input.replace(/[\n|\r]/g, "<br/>"));
    		//console.log("input2", returnStr);
    	}
    	return returnStr;
    };
}])

.filter('filterWithOr',function($filter) {
	var comparator = function(actual, expected) {
		if (angular.isUndefined(actual)) {
			// No substring matching against `undefined`
			return false;
		}
		if ((actual === null) || (expected === null)) {
			// No substring matching against `null`; only match
			// against `null`
			return actual === expected;
		}
		if ((angular.isObject(expected) && !angular
				.isArray(expected))
				|| (angular.isObject(actual) && !hasCustomToString(actual))) {
			// Should not compare primitives against objects,
			// unless they have custom `toString` method
			return false;
		}
		/*console.log('ACTUAL EXPECTED')
		console.log(actual)
		console.log(expected)
		*/
		actual = angular.lowercase('' + actual);
		if (angular.isArray(expected)) {
			var match = false;
			expected.forEach(function(e) {
				//console.log('forEach')
				//console.log(e)
				e = angular.lowercase('' + e);
				if (actual.indexOf(e) !== -1) {
					match = true;
				}
			});
			return match;
		} else {
			expected = angular.lowercase('' + expected);
			return actual.indexOf(expected) !== -1;
		}
	};
	return function(array, expression) {
		return $filter('filter')(array, expression, comparator);
	};
})

.filter('filterByConditions',function() {
	return function (items, conditionOps) {
	    var filtered = [];
	    var conditionJoinOp = (conditionOps['joinOp']!== "undefined")?conditionOps['joinOp']:'AND';
	    var conditionSet = conditionOps.cond;
	    //console.log("conditionSet:",typeof (conditionSet), conditionSet);
	    if(typeof (conditionSet) === "object" && conditionSet.length > 0){
	    	angular.forEach(items, function(item){
	    		var filterSuccess = 0;
	    		var totalCond = 0;
	    		angular.forEach(conditionSet, function(cond){
	    			totalCond++;
	    			if(cond[0] == 'EQUALS'){
	    				if(typeof (item[cond[1]]) !== "undefined" && typeof (cond[2]) !== "undefined" && item[cond[1]] == cond[2]){
	    					filterSuccess++;
	    				}
	    			}
	    		});
	    		if(conditionJoinOp === 'OR'){
	    			if(filterSuccess > 0){
	    				filtered.push(item);
	    			}
	    		}else if(conditionJoinOp === 'AND'){
	    			if(filterSuccess > 0 && filterSuccess === totalCond){
	    				filtered.push(item);
	    			}
	    		}
	    	});
	    }
	    return filtered;
	};
})

.filter('ageFilter', ['moment', function(moment){
	return function(fromDate, addlParams) {
		var dateFormat = addlParams['dateFormat'];
		var dateUnit = addlParams['dateUnit'];
		if(! ( typeof dateUnit === 'string' && (dateUnit === 'months' || dateUnit === 'days' || dateUnit === 'years') ) ){
			dateUnit = 'days';
		}
		var res = moment.utc(moment().diff(moment(fromDate,dateFormat), dateUnit));
		var result = typeof res["_i"] === "number"?res["_i"]:0;
		//console.log("ageFilter:[fromDate:" + fromDate + ", dateFormat:" + dateFormat + ", dateUnit:" + dateUnit + ", value:", result, ", obj:", res, "]");
        return result;
	}; 
}])

.filter('displayDateFormatFilter', ['moment', function(moment){
	return function(origDate, addlParams) {
		var currentDateFormat = addlParams['currentDateFormat'];
		var displayDateFormat = addlParams['displayDateFormat'];
		var res = moment(origDate, currentDateFormat).format(displayDateFormat);
		return res;
	}
}])

.directive("splitStr", function(){
	return {
		restrict:"A",
		scope:{
			splitStr:"=splitStr"
		},
		link: function(scope, ele, attrs, ctrl){
			console.log(ele.val(), scope.splitStr);
			var str = ele.val();
			var cssPropStrs = str.split(';')
			newCssObj = {};
			angular.forEach(cssPropStrs, function(cssPropStr){
				var cssPropObj = cssPropStr.split(':');
				console.log(cssPropObj, cssPropObj.length);
				
				if(cssPropObj.length === 2){
					newCssObj[cssPropObj[0]] = cssPropObj[1];
				}
			});
			scope.splitStr = newCssObj;
		}
	}
})
/* Directive for enforcing name split on firstName and lastName 
 * required : attr@firstName
 * required : attr@lastName
 * Will split the value of the field in two models as specified in the above attrs. 
 * The firstName will have the first word, and rest will be in lastName
 * */
.directive("fullNameSplit", function(){
	return {
           // restrict to an attribute type.
           restrict: 'A',
          // element must have ng-model attribute.
           require: 'ngModel',
           
           scope:{
        	   firstName:"=firstName",
        	   lastName:"=lastName"
           },
           
           link: function(scope, ele, attrs, ctrl){
        	  
              // add a parser that will process each time the value is
              // parsed into the model when the user updates it.
        	   //console.log("Hi, linking fullNameSplit");
        	   var onFullNameValChange = function(value) {
            	  //console.log("Running firsttime - fullNameSplit");
            	  //console.log("value:",value);
            	  var valid = undefined;
            	  if(value){
                	//console.log("scope.matchVal:",scope.matchVal);
                	if(value.indexOf(" ") !== -1 && value.trim().length > 0){
                		var fullName = value.trim();
                		scope.firstName = fullName.substr(0,fullName.indexOf(" "));
                		scope.lastName = fullName.substr(fullName.indexOf(" ") + 1,fullName.length);
                	}else{
                		scope.firstName = scope.lastName = "";
                	}
                	//console.log("First & Last Name:",scope.firstName ,":", scope.lastName);
                  //console.log(value)// test and set the validity after update.
                  if(scope.firstName && scope.lastName && scope.firstName.length > 0 && scope.lastName.length > 0 ){
                	  ctrl.$setValidity('fullNameSplit', true);
                	  valid = true;
                  }else{
                	  valid=false;
                	  ctrl.$setValidity('fullNameSplit', false);
                  }
                  
                }

                // if it's valid, return the value to the model,
                // otherwise return undefined.
                return valid;
              }
        	  ctrl.$parsers.unshift(onFullNameValChange);
        	  onFullNameValChange(ele.val());
           }
	};
 
              
});


jQuery(function() {
	window.initDatepicker = function(){
		if(jQuery("").datepicker){
			jQuery( ".datepicker.month-year" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "mm/dd/yy"
				
			});
			
			jQuery( ".datepicker.date-month-year" ).datepicker({
				changeMonth: true,
				changeYear: true,
				changeDate:true,
				dateFormat: "mm/dd/yy",
				altField: "#ownership2Dob",
			    altFormat: "DD, d MM, yy"
			});
		}
	}
	
	window.initDatepicker();
	
	jQuery("[data-url-active][data-url]").on("click",function(){
		//console.log("this.getAttribute('data-url'):" + this.getAttribute("data-url"));
		window.location.href = this.getAttribute("data-url");
	});
	
	/* START : For top message customization */
	var jTopMsgDiv = jQuery(".phub-msg");
	var jTopMsgContent = jQuery(".phub-msg p");
	var jTopMsgClose = jQuery(".phub-msg a.close-btn");
	/* Configure toastr plugin if available */
	if(typeof toastr !== "undefined"){
		toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "positionClass": "toast-top-full-width",
			  "onclick": null,
			  "showDuration": "10000",
			  "hideDuration": "100",
			  "timeOut": "10000",
			  "extendedTimeOut": "3000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			};
	}
	
	
	
	jTopMsgClose.on("click", function(){
		jTopMsgContent.html("");
		jTopMsgDiv.hide();
	});
	
	window.executeJqueryFn = function(elmId, elmFn, elmFnParam){
		if(typeof elmFnParam == 'string'){
			jQuery(elmId)[elmFn](elmFnParam);
		}else{
			jQuery(elmId)[elmFn]();
		}
	}
	/* STOP : For top message customization */
	
	/* START : For alert box customization 
	var jphubModalWindow = jQuery(".phub-modal");
	var jphubModalMsg = jQuery("#phub-modal-msg");
	var jphubModalBtn = jQuery(".phub-modal-button");
	window.alert = function(arg){
		
		jphubModalMsg.html(arg);
		jphubModalWindow.show();
	}
	jphubModalBtn.on("click",function(){
		jphubModalWindow.hide();
	});
	/* STOP : For alert bo customization */
	
	/* START : For Drag n Drop interface on the upload-docs page */
	var jDropEnabledArea = jQuery(".drophandler");
	var jDocument = jQuery(document);
	jDropEnabledArea.on('dragenter', function (e){
	    e.stopPropagation();
	    e.preventDefault();
	    $(this).css('border', '2px solid #8ac346');
	});
	jDropEnabledArea.on('dragover', function (e){
	     e.stopPropagation();
	     e.preventDefault();
	});
	jDropEnabledArea.on('drop', function (e){
		e.preventDefault();
	     $(this).css('border', '2px dotted #8ac346');
	     var files = e.originalEvent.dataTransfer.files;
	 
	     //We need to send dropped files to Server
	     $(this).trigger("fileDropped",{"files":files,"obj":this});
	});
	jDocument.on('dragenter', function (e){
	    e.stopPropagation();
	    e.preventDefault();
	});
	jDocument.on('dragover', function (e){
	  e.stopPropagation();
	  e.preventDefault();
	  jDropEnabledArea.css('border', '2px dotted #8ac346');
	});
	jDocument.on('drop', function (e){
	    e.stopPropagation();
	    e.preventDefault();
	});
	
	var handleFileUpload = function(files, obj){
		//console.log("Handle File upload : ", files, obj);
	}
	 
	/* STOP : For Drag n Drop interface on the upload-docs page */
	
	var notDisClasses = ["button-1","button-2","phub-merchant-form-na"];
	if( typeof (merchantFormLocked) !== "undefined" && merchantFormLocked === true){
		var phubForm = jQuery(".phub-merchant-form.formlock-Y");
		var formElms = phubForm.find("select,input");
		
		formElms.each(function(idx,elm){
			var elmDis = true;
			var jElm = jQuery(elm);
			for(var idx in notDisClasses){
				
				if (jElm.hasClass(notDisClasses[idx]) || jElm.parents('.' + notDisClasses[idx]).length !== 0){
					//console.log(elm.getAttribute("name"),notDisClasses[idx]);
					elmDis = false;
					break;
				}
			}
			if(elmDis){
				elm.setAttribute("disabled","true");
				//console.log("disabled element name:" + elm.getAttribute("name"));
			}else{
				//console.log("ignore element name:" + elm.getAttribute("name"));
			}
			
			
			
		});
	}
	
	//For actions on button
	jQuery("[data-button-action]").on("click",function(){
		if(this.hasAttribute("data-button-action")){
		
			var confirmResponse = true;
			console.log("about to browse to the url:",this.getAttribute("data-button-action"));
			if(this.hasAttribute("data-button-confirm")){
				confirmResponse = window.confirm(this.getAttribute("data-button-confirm"));
			}
			if(confirmResponse){
				window.location.href=this.getAttribute("data-button-action");
			}
		}
	});
	
	var jToggleDiv = jQuery(".toggle-div");
	jToggleDiv.on("toggle",function(){
		console.log("toggle now");
		jQuery(">div.toggle-div-part",this).toggle();
	});
	
	jQuery("[data-trigger-event]").on("click",function(){
		var confirmResponse = true;
		if(this.hasAttribute("data-button-confirm")){
			confirmResponse = window.confirm(this.getAttribute("data-button-confirm"));
		}
		if(!confirmResponse){
			return;
		}
		
		if(this.hasAttribute("data-trigger-id")){
			jQuery("#" + this.getAttribute("data-trigger-id")).trigger(this.getAttribute("data-trigger-event"));
		}
		
		if(this.hasAttribute("data-trigger-focus")){
			console.log("Setting focus", this.getAttribute("data-trigger-focus"))
			jQuery("#" + this.getAttribute("data-trigger-focus")).focus();
		}
		
		
	});
	
	jQuery("[data-trigger-copy-clipboard]").on("click", function(){
		jElm = jQuery('#' + this.getAttribute('data-trigger-copy-clipboard'));
		if(jElm){
			//var elmVal = jElm.val();
			jElm.select();
			
			if(typeof document.execCommand !== "undefined"){
				document.execCommand('copy');
			}
			//jElm.val(elmVal);
		}
		return false;
	});
});

window.stringStartsWith = function(str, strtocheck){
	var len = strtocheck.length;
	if(typeof str !== "string" || typeof strtocheck !== "string" || !( str.length > 0 ) || !(strtocheck.length > 0) || strtocheck.length > str.length){
		return false;
	}
	
	return str.substr(0, len).indexOf(strtocheck) != -1;
}
window.reportSuccess = function(msg){
	console.log("Popup Success Msg : " + msg);
	if(typeof toastr !== "undefined"){
		toastr["success"](msg);
	}else{
		jTopMsgContent.html(msg);
		jTopMsgDiv.addClass("phub-msg-success").removeClass("phub-msg-error phub-msg-info");
		jTopMsgDiv.show();
	}
}

window.reportError = function(msg){
	console.log("Popup Error Msg : " + msg);
	if(typeof toastr !== "undefined"){
		toastr["error"](msg);
	}else{
		jTopMsgContent.html(msg);
		jTopMsgDiv.addClass("phub-msg-error").removeClass("phub-msg-success phub-msg-info");
		jTopMsgDiv.show();
	}
}

window.reportInfo = function(msg){
	console.log("Popup Info Msg : " + msg);
	if(typeof toastr !== "undefined"){
		toastr["info"](msg);
	}else{
		jTopMsgContent.html(msg);
		jTopMsgDiv.addClass("phub-msg-info").removeClass("phub-msg-success phub-msg-error");
		jTopMsgDiv.show();
	}
}
var todayDate = new Date();
var dateOnlastDayOfYear = new Date(todayDate.getFullYear(), 12, 1);
var daysLeftInCurrentYear = daydiff(todayDate, dateOnlastDayOfYear);
function daydiff(first, second) {
    return (second-first)/(1000*60*60*24);
}
