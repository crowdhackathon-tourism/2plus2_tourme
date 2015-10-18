
//alert(tme_user_id);

function testing() {

	jQuery.getJSON("http://192.168.29.1:8080/tourme-app/rest/1/adventures", function (data) {
		(data[0].imageurl);
	});

	jQuery.ajax({
		url : "http://192.168.29.1:8080/tourme-app/rest/1/newadventure",
		type : "POST",
		data : JSON.stringify({
			imageurl : "skatoules"
		}),
		dataType : "json",
		contentType : "application/json; charset=utf-8",
		statusCode : {
			200 : function () {
				alert('Success Data Test');
			}
		}
	});
}

function explore(){
	//http://192.168.29.1:8080/tourme-app/rest/2/suggestions
	//alert("Exploring");	
	
	var address = "http://192.168.29.1:8080/tourme-app/rest/"+tme_user_id+"/suggestions";
	alert(address);
	
	jQuery.getJSON(address, function (data) {
		var profiles = JSON.stringify(data);
		console.log(JSON.stringify(data));
		
		var currentProfile = data[0];
		console.log(currentProfile);
		document.getElementById("explore_profile").src = currentProfile.user_photo_url;
	});
}

function iframeRef( frameRef ) {
    return frameRef.contentWindow
        ? frameRef.contentWindow.document
        : frameRef.contentDocument
}



function viewAdventure(){
	//alert("View Adventure");
	jQuery.getJSON("http://192.168.29.1:8080/tourme-app/rest/1/adventures", function (data) {
		alert(JSON.stringify(data));
	});
	
}

function createAdventure(userId){
	//wdform_1_element28
	
	
	var loc_address = "Not implemented";
	http://thumbs.dreamstime.com/z/travel-to-india-14306973.jpg
	
	var startDateElem = jQuery('#wdform_1_element28');
	var startDate = startDateElem[0].value;
	
	var endDate = jQuery('#wdform_2_element28')[0].value;
	var title = jQuery('#wdform_3_element28')[0].value;
	var description = jQuery('#wdform_4_element28')[0].value;
	
	var Budget = jQuery('#wdform_7_element28')[0].value;
	var Types = [];
	
	if(jQuery('#wdform_8_element280')[0].checked)
	Types.push(jQuery('#wdform_8_element280')[0].value);

	if(jQuery('#wdform_8_element281')[0].checked)
	Types.push(jQuery('#wdform_8_element281')[0].value);
	
	//alert(JSON.stringify(Types));
	
	//[jQuery('#wdform_8_element280')[0].value, jQuery('#wdform_8_element281')[0].value];

	var minAge = jQuery('#minAge')[0].value * 1;
	var maxAge = jQuery('#maxAge')[0].value * 1;
	
	var inside_frame = iframeRef( document.getElementById('selMap') )	
	var lon = inside_frame.getElementById("lon").value;
	var lat = inside_frame.getElementById("lat").value
	var loc_name = inside_frame.getElementById('addressSearch').value;
	
	//alert(lon+","+lat);
	
	var d = {
		user_id: tme_user_id,
		title: title,
		description: description,
		loc_name : loc_name,
		loc_address: loc_address,
		loc_radius_km: inside_frame.tm_radius,
		loc_photo_url: "http://thumbs.dreamstime.com/z/travel-to-india-14306973.jpg",
		date_start: startDate,
		date_end: endDate,
		interest_age_min: minAge,
		interest_age_max: maxAge,
		interest_gender: '',
		op_budget: Budget,
		op_accomodation: Types,
		loc_latitude: lon,
		loc_longitude: lat
	};
	
	alert(JSON.stringify(d));
	
	jQuery.ajax({
		url : "http://192.168.29.1:8080/tourme-app/rest/1/newadventure",
		type : "POST",
		data : JSON.stringify(d),
		dataType : "json",
		contentType : "application/json; charset=utf-8",
		statusCode : {
			200 : function () {
				alert('Success Data Test');
			}
		}
	});

	
	/*
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `loc_name` varchar(100) NOT NULL,
  `loc_address` varchar(200) DEFAULT NULL,
  `loc_latitude` float(10,6) NOT NULL,
  `loc_longitude` float(10,6) NOT NULL,
  `loc_radius_km` float(8,3) DEFAULT '20.000',
  `loc_photo_url` varchar(200) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `interest_age_min` int(11) DEFAULT NULL,
  `interest_age_max` int(11) DEFAULT NULL,
  `interest_gender` varchar(50) DEFAULT NULL,
  `interest_relationship` varchar(50) DEFAULT NULL,
  `op_budget` varchar(45) DEFAULT NULL,
  `op_accomodation` varchar(45) DEFAULT NULL,
  `op_interests` varchar(1000) DEFAULT NULL,
  `op_habbits` varchar(500) DEFAULT NULL,
  */
}


if(document.location.href.indexOf('/tourme/index.php/main/')!=-1)
	testing();

//if(document.location.href.indexOf('tourme/view-adventure/')!=-1)
//	viewAdventure();

 if(document.location.href.indexOf('tourme/explore-dev/')!=-1)
	 explore();