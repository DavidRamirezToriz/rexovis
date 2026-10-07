(() => {
  const modal = document.getElementById("briefing-modal");
  const form = document.getElementById("briefing-form");
  const status = document.getElementById("briefing-form-status");
  const submitButton = form?.querySelector('button[type="submit"]');

  if (!(modal instanceof HTMLDialogElement) || !(form instanceof HTMLFormElement) || !status || !submitButton) {
    console.error("No se pudo inicializar el formulario de contacto.");
    return;
  }

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
        response = await fetch("includes/sendBriefing.php", {
          method: "POST",
          body: new FormData(form),
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
