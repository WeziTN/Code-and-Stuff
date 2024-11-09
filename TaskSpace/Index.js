const input = document.getElementById("input");
const lists = document.getElementById("lists");

function taskadd(){
    if(input.value === ''){
       alert("Invalid, please enter something...");
    }
    else{
        let li = document.createElement("li");
        li.innerHTML=input.value;
        lists.appendChild(li);
        let span = document.createElement("span");
        span.innerHTML="\u00d7";
        li.appendChild(span);
    }
    input.value = "";
}
lists.addEventListener("click", function(event) {
    console.log(event.target.tagName); // Debugging line
    if (event.target.tagName === "LI") {
        event.target.classList.toggle("check");

    } 
    else if (event.target.tagName === "SPAN") {
        event.target.parentElement.remove();
    }
});

document.getElementById('input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        taskadd();
    }
});