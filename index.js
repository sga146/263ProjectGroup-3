// This is where your client side code will go for the index.html page

function login() {
    hideElement("loginDiv")
    showElement("mainDiv")

}

function logout() {
    hideElement("mainDiv")
    showElement("loginDiv")
}

function newEvent() {
    window.location.assign("../newEvents/new_event.html")
}

function viewEvents() {
    window.location.assign("view_event.html");
}

function hideElement(elementId) {
    document.getElementById(elementId).style.display = "none";
}

function showElement(elementId) {
    document.getElementById(elementId).style.display = "block";
}