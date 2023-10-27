const submit = document.querySelector("#submit")
const login = document.querySelector("input[name=login]")
const pass = document.querySelector("input[name=pass]")
const rPass = document.querySelector("input[name=rPass]")
const phone = document.querySelector("input[name=phone]")
const control = document.querySelector(".pass-control")

const letters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
const numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
const special = ["!", "@", "#", "$", "%"]

submit.addEventListener("click", e => {
  // if(pass.value === rPass.value){
  //   alert("git")
  // }else{
  //   e.preventDefault()
  //   alert("Hasła są niepoprawne")
  // }
  e.preventDefault()
  const password = pass.value.split(" ")
  if(pass.value.length < 6){
    alert("Hasło za krótkie")
  }
});

pass.addEventListener("input", e => {
  if(e.target.value.length < 6){
    control.className = "length"
  }else{
    let specialCount = 0
    let numbersCount = 0
    let capital = 0
    for(let i = 0; i < e.target.value.length; i++){
      if(special.includes(i)) specialCount++
      if(numbers.includes(i)) numbersCount++
    }
    if(specialCount >= 1 && numbersCount >= 1){
      alert("git")
    }else{
      alert("min. 1 liczba i 1 special")
    }
  }
})