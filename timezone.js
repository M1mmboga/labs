$(document).ready(function()
{
    var offset = new Date().getTimeZoneOffset();
    var timestamp = new Date().getTime();

    //convert our time to universal coordinated time 
    var utc_timestamp = timestamp + (60000 * offset);

    $('#time_zone_offset').val(offset);
    $('#utc_timestamp').val(utc_timestamp);
});