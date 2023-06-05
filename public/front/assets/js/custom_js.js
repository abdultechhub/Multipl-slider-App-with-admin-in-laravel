$('#city_id').on('change', function () {
    var city_id = this.value;
    $("#pincode_id").html('');
    $('#display_address').html('');
    $.ajax({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/retail/fetch_pincode',
        data: { city_id: city_id, },
        dataType: 'json',
        beforeSend: function () {

            $('#display_address').html(`<div class="spinner-border spinner-border-lg text-success mx-auto" role="status"></div>`);

        },
        success: function (result) {
            //console.log(result.address);
            $('#display_address').html('');
            $('#pincode_id').html('<option value="">Select Pin Code</option>');
            $.each(result.pincode, function (key, value) {
                console.log(value.name);
                $("#pincode_id").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });

            if (result.address.length != 0) {
                //$('#display_address').html('<div>');
                $.each(result.address, function (key, value) {
                    console.log(value.name);
                    $("#display_address").append('<div class="address_inn"><h3 class="address_state">' + value.state + '</h3><p>' + value.name + '</p></div>');
                });
                //   console.log("Found" + result.address.length);
            } else {
                $('#display_address').html('<div class="no_data_found">NO Data Found</div>');
                //  console.log("NotFound" + result.address.length);
            }
        }
    });
});


$('#find_location').on('click', function () {
    var city_id = $("#city_id").val();
    var pincode_id = $("#pincode_id").val();
    // console.log(pincode_id);
    //$("#display_address").html('');
    if (pincode_id == "") {
        $("#pincode_error").html("Please Select Pincode*");
    } else {
        $("#pincode_error").html("");
        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/retail/fetch_address',
            data: { city_id: city_id, pincode_id: pincode_id, },
            dataType: 'json',

            beforeSend: function () {

                $('#find_location').html(`Please Wait <div class="spinner-border ms-1" role="status"></div>`);
                $('#find_location').attr('disabled', true);
                $('#display_address').html(`<div class="spinner-border  mx-auto spinner-border-md text-success" role="status"></div>`);

            },
            success: function (result) {
                console.log(result);
                if (result.address.length != 0) {
                    $('#display_address').html('');
                    $.each(result.address, function (key, value) {
                        console.log(value.name);
                        $("#display_address").append('<div class="address_inn"><h3 class="address_state">' + value.state + '</h3><p>' + value.name + '</p></div>');
                    });
                    //   console.log("Found" + result.address.length);
                } else {
                    $('#display_address').html('<div class="no_data_found">NO Data Found</div>');
                    //  console.log("NotFound" + result.address.length);
                }
            },
            complete: function () {

                $('#find_location').html('find location');
                $('#find_location').attr('disabled', false);

                // $('#myform').trigger("reset");
            }
        });

    }
});