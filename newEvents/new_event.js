//Basic Page Functions

/**
 Functions
 - Logout
 - Home
 - View Events
 - Back Button - Instead of Home and View Events
 */

function index() {
    window.location.assign("index.html")
}

function logout() {
    window.location.assign("index.html")
}

/**
 * Runs Onload functions required for the form.
 * This includes the jqueryUI functions for the date picker.
 */

$(document).ready( function(){
    getGroup();
    getClusters();
    $("#datepicker").datepicker();
});

/**
 *  AJAX Queries to fill dropdown on form.
 */

function getGroup() {
    $.get("machine_list.php" , function (data) {
        var len = data.length;
        for(var i=0; i<len; i++){
            var id = data[i].id;
            var group = data[i].group;

            var opt_str = "<option value='" + id + "'>" + group + "</option>";

            $("#group").append(opt_str);
        }
    }, "JSON")
}

function getClusters() {
    $.get("cluster_list.php" , function (data) {
        var len = data.length;
        for(var i=0; i<len; i++){
            var id = data[i].id;
            var cluster = data[i].cluster_name;

            var opt_str = "<option value='" + id + "'>" + cluster + "</option>";

            $("#cluster").append(opt_str);
        }
    }, "JSON")
}
