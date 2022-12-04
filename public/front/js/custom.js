
// This function uses for send Ajax query
function ajaxReq(
    url,
    method = "GET",
    callback,
    data = null,
    bcallback = null,
    errorElementID = "null"
) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-Token": $("meta[name=csrf-token]").attr("content"),
        },
    });
    $.ajax({
        url: url,
        data: data,
        type: method,
        contentType: false,
        cache: false,
        processData: false,
        //dataType: 'json',
        beforeSend: function () {
            if (bcallback != null) bcallback();
        },
        success: function (data) {
            callback(data);
        },
        error: function (data) {
            console.log(data);
            if (errorElementID === "null") {
                console.log(console.log(data));
            } else if (errorElementID === "window.alert") {
                let a;
                $.each(data.responseJSON.errors, function (key, value) {
                    a += value[0];
                });
                alert(a);
            } else {
                $("#" + errorElementID).removeClass("d-none");
                $.each(data.responseJSON.errors, function (key, value) {
                    $("#" + errorElementID).append(value[0] + "<br>");
                });
            }
        },
    });
}
//Spinner for loading button
const spinner = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
//Reset Buton
$(document).on('click', '#reset_text',function(){
  $('#content_comment').val('');
});
//Send Comment
$(document).on('click', '#send_comment', function(e) {
 e.preventDefault();
 comment = $('#content_comment').val();
 if (comment == "") {
     return;
 }
 post_id = $(this).attr('data-postid');
 form_data = new FormData();
 form_data.append('content', comment);
 form_data.append('post_id', post_id);
 $(this).html(spinner);
 $(this).attr('disabled', 'disabled');
 ajaxReq('/sendComment', 'post', (data) => {
    $(this).html('Send');
    $(this).removeAttr('disabled');
    if (data.status == 1) {
        $('#formComments').prepend(data.html);
        $('#content_comment').val('');
    }
 }, form_data);
});
//Edit Comment
$(document).on('click', '#edit_comment', function(e){
    if ($(this).attr('data-active') == "false") {
        return;
    }
  oldParent = $(this).parent().parent();
  comment = oldParent.find('p').text();
  html = `  <div class="col-md-11 pl-0">
  <textarea type="text" id="edit_content_comment" class="form-control" placeholder="Enter your comment..." rows="auto">${comment}</textarea>
  <div class="mt-2 row justify-content-end mr-1">
      <button type="button" class="btn d" id="close_comment" >Close</button>
      <button type="button" class="btn b" id="update_comment" data-id ="${$(this).data('id')}" data-postid="${$(this).data('postid')}">Save</button>
  </div>
</div>`;
 oldParent.append(html);
  console.log(comment);
  $(this).attr('data-active', 'false');
});
$(document).on('click', '#close_comment', function(e){
 $(this).parent().parent().parent().find('span#edit_comment').attr('data-active', 'true');
 $(this).parent().parent().remove();
});

// Update Comment
$(document).on('click', '#update_comment', function(e){
 comment = $(this).parent().parent().find('textarea#edit_content_comment').val();
 post_id = $(this).attr('data-postid');
 if (comment == "" || $(this).attr('data-id') == ""){
     return;
 }
 form_data = new FormData();
 form_data.append('content', comment);
 $(this).html(spinner);
 $(this).attr('disabled', 'disabled');
 ajaxReq('/updateComment/' + $(this).attr('data-id'), 'Post', (data) => {
    $(this).html('Save');
    $(this).removeAttr('disabled');
 if (data.status == 1) {
    $('#comment_' + $(this).attr('data-id')).find('p').html(data.text);
    $(this).parent().parent().parent().find('span#edit_comment').attr('data-active', 'true');
     $(this).parent().parent().remove();
 }
 }, form_data);
});
//Delete Comment
$(document).on('click', '#delete_comment', function(e){
 e.preventDefault();
 console.log("ik");
 $('#deleteModal #deleteClasstTogglerModal').attr('data-comment', $(this).attr('data-id'));
 $('#deleteModal').modal('show');
});

$(document).on('click', '#deleteClasstTogglerModal', function(e){
  e.preventDefault();
  ajaxReq('/deleteComment/' + $(this).data('comment'), 'Get', (data) => {
      if (data.status == 1) {
          $('#comment_' + $(this).data('comment')).remove();
        $('#deleteModal').modal('hide');
      }
  });
});

