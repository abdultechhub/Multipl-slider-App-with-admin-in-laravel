$(document).ready(function () {
  var path_url = window.location.href;
  //alert (path_url); 
  $("#sidebar_nav .no_css_nav_drop").each(function () {
    if (this.href === path_url) {
      $(this).addClass("top_active");
      $(this).closest(".treeview").addClass("active");
      $(this).closest(".treeview").find(".treeview-menu").addClass("menu-open");
    }
    else {
      $(this).removeClass("top_active");
    }

  });
  $("#sidebar_nav .no_css_nav_drop2").each(function () {

    //http://localhost/top_gear/index.php
    if (this.href === path_url) {
      $(this).addClass("top_active");
      //$(this).closest(".treeview-menu").addClass("menu-open");
      $(this).parents(".treeview-menu").addClass("menu-open");
      $(this).parents(".treeview").addClass("active");
      //$(this).parents().addClass("active");
    } else {
      $(this).removeClass("top_active");
    }
  });
  $("#sidebar_nav .no_css_nav_link").each(function () {

    //http://localhost/top_gear/index.php
    if (this.href === path_url) {
      $(this).addClass("top_active");
      //$(this).closest(".treeview-menu").addClass("menu-open");
      $(this).parents(".treeview-menu").addClass("menu-open");
      $(this).parents(".treeview").addClass("active");
      //$(this).parents().addClass("active");
    } else {
      $(this).removeClass("top_active");
    }
  });

});

//for top nav active link
$(document).ready(function () {
  var path_url = window.location.href;
  //alert (path_url); 
  $(".navbar-custom-menu .nav-link").each(function () {
    //$(this).addClass("active"); http://localhost/top_gear/#
    // alert(this.href);
    //alert (path_url);

    //http://localhost/top_gear/index.php
    if (this.href === path_url) {
      $(this).addClass("top_active");
      //$(this).closest(".treeview-menu").addClass("menu-open");
      //$(this).closest(".treeview").addClass("active");
      //$(this).parents().addClass("active");
    } else {
      $(this).removeClass("top_active");
    }
  });

});





// $(document).ready(function(){

//   if ($('#preloader').length) {
//     $('#preloader').delay(900).fadeOut('slow', function () {
//       $(this).remove();
//     });
//   }


// });


// search button



/*******************************
* ACCORDION WITH TOGGLE ICONS
btn-default
   $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
          $(this).prev(".panel-heading").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
          $(this).prev(".panel-heading").find(".fas").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
          $(this).prev(".panel-heading").find(".fas").removeClass("fa-minus").addClass("fa-plus");
        });
    });





/*filter search*/
$(document).ready(function () {
  $("#myInput").on("keyup", function () {

    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

    });
  });
});


/*for initializing bs4 tooltip*/


function myFunction() {
  var input, filter, box_outer, s_box, matching_title, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();


  box_outer = document.getElementById("box_outer");

  s_box = box_outer.getElementsByClassName("s_box");

  for (i = 0; i < s_box.length; i++) {
    matching_title = s_box[i].getElementsByTagName("h2")[0];
    txtValue = matching_title.textContent || matching_title.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      s_box[i].style.display = "block";
    } else {
      s_box[i].style.display = "none";
    }
  }
}



/*show hide btn*/
$(document).ready(function () {
  $(".show_btn").click(function () {
    //console.log("yyy");
    $("#pass").attr("type", "text");
  })

  $(".hide_btn").click(function () {
    // console.log("yyy");
    $("#pass").attr("type", "password");

  });
  //alert ("helo");
});



$(document).ready(function () {
  code_common_h = 0;
  $(".code_equal").each(function () {
    if ($(this).outerHeight() > code_common_h) {
      code_common_h = $(this).outerHeight();
    }
    $(".code_equal").outerHeight(code_common_h);
  });
})





//hameburger menu 
$(document).ready(function () {
  var forEach = function (t, o, r) { if ("[object Object]" === Object.prototype.toString.call(t)) for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t); else for (var e = 0, l = t.length; l > e; e++)o.call(r, t[e], e, t) };

  var hamburgers = document.querySelectorAll(".hamburger");
  if (hamburgers.length > 0) {
    forEach(hamburgers, function (hamburger) {
      hamburger.addEventListener("click", function () {
        this.classList.toggle("is-active");
      }, false);
    });
  }
});

//$(document).ready(function(){
function confirm_reset() {
  return confirm("Are you sure you want to reset all text?");
}
//});

/*go top start*/
$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
      $("#go_top").fadeIn();
    }
    else {
      $("#go_top").fadeOut();
    }
  });
  //--------------------  -- - - - - ------to close
  $("#go_top").click(function () {
    $("body,html").animate({ scrollTop: 0 }, 100);

  });

});

