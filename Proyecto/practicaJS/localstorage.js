const userNameText = document.querySelector(".userName")
const userAgeText = document.querySelector(".userAge")

const saveNameButton = document.querySelector(".saveNameBtn")
const saveAgeButton = document.querySelector(".saveAgeBtn")

saveNameButton.addEventListener("click", () => {
  const userName = document.querySelector(".name").value
  userNameText.textContent = userName
  localStorage.setItem("name", userName)
})

saveAgeButton.addEventListener("click", () => {
    const userAge = document.querySelector(".age").value
    userAgeText.textContent = userAge
    localStorage.setItem("age", userAge)
})

function displayUserName () {
  const nameFromLocalStorage = localStorage.getItem("name")

  if (nameFromLocalStorage) {
    userNameText.textContent = nameFromLocalStorage
  } else {
    userNameText.textContent = "No name data in local storage"
  }
}

function displayUserAge () {
  const ageFromLocalStorage = localStorage.getItem("age")

  if (ageFromLocalStorage) {
    userAgeText.textContent = ageFromLocalStorage
  } else {
    userAgeText.textContent = "No age data in local storage"
  }
}

displayUserName()
displayUserAge()    