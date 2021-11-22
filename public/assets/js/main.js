$(document).ready(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  $(".next").click(function () {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          next_fs.css({ opacity: opacity });
        },
        duration: 600,
      }
    );
  });

  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //Remove class active
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_fs.css({ opacity: opacity });
        },
        duration: 600,
      }
    );
  });

  $(".radio-group .radio").click(function () {
    $(this).parent().find(".radio").removeClass("selected");
    $(this).addClass("selected");
    $(this).parents("fieldset").find(".action-button").prop("disabled", false);
  });

  window.setInterval(function () {
    var images = $("#backgroundChanger img");
    var active, next;

    images.each(function (index, img) {
      if ($(img).hasClass("active")) {
        active = index;
        next = index === images.length - 1 ? 0 : index + 1;
      }
    });

    $(images[active]).fadeOut(50, function () {
      $(images[next]).fadeIn(50);
    });

    $(images[next]).addClass("active");
    $(images[active]).removeClass("active");
  }, 6000);

  $(".submit").click(function (event) {
    $(".result-subscribe-quiz").hide();
    var current_answer = 5;
    $("#msform .selected").each(function () {
      var question = $(this).parent().attr("id");
      var answer = $(this).attr("data-value");
      if (answer == "true") {
        $("#result_quiz").html(current_answer);
        $("#current_quiz").html(current_answer);
      } else {
        current_answer--;
        $("#result_quiz").html(current_answer);
        $("#current_quiz").html(current_answer);
        var video_btn = "#result_question ." + question;
        $(video_btn).css("display", "inline-block");
      }
    });
    if (current_answer > 3) {
      $(".result .success").show();
    } else {
      $(".result .failed").show();
      $(".result p .failed").show();
      $(".result .description-failed").show();
    }

    var formData = {
      name: $("#quizName").val(),
      phone: $("#quizPhone").val(),
      flag: $("#quiz_flag").val(),
    };

    $.ajax({
      type: "POST",
      url: "panel/process.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
      $(".result-subscribe-quiz").fadeIn("slow");
      if (data["success"] == true) {
        $(".box-form-step").hide();
        $("#box-result-quiz").fadeIn("slow");
        $("html, body").animate(
          {
            scrollTop: $("#box-result-quiz").offset().top,
          },
          1000
        );
      } else {
        $(".result-subscribe-quiz").html(data["message"]);
      }

      console.log(data);
    });
    event.preventDefault();
  });

  $(".btn-play").click(function () {
    $(this).hide();
    $(this).parent().find("iframe").show();
    $(this).parent().find(".cover").hide();
  });

  $("#video_list button").click(function (event) {
    $("video").each(function () {
      $(this).get(0).pause();
    });
  });
  // var swiper = new Swiper(".mySlider", {
  //   spaceBetween: 30,
  //   effect: "fade",
  //   grabCursor: true,

  //   centeredSlides: true,
  //   autoplay: {
  //     delay: 6000,
  //   },
  // });

  $("#result_question button").click(function (e) {
    $("html, body").animate(
      {
        scrollTop: $("#video_list").offset().top,
      },
      "fast"
    );
  });
});
function startQuiz() {
  $(".box-quiz").hide();
  $(".box-form-step").fadeIn("slow");
}
function formReload() {
  location.reload();
}

function form_quiz() {
  var formData = {
    name: $("#quizName").val(),
    phone: $("#quizPhone").val(),
    flag: $("#quiz_flag").val(),
  };
  $(".quiz-subscribe").show();
  $.ajax({
    type: "POST",
    url: "/public_html/avak/process.php",
    data: formData,
    dataType: "json",
    encode: true,
  }).done(function (data) {
    console.log(data);
    if (data["success"] == true) {
      $("#form_subscribe").hide();
    }
    $(".result-subscribe").html(data["message"]);
  });
}
$(document).ready(function () {
  $("form#form_subscribe").submit(function (event) {
    var formData = {
      name: $("#name").val(),
      phone: $("#phone").val(),
      flag: $("#flag").val(),
    };
    $(".result-subscribe").hide();
    $.ajax({
      type: "POST",
      url: "panel/process.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
      $(".result-subscribe").fadeIn("slow");

      if (data["success"] == true) {
        $("#form_subscribe").hide();
      }
      $(".result-subscribe").html(data["message"]);
    });

    event.preventDefault();
  });
});
