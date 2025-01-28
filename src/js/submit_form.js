const $form = document.querySelector('.form')
const $message = document.getElementById('message')

const submitForm = () => {
  $form.addEventListener('submit', async (e) => {
    e.preventDefault()
    const formData = new FormData($form)

    try {
      const response = await fetch('../php/api.php', {
        method: 'POST',
        body: formData,
      })

      if (!response.ok) {
        const errorData = await response.json()
        throw new Error(errorData.error)
      }

      const json = await response.json()
      showMessage(json.message)
    } catch (error) {
      console.error(`Error: ${error}`)
    }

    $form.reset()
  })
}

const showMessage = (message) => {
  $message.innerText = message

  setTimeout(() => {
    $message.innerText = ''
  }, 3000)
}

export default submitForm
