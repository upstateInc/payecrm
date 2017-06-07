var app = angular.module("phubapp",['initFromForm','ui.utils','angularMoment', 'localytics.directives']);
angular.module("demoApp",[]);
app.controller("lCtrl",function($scope){
	$scope.ca = {};
	
});

app.controller("ShortFormCtrl",["$scope", "CONS", "$rootScope", function($scope, CONS, $rootScope){
	$scope.submitTo = "";
	$scope.submitted = false;
	$scope.submit = function(form){
		//console.log("Submitted to form",form.$valid,arguments.length,arguments);
		//console.log("Submitted to form",form.$error);
		//return false;
		$scope.submitted = true;
		if(form.$valid){
			document.forms[form.$name].submit();
		}else{
			if(form.$error ){
				window.ngForm = form;
				for(var i in form.$error){
					var setFocus = false;
					
					for(var j in form.$error[i]){
						var firstErrorField = form.$error[i][j]['$name'];
						console.log("firstErrorField:",firstErrorField);
						if(firstErrorField){
							document.forms[form.$name].elements[firstErrorField].focus();
							setFocus = true;
							break;
						}
					}
					if(setFocus){
						break;
					}
				}
			}
			console.log("Set focus on",form.$error);
		}
		
		return false;
	}

	$scope.con = CONS.data;
	
	$scope.changedTrialOffer = function(){
		var industryFound = false;
		angular.forEach($scope.con["industryData"], function(elm,idx){
			
			if(!industryFound && elm && elm.industryName && elm.industryName == 'Trial Offer'){
				console.log(elm, idx);
				$scope.frm.industryId = elm.industryId;
				industryFound = true;
			}
			
		});
	}
	
	/* When constants are updated, load them onto $scope.con variable for access */
	$rootScope.$on('constant_updated', function(evt, data){
		//console.log("constant_updated", data["constant_data"]);
		$scope.con[data["constant_name"]] = data["constant_data"];

		updateIndustryProcessor();
	});

	/* Creating industry hashmap to populate dropdown */
	var updateIndustryProcessor = function(){
		var industries = {};
		angular.forEach($scope.con["industryData"], function(elm,idx){
			industries[elm.industryId] = elm;
		});
		$scope.con.industries = industries;
		//console.log("Industries updated",industries);
	}
	
	var docusignEnabled = {"Merchant Processing (High Risk)":1,"Cash Advance":"00269"};
	/* When industry's value from dropdown or progammatically is changed */
	$scope.industryChanged = function(){
		console.log("Industry Changed:", $scope.frm.industryId);
		var selectedIndustries = {};
		var selectedEpi  = false;
		var priorityDefault = 0;
		var selectedEpiId = "";
		var existingEpiFound = false;
		var isData = false;
		
		var validDocusignTemplatesFound = false;
		
		if(($scope.frm && $scope.frm.industryId)){
			angular.forEach($scope.con["pfiData"], function(elm, idx){
				if($scope.con["agentExData"]){
					angular.forEach($scope.con["agentExData"], function(agentExObj, agentExProcId){
						if( agentExObj.pfiId === elm.pfiId ){
							elm.agentExcludedProcessor = true;
						}
					});
				}
			});
			
			angular.forEach($scope.con["industryData"], function(elm, idx){
				
				if(elm.industryId === $scope.frm.industryId){
					//console.log(elm.pfiId, elm.industryId, $scope.con["industryData"]);
					isData = true;
					selectedIndustries[elm.epiId] = elm;
					
					priorityDefault = +elm.priority;
					if(existingEpiFound === false){
						//console.log(($scope.frm.epiId === elm.epiId), elm.pfiId, $scope.con["pfiDataIdx"], $scope.con["pfiDataIdx"][elm.pfiId], isDefined($scope.con["pfiDataIdx"][elm.pfiId]), $scope.con["pfiDataIdx"][elm.pfiId]['agentExcludedProcessor']);
						validDocusignTemplatesFound = true;
						if($scope.frm.epiId === elm.epiId && isDefined($scope.con["pfiDataIdx"]) && isDefined($scope.con["pfiDataIdx"][elm.pfiId]) && isDefined($scope.con["pfiDataIdx"][elm.pfiId]['agentExcludedProcessor']) && !$scope.con["pfiDataIdx"][elm.pfiId]['agentExcludedProcessor'] ){
							console.log("Selected epiid", elm.epiId);
							selectedEpiId = elm.epiId;
							existingEpiFound = true;
							selectedEpi = true;
						}
					}
					if(selectedEpi === false && $scope.con["pfiDataIdx"][elm.pfiId] && !$scope.con["pfiDataIdx"][elm.pfiId]['agentExcludedProcessor']){
						selectedEpiId = elm.epiId;
						selectedEpi = true;
					}
				}
			});
			
			
		}
		selectedIndustries["NA"] = { "epiId" : "NA" , "processor" : "No Docusign", "priority" : ++priorityDefault };
		selectedIndustries["agentExcludeStub"] = { "epiId" : "agentExcludeStub" , "value" : "See Agent Do Not Submit List", "providerPriority" : ++priorityDefault } ;
		$scope.con.selectedIndustries = selectedIndustries;
		//console.log("selectedIndustries:" , selectedIndustries ,selectedEpi, selectedEpiId, "[",$scope.frm.potentialType,"]");
		//console.log("validDocusignTemplatesFound:",validDocusignTemplatesFound, ", selectedEpi:", selectedEpi);
		if (validDocusignTemplatesFound && selectedEpi === false){
			console.log("Setting to agentExcludeStub");
			$scope.frm.submittedTo = "See Agent Do Not Submit List";
			selectedEpiId = "agentExcludeStub";
			//selectedEpi = true;
			selectedEpi = true;
		}
		if( !selectedEpi || !isData || ($scope.frm && $scope.frm.potentialType && !docusignEnabled[$scope.frm.potentialType])  ){
			//console.log("Current EpiId:", $scope.frm.epiId);
			selectedEpiId = "NA";
			selectedEpi = true;
			changedFirstEpiId = false;
		}
		
		if( selectedEpi && $scope.frm ){
			$scope.frm.epiId = selectedEpiId;
			/*if($scope.frm.epiId !== "NA"){
				populatphubFormPricingMatrix();
			}*/
		}
		
		if ( docusignEnabled[$scope.frm.potentialType] && docusignEnabled[$scope.frm.potentialType] !== 1 ){
			$scope.frm.epiId = docusignEnabled[$scope.frm.potentialType];
		}
		//$scope.frm.epiId = $scope.con.industries[ca.industryId]['epiId']
		//console.log("Selected Industries updated",selectedIndustries); 
	}



	/* When processor's value from dropdown or progammatically is changed */
	$scope.processorChanged = function(){
		//console.log("Do something when processor is changed!");
		/*if($scope.frm && !angular.isUndefined($scope.frm.epiId) ){
			generateProcessorOverridingFields();
		}*/
	}
	
	$scope.initDatepicker = function(){
		if (window.initDatepicker){
			window.initDatepicker();
		}
		return true;
	}
}]);