// Load more comment
$(document).on('click', '#ShowMore', function(e) {
 e.preventDefault();
 post_id = (window.location.pathname).split('/')[2];
 offset_comment = $(this).attr('data-offset');
 $(this).attr('disabled', 'disabled');
 $(this).html(spinner);
 console.log(offset_comment);
 ajaxReq('/moreComment/post/' + post_id + '/offset/' + offset_comment , 'get', (data) => {
     $(this).html('More');
     $(this).removeAttr('disabled');
     if (data.status == 1) {
         $('#formComments').append(data.html);
         $(this).attr('data-offset', data.offset);
         if (data.next  == 0) {
             $('#ShowMore').remove();
         }
     }
 });
});

//Select option for filter comments
$(document).on('change', '#FilterBy', function(click){
 if ($(this).val() == 'login') {
     $('#searchForm').removeClass('d-none');
     $('#searchForm').addClass('d-flex');
     $('#content_search').removeClass('d-none');
         return;
 } else {
     post_id = (window.location.pathname).split('/')[2];
    filterCommentByDateAscOrDesc(post_id, 1, $(this).val());
   }
 $('#searchForm').removeClass('d-flex');
    $('#searchForm').addClass('d-none');
    $('#searchForm input').val('');
    $('#content_search').addClass('d-none');
});

// Search Users by login on key up
$(document).on('keyup', '#inputText', function(e) {
    post_id = (window.location.pathname).split('/')[2];
 if (($(this).val()).length >= 3) {
    $('#content_search .text_wrapper').html('<p>loading...</p>');
     ajaxReq('/searchUserBylogin/' + $(this).val() + '/forPost/' + post_id, 'get', (data) => {
       if (data.status == 1) {
           if (data.count_login < 5) {
            $('#content_search').css({'height': 'auto'});
           } else {
            $('#content_search').css({'height': '200px', 'overflow': 'overlay'});
           }
           $('#content_search').removeClass('d-none');
           $('#content_search .text_wrapper').html(data.html);
       }
       if (data.count_login == 0) {
        $('#content_search .text_wrapper').html('<p>Not found</p>');
       }
     });
 } else {
 $('#content_search').addClass('d-none');
 }
});
$(document).mouseup(function (e) {
    var container = $("#content_search");
    if(!container.is(e.target) &&
    container.has(e.target).length === 0) {
        $('#content_search').addClass('d-none');

    }
});
// Function For filter and More Comment By Date Asc or Desc
function filterCommentByDateAscOrDesc(post_id, offset , filterBy)
{
    $('#ShowMoreBy'+filterBy).attr('disabled', 'disabled');
    $('#ShowMoreBy'+filterBy).html(spinner);
    ajaxReq('/filterCommentByDateAscOrDesc/post/' + post_id + '/offset/' + offset +'/filterBy/' + filterBy , 'get', (data) => {
        $('#ShowMoreBy'+filterBy).html('More');
        $('#ShowMoreBy'+filterBy).removeAttr('disabled');
        if (data.status == 1) {
            $('#ShowMoreBy'+filterBy).attr('data-offset', data.offset);
            if (offset == 1) {
                $('#fomrButton').html(`<button class="btnMore" id="ShowMoreBy${filterBy}" data-offset="2" data-filter="${filterBy}">More</button>`);
                $("#formComments").html(data.html);
            } else {
                $("#formComments").append(data.html);
            }
            if (data.next == 0) {
                $('#ShowMoreBy'+filterBy).remove();
            }
        } else {
            $("#formComments").html('<h5>Not Found</h5>');
        }
    });
}

//Filter Comment by login
function filterCommentByLoginOfUser(login, post_id, offset) {
    console.log("PRevioes " + offset);
    $('#ShowMoreByLogin').attr('disabled', 'disabled');
    $('#ShowMoreByLogin').html(spinner);
    ajaxReq('/filterCommentByLoginOfUser/'+login+'/post/' + post_id +  '/offset/' + offset, 'Get', (data) => {
        $('#ShowMoreByLogin').html('More');
        $("#ShowMoreByLogin").removeAttr('disabled');
        if (data.status == 1) {
            if (data.html != '') {
                if (offset == 1) {
                    $('#fomrButton').html('<button class="btnMore" id="ShowMoreByLogin" data-offset="2">More</button>');
                    $("#formComments").html(data.html);
                } else {
                    $("#formComments").append(data.html);
                }
                $('#ShowMoreByLogin').attr('data-offset', data.offset);
            }
            if (data.next == 0) {
                $('#ShowMoreByLogin').remove();
            }
        } else {
            $("#formComments").html('<h5>Not Found</h5>');
        }
    });
}


