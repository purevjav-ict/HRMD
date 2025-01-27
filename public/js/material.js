"use strict";

!(function (a) {
  function b(a) {
    return "undefined" == typeof a.which
      ? !0
      : "number" == typeof a.which && a.which > 0
      ? !a.ctrlKey &&
        !a.metaKey &&
        !a.altKey &&
        8 != a.which &&
        9 != a.which &&
        13 != a.which &&
        16 != a.which &&
        17 != a.which &&
        20 != a.which &&
        27 != a.which
      : !1;
  }

  function c(b) {
    var c = a(b);
    c.prop("disabled") || c.closest(".form-group").addClass("is-focused");
  }

  function d(a, b) {
    var c;
    return (
      (c =
        a.hasClass("checkbox-inline") || a.hasClass("radio-inline")
          ? a
          : a.closest(".checkbox").length
          ? a.closest(".checkbox")
          : a.closest(".radio")),
      c.toggleClass("disabled", b)
    );
  }

  function e(b) {
    var e = !1;
    (b.is(a.material.options.checkboxElements) ||
      b.is(a.material.options.radioElements)) &&
      (e = !0),
      b.closest("label").hover(
        function () {
          var b = a(this).find("input"),
            f = b.prop("disabled");
          e && d(a(this), f), f || c(b);
        },
        function () {
          f(a(this).find("input"));
        }
      );
  }

  function f(b) {
    a(b).closest(".form-group").removeClass("is-focused");
  }

  (a.expr[":"].notmdproc = function (b) {
    return a(b).data("mdproc") ? !1 : !0;
  }),
    (a.material = {
      options: {
        validate: !0,
        input: !0,
        ripples: !0,
        checkbox: !0,
        togglebutton: !0,
        radio: !0,
        arrive: !0,
        autofill: !1,
        withRipples: [
          ".btn:not(.btn-link)",
          ".card-image",
          ".navbar a:not(.withoutripple)",
          ".dropdown-menu a",
          ".nav-tabs a:not(.withoutripple)",
          ".withripple",
          ".pagination li:not(.active):not(.disabled) a:not(.withoutripple)"
        ].join(","),
        inputElements:
          "input.form-control, textarea.form-control, select.form-control",
        checkboxElements:
          ".checkbox > label > input[type=checkbox], label.checkbox-inline > input[type=checkbox]",
        togglebuttonElements: ".togglebutton > label > input[type=checkbox]",
        radioElements:
          ".radio > label > input[type=radio], label.radio-inline > input[type=radio]"
      },
      checkbox: function (b) {
        var c = a(b ? b : this.options.checkboxElements)
          .filter(":notmdproc")
          .data("mdproc", !0)
          .after(
            "<span class='checkbox-material'><span class='check'></span></span>"
          );
        e(c);
      },
      togglebutton: function (b) {
        var c = a(b ? b : this.options.togglebuttonElements)
          .filter(":notmdproc")
          .data("mdproc", !0)
          .after("<span class='toggle'></span>");
        e(c);
      },
      radio: function (b) {
        var c = a(b ? b : this.options.radioElements)
          .filter(":notmdproc")
          .data("mdproc", !0)
          .after("<span class='circle'></span><span class='check'></span>");
        e(c);
      },
      input: function (b) {
        a(b ? b : this.options.inputElements)
          .filter(":notmdproc")
          .data("mdproc", !0)
          .each(function () {
            var b = a(this),
              c = b.closest(".form-group");
            0 !== c.length ||
              "hidden" === b.attr("type") ||
              b.attr("hidden") ||
              (b.wrap("<div class='form-group'></div>"),
              (c = b.closest(".form-group"))),
              b.attr("data-hint") &&
                (b.after(
                  "<p class='help-block'>" + b.attr("data-hint") + "</p>"
                ),
                b.removeAttr("data-hint"));
            var d = {
              "input-lg": "form-group-lg",
              "input-sm": "form-group-sm"
            };

            if (
              (a.each(d, function (a, d) {
                b.hasClass(a) && (b.removeClass(a), c.addClass(d));
              }),
              b.hasClass("floating-label"))
            ) {
              var e = b.attr("placeholder");
              b.attr("placeholder", null).removeClass("floating-label");
              var f = b.attr("id"),
                g = "";
              f && (g = "for='" + f + "'"),
                c.addClass("label-floating"),
                b.after(
                  "<label " + g + "class='control-label'>" + e + "</label>"
                );
            }

            (null === b.val() || "undefined" == b.val() || "" === b.val()) &&
              c.addClass("is-empty"),
              c.find("input[type=file]").length > 0 &&
                c.addClass("is-fileinput");
          });
      },
      attachInputEventHandlers: function () {
        var d = this.options.validate;
        a(document)
          .on("keydown paste", ".form-control", function (c) {
            b(c) && a(this).closest(".form-group").removeClass("is-empty");
          })
          .on("keyup change", ".form-control", function () {
            var b = a(this),
              c = b.closest(".form-group"),
              e =
                "undefined" == typeof b[0].checkValidity ||
                b[0].checkValidity();
            "" === b.val() ? c.addClass("is-empty") : c.removeClass("is-empty"),
              d && (e ? c.removeClass("has-error") : c.addClass("has-error"));
          })
          .on("focus", ".form-control, .form-group.is-fileinput", function () {
            c(this);
          })
          .on("blur", ".form-control, .form-group.is-fileinput", function () {
            f(this);
          })
          .on("change", ".form-group input", function () {
            var b = a(this);

            if ("file" != b.attr("type")) {
              var c = b.closest(".form-group"),
                d = b.val();
              d ? c.removeClass("is-empty") : c.addClass("is-empty");
            }
          })
          .on(
            "change",
            ".form-group.is-fileinput input[type='file']",
            function () {
              var b = a(this),
                c = b.closest(".form-group"),
                d = "";
              a.each(this.files, function (a, b) {
                d += b.name + ", ";
              }),
                (d = d.substring(0, d.length - 2)),
                d ? c.removeClass("is-empty") : c.addClass("is-empty"),
                c.find("input.form-control[readonly]").val(d);
            }
          );
      },
      ripples: function (b) {
        a(b ? b : this.options.withRipples).ripples();
      },
      autofill: function () {
        var b = setInterval(function () {
          a("input[type!=checkbox]").each(function () {
            var b = a(this);
            b.val() && b.val() !== b.attr("value") && b.trigger("change");
          });
        }, 100);
        setTimeout(function () {
          clearInterval(b);
        }, 1e4);
      },
      attachAutofillEventHandlers: function () {
        var b;
        a(document)
          .on("focus", "input", function () {
            var c = a(this).parents("form").find("input").not("[type=file]");
            b = setInterval(function () {
              c.each(function () {
                var b = a(this);
                b.val() !== b.attr("value") && b.trigger("change");
              });
            }, 100);
          })
          .on("blur", ".form-group input", function () {
            clearInterval(b);
          });
      },
      init: function (b) {
        this.options = a.extend({}, this.options, b);
        var c = a(document);
        a.fn.ripples && this.options.ripples && this.ripples(),
          this.options.input && (this.input(), this.attachInputEventHandlers()),
          this.options.checkbox && this.checkbox(),
          this.options.togglebutton && this.togglebutton(),
          this.options.radio && this.radio(),
          this.options.autofill &&
            (this.autofill(), this.attachAutofillEventHandlers()),
          document.arrive &&
            this.options.arrive &&
            (a.fn.ripples &&
              this.options.ripples &&
              c.arrive(this.options.withRipples, function () {
                a.material.ripples(a(this));
              }),
            this.options.input &&
              c.arrive(this.options.inputElements, function () {
                a.material.input(a(this));
              }),
            this.options.checkbox &&
              c.arrive(this.options.checkboxElements, function () {
                a.material.checkbox(a(this));
              }),
            this.options.radio &&
              c.arrive(this.options.radioElements, function () {
                a.material.radio(a(this));
              }),
            this.options.togglebutton &&
              c.arrive(this.options.togglebuttonElements, function () {
                a.material.togglebutton(a(this));
              }));
      }
    });
})(jQuery);
