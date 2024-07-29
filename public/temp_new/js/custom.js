"use strict";

$("input").on("ifChecked", function (event) {
  $(this).parents("li").addClass("task-done");
  console.log("ok");
});
$("input").on("ifUnchecked", function (event) {
  $(this).parents("li").removeClass("task-done");
  console.log("not");
});
$("#noti-box").slimScroll({
  height: "400px",
  size: "5px",
  BorderRadius: "5px"
});
$('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
  checkboxClass: "icheckbox_flat-grey",
  radioClass: "iradio_flat-grey"
});
$(document).ready(function () {
  $("#date").bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
  $("#date2").bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
  $("#time").bootstrapMaterialDatePicker({
    date: false,
    shortTime: false,
    format: "HH:mm"
  });
  $("#date-format").bootstrapMaterialDatePicker({
    format: "YYYY-m-d HH:mm"
  });
  $("#date-fr").bootstrapMaterialDatePicker({
    format: "YYYY-M-d HH:mm",
    lang: "fr",
    weekStart: 1,
    cancelText: "ANNULER",
    nowButton: true,
    switchOnClick: true
  });
  $("#date-end").bootstrapMaterialDatePicker({
    weekStart: 0,
    format: "YYYY-MM-D",
    time: false
  });
  $("#date-start")
    .bootstrapMaterialDatePicker({
      weekStart: 0,
      format: "YYYY-MM-D",
      time: false,
      shortTime: true
    })
    .on("change", function (e, date) {
      $("#date-end").bootstrapMaterialDatePicker("setMinDate", date);
    });
  $("#min-date").bootstrapMaterialDatePicker({
    format: "YYYY-m-d",
    minDate: new Date()
  }); //time start, end

  $("#time-end").bootstrapMaterialDatePicker({
    weekStart: 0,
    format: "YYYY-MM-D HH:mm"
  });
  $("#time-start")
    .bootstrapMaterialDatePicker({
      weekStart: 0,
      format: "YYYY-MM-D HH:mm",
      shortTime: true
    })
    .on("change", function (e, date) {
      $("#time-end").bootstrapMaterialDatePicker("setMinTime", date);
    });
  $("#min-time").bootstrapMaterialDatePicker({
    format: "YYYY-m-d HH:mm",
    minDate: new Date()
  });
  $.material.init();
});
$(document).ready(function () {
  $(".collapse").collapse();
  $('[data-toggle="tooltip"]').tooltip({
    placement: "top"
  });
  $(".tool-tip").tooltip();
  $('[data-toggle="popover"]').popover();
});
