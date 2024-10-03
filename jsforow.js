

const currentDate = document. querySelector(".current-date"),
daysTag = document.querySelector(".days");


let date = new Date(),
currYear = date.getFullYear(),
currMonth= date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "Septemeber", "October", "November", "December", ]; 

const renderCalender = () => { 
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),//getDate returns the day of the month (1to31) of a date, +1 makes sure that it moves on to the next month
    lastDateofMonth = new Date(currYear, currMonth +1,  0).getDate(),
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    console.log(lastDateofMonth);
    let liTag= ""; 

    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        
    }

    for (let i=1; i <= lastDateofMonth; i++) {
        liTag += `<li>${i}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag; 
}
renderCalender();

prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        console.log(icon);
        currMonth = icon.id === "prev" ? currMonth -1: currMonth +1;
        renderCalender();
    });
});