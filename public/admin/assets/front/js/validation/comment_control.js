<script type="text/javascript">
var totalLikes = 0;
var totalUnlikes = 0;

function postReply(commentId) {
    $('#commentId').val(commentId);
    $("#name").focus();
}

$("#submitButton").click(function () {
    //$("#comment-message").css('display', 'none');
    console.log("hellow");

    var name = $("#name").val();
    var email = $("#email").val();
    /*email  validation*/
    var emailReg2 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;


    if(name == ""){
       $("#name_error").html("Name field is required");
    }else if(name.length < 3){
        $("#name_error").html("Name  is too short");
    }else{
        $("#name_error").html("");
    }

    if ($("#email").val().length <= 0) {
      $("#email_error").html("Required field");
    }
    else if(!emailReg2.test(email))
        {
          $("#email_error").html("Enter a valid email");
        }else{
       $("#email_error").html(""); 
    }


    //var str = $("#frm-comment").serialize();

    if (name != "" && email != "" && name.length >= 3 && emailReg2.test(email)) {


    var form = $('#frm-comment')[0];
    var str = new FormData(form);
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "../../updation/comment-add.php",
      data: str,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 6000000,
      beforeSend: function(){
          // Show image container
          //$("#submition_loader").show();
          //alert ("yyy");
          $("#submitButton").find('#spinner').show();
          $("#submitButton").find('#tick').hide();
         },

      success: function (response) {
              // console.log();
              $("#name").val("");
              $("#email").val("");
              $("#comment").val("");
              $("#commentId").val("");
              $(document).ajaxStop(function(){
                  if(response == 1){
                    $("#comment-message").html("Comments Added Successfully!");
                    $("#submitButton").find('#spinner').hide();
                    $("#submitButton").find('#tick').show();

                  }
              });
              listComment();
          },
      complete:function(data){
         // Hide image container
        // $("#submition_loader").hide();
       // setTimeout($("#submitButton").find('#tick').hide(), 2000);
       }
    });
    }
    else{
        console.log("field required")
    }
});

$(document).ready(function () {
    listComment();
});

function listComment() {
    $.ajax({
            url:"<?php echo base_url(); ?>/updation/comment-list.php",
            type: 'post',
            success:function (data) {
                var data = JSON.parse(data);

                var comments = "";
                var replies = "";
                var item = "";
                var parent = -1;
                var results = new Array();

                var list = $("<ul class='outer-comment'>");
                var item = $("<li>").html(comments);

                for (var i = 0; (i < data.length); i++)
                {
                    var commentId = data[i]['comment_id'];
                    parent = data[i]['parent_comment_id'];

                    var obj = getLikesUnlikes(commentId);

                    
                    if (parent == "0")
                    {
                        if(data[i]['like_unlike'] >= 1) 
                        {
                            like_icon = "<button type='button' class='float-right btn btn-primary ml-2' id='unlike_" + data[i]['comment_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comment_id'] + ",-1)'> <i class='fa fa-heart mr-2'></i>You Liked </button>";
                
                            like_icon += "<button type='button' style='display:none;'  class='float-right  btn btn-light border ml-2' style='display:none'  id='like_" + data[i]['comment_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comment_id'] + ",1)'> <i class='fa fa-heart mr-2'></i> Like </button>";
                            
                        }
                        else
                        {

                            like_icon = "<button type='button' class='float-right btn btn-primary ml-2' style='display:none;'  id='unlike_" + data[i]['comment_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comment_id'] + ",-1)'> <i class='fa fa-heart mr-2'></i>You liked</button>";
                            
                            like_icon += "<button type='button' class='float-right  btn btn-light border ml-2' id='like_" + data[i]['comment_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comment_id'] + ",1)'> <i class='fa fa-heart mr-2'></i> Like</button>";
                            
                        }
                        
                    comments = "\
                        <div class='media'>\
                        <img src='https://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png' class='mr-3 img-thumbnail' alt='...' style='width:60px;'>\
                        <div class='media-body'>\
                        <header class='text-left'>\
                            <div class='comment-user'><i class='fas fa-user'></i> " + data[i]['comment_sender_name'] + "</div>\
                            <time class='comment-date' datetime='16-12-2014 01:05'><i class='fas fa-clock'></i> " + data[i]['date'] + "</time>\
                        </header>\
                        <p>" + data[i]['comment'] + "</p>\
                        <div class='row comment_action_row'>\
                            <div class='col-md-12 text-right'>\
                                <button type='button' class='float-right btn btn-outline-primary ml-2' onClick='postReply(" + commentId + ")'> <i class='fa fa-reply'></i> Reply</button>\
                                 " + like_icon + "&nbsp;\
                                <span id='likes_" + commentId + "'> " + totalLikes + " likes </span>\
                            </div>\
                        </div>\
                    </div>\
                    </div>\
                        ";

                        var item = $("<li>").html(comments);
                        list.append(item);
                        var reply_list = $('<ul>');
                        item.append(reply_list);
                        listReplies(commentId, data, reply_list);

                    }
                }
                $("#output").html(list);
            }
            
    });
}

function listReplies(commentId, data, list) {

    for (var i = 0; (i < data.length); i++)
    {

        var obj = getLikesUnlikes(data[i].comment_id);
        if (commentId == data[i].parent_comment_id)
        {   

            if(data[i]['like_unlike'] >= 1) 
            {   

                like_icon = "<button type='button' class='float-right btn btn-primary ml-2' id='unlike_" + data[i]['comment_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comment_id'] + ",-1)' > <i class='fa fa-heart mr-2'></i>You liked </button>";
                
                like_icon += "<button type='button' class='float-right  btn btn-light border ml-2' style='display:none'  id='like_" + data[i]['comment_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comment_id'] + ",1)'> <i class='fa fa-heart mr-2'></i> Like </button>";
                
            }
            else
            {

                like_icon = "<button type='button' class='float-right btn btn-primary ml-2' style='display:none;'  id='unlike_" + data[i]['comment_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comment_id'] + ",-1)'> <i class='fa fa-heart '></i>You Liked </button>";
                
                like_icon += "<button type='button' class='float-right  btn btn-light border ml-2' id='like_" + data[i]['comment_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comment_id'] + ",1)'> <i class='fa fa-heart'></i> Like </button>";
                
            }
            var comments = "\
            <div class='media'>\
    <img src='https://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png' class='mr-3 img-thumbnail' alt='...' style='width:60px;'>\
    <div class='media-body'>\
                    <header class='text-left'>\
                        <div class='comment-user'><i class='fas fa-user'></i> " + data[i]['comment_sender_name'] + "</div>\
                        <time class='comment-date' datetime='16-12-2014 01:05'><i class='fas fa-clock'></i> " + data[i]['date'] + "</time>\
                    </header>\
                    <p>" + data[i]['comment'] + "</p>\
                    <div class='row'>\
                        <div class='col-md-12 text-right'>\
                            <button type='button' class='float-right btn btn-outline-primary ml-2' onClick='postReply(" + data[i]['comment_id'] + ")'> <i class='fa fa-reply'></i> Reply</button>\
                            " + like_icon + "&nbsp;\
                             <span id='likes_" + data[i]['comment_id'] + "'> " + totalLikes + " likes </span>\
                        </div>\
                    </div>\
                    </div>\
                    </div>\
                    ";

            var item = $("<li>").html(comments);
            var reply_list = $('<ul>');
            list.append(item);
            item.append(reply_list);
            listReplies(data[i].comment_id, data, reply_list);
        }
    }
}

function getLikesUnlikes(commentId)
{

    $.ajax({
        type: 'POST',
        async: false,
        url: '<?php echo base_url(); ?>/updation/get-like-unlike.php',
        data: {comment_id: commentId},
        success: function (data)
        {
            totalLikes = data;
        }

    });

}

             
function likeOrDislike(comment_id,like_unlike)
{
  
    $.ajax({
        url: '<?php echo base_url(); ?>/updation/comment-like-unlike.php',
        async: false,
        type: 'post',
        data: {comment_id:comment_id,like_unlike:like_unlike},
        dataType: 'json',
        success: function (data) {
            
            $("#likes_"+comment_id).text(data + " likes");
            
            if (like_unlike == 1) { 
                $("#like_" + comment_id).css("display", "none");
                $("#unlike_" + comment_id).show();
            }

            if (like_unlike == -1) {
                $("#unlike_" + comment_id).css("display", "none");
                $("#like_" + comment_id).show();
            }
            
        },
        error: function (data) {
            alert("error : " + JSON.stringify(data));
        }
    });
}


</script>