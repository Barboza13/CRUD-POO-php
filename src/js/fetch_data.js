const $tbody = document.querySelector('tbody')

const fetchData = async () => {
  try {
    const response = await fetch('../php/api.php', {
      method: 'GET',
    })

    if (!response.ok) {
      const errorData = await response.json()
      throw new Error(errorData.message)
    }

    const json = await response.json()
    fillTable(json.data)
  } catch (error) {
    console.error(`Error: ${error}`)
  }
}

const fillTable = (data) => {
  let counter = 1

  data.forEach((element) => {
    const $tr = document.createElement('tr')
    const $counter = document.createElement('td')
    const $name = document.createElement('td')
    const $CI = document.createElement('td')
    const $email = document.createElement('td')
    $tr.style.color = '#000'
    $counter.classList.add('table-td')
    $name.classList.add('table-td')
    $CI.classList.add('table-td')
    $email.classList.add('table-td')

    $counter.textContent = counter++
    $name.textContent = element.full_name
    $CI.textContent = element.CI
    $email.textContent = element.email

    $tr.appendChild($counter)
    $tr.appendChild($name)
    $tr.appendChild($CI)
    $tr.appendChild($email)
    $tbody.appendChild($tr)
  })
}

export default fetchData