$(document).ready(function () {
  /*testimonials_carousel*/
  $('.bottom_post_carousel').owlCarousel({
    items: 4,
    nav: true,
    dots: false,
    loop: true,

    mouseDrag: true,
    responsiveClass: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    /*navText : ["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"],*/
    responsive: {
      0: {
        items: 1
      },
      480: {
        items: 1
      },
      767: {
        items: 2
      },
      992: {
        items: 2
      },
      1200: {
        items: 2
      },
      1300: {
        items: 2
      },
      1400: {
        items: 3
      }
    }
  });
});




$(document).ready(function () {
  /*testimonials_carousel*/
  $('.right_tranding_post_carousel').owlCarousel({
    items: 1,
    nav: false,
    dots: true,
    loop: true,

    mouseDrag: true,
    responsiveClass: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    /*navText : ["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"],*/
    responsive: {
      0: {
        items: 1
      },
      480: {
        items: 1
      },
      767: {
        items: 1
      },
      992: {
        items: 1
      },
      1200: {
        items: 1
      }
    }
  });
});


// main search box start
$("body").bind("keydown", keyDown);

function keyDown(e) {
  if ((e.ctrlKey) && (e.keyCode == 191)) {
    console.log("Keys down are Ctrl + /");
    $('#txt_search').focus();
  }
}
$(document).ready(function () {
  $(".s_key_btn").on('click', function () {
    $('#txt_search').focus();
  })

  var KEYCODE_ESCAPE = 27;
  var KEYCODE_UP = 38;
  var KEYCODE_DOWN = 40;

  //console.log('<?php echo base_url(); ?>/updation/getSearch.php');

  $('#txt_search').on('click', function () {
    $('#list1').removeClass('hide');
    console.log("clicked")
  });

  $('#txt_search').on('focus', function () {
    $('#list1').removeClass('hide');

  }).on('keyup', function (e) {
    $('#list1').removeClass('hide');
    var search = $(this).val();

    console.log(search.length);

    if (search.length >= 3) {

      $.ajax({
        url: '<?php echo base_url(); ?>/updation/getSearch.php',
        type: 'post',
        data: {
          search: search,
          type: 1
        },
        dataType: 'json',
        success: function (response) {

          var len = response.length;
          $("#searchResult").empty();
          for (var i = 0; i < len; i++) {
            var id = response[i]['id'];
            var name = response[i]['name'];
            var url = response[i]['url'];

            $("#searchResult").append("<li><a  href='" + url + "'>" + name + "</a></li>");

            //console.log(name);

          }

          //binding click event to li
          // $("#searchResult").bind("click", function() {
          //     setText(this);
          // });

          console.log(len);

          if (len < 1) {
            $("#searchResult").empty();
            $("#searchResult").append("<li><a  style='color:#ccc' href='#'>Oops! No result found...Try another keyword <br><img style='width:60px; opacity: 0.4;' src='<?php echo base_url(); ?>/static/images/eyes.gif'></a></li>");

          }

        }
      });
    } else {
      $("#searchResult").empty();
    }

    if (e.keyCode === KEYCODE_DOWN) {

      if ($('#list1.hide').length > 0) {

        $('#list1.hide').removeClass('hide');

      } else {

        $('#list1 .list-group-item:first-child').focus();

      }

    } else if (e.keyCode === KEYCODE_UP) {

      if ($('#list1.hide').length > 0) {

        $('#list1.hide').removeClass('hide');

      } else {

        $('#list1 .list-group-item:last-child').focus();

      }

    } else if (e.keyCode === KEYCODE_ESCAPE) {

      $('#list1').addClass('hide');

    } else {

      $('#list1').removeClass('hide');

    }

  });

  $('#list1').on('keydown', '.list-group-item', function (e) {

    if (e.keyCode === KEYCODE_DOWN) {

      if ($(this).is(':last-child')) {
        $(this).closest('.list-group').find('.list-group-item:first-child').focus();
      } else {
        $(this).next().focus();
      }

    } else if (e.keyCode === KEYCODE_UP) {

      if ($(this).is(':first-child')) {
        $(this).closest('.list-group').find('.list-group-item:last-child').focus();
      } else {
        $(this).prev().focus();
      }

    } else if (e.keyCode === KEYCODE_ESCAPE) {

      $('#list1').addClass('hide');
      $('#input1').focus();
    } else {
      $('#input1').focus();
    }

  }).on('focus', '.list-group-item', function () {
    $(this).addClass('active').attr('aria-selected', 'true');

  }).on('blur', '.list-group-item', function () {
    $(this).removeClass('active').attr('aria-selected', 'false');
  });

  /**
   * Click handler on the body because
   * we can't use the blur event to 
   * hide the drop-down.
   */
  $('html, body').on('click', function (e) {
    if (!$(e.target).is('#txt_search') &&
      !$(e.target).is('#list1') &&
      !$(e.target).closest('#list1').length > 0) {
      $('#list1').addClass('hide');
    }
  });

});

// main search box end



