<?php 

$myday = new DateTime();
$myoffday = date_offset_get($myday);

echo strtotime($myday);
echo $myoffday;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <script type="text/javascript">
     //returns time ahead or behind of GMT
     var offset = new Date().getTimeZoneOffset();

//returns time from 1970 jan
var timestamp = new Date().getTime();

//convert our time to universal coordinated time 
var utc_timestamp = timestamp + (60000 * offset);


document.write(offset);
document.write(timestamp);
document.write(utc_timestamp);
var dt = new Date();
         var tz = dt.getTimezoneOffset(); 
         document.write("getTimezoneOffset() : " + tz ); 
    </script>
    
</body>
</html>