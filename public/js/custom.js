/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

$('#tnc').change(function(event) {
	
	if ($(this)[0].checked) {

		$(this).val(1);
	}
	else {
		
		$(this).val(0);
	}
});

function doRegister() {

	// validateRegistrationForm();

	$('.company_name-err').hide();
	$('.company_reg_no-err').hide();
	$('.email-err').hide();
	$('.contact_no-err').hide();
	$('.password-err').hide();
	$('.tnc-err').hide();

	var xtoken = $('#xtoken');
	var company_name = $('#company_name');
	var company_reg_no = $('#company_reg_no');
	var email = $('#email');
	var contact_no = $('#contact_no');
	var password = $('#password');
	var password_confirmation = $('#password2');
	var tnc = $('#tnc');

	$('#pleaseWait').modal('show');

	$.ajax({
		url: register_url,
		type: 'POST',
		data: {
			_token:xtoken.val(),
			company_name:company_name.val(),
			company_reg_no:company_reg_no.val(),
			email:email.val(),
			contact_no:contact_no.val(),
			password:password.val(),
			password_confirmation:password_confirmation.val(),
			tnc:tnc.val(),
		},
	})
	.done(function(r) {
		
		if (r.status) {

			$('#pleaseWait').modal('hide');
			location.href=verify_account;
		}
	})
	.fail(function(e) {
		
		$('#pleaseWait').modal('hide');
		$.each(e.responseJSON.errors, function(el, message) {
			
			$("."+el+"-err").text(message);
			$("."+el+"-err").show();
		});
	});
}

function validateRegistrationForm() {
	
	var input = $('#registration-form').find('input');
	delete input[0];
	
	$.each(input, function(i, e) {
		
		if (i > 0) {

			if ($(e)[0].type=="checkbox") {

				if ($(e)[0].checked==false) {

					$('.tnc-err').show();
				}
				else {

					$('.tnc-err').show();
				}
			}

			if ($(e).val()=="" || $(e).val()==" ") {

				$("."+$(e)[0].id+"-err").show();
			}
			else {
				
				// if (true) {}	
				$("."+$(e)[0].id+"-err").hide();
			}
		}
	});
}

function verifyAccount() {

	var activation_code = $('#activation_code');
	var xtoken = $('#xtoken');
	
	$.ajax({
		url: verify_account_url,
		type: 'POST',
		data: {
			_token:xtoken.val(),
			activation_code:activation_code.val()
		},
	})
	.done(function(r) {
		
		if (r.status) {
			location.href=dashboard_url;
		}
	})
	.fail(function(e) {
		console.log(e);

		if (e.responseJSON.err_code==409) {

			$(".activation_code-err").text(e.responseJSON.message);
			$(".activation_code-err").show();
		}
		else {

			$.each(e.responseJSON.errors, function(el, message) {
				
				$("."+el+"-err").text(message);
				$("."+el+"-err").show();
			});
		}
	});
}

function doLogin() {
	
	$('.account-error').hide('slow');
	$('.email-err').hide();
	$('.password-err').hide();

	var email = $('#email');
	var password = $('#password');
	var xtoken = $('#xtoken');
	
	$.ajax({
		url: login_url,
		type: 'POST',
		data: {
			_token:xtoken.val(),
			email:email.val(),
			password:password.val(),
		},
	})
	.done(function(r) {
		
		if (r.status) {
			
			location.href=dashboard_url;
		}
	})
	.fail(function(e) {

		switch(e.responseJSON.err_code) {

			case 403:

				// $('.account-error').html("Your account is inactive. Please check your email for the activation code.");
				// $('.account-error').show('slow');

				location.href=verify_account+"?e=403";				
				break;

			case 404:

				$('.account-error').html(e.responseJSON.message+". Would you like to <a href='"+register_account+"'>create a new account</a> ?");
				$('.account-error').show('slow');
				break;

			case 409:
				$('.account-error').text(e.responseJSON.message);
				$('.account-error').show('slow');
				break;
			
			default:
				$.each(e.responseJSON.errors, function(el, message) {
					
					$("."+el+"-err").text(message);
					$("."+el+"-err").show();
				});
				break;
		}

	});
}

function addNewProduct() {
	
	$('.error-div').hide();
	$('.name-err').hide();
	$('.category-err').hide();
	$('.cost_price-err').hide();
	$('.sale_price-err').hide();
	$('.agent_price-err').hide();
	$('.max_discount-err').hide();
	$('.total_stock-err').hide();
	$('.remarks-err').hide();

	var name = $('#name');
	var cost_price = $('#cost_price');
	var sale_price = $('#sale_price');
	var agent_price = $('#agent_price');
	var max_discount = $('#max_discount');
	var total_stock = $('#total_stock');
	var remarks = $('#remarks');
	// var token = $('input[name=_token]');

	var data = {};

	data.name = name.val();
	if (newCategory) {

		data.category = $('#new_category').val();
		data.new_product_category = true;
	}
	else {
		
		data.category = $('#category').val();
	}
	data.cost_price = cost_price.val();
	data.sale_price = sale_price.val();
	data.agent_price = agent_price.val();
	data.max_discount = max_discount.val();
	data.total_stock = total_stock.val();
	data._token = token;

	Http.post(add_product_url,data,function(r) {
		
		if (r.status) {

			location.href=list_product_url;
		}

	},function(e) {
		handleError(e);
	});
}