$(document).on('click', 'ul.text_wrapper >li', function(e){
 e.preventDefault();
 $('#inputText').val($(this).text());
 $('#content_search').addClass('d-none');
});

$(document).on('change', '#inputText', function(e){
   if ($(this).val() == 0) {
       return;
   }
  post_id = (window.location.pathname).split('/')[2];
  filterCommentByLoginOfUser($(this).val(), post_id, 1);
});

$(document).on('click', '#command_search', function(e){
    $('#inputText').change();
});

$(document).on('click', '#ShowMoreByLogin', function(e){
    e.preventDefault();
post_id = (window.location.pathname).split('/')[2];
login = $('#inputText').val();
if (login == "") {
    return;
}
filterCommentByLoginOfUser(login, post_id, $(this).attr('data-offset'));
});

$(document).on('click', '#ShowMoreByasc, #ShowMoreBydesc', function(e){
post_id = (window.location.pathname).split('/')[2];
filterBy = $(this).attr('data-filter');
filterCommentByDateAscOrDesc(post_id, $(this).attr('data-offset'), filterBy);
});

function showErrors(message) {
    return `<div class="alert alert-icon alert-danger alert-dismissible " role="alert">
    <button class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-exclamation-triangle"></i>
    ${message}
</div>`;
}

function showAlert(message) {
    return `'<div class="col-12 mb-30">  <div class="alert alert-primary">
    <button class="close" data-dismiss="alert">&times;</button>
    <i class="zmdi zmdi-alert-polygon"></i> ${message}</a></div></div></div>'`;
}

//Store post
$(document).on('click', '#store_post', function(e){
title = $('#title-post').val();
description = $('#description-post').val();
image = $('#image-post').val() !="" ? $("#image-post").prop('files')[0] : "";
form_data = new FormData();
form_data.append('title', title);
form_data.append('content', description);
form_data.append('image', image);
$(this).attr('disabled', 'disabled');
$(this).html(spinner);
ajaxReq('/store/post', 'post', (data) => {
    $(this).removeAttr('disabled');
    $(this).html('Create post');
   if (data.status == 0 ) {
     $('#errors').html(showErrors(data.message));
   }
   if (data.status == 1) {
       window.location = '/myposts';
   }
}, form_data);
});
// Update Post
$(document).on('click', '#update_post', function(e){
title = $('#title-post').val();
description = $('#description-post').val();
image = $('#image-post').val() !="" ? $("#image-post").prop('files')[0] : "";
post_id = (window.location.pathname).split('/')[3];
form_data = new FormData();
form_data.append('title', title);
form_data.append('content', description);
form_data.append('image', image);
form_data.append('post_id', post_id);
$(this).attr('disabled', 'disabled');
$(this).html(spinner);
ajaxReq('/update/post/' + post_id, 'post', (data) => {
    $(this).removeAttr('disabled');
    $(this).html('Update post');
   if (data.status == 0 ) {
     $('#errors').html(showErrors(data.message));
   }
   if (data.status == 1) {
       window.location = '/myposts';
   }
}, form_data);
});
//For change password
$(document).on("click", "#submit_password", function (e) {
    e.preventDefault();
    password = $("#change_password #current-password").val();
    new_password = $("#change_password #new-password").val();
    verify_password = $("#change_password #verify-password").val();
    form_data = new FormData();
    form_data.append("old_password", password);
    form_data.append("new_password", new_password);
    form_data.append("verify_password", verify_password);
    ajaxReq( "/change/password", "post",
        (data) => {
          if (data.status == 0) {
              $('#errors').html(showErrors('<p>'+ data.message +'</p>'));
          } else {
            $('#errors').html(showAlert('Password successfully changed'));
            $("#change_password #current-password").val('');
            $("#change_password #new-password").val('');
            $("#change_password #verify-password").val('');
          }
        },form_data);
});
