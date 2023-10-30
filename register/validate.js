const submit = document.querySelector("#submit")
const login = document.querySelector("input[name=login]")
const pass = document.querySelector("input[name=pass]")
const rPass = document.querySelector("input[name=rPass]")
const phone = document.querySelector("input[name=phone]")
const control = document.querySelector(".pass-control")
const codeSelect = document.querySelector(".code-select")
const codesList = document.querySelector(".codes-list")
const selectedCode = document.querySelector(".selected-code")

const letters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
const capital = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
const numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
const special = ["!", "#", "$", "&"]
const notAllowed = ["@", "$", "%", "^", "*", "(", ")", "<", ">", "?", "/", ",", ".", "[", "]", "{", "}", "'", '"', "`", "~", "|"]

let codes = []

let select = "+48"
selectedCode.innerText = select

fetch("./codes.json")
.then(res => res.json())
.then(res => {
  codes = res.codes
  codes.forEach(code => {
    codesList.innerHTML += `<p class="code">${code.dial_code}</p>`
  })
})
.catch(err => alert("codes error"))

document.body.addEventListener("click", (e) => {
  if(e.target.className === "code-select" || e.target.className === "selected-code"){
    codesList.style.display === "none" || codesList.style.display === ""
    ? codesList.style.display = "block"
    : codesList.style.display = "none"
  }else if(codesList.style.display === "block" && e.target.className !== "code") codesList.style.display = "none"
})

codesList.addEventListener("click", (e) => {
  select = e.target.innerText
  selectedCode.innerText = select
  codesList.style.display = "none"
})

submit.addEventListener("click", e => {
  e.preventDefault()
});

pass.addEventListener("input", e => {
  console.log(e.target.value.length)
  if(e.target.value.length < 6){
    control.className = "length"
  }else{
    let specialCount = 0
    let numbersCount = 0
    let lettersCount = 0
    let capitalCount = 0
    let notAllowedChar = 0
    for(let i = 0; i < e.target.value.length; i++){
      if(special.includes(e.target.value[i])) specialCount++
      if(numbers.includes(e.target.value[i])) numbersCount++
      if(letters.includes(e.target.value[i])) lettersCount++
      if(capital.includes(e.target.value[i])) capitalCount++
      if(notAllowed.includes(e.target.value[i])) notAllowedChar++
    }
    if(specialCount === 0 || numbersCount === 0 || capitalCount === 0 || lettersCount < 3){
      control.className = "symbols"
    }else if(specialCount >= 1 && numbersCount >= 1){
      control.className = ""
    }else if(e.target.value.length > 6){
      control.className = "symbols"
    }
    console.log(notAllowedChar)
    if(notAllowedChar > 0){
      console.log("są")
      control.className = "not-allowed"
    }
  }
})