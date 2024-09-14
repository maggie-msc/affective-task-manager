const mainCalendarContainer = document.querySelector("#calendar-main-container");
const dayNamesBlock = document.querySelector("#day-names");
const monthList = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const weekDayList = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

let newDate = new Date();
let currentMonth = newDate.getMonth();
let getDay = newDate.getDay();

let monthName = document.querySelector("#month-name");
const leftArrow = document.querySelector("#left-arrow");
const rightArrow = document.querySelector("#right-arrow");

monthName.innerHTML = monthList[currentMonth];

let currentDateText = document.getElementById("current-date");
if (newDate.getDate() === 1) {
    currentDateText.innerText = weekDayList[getDay]+" "+newDate.getDate()+"st";
} else if (newDate.getDate() === 2) {
    currentDateText.innerText = weekDayList[getDay]+" "+newDate.getDate()+"nd";
} else if (newDate.getDate() === 3) {
    currentDateText.innerText = weekDayList[getDay]+" "+newDate.getDate()+"rd";
} else {
    currentDateText.innerText = weekDayList[getDay]+" "+newDate.getDate()+"th";
}

leftArrow.addEventListener("click", function() {
    let monthValue = monthName.innerHTML;
    for (let i = 0; i < monthList.length; i++) {
        if (monthValue === "January") {
            monthName.innerHTML = monthList[monthList.length-1];
            break;
        } else if (monthList[i] == monthValue) {
            monthName.innerHTML = monthList[i-1];
            break;
        }
    }
})

rightArrow.addEventListener("click", function() {
    let monthValue = monthName.innerHTML;
    for (let i = 0; i < monthList.length; i++) {
        if (monthValue === "December") {
            monthName.innerHTML = monthList[0];
            break;
        } else if (monthList[i] == monthValue) {
            monthName.innerHTML = monthList[i+1];
            break;
        }
    }
})

let dayList = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
for (let i = 0; i < dayList.length; i++) {
    dayNamesBlock.insertAdjacentHTML("beforeend", 
    `<div class="single-day-name" id="single-day-name-${i}">${dayList[i]}</div>`)
}


for (let i = 1; i <= 35; i++) {
    // console.log(i);
    if (i > 31) {
        mainCalendarContainer.insertAdjacentHTML("beforeend", 
        `<div class="day-block-dark" id="day-block-${i}">
        </div>`);
    } else {
        mainCalendarContainer.insertAdjacentHTML("beforeend", 
        `<div class="day-block" id="day-block-${i}">
            <p class="day-count" id="day-count-${i}">${i}</p>
        </div>`);

    }
}