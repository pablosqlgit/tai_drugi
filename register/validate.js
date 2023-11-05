const submit = document.querySelector("#submit")
const login = document.querySelector("input[name=login]")
const pass = document.querySelector("input[name=pass]")
const rPass = document.querySelector("input[name=rPass]")
const phone = document.querySelector("input[name=phone]")
const control = document.querySelector(".pass-control")
const codeSelect = document.querySelector(".code-select")
const codesList = document.querySelector(".codes-list")
const selectedCode = document.querySelector(".selected-code")
const rPassControl = document.querySelector(".rPass-control")
const loginControl = document.querySelector(".login-control")
const passControl = document.querySelector(".pass-control")
const phoneControl = document.querySelector(".phone-control")
const codeSearch = document.querySelector(".code-search")

const letters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
const capital = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
const numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
const special = ["!", "#", "$", "&", "@"]
const notAllowed = ["%", "^", "*", "(", ")", "<", ">", "?", "/", ",", ".", "[", "]", "{", "}", "'", '"', "`", "~", "|"]

let codes = []

let select = "+48"
let ok = 0
selectedCode.innerText = select

const notSame = (item) => {
  if(item.target.name === 'pass'){
    if(item.target.value !== rPass.value) rPassControl.className = "different" 
    else rPassControl.className = "rPass-control"
  }
  if(item.target.name === 'rPass'){
    if(item.target.value !== pass.value) rPassControl.className = "different" 
    else rPassControl.className = "rPass-control"
  }
}

fetch("./codes2.json")
.then(res => res.json())
.then(res => {
  for(let [key, value] of Object.entries(res)){
    const dialCode = value.phone[0].replace('-', '')
    codesList.innerHTML += `<div class='dial-code-container'><img src=${value.image} class='flag-icon'><p class="code">${dialCode}</p></div>`
  }
})
.catch(err => alert("codes error" + err))

document.body.addEventListener("click", (e) => {
  if(e.target.className === 'dial-code-search'){
    codesList.style.display = 'block'
  }
  if(e.target.className === "code-select" || e.target.className === "selected-code"){
    codesList.style.display === "none" || codesList.style.display === ""
    ? codesList.style.display = "block"
    : codesList.style.display = "none"
  }
  if(e.target.className === ''){
    if(codesList.style.display === "block"){
      codesList.style.display = 'none'
    }
  }
})

codesList.addEventListener("click", (e) => {
  if(e.target.className === 'code'){
    select = e.target.innerText
    selectedCode.innerText = select
    codesList.style.display = "none"
  }
})

pass.addEventListener("input", e => {
  notSame(e)
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
      control.className = "pass-control"
    }else if(e.target.value.length > 6){
      control.className = "symbols"
    }
    if(notAllowedChar > 0){
      control.className = "not-allowed"
    }
  }
})

rPass.addEventListener("input", e => {
  notSame(e)
})

login.addEventListener("input", e => {
  for(let i in e.target.value){
    if(notAllowed.includes(e.target.value[i])){
      loginControl.className = 'not-allowed'
      break
    }else{
      loginControl.className = 'login-control'
    }
  }
  if(e.target.value.length < 6){
    loginControl.className = 'login-length'
  }
})

submit.addEventListener("click", e => {
  if(
    rPassControl.className !== 'rPass-control'
    && loginControl.className !== 'login-control'
    && passControl.className !== 'pass-control'
    && phoneControl.className !== 'phone-control'
  ){
    e.preventDefault()
  }
});