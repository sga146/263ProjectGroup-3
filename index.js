// This is where your client side code will go for the index.html page

function login() {
    hideElement("loginDiv")
    showElement("mainDiv")
}

function logout() {
    hideElement("mainDiv")
    showElement("loginDiv")
}

function viewEvents() {
    window.location.assign("view_events.html");
}

function hideElement(elementId) {
    document.getElementById(elementId).style.display = "none";
}

function showElement(elementId) {
    document.getElementById(elementId).style.display = "block";
}