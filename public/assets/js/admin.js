
// import swal from 'sweetalert';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});
$('#source_auth_type').change(function() {
  let selectedValue = $(this).val();
  $('.source_keyfields').fadeOut(1000);
  $('.'+selectedValue).fadeIn(1000);
  clearSourceTest();
});
$('#source').change(function() {
    let selectedValue = $(this).find(':selected').data('desc');
    $('.'+selectedValue).fadeIn(1000);
    clearSourceTest();
  });

$('#destination_auth_type').change(function() {
  let selectedValue = $(this).val();
  $('.destination_keyfields').fadeOut(1000);
  $('.'+selectedValue).fadeIn(1000);
  clearDestinationTest();

});
$('#destination').change(function() {
  let selectedValue = $(this).find(':selected').data('desc');
  $('.'+selectedValue).fadeIn(1000);
  clearDestinationTest();
});

$('#destination_api_url').on('change', function() {
    clearDestinationTest();
});
$('#source_api_url').on('change', function() {
    clearDestinationTest();
});
$('#source_api_key').on('change', function() {
    clearDestinationTest();
});
$('#destination_api_key').on('change', function() {
    clearDestinationTest();
});

$('#fatchAcroCustomer').on('click', function (e) {
  e.preventDefault();

  const apiKey = document.getElementById('destination_api_key').value;
  const apiurl = document.getElementById('destination_api_url').value;
 
  $.ajax({
      type:'POST',
      url:route('admin.stores.getCompanyName'),
      data:{apiKey:apiKey, apiurl:apiurl},
      beforeSend: function (xhr) {
            $(this).prop('disabled', true);
        },
      success:function(data){
        if (typeof data.body != 'undefined' && data.body !== '') {
            let dropdown = $('#ackroCustomerDropdown');
            let bodyData = JSON.parse(data.body); 
            bodyData.forEach(company => {
                let option = document.createElement("option");
                option.value = company.code; // or any unique identifier
                option.textContent = company.name; // Assuming the company object has a name field
                dropdown.append(option);
            });
            swal({
                title: 'Connected',
                text: 'Companies fatched successfully',
                icon: 'success',
                confirmButtonText: 'Close'
            });
        } else {
            swal({
                title: 'Failed',
                text: "Something went wrong",
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }
        
      },
      error: function (error) {
        
      }
  });
});

$('#fatchshopifyapiversion').on('click', function (e) {
  e.preventDefault();

  const apiKey = document.getElementById('source_api_key').value;
  const apiurl = document.getElementById('source_api_url').value;
 
  $.ajax({
      type:'POST',
      url:route('admin.stores.getShopifyApiVersion'),
      data:{apiKey:apiKey, apiurl:apiurl},
      beforeSend: function (xhr) {
            $(this).prop('disabled', true);
        },
      success:function(data){
        let dropdown = $('#shopifyapiversion');
        if (typeof data.body != 'undefined' && data.body !== '') {
            data.body.forEach(version => {
                let option = document.createElement("option");
                option.value = version.handle; // or any unique identifier
                option.textContent = version.displayName; // Assuming the company object has a name field
                dropdown.append(option);
            });
            swal({
                title: 'Connected',
                text: 'Vesrions fatched successfully',
                icon: 'success',
                confirmButtonText: 'Close'
            });
        } else {
            swal({
                title: 'Failed',
                text: "Something went wrong",
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }
      
        
      },
      error: function (error) {
        
      }
  });
});
$('#testsource').on('click', function (e) {
  e.preventDefault();

  var button = $(this);  // Store the reference to the button

  const apiKey = document.getElementById('source_api_key').value;
  const source = document.getElementById('source').value;
  const auth_type = document.getElementById('source_auth_type').value;
  const apiurl = document.getElementById('source_api_url').value;
  const shopifyapiversion = document.getElementById('shopifyapiversion').value;
 
  $.ajax({
      type:'POST',
      url:route('admin.stores.test'),
      data:{apiKey:apiKey, apiurl:apiurl, shopifyapiversion:shopifyapiversion, auth_type:auth_type, source:source},
      beforeSend: function (xhr) {
            button.prop('disabled', true);
        },
      success:function(data){
            console.log(data.body)
            if (typeof data.body != 'undefined' && data.body !== '') {
                let shopData = JSON.parse(data.body);
                swal({
                    title: 'Connected',
                    text: shopData.shop.domain,
                    icon: 'success',
                    confirmButtonText: 'Close'
                });
                $('#testsourcefld').val('true');
            } else {
                swal({
                    title: 'Failed',
                    text: "Something went wrong",
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
                $('#testsourcefld').val('false');
                button.prop('disabled', false);
            }
      },
      error: function (error) {
        
      }
  });
});

$('#testdestination').on('click', function (e) {
    e.preventDefault();
    var button = $(this);  // Store the reference to the button
    const apiKey = document.getElementById('destination_api_key').value;
    const source = document.getElementById('destination').value;
    const auth_type = document.getElementById('destination_auth_type').value;
    const apiurl = document.getElementById('destination_api_url').value;
   
    $.ajax({
        type:'POST',
        url:route('admin.stores.test'),
        data:{apiKey:apiKey, apiurl:apiurl, auth_type:auth_type, source:source},
        beforeSend: function (xhr) {
            button.prop('disabled', true);
          },
        success:function(data){
              console.log(data.body)
              if (typeof data.body != 'undefined' && data.body !== '') {
                  let shopData = JSON.parse(data.body);
                  swal({
                      title: 'Connected',
                      text: shopData.name,
                      icon: 'success',
                      confirmButtonText: 'Close'
                  });
                  $('#testdestinationfld').val('true');
              } else {
                  swal({
                      title: 'Failed',
                      text: "Something went wrong",
                      icon: 'error',
                      confirmButtonText: 'Close'
                  });
                  $('#testdestinationfld').val('true');
                  button.prop('disabled', false);
              }
        },
        error: function (error) {
          
        }
    });
});

function clearSourceTest(){
    $('#testsource').prop('disabled', false);
    $('#testsourcefld').val('');  // Clear the value of the hidden field
}

function clearDestinationTest(){
    $('#testdestination').prop('disabled', false);
    $('#testdestinationfld').val('');  // Clear the value of the hidden field
}

// Store page

$(document).ready(function () {
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        var target = $(e.target);
    
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        active.next().removeClass('disabled');
        nextTab(active);

    });
    $(".prev-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
$(document).ready(function() {
    $('#shopify_order_transfer_payment_status').select2();
    $('#shopify_order_transfer_fulfillment_status').select2();
    $('#ackro_order_update_status').select2();
});


$(document).ready(function () {
    $('#IsActive').change(function () {
        var url;
        var id = $(this).data('id');
        var status = '';

        switch($(this).data('for')){
            case "store":
                url = route('admin.stores.activate') ;
                break;
        }

        if ($(this).is(':checked')) {
          
        } else {
            alert("asdxakjd");
        }
    });
});