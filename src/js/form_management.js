export default function formManagement() {
  const $form = document.querySelector(".form")
  const $message = document.getElementById("message")

  $form.addEventListener("submit", async (e) => {
    e.preventDefault()
    /* 
     * El formData debe de estar adentro del evento "submit",
     * de lo contrario los datos del formulario no se capturan.
     */
    const formData = new FormData($form)

    await fetch("../php/Guardar_cliente.php", {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Error al mandar los datos: " + response.status)
        }

        return response.text()
      })
      .then(data => {
        $message.innerText = data
      })
      .catch(error => {
        console.error("Error: " + error.message)
      })
  })
}