app.controller("MerchantFormController", ["$scope", "CONS", "$rootScope", "$window", function($scope, CONS, $rootScope, $window){
	$scope.submitTo = "";
	
	$scope.submitted = false;
	$scope.submit = function(form, successFn){
		formphub = form;
		//console.log("Submitted to form",form.$valid,arguments.length,arguments);
		//console.log("Submitted to form",form.$error);
		$scope.submitted = true;
		if(form.$valid){
			if( typeof successFn === 'object' && typeof successFn['id'] === 'string' && typeof successFn['event'] === 'string' ){
				if(typeof successFn['param'] === 'string'){
					$window.executeJqueryFn(successFn.id, successFn.event, successFn.param);
				}else{
					$window.executeJqueryFn(successFn.id, successFn.event);
				}
            }
			document.forms[form.$name].submit();
		}else{
			if(form.$error ){
				window.ngForm = form;
				for(var i in form.$error){
					var setFocus = false;
					
					for(var j in form.$error[i]){
						var firstErrorField = form.$error[i][j]['$name'];
						console.log("firstErrorField:",firstErrorField);
						if(firstErrorField && document.forms[form.$name].elements[firstErrorField].focus){
							document.forms[form.$name].elements[firstErrorField].focus();
							setFocus = true;
							break;
						}
					}
					if(setFocus){
						break;
					}
				}
			}
			//console.log("Set focus on",form.$error);
		}
		
		return false;
	}
	
	
	/* START : Copied from the ShortFormCtrl */
	$scope.con = CONS.data;
	
	/* When constants are updated, load them onto $scope.con variable for access */
	$rootScope.$on('constant_updated', function(evt, data){
		//console.log("constant_updated", data["constant_data"]);
		$scope.con[data["constant_name"]] = data["constant_data"];

		updateIndustryProcessor();
	});

	/* Creating industry hashmap to populate dropdown */
	var updateIndustryProcessor = function(){
		var industries = {};
		angular.forEach($scope.con["industryData"], function(elm,idx){
			industries[elm.industryId] = elm;
		});
		$scope.con.industries = industries;
		//console.log("Industries updated",industries);
	}

	var changedFirstEpiId = true;
	/* When industry's value from dropdown or progammatically is changed */
	$scope.industryChanged = function(){
		//console.log("Industry Changed:", $scope.frm.industryId);
		var selectedIndustries = {};
		var selectedEpi  = false;
		var priorityDefault = 0;
		var selectedEpiId = "";
		var existingEpiFound = false;
		var isData = false;
		if(($scope.frm && $scope.frm.industryId)){
			angular.forEach($scope.con["industryData"], function(elm, idx){
				if(elm.industryId === $scope.frm.industryId){
					isData = true;
					selectedIndustries[elm.epiId] = elm;
					priorityDefault = +elm.priority;
					if(existingEpiFound === false){
						if($scope.frm.epiId === elm.epiId){
							selectedEpiId = elm.epiId;
							existingEpiFound = true;
							selectedEpi = true;
						}
					}
					if(selectedEpi === false){
						selectedEpiId = elm.epiId;
						selectedEpi = true;
					}
				}
			});
		}
		//console.log("selectedIndustries:",selectedIndustries);
		selectedIndustries["NA"] = { "epiId" : "NA" , "processor" : "No Docusign", "priority" : ++priorityDefault };
		$scope.con.selectedIndustries = selectedIndustries;
		
		if( ( $scope.frm && typeof $scope.frm.epiId !== "undefined" ) && (($scope.frm.epiId === "NA" && changedFirstEpiId) || !isData ) ){
			//console.log("Current EpiId:", $scope.frm.epiId);
			selectedEpiId = "NA";
			selectedEpi = true;
			changedFirstEpiId = false;
		}
		if(selectedEpi && $scope.frm && !angular.isUndefined($scope.frm.epiId) ){
			$scope.frm.epiId = selectedEpiId;
			/*if($scope.frm.epiId !== "NA"){
				populatphubFormPricingMatrix();
			}*/
		}
		
		//$scope.frm.epiId = $scope.con.industries[ca.industryId]['epiId']
		//console.log("Selected Industries updated",selectedIndustries); 
	}



	/* When processor's value from dropdown or progammatically is changed */
	$scope.processorChanged = function(){
		//console.log("Do something when processor is changed!");
		/*if($scope.frm && !angular.isUndefined($scope.frm.epiId) ){
			generateProcessorOverridingFields();
		}*/
	}
	
	/* END : Copied from the ShortFormCtrl */
	
	$scope.initDatepicker = function(){
		if (window.initDatepicker){
			window.initDatepicker();
		}
		return true;
	}

	var updateTotalFields = {"posSalesTotal":["perPosKeyedSales","perPosSwipeSales"],"orderTotalPer":["perFaxOrder","perTelephoneOrder","perMailOrder","perInternetOrder","perFaceToFace"]};
	$scope.updateTotal = function(modelName){
		//console.log("1",$scope.frm,$scope.frm[modelName],updateTotalFields[modelName]);
		if(typeof $scope.frm !== "undefined" && typeof updateTotalFields[modelName] !== "undefined"){
			//console.log("2",$scope.frm);
			var total = 0;
			angular.forEach(updateTotalFields[modelName],function(elm,idx){
				//console.log("Update to modelName",elm,idx);
				if(+$scope.frm[elm]){
					total = total + +$scope.frm[elm];
				}
			});
			
			$scope.frm[modelName] = total;
			
		}
	}

}]);
app.controller("CaCtrl",function($scope){
	$scope.submitTo = "";
	$scope.submitted = false;
	$scope.submit = function(form){
		//console.log("Submitted to form",form.$valid,arguments.length,arguments);
		//console.log("Submitted to form",form.$error);
		$scope.submitted = true;
		if(form.$valid){
			document.forms[form.$name].submit();
		}else{
			if(form.$error ){
				//window.ngForm = form;
				for(var i in form.$error){
					var firstErrorField = form.$error[i][0]['$name'];
					//console.log("firstErrorField:",firstErrorField);
					document.forms[form.$name].elements[firstErrorField].focus();
					break;
				}
			}
			console.log("Set focus on",form.$error);
		}
		
		return false;
	}
	
	$scope.initDatepicker = function(){
		if (window.initDatepicker){
			window.initDatepicker();
		}
		return true;
	}
});