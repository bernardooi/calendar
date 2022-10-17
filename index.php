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
$bday="";
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
 <th abbr="Sunday" scope="col" title="Sunday" style="color:red">S</th>
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
        $file=fopen("birthday.txt", "r");

        // $Arr = file("birthday.txt");
        

        // for($x=0;$x <count($Arr);$x++)
        // {

        //     $temp=explode(".",$Arr[$x]);
        //     var_dump($temp);
        //     $temp2=explode("-", $temp[0]);
        //     $bDate=$temp2[1]."-".$temp2[2];
        //     echo $bDate;
        //     if($bDate==$month."-".$i)
        //     {
        //         $bday.="$temp[1]";

        //     }
        
        // }
        if($bdayArr=fgets($file))
        {
        $temp=explode(",", $bdayArr);
        for($x=0;$x < count($temp);$x++)
        {
            $t="$month-$i";
            $temp2=explode(".",$temp[$x]);
            $temp3= substr($temp2[0], 5);
            $bDate=$temp3;
            if($bDate==$t)
            {
                $bday.="$temp2[1]";
                break;
            }

            else if($bDate != $t)
             {
                 $bday= "";
             }
        }
        }

        if($day == "Mon")
        {
            echo "<td>";
            echo "<p class='week'>W".$week."</p>";
            echo "<p class='tDay'> D:".$totaldays."</p>"."<p class='nam'>".$namnsdag."</p>". $i . ".     " .$day. "<p>".$bday."</p>";
            echo("</td>");
        }
        else if($day == "Sun")
        {

            echo("<td>"); 
            echo "<p class='tDay' style='color:red;'> D:".$totaldays."</p>"."<p class='nam' style='color:red;'>".$namnsdag."</p>". "<p style='color:red;'>". $i.". ". $day. "</p>". "<p style='color:red;'>".$bday."</p>";
            echo("</td>");

        }
        else
        {   
        echo("<td>"); 
        echo "<p class='tDay'> D:".$totaldays."</p>"."<p class='nam'>".$namnsdag."</p>". $i.". ". $day. "<p>".$bday."</p>";
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
    $writeB=",". $_POST["bDay"].".".$_POST["name"];
    fwrite($file, $writeB);

    }
    fclose($file);

?>


<form method="POST" action="index.php">
    <br>
        <label for="birthday">Birthday:</label>
    <br>
        <input type="date" name="bDay" id="birthday">
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