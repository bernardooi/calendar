<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<? 

include("namnsdag.php");
    
$date = $_GET["date"] ?? date("Y-m-d");
$fast=strtotime($date);
$year = date('Y', $fast);
$month = date('n',$fast);
$days=cal_days_in_month(CAL_GREGORIAN, $month, $year);

$numDay = date('d', $fast);
$numMonth = date('m', $fast);
$monthName= date("M", strtotime($days.'-'. $month.'-'.$year));
 $strMonth = date('F', $fast);
 $firstDay = mktime(0,0,0,$numMonth,1,$year);
$dayOfWeek = date('w', $firstDay);
?>
<table>
 <caption><? echo("<h2>".$strMonth." ".$year."</h2>"); ?></caption>
 <thead>
 <tr>
 <th abbr="Sunday" scope="col" title="Sunday">S</th>
 <th abbr="Monday" scope="col" title="Monday">M</th>
 <th abbr="Tuesday" scope="col" title="Tuesday">T</th>
 <th abbr="Wednesday" scope="col" title="Wednesday">W</th>
 <th abbr="Thursday" scope="col" title="Thursday">T</th>
 <th abbr="Friday" scope="col" title="Friday">F</th>
 <th abbr="Saturday" scope="col" title="Saturday">S</th>

 </tr>
 </thead>
 <tbody>
 <tr>

 
<?php

    if($dayOfWeek != 0) 
    { 
        echo('<td colspan="'.$dayOfWeek.'"> </td>');
    }

    for($i=1;$i<=$days;$i++) {

        $dag=date("$i-$month-$year");
        $totaldays=date("z", strtotime($dag))+1;
        $namnsdag = implode(" " , $namn[$totaldays]);
        $day=date("D", strtotime($dag));
        $week = date('W', strtotime($dag)); 
    
        if($day == "Mon")
        {
            echo "<td>";
            echo "<p class='week'>W".$week."</p>";
            echo "<p class='tDay'> D:".$totaldays."</p>"."<p class='nam'>".$namnsdag."</p>". $i . ".     " .$day;
            echo("</td>");
        }
        else
        {   
        echo("<td>"); 
        echo "<p class='tDay'> D:".$totaldays."</p>"."<p class='nam'>".$namnsdag."</p>". $i.". ". $day;
        echo("</td>");
        }

        if(date('w', mktime(0,0,0,$numMonth, $i, $year)) == 6) {
        echo("</tr><tr>");
        }
    }


    
    $now= date($date);    
    $str = strtotime($now);
    
    $minusMonth= date("Y-m-d",strtotime("-1 month",$str));
    $plusMonth= date("Y-m-d",strtotime("+1 month",$str));
    
    
    if(isset($_POST["sub"]))
    {

    $file=fopen("birthday.txt", "a+");
    $writeB= $_POST["bDay"].", ".$_POST["name"]."\n";
    fwrite($file, $writeB);
    fclose($file);
    $lines = file("birthday.txt");
    echo $lines[0];

    }
    
?>



<form method="POST">
    <br>
        <label for="birthday">Birthday:</label>
    <br>
        <input type="text" name="bDay" id="birthday">
    <br>
    <br>
        <label for="namn">Name:</label>
    <br>
        <input type="text" name="name" id="namn">
    <br>
    <br>
        <input type="submit" name="sub" id="">
</form>
<br>
<br>
    <a href="<?echo '?date='.$minusMonth?>" class='anc'>
        <div id='left' class='btn'>Previous</div>
    </a>    
    <a href="<?echo '?date='.$plusMonth?>" class='anc'>
        <div id='right' class='btn'>Next</div>
    </a>
</body>
</html>