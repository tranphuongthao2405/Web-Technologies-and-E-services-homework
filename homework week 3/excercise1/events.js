function reset() {
  console.log("ref");
  let input = document.getElementById("input");
  let result = document.getElementById("result");
  input.value = "";
  result.value = "";
}

function setPI() {
  let input = document.getElementById("input");
  input.value = input.value + "π";
}
