(() => {
  const modal = document.getElementById("briefing-modal");
  const form = document.getElementById("briefing-form");
  const status = document.getElementById("briefing-form-status");
  const submitButton = form?.querySelector('button[type="submit"]');
  const phoneInput = document.getElementById("briefing-phone");
  const messageInput = document.getElementById("briefing-message");
  const messageLength = document.getElementById("briefing-message-length");

  if (!(modal instanceof HTMLDialogElement) || !(form instanceof HTMLFormElement) || !status || !submitButton || !(phoneInput instanceof HTMLInputElement) || !(messageInput instanceof HTMLTextAreaElement) || !messageLength) {
    console.error("No se pudo inicializar el formulario de contacto.");
    return;
  }

  const updateMessageCount = () => {
    messageLength.textContent = String(messageInput.value.length);
  };
  messageInput.addEventListener("input", updateMessageCount);
  form.addEventListener("reset", () => requestAnimationFrame(updateMessageCount));
  updateMessageCount();

  const getPhoneDigits = (value) => value.replace(/\D/g, "").slice(0, 10);
  const formatPhone = (digits) => {
    const parts = [digits.slice(0, 2), digits.slice(2, 6), digits.slice(6, 10)].filter(Boolean);
    return parts.join(" ");
  };
  const caretPositionForDigits = (value, digitCount) => {
    if (digitCount === 0) return 0;
    let seenDigits = 0;
    for (let index = 0; index < value.length; index += 1) {
      if (/\d/.test(value[index])) seenDigits += 1;
      if (seenDigits === digitCount) return index + 1;
    }
    return value.length;
  };
  const setPhoneValue = (digits, caretDigits) => {
    const formatted = formatPhone(digits);
    phoneInput.value = formatted;
    phoneInput.setCustomValidity(
      digits.length === 0 || digits.length === 10 ? "" : ""
    );
    const caretPosition = caretPositionForDigits(formatted, caretDigits);
    phoneInput.setSelectionRange(caretPosition, caretPosition);
  };

  phoneInput.addEventListener("input", () => {
    const digitsBeforeCaret = phoneInput.value.slice(0, phoneInput.selectionStart ?? 0).replace(/\D/g, "").length;
    const digits = getPhoneDigits(phoneInput.value);
    setPhoneValue(digits, Math.min(digitsBeforeCaret, digits.length));
  });

  phoneInput.addEventListener("paste", (event) => {
    event.preventDefault();
    const pastedText = event.clipboardData?.getData("text") ?? "";
    const currentDigits = phoneInput.value.replace(/\D/g, "");
    const selectionStart = phoneInput.selectionStart ?? phoneInput.value.length;
    const selectionEnd = phoneInput.selectionEnd ?? selectionStart;
    const startDigit = phoneInput.value.slice(0, selectionStart).replace(/\D/g, "").length;
    const endDigit = phoneInput.value.slice(0, selectionEnd).replace(/\D/g, "").length;
    const pastedDigits = pastedText.replace(/\D/g, "");
    const digits = `${currentDigits.slice(0, startDigit)}${pastedDigits}${currentDigits.slice(endDigit)}`.slice(0, 10);
    setPhoneValue(digits, Math.min(startDigit + pastedDigits.length, digits.length));
  });

  let lastTrigger = null;

  document.querySelectorAll("[data-open-briefing]").forEach((trigger) => {
    trigger.addEventListener("click", (event) => {
      event.preventDefault();
      lastTrigger = trigger;
      status.textContent = "";
      status.removeAttribute("data-state");
      modal.showModal();
      form.querySelector("input")?.focus();
    });
  });

  modal.querySelector("[data-close-briefing]")?.addEventListener("click", () => modal.close());
  modal.addEventListener("click", (event) => {
    if (event.target === modal) modal.close();
  });
  modal.addEventListener("close", () => lastTrigger?.focus());

  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    status.textContent = "";
    status.removeAttribute("data-state");
    submitButton.disabled = true;

    try {
      let response;
      try {
        const formData = new FormData(form);
        formData.set("phone", phoneInput.value.replace(/\D/g, ""));
        response = await fetch("includes/sendBriefing.php", {
          method: "POST",
          body: formData,
          headers: { Accept: "application/json" },
        });
      } catch {
        throw new Error("No se pudo conectar con el servidor. Revisa tu conexión e intenta de nuevo.");
      }

      let result;
      try {
        result = await response.json();
      } catch {
        throw new Error("El servidor devolvió una respuesta inesperada. Intenta de nuevo.");
      }

      if (!response.ok || !result || typeof result !== "object" || result.success !== true) {
        const message = result && typeof result.message === "string"
          ? result.message
          : "No fue posible enviar el formulario. Intenta de nuevo.";
        throw new Error(message);
      }

      form.reset();
      status.textContent = "Tu solicitud se envió correctamente.";
      status.dataset.state = "success";
    } catch (error) {
      status.textContent = error instanceof Error ? error.message : "No fue posible enviar el formulario. Intenta de nuevo.";
      status.dataset.state = "error";
    } finally {
      submitButton.disabled = false;
    }
  });
})();
