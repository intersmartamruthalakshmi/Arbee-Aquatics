// Enquiry forms (Request a Quote modal + Contact page).
// The original forms had no handler; submissions now go to admin-ajax (see inc/forms.php).
(function ($) {
  "use strict";

  if (typeof arbeeForms === "undefined") return;

  const EMAIL_RE = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z][a-zA-Z0-9-]{0,61}[a-zA-Z]\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/;
  const NAME_RE = /^[a-zA-Z\s]+$/;
  const TEXTAREA_RE = /^[a-zA-Z0-9\s.,!?'"()-]+$/;
  const SCRIPT_TAG_RE = /<[a-z][\s\S]*>/i;
  // The phone number itself is digits only — the separate country-code
  // picker (.mobile_code / intlTelInput) already supplies the "+" dial code.
  const PHONE_DIGITS_RE = /^[0-9]+$/;

  function fieldError(field, message) {
    const $field = $(field);
    const $group = $field.closest(".form-group, .contrbook, .covercontact, .covercontact1, .covercontact2, .covertextarea");
    const $help = $group.find(".help-block").first();
    $field.attr("aria-invalid", message ? "true" : "false");
    if ($help.length) {
      $help.text(message || $help.data("default") || "").toggleClass("d-none", !message);
    }
  }

  // Validates a single field and immediately shows/clears its message —
  // used both while the visitor is still filling the form (on blur) and
  // as the final check right before submit.
  function validateField(el) {
    const $el = $(el);
    const rules = String($el.data("validate") || "").split(" ");
    const value = String($el.val() || "").trim();
    let message = "";

    if (rules.includes("required") && !value) {
      message = $el.data("msgRequired") || "This field is required.";
    } else if (value && rules.includes("name")) {
      if (value.length < 3) {
        message = "Minimum 3 characters required.";
      } else if (SCRIPT_TAG_RE.test(value)) {
        message = "Invalid input. Script tags are not allowed.";
      } else if (!NAME_RE.test(value)) {
        message = "Only alphabets and spaces are allowed.";
      }
    } else if (value && rules.includes("email")) {
      if (value.length > 50) {
        message = "Maximum 50 characters allowed.";
      } else if (!EMAIL_RE.test(value)) {
        message = "Please enter a valid email address.";
      }
    } else if (value && rules.includes("phone")) {
      const digits = value.replace(/\s+/g, "");
      if (digits.length < 7) {
        message = "Phone number must be at least 7 digits.";
      } else if (digits.length > 15) {
        message = "Phone number cannot exceed 15 digits.";
      } else if (!PHONE_DIGITS_RE.test(digits)) {
        message = "Only numbers are allowed.";
      }
    } else if (value && rules.includes("textarea")) {
      if (value.length < 3) {
        message = "Minimum 3 characters required.";
      } else if (value.length > 500) {
        message = "Maximum 500 characters allowed.";
      } else if (SCRIPT_TAG_RE.test(value)) {
        message = "Invalid input. Script tags are not allowed.";
      } else if (!TEXTAREA_RE.test(value)) {
        message = "Only letters, numbers, spaces, and common punctuation are allowed.";
      }
    }

    fieldError(el, message);
    return message;
  }

  function validate(form) {
    let firstInvalid = null;
    $(form).find("[data-validate]").each(function () {
      const message = validateField(this);
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
    // Request a Quote modal: separate flag/dial-code field.
    // Contact page: the flag/dial-code is attached directly to the phone input itself.
    const $code = $(form).find(".mobile_code, .contact-phone-intl");
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

  // Clear a field's error as soon as it is edited; the full check runs again on blur.
  $(document).on("input change", "form.arbee-enquiry-form [data-validate]", function () {
    if ($(this).attr("aria-invalid") === "true") fieldError(this, "");
  });

  // Live validation: as soon as the visitor leaves a field (clicks/tabs anywhere
  // else), check just that field and show its message underneath immediately —
  // no need to wait for the whole form to be submitted.
  $(document).on("blur", "form.arbee-enquiry-form [data-validate]", function () {
    const rules = String($(this).data("validate") || "").split(" ");
    if (rules.includes("name")) {
      // Trim ends and collapse repeated inner spaces ("John   Doe" -> "John Doe").
      $(this).val($.trim($(this).val()).replace(/\s+/g, " "));
    } else if (rules.includes("textarea")) {
      // Same collapsing, but keep intentional line breaks in a multi-line message.
      $(this).val($.trim($(this).val()).replace(/[ \t]+/g, " "));
    }
    validateField(this);
  });
})(jQuery);
