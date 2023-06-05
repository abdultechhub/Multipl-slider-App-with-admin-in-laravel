

/*button effect End*/

//$('#overlay').modal('show');

setInterval(function () {
    $('#overlay').modal('show');
}, 200000);



/*more help modal*/
$(document).ready(function () {
    $('.next_btn, .submit_btn').prop('disabled', true).css({ "cursor": "not-allowed" });

    $("input").keyup(function () {

        /*name */
        if ($("#Name").val().length <= 0) {
            $("#Name_Err").html("Required field");
        }
        else if ($("#Name").val().length > 0 && $("#Name").val().length < 4) {
            $("#Name_Err").html("Enter valid name");
        } else {
            $("#Name_Err").html("");
        }

        /*email  validation*/
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if ($("#Email").val().length <= 0) {
            $("#Email_Err").html("Required field");
        }
        else if (!emailReg.test($("#Email").val())) {
            $("#Email_Err").html("Enter a valid email");
        } else {
            $("#Email_Err").html("");
        }

        /*contact number*/
        if (!$.isNumeric($("#Contact_Number").val())) {
            $("#Contact_Number_Err").html("Only number required");
        }
        else if ($("#Contact_Number").val().length <= 0) {
            $("#Contact_Number_Err").html("Required field");
        }
        else if ($("#Contact_Number").val().length != 10) {
            $("#Contact_Number_Err").html("Only 10 digit required");
        } else {
            $("#Contact_Number_Err").html("");
        }

        /*submit btn or next btn disabled or not*/
        if ($("#Name").val().length < 0 || $("#Name").val().length < 4 ||
            $("#Email").val().length <= 0 || !emailReg.test($("#Email").val()) ||
            !$.isNumeric($("#Contact_Number").val()) ||
            $("#Contact_Number").val().length <= 0 || $("#Contact_Number").val().length != 10) {
            $('.next_btn, .submit_btn').prop('disabled', true).css({ "cursor": "not-allowed" });
        } else {
            $("#Name_Err").html("");
            $("#Email_Err").html("");
            $("#Contact_Number_Err").html("");
            $('.next_btn, .submit_btn').prop('disabled', false).css({ "cursor": "pointer" });
            frm_validation = true;
        }
    });


    $('#more_help').change(function () {
        if (this.checked) {

            $('.submit_btn').hide();
            $('.prev_btn').show();
            $('.next_btn').show();
            //$('.next_btn').prop('disabled',true).css({"cursor":"not-allowed"});
        }
        else {
            $('.next_btn').hide();
            $('.prev_btn').hide();
            $('.submit_btn').show();
        }
    });

    /*skip next prev btn*/
    $('.skip_step').change(function () {
        if (this.checked) {

            $('.submit_btn').show();
            $('.prev_btn').hide();
            $('.next_btn, #next_btn2').hide();
            //$('.next_btn').prop('disabled',true).css({"cursor":"not-allowed"});
        }
        else {
            $('.next_btn, #next_btn2').show();
            $('.prev_btn').show();
            $('.submit_btn').hide();
        }
    });

    $('#project_type').change(function () {
        if ($("#project_type").val() == "Old_Project") {
            //alert ("y");
            $("#old_project_link_div").show();

        }
        else {
            $("#old_project_link_div").hide();
        }
    });


    /*next prev btn */
    $('#next_btn1').on('click', function (e) {
        $('#modal_outer2').show();
        $('#modal_outer1').hide();
    });
    $('#prev_btn2').on('click', function (e) {
        $('#modal_outer1').show();
        $('#modal_outer2').hide();
    });

    /*job type next btndisable enable*/
    $('#next_btn2').prop('disabled', true).css({ "cursor": "not-allowed" });
    $("input[name='job_type']").click(function () {
        if ($(this).is(':checked')) {
            // alert('checked!');
            $('#next_btn2').prop('disabled', false).css({ "cursor": "pointer" });
        }
        else {
            //alert('nothing is checked!'); 
            $('#next_btn2').prop('disabled', true).css({ "cursor": "not-allowed" });
        }
    });



    $('#next_btn2').on('click', function (e) {
        if ($('#full_time').prop("checked") || $('#part_time').prop("checked")) {
            //alert ("yy");
            $('#modal_outer3').show();
            $('#modal_outer2').hide();
            $('#next_btn2').prop('disabled', false).css({ "cursor": "pointer" });
        }
        if ($('#work_home').prop("checked")) {
            //alert ("yy");
            $('#modal_outer3_f').show();
            $('#modal_outer2').hide();
            $('#next_btn2').prop('disabled', false).css({ "cursor": "pointer" });
        }
        /* if{
           $('#next_btn2').prop('disabled',true).css({"cursor":"not-allowed"});
         }*/
    });
    $('#prev_btn3').on('click', function (e) {
        $('#modal_outer2').show();
        $('#modal_outer3').hide();
    });
    $('#prev_btn3_f').on('click', function (e) {
        $('#modal_outer2').show();
        $('#modal_outer3_f').hide();
    });


});
