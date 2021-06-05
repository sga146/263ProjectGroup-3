/**
 * Page movement functions
 */
function logout() {
    window.location.assign("index.html")
}

function homepage() {
    window.location.assign("index.html")
}

/**
 *  Functions for Hiding and Showing Elements
 */

function hideElement(elementId) {
    document.getElementById(elementId).style.display = "none";
}

function showElement(elementId) {
    document.getElementById(elementId).style.display = "";
}

/**
 *  View Events data , Ajax requests data from database
 */

var event_list = [];
var events = [];
var event_hint_name = [];


$.get("PHP_Functions/view_events.php", function(data) {
    //console.log(data);
    events = data;
    for (let key in data) {
        $each = [];
        // console.log(data[key][0]); The first of each event
        event_list.push(data[key][0]);
        $each["name"] = data[key][0].event_name;
        $each["id"] = data[key][0].event_id;
        event_hint_name.push($each);
    }


}, "JSON").then(function(){
    clearEvents();
    printEvents();
    //console.log(event_hint_name);
});

/**
 *  Display Functions, including event listener for changing table length
 *  by increasing iterations of event array.
 */
var len = 30;

$(document).on("submit", '#display_list', null, function(event){
    event.preventDefault();
    len = $("#display_length").val();
    clearEvents();
    printEvents();
});

$(document).on("submit", '#reset', null, function(event){
    event.preventDefault();
    $("#display_length").val("");
    len = 30;
    clearEvents();
    printEvents();
});

function clearEvents() {
    $("#eventTable tbody tr").remove();
    $("#detailTable tbody tr").remove();
    hideElement("detail_Table")
    $("#display_length").val("");
};

function printEvents() {
    for(var i=0; i<len; i++){
        var id = event_list[i].event_id;
        var event_name = event_list[i].event_name;
        var cluster = event_list[i].clustername;
        var date = event_list[i].date;
        var time = event_list[i].time;
        var machine = event_list[i].machinegroup;
        var activate = event_list[i].activate;

        var tr_str = "<tr>" +
            "<td align='center' scope='row'>" + id + "</td>" +
            "<td align='center'>" + event_name + "</td>" +
            "<td align='center'>" + date + "</td>" +
            "<td align='center'>" + time + "</td>" +
            "<td align='center'><button value='"+ id +"' class='bi bi-info-square'></button></td>" +
            "</tr>";

        $("#eventTable tbody").append(tr_str);


    }
}

/**
 * Function for listening to buttons on table, then searches array for data.
 */

$(document).on("click", 'button', null, function(event){
    event.preventDefault();
    let value = $(this).val();
    clearSearch();
    eventShow(value);
})

function eventShow(val) {
    clearEvents()
    var event_array = events[val];
    //console.log(event_array);

    var id = event_array[0].event_id;
    var event_name = event_array[0].event_name;
    var date = event_array[0].date;
    var time = event_array[0].time;

    //Event Printer
    var tr_str = "<tr>" +
        "<td align='center' scope='row'>" + id + "</td>" +
        "<td align='center'>" + event_name + "</td>" +
        "<td align='center'>" + date + "</td>" +
        "<td align='center'>" + time + "</td>" +
        "<td align='center'><button value='" + id + "' class='bi bi-info-square'></button></td>" +
        "</tr>";

    $("#eventTable tbody").append(tr_str);
    showElement("detail_Table");


    for(var i=0; i<len; i++) {
        var id = event_array[i].event_id;
        var event_name = event_array[i].event_name;
        var cluster = event_array[i].cluster_name;
        var date = event_array[i].date;
        var time = event_array[i].time;
        var machine = event_array[i].machine_group;
        var activate = event_array[i].activate;

        var tr_str = "<tr>" +
            "<td align='center' scope='row'>" + id + "</td>" +
            "<td align='center'>" + event_name + "</td>" +
            "<td align='center'>" + cluster + "</td>" +
            "<td align='center'>" + machine + "</td>" +
            "<td align='center'>" + date + "</td>" +
            "<td align='center'>" + time + "</td>" +
            "<td align='center'>" + activate + "</td>" +
            "</tr>";

        $("#detailTable tbody").append(tr_str);
    }
}


/**
 * console.log(event_list);
 var len = 10;
 for(var i=0; i<len; i++){
        var id = event_list[i].event_id;
        var event_name = event_list[i].event_name;
        var cluster = event_list[i].clustername;
        var date = event_list[i].date;
        var time = event_list[i].time;
        var machine = event_list[i].machinegroup;
        var activate = event_list[i].activate;

        var tr_str = "<tr>" +
            "<td align='center' scope='row'>" + id + "</td>" +
            "<td align='center'>" + event_name + "</td>" +
            "<td align='center'>" + date + "</td>" +
            "<td align='center'>" + time + "</td>" +
            "<td align='center'><button class='bi bi-info-square'></button></td>" +
            "</tr>";

        $("#eventTable tbody").append(tr_str);


    }
 *
 */

/**
 *  AutoComplete Searchbar and Clearing (table and input)
 */

$(document).ready(function ()
{
    $("#eventSearch").on("keyup", function()
    {
        eventSearch($("#eventSearch").val());
    });
});

function eventSearch(search)
{
    search= search.toLowerCase();
    var eventArray=event_hint_name.map(function(event){
        if(!search ||  event.name.toLowerCase().indexOf(search)!==-1){
            return "<tr>" + "<td scope='row'>" + event.name + "</td>" +
                "<td align='center'><button value='" + event.id + "' class='bi bi-info-square'></button></td>" +"</tr>"
        }
    });
    $('#searchTable tbody').html(eventArray);
}

function clearSearch() {
    $("#searchTable tbody tr").remove();
    hideElement("detail_Table")
    $("#eventSearch").val("");
}

/**  Old autocomplete --- From lectures and w3school example
 function showHint(str) {
    console.log("Checkpoint 1");
    console.log(event_hint_id);
    console.log("Checkpoint 2")
    console.log(event_hint_name);
    if (str.length === 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
        ;
        xmlhttp.open("GET", "PHP/PHP_Functions/auto_complete.php?q=" + str, true);
        // xmlhttp.open("GET", "gethint-db.php?q=" + str, true);
        xmlhttp.send();
    }
}
 */


