const currentDate = document. querySelector(".current-date");
daysTag = document.querySelector(".days"),
prevNextIcon = document.querySelectorAll(".icons span");
//The pages has this variable, days, icons, and the current date: the one that is need to set the whole days starting from this variable. 
let date = new Date(),
currYear = date.getFullYear(),
currMonth= date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "Septemeber", "October", "November", "December"]; 
//Lists the variable name months with the 12 months. 
const renderCalender = () => { 
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
    lastDateofMonth = new Date(currYear, currMonth +1,  0).getDate(),
    lastDayofMonth = new Date(currYear, currMonth +1,  lastDateofMonth).getDay(),
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag= ""; 
// This sets the 4 variables, the days/date of month to the year 
    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
       //For sets the restriction of the first day of the month.  
    }


    for (let i= 1; i <= lastDateofMonth; i++) {
        let isToday = i === date.getDate() && currMonth === new Date().getMonth()
        //Adding active class to li if the current day, month and year matched. 
                      && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}">${i}</li>`;
    }
    for (let i= lastDayofMonth; i < 6; i++) {
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
    }
    //This sets the week days. 

    

    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
}
renderCalender();

prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        currMonth = icon.id === "prev" ? currMonth -1: currMonth +1;

        //This loop sets the new yaer: To be teh smae with this year, loop the Months. 
        if(currMonth < 0 || currMonth > 11){
            date = new Date(currYear, currMonth);
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalender();
    });
});