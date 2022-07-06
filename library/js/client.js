// pop up filters
let writer = document.querySelector("#writer");
let kind = document.querySelector("#kind");
let company = document.querySelector("#company");

let boolCompany = true;
let boolKind = true;
let boolWriter = true;

company.addEventListener("click", function(e) {
    if (boolCompany) {
        e.target.nextElementSibling.style.display = "block";
        e.target.style.color = "#fff"
        boolCompany = false;
    } else {
        e.target.nextElementSibling.style.display = "none";
        e.target.style.color = "rgba(223, 223, 223, 0.4)";
        boolCompany = true;
    }
})

kind.addEventListener("click", function(e) {
    if (boolKind) {
        e.target.nextElementSibling.style.display = "block";
        e.target.style.color = "#fff"
        boolKind = false;
    } else {
        e.target.nextElementSibling.style.display = "none";
        e.target.style.color = "rgba(223, 223, 223, 0.4)";
        boolKind = true;
    }
})

writer.addEventListener("click", function(e) {
    if (boolWriter) {
        e.target.nextElementSibling.style.display = "block";
        e.target.style.color = "#fff"
        boolWriter = false;
    } else {
        e.target.nextElementSibling.style.display = "none";
        e.target.style.color = "rgba(223, 223, 223, 0.4)";
        boolWriter = true;
    }
})

//do filters
let filters = [];
let checkboxes = document.querySelectorAll(".checkbox");

checkboxes.forEach(function(item, index) {
    item.addEventListener("click", function(e) {
        if (e.target.checked) {
            filters.push(e.target.name+"="+e.target.previousElementSibling.textContent.trim());
        } else {
            filters.forEach(function(item, index) {
                if (item === e.target.name+"="+e.target.previousElementSibling.textContent.trim()) {
                    filters.splice(index, 1);
                }
            })
        }
    })
})

// show filters
let filterNames = document.querySelectorAll("#filter-name")
let btn = document.querySelector(".filter__btn")
let alert = document.querySelector(".alert__holder")

btn.addEventListener("click", function(e) {
    filters.forEach(function(item, index) {
        let name;
        let divAlert = document.createElement("div");
        divAlert.className = "alert";
        let pAlert = document.createElement("p");
        pAlert.className = "alert__p"
        pAlert.textContent = item;
        name = item;
        let spanAlert = document.createElement("span")
        spanAlert.textContent = "×";
        spanAlert.className = "alert__times"
        spanAlert.addEventListener("click", function(e) {
            filterNames.forEach(function(item, index) {
                if (name === item.textContent) {
                    console.log(item.nextElementSibling)
                    item.nextElementSibling.checked = false
                }
            })
            divAlert.remove()
            filters.splice(index, 1);
        })
        pAlert.appendChild(spanAlert);
        divAlert.appendChild(pAlert);
        alert.appendChild(divAlert);
    })
})

let fav = document.querySelector("#fav")
fav.addEventListener("click", function(e) {
    console.log(e.target)
    if (e.target.style.backgroundColor === '') {
        e.target.style.backgroundColor = "#E45826"
    } else if (e.target.style.backgroundColor === 'rgb(228, 88, 38)') {
        e.target.style.backgroundColor = ""
    }
})