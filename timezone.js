$(document).ready(function()
{
    //returns time ahead or behind of GMT
    var offset = new Date().getTimezoneOffset();

    //returns time from 1970 jan
    var timestamp = new Date().getTime();

    //convert our time to universal coordinated time 
    var utc_timestamp = timestamp + (60000 * offset);

    $('#time_zone_offset').val(offset);
    $('#utc_timestamp').val(utc_timestamp);

    console.log($('#time_zone_offset').val());
});

