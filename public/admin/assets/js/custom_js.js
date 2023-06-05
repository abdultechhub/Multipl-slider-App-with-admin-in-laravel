//global modal close function
function modal_close(id) {
  $("#" + id).modal("hide");
  //console.log("click");
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});



function validate_delete(form) {
  var confirm_msg = "Are you sure you want to delete?";
  if (confirm(confirm_msg)) {
    return true;
  } else {
    return false;
  }
}

function validate_restore(form) {
  var confirm_msg = "Are you sure you want to restore ";
  if (confirm(confirm_msg)) {
    return true;
  } else {
    return false;
  }
}
function validate_permanet_delete(form) {
  var confirm_msg = "Are you sure you want to Delete permanantly \n This action can't be undone!!";
  if (confirm(confirm_msg)) {
    return true;
  } else {
    return false;
  }
}

$(function () {
  var url = window.location;
  // for single sidebar menu
  $('ul a').click(function () {
    return true;
    console.log("clcil");
  })
  $('ul.nav-sidebar a').filter(function () {
    return this.href == url;
  }).addClass('active');

  // for sidebar menu and treeview
  $('ul.nav-treeview a').filter(function () {
    return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview")
    .css({
      'display': 'block'
    })
    .addClass('menu-open').prev('a')
    .addClass('active');
});

$('#summernote_ed1').summernote();
$('#summernote_ed2').summernote(
  {
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']],
    ]
  }
);
$('.summernote_multi').summernote();


// Make the dashboard widgets sortable Using jquery UI
$('.connectedSortable').sortable({
  placeholder: 'sort-highlight',
  connectWith: '.connectedSortable',
  handle: '.card-header, .nav-tabs',
  forcePlaceholderSize: true,
  zIndex: 999999,
  update: function (event, ui) {
    adjust_position()
    //alert("Sortable Event Updated!")
  }
})
$('.connectedSortable .card-header').css('cursor', 'move')



