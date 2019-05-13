class Ajax {

	post(url,data,successCallback=null,errorCallback=null) {
		
		$.ajax({
			url: url,
			type: 'POST',
			data: data
		})
		.done(function(r) {
			
			successCallback(r);
		})
		.fail(function(e) {
			
			errorCallback(e);

		});
	}

	get(url,data=null,successCallback=null,errorCallback=null) {

		$.ajax({
			url: url,
			type: 'GET',
			data: data,
		})
		.done(function(r) {
			
			successCallback(r);
		})
		.fail(function(e) {
			
			errorCallback(e);
		});
	}

	put(url,data=null,successCallback=null,errorCallback=null) {

		$.ajax({
			url: url,
			type: 'PUT',
			data: data,
		})
		.done(function(r) {
			
			successCallback(r);
		})
		.fail(function(e) {
			
			errorCallback(e);
		});
	}

	delete(url,successCallback=null,errorCallback=null) {

		$.ajax({
			url: url,
			type: 'DELETE',
		})
		.done(function(r) {
			
			successCallback(r);
		})
		.fail(function(e) {
			
			errorCallback(e);
		});
	}
}