function editProduct() {
	
	$('.error-div').hide();
	$('.name-err').hide();
	$('.category-err').hide();
	$('.cost_price-err').hide();
	$('.sale_price-err').hide();
	$('.agent_price-err').hide();
	$('.max_discount-err').hide();
	$('.total_stock-err').hide();
	$('.remarks-err').hide();

	var name = $('#name');
	var cost_price = $('#cost_price');
	var sale_price = $('#sale_price');
	var agent_price = $('#agent_price');
	var max_discount = $('#max_discount');
	var total_stock = $('#total_stock');
	var remarks = $('#remarks');
	// var token = $('input[name=_token]');

	var data = {};

	data.name = name.val();
	if (newCategory) {

		data.category = $('#new_category').val();
		data.new_product_category = true;
	}
	else {
		
		data.category = $('#category').val();
	}
	data.cost_price = cost_price.val();
	data.sale_price = sale_price.val();
	data.agent_price = agent_price.val();
	data.max_discount = max_discount.val();
	data.total_stock = total_stock.val();
	data._token = token;

	Http.put(edit_product_url,data,function(r) {

		if (r.status) {

			location.href=list_product_url;
		}

	},function(e) {
		handleError(e);
	});
}

function addNewCategory() {
	newCategory=true;
	$('.existingCategory').hide('slow');
	$('.ifNewCategory').show('slow');
}

function chooseExistingCategory() {
	newCategory=false;
	$('.existingCategory').show('slow');
	$('.ifNewCategory').hide('slow');
}

function viewProduct(url) {

	Http.get(url,{},function (r) {

		$('#product_view_name').text(r.data.product.name);
		$('#product_view_category').text(r.data.product.category.name);
		$('#product_view_cost_price').text(r.data.product.cost_price);
		$('#product_view_sale_price').text(r.data.product.selling_price);
		$('#product_view_agent_price').text(r.data.product.agent_price);
		$('#product_view_max_discount').text((r.data.product.max_discount!=0 ? r.data.product.max_discount+"%" : " - "));
		$('#product_view_total_stock').text((r.data.product.total_stock!=0 ? r.data.product.total_stock : " - "));
		$('#product_view_remarks').text((r.data.product.remarks!=null ? r.data.product.remarks : " - "));
		$('#product_view_created_at').html(r.data.product.created_at+"<br><b>"+r.data.product.created_by.email+"</b>");
		$('#product_view_updated_at').html(r.data.product.updated_at+"<br><b>"+r.data.product.updated_by.email+"</b>");

		$('#productView').modal('show');
	}, function(e) {

		handleError(e);
	});
}

function confirmDeleteProduct(id,name) {
    
    $('#product_name').text(name);

    $('#product_id_delete').val(id);
    $('#deleteProductModal').modal('show');
}

function deleteProduct() {

	var id = $('#product_id_delete').val();
	// var token = $('#product_id_delete_token').val();

	Http.post('product/'+id+'/delete',{
		_token:token
	},function(r) {

		if (r.status) {

			$('#deleteProductModal').modal('hide');
			loadProduct();
		}
	}, function(e) {

		l(e);
	});
}

function addNewAgent() {

	$('.error-div').hide();
	$('.name-err').hide();
	$('.contact_no-err').hide();
	$('.address-err').hide();
	$('.postal_code-err').hide();
	$('.state-err').hide();
	$('.branch-err').hide();
	$('.code-err').hide();
	$('.password-err').hide();

	var name = $('#name');
	var email = $('#email');
	var contact_no = $('#contact_no');
	var address = $('#address');
	var postal_code = $('#postal_code');
	var state = $('#state');
	var branch = $('#branch');
	var password = $('#password');

	Http.post(add_agent_url,{
		_token:token,
		name:name.val(),
		email:email.val(),
		contact_no:contact_no.val(),
		address:address.val(),
		postal_code:postal_code.val(),
		state:state.val(),
		branch:branch.val(),
		password:password.val(),
	},function(r) {

		if (r.status) {

			location.href=list_agent_url;
		}

	},function(e) {
		handleError(e);
	});
}

function viewAgent(url) {
	
	$('#loadingState').show();
	$('#result').hide();
	$('#agentView').modal('show');

	Http.get(url,{},function (r) {

		$('#loadingState').hide();
		$('#result').show();

		$('#agent_view_name').text(r.data.agent.details.name);
		$('#agent_view_email').text(r.data.agent.details.email);
		$('#agent_view_contact_no').text(r.data.agent.details.contact_no);
		$('#agent_view_address').text(r.data.agent.details.address);
		$('#agent_view_postal_code').text(r.data.agent.details.postal_code);
		$('#agent_view_state').text(r.data.agent.details.state);
		$('#agent_view_branch').text(r.data.agent.branch);
		$('#agent_view_created_at').text(r.data.agent.details.created_at);
		$('#agent_view_updated_at').text(r.data.agent.details.updated_at);

	}, function(e) {
		
		handleError(e);
	});
}

function handleError(e) {
	
	switch(e.responseJSON.err_code) {

		case 404:

			$('.error-div').html(e.responseJSON.message);
			$('.error-div').show();
			break;

		case 412:
			
			$.each(e.responseJSON.errors, function(el, message) {
				
				$("."+el+"-err").text(message);
				$("."+el+"-err").show();
			});
			break;

		case 500:

			$('.error-div').html(e.responseJSON.message);
			$('.error-div').show();
			break;
		
		default:
			$.each(e.responseJSON.errors, function(el, message) {
				
				$("."+el+"-err").text(message);
				$("."+el+"-err").show();
			});
			break;
	}
}