// Enquiry forms (Request a Quote modal + Contact page).
// The original forms had no handler; submissions now go to admin-ajax (see inc/forms.php).
(function ($) {
  "use strict";

  if (typeof arbeeForms === "undefined") return;

  const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const PHONE_RE = /^[0-9+()\-\s]{5,20}$/;

  function fieldError(field, message) {
    const $field = $(field);
    const $group = $field.closest(".form-group, .contrbook, .covercontact, .covercontact2, .covertextarea");
    const $help = $group.find(".help-block").first();
    $field.attr("aria-invalid", message ? "true" : "false");
    if ($help.length) {
      $help.text(message || $help.data("default") || "").toggleClass("d-none", !message);
    }
  }

  function validate(form) {
    let firstInvalid = null;
    $(form).find("[data-validate]").each(function () {
      const rules = String($(this).data("validate")).split(" ");
      const value = String($(this).val() || "").trim();
      let message = "";
      if (rules.includes("required") && !value) {
        message = $(this).data("msgRequired") || "This field is required.";
      } else if (value && rules.includes("email") && !EMAIL_RE.test(value)) {
        message = "Please enter a valid email address.";
      } else if (value && rules.includes("phone") && !PHONE_RE.test(value)) {
        message = "Please enter a valid phone number.";
      }
      fieldError(this, message);
      if (message && !firstInvalid) firstInvalid = this;
    });
    return firstInvalid;
  }

  function showStatus(form, type, message) {
    let $status = $(form).find(".arbee-form-status");
    if (!$status.length) {
      $status = $('<div class="arbee-form-status action-alert" role="status" aria-live="polite"></div>');
      $(form).append($status);
    }
    $status.removeClass("success danger d-none").addClass(type).text(message);
  }

  function dialCode(form) {
    const $code = $(form).find(".mobile_code");
    if ($code.length && $.fn.intlTelInput) {
      try {
        const data = $code.intlTelInput("getSelectedCountryData");
        if (data && data.dialCode) return "+" + data.dialCode;
      } catch (e) { /* plugin not initialised */ }
    }
    return String($(form).find('[name="country_code"]').val() || "");
  }

  $(document).on("submit", "form.arbee-enquiry-form", function (e) {
    e.preventDefault();
    const form = this;
    const $btn = $(form).find('[type="submit"]');

    const invalid = validate(form);
    if (invalid) {
      showStatus(form, "danger", $(form).data("msgInvalid") || "Please correct the highlighted fields.");
      invalid.focus();
      return;
    }

    const data = new FormData(form);
    data.set("action", "arbee_enquiry");
    data.set("nonce", arbeeForms.nonce);
    data.set("country_code", dialCode(form));
    data.set("page_url", window.location.href);

    const label = $btn.text();
    $btn.prop("disabled", true).text(arbeeForms.sending);

    fetch(arbeeForms.ajaxUrl, { method: "POST", body: data, credentials: "same-origin" })
      .then((r) => r.json())
      .then((res) => {
        if (res && res.success) {
          showStatus(form, "success", res.data.message);
          form.reset();
          $(form).find(".select2").trigger("change");
        } else {
          const errors = (res && res.data && res.data.errors) || {};
          Object.keys(errors).forEach((name) => {
            const el = form.querySelector('[name="' + name + '"]');
            if (el) fieldError(el, errors[name]);
          });
          showStatus(form, "danger", (res && res.data && res.data.message) || arbeeForms.error);
        }
      })
      .catch(() => showStatus(form, "danger", arbeeForms.error))
      .finally(() => $btn.prop("disabled", false).text(label));
  });

  // Clear a field's error as soon as it is edited.
  $(document).on("input change", "form.arbee-enquiry-form [data-validate]", function () {
    if ($(this).attr("aria-invalid") === "true") fieldError(this, "");
  });
})(jQuery);
