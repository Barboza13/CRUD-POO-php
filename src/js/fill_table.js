export default function fillTable() {
  const $tbody = document.querySelector("tbody")

  fetch("../php/Guardar_cliente.php")
    .then(response => {
      if (!response.ok) {
        throw new Error("Error en la solicitud: " + response.status)
      }
      return response.json();
    })
    .then(data => {
      let counter = 1
      data.forEach((element) => {
        const $tr = document.createElement("tr")
        const $counter = document.createElement("td")
        const $name = document.createElement("td")
        const $CI = document.createElement("td")
        const $email = document.createElement("td")
        $tr.style.color = "#000"

        $counter.textContent = counter++
        $name.textContent = element.full_name
        $CI.textContent = element.CI
        $email.textContent = element.email

        $tr.appendChild($counter)
        $tr.appendChild($name)
        $tr.appendChild($CI)
        $tr.appendChild($email)
        $tbody.appendChild($tr)
      });
    })
    .catch(error => {
      console.error("Error: " + error.message)
    });
}