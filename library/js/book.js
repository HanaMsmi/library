let price = document.querySelector("#price")
let day = document.querySelector("#day")
let dayRange = document.querySelector("#dayRange")
let cost = document.querySelector("#cost")

day.textContent = dayRange.value;
cost.textContent = Number(day.textContent) * Number(price.textContent);
document.getElementById("form_day").value = Number(day.textContent) * Number(price.textContent);

dayRange.addEventListener("change", function(e) {
    day.textContent = e.target.value;
    cost.textContent = Number(day.textContent) * Number(price.textContent);
    document.getElementById("form_day").value = Number(day.textContent) * Number(price.textContent);
})
