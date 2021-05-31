function logout() {
    window.location.assign("index.html")
}

// View Events data table Builder, Ajax requests data from database

$.get("view_events.php", function(data) {
    var len = data.length;
    for(var i=0; i<len; i++){
        var id = data[i].id;
        var event_name = data[i].eventname;
        var cluster = data[i].clustername;
        var date = data[i].date;
        var time = data[i].time;
        var machine = data[i].machinegroup;
        var activate = data[i].activate;

        var tr_str = "<tr>" +
            "<td align='center' scope='row'>" + id + "</td>" +
            "<td align='center'>" + event_name + "</td>" +
            "<td align='center'>" + date + "</td>" +
            "<td align='center'>" + time + "</td>" +
            "<td align='center'><button class='bi bi-info-square'></button></td>" +
            "</tr>";

        $("#eventTable tbody").append(tr_str);
    }
}, "JSON");


// Search Bar Autocomplete

function showHint(str) {
    console.log("Checkpoint 1");
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
        xmlhttp.open("GET", "PHP_Functions/auto_complete.php?q=" + str, true);
        // xmlhttp.open("GET", "gethint-db.php?q=" + str, true);
        xmlhttp.send();
    }
}



