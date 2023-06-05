$(document).ready(function() {
  $('#submit_btn').prop('disabled',true).css({"cursor":"not-allowed"});
    
  $("#contact_frm input").keyup(function(){

    /*name */
      if ($("#name").val().length < 4) {
         //$("#Name_Err").html("Required field");
         $("#name").css({"border-color":"red", "color":"red"});
      }else{
        $("#name").css({"border-color":"#00e800", "color":"#00e800"});
      }
      /*else if($("#name").val().length > 0 && $("#name").val().length<4)
          {
            $("#Name_Err").html("Enter valid name");
          }else{
            $("#Name_Err").html("");
          }*/
    
    /*email  validation*/
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if (!emailReg.test($("#email").val()) || $("#email").val().length < 4) {
        //$("#Email_Err").html("Required field");
      $("#email").css({"border-color":"red", "color":"red"});
      }else{
        $("#email").css({"border-color":"#00e800", "color":"#00e800"});
      }
    

      /*contact number*/
      if(!$.isNumeric($("#contact").val())  ) {
         $("#contact").css({"border-color":"red", "color":"red"});
      }else if($("#contact").val().length !=10)
      {
        $("#contact").css({"border-color":"red", "color":"red"});
      }
      else{
          $("#contact").css({"border-color":"#00e800", "color":"#00e800"});
          }
  
    /*submit btn or next btn disabled or not*/
    if ($("#name").val().length < 4 || 
     !emailReg.test($("#email").val()) || 
      !$.isNumeric($("#contact").val()) || 
      $("#contact").val().length <= 0 || $("#contact").val().length !=10)
    {
      $('#submit_btn').prop('disabled',true).css({"cursor":"not-allowed"});
    }else{
        $("#name").css({"border-color":"#00e800", "color":"#00e800"});
        $("#email").css({"border-color":"#00e800", "color":"#00e800"});
        $("#contact").css({"border-color":"#00e800", "color":"#00e800"});

        $('#submit_btn').prop('disabled',false).css({"cursor":"pointer"});
        frm_validation = true;
        }
  });


        $("#submit_btn").click(function(){
            var form = $('#contact_frm')[0];
            var data = new FormData(form);
            $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  //url: "submition/topgear_contact_action.php",
                  url: "../submition/topgear_contact_action.php",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  timeout: 6000000,
              beforeSend: function(){
                  // Show image container
                  $("#loader").show();
                 },
              success: function (data) {
                      $(document).ajaxStop(function(){
                          $(".show_success_msg").html(data);
                      });
                     // alert (data);
              },
              complete:function(data){
                 // Hide image container
                 $("#loader").hide();
              }
            });
        });
});