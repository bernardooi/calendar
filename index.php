<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        .btn{
            width:3vw;
            height:2.25vh;
            padding-top:0.75vh;
            font-size:0.5rem;
            background-color:hsl(0,0%,60%);
            text-align:center;
            display:inline-block;
        }
        .btn:hover{
            cursor:pointer;
            background-color:hsl(0,0%,50%);
        }
        .anc{
            color:black;  
        }
        .bam{
            display:inline-block;
            width:12vw;
            height:16vh;
            border:2px solid black;
            margin:2px;
            background-color:orange;
            font-size:0.75em;
        }
    </style>
</head>
<body>
<?php

    include("namnsdag.php");
    
    $date = $_GET["date"];
    if(empty($date)){
        $date= date("Y-m-d");
    }
    $year = date('Y', strtotime($date));
    $month = date('n',strtotime($date));
    $days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $monthName= date("M", strtotime($days.'-'. $month.'-'.$year));
    echo "<h2>". $monthName . " " . $year."</h2>";

        for ($i = 1; $i <= $days ; $i++)
        {
  
            $dag=date("$i-$month-$year");
            $totaldays=date("z", strtotime($dag))+1;
            $namnsdag = implode(" " , $namn[$totaldays]);
            $week = date('W', strtotime($dag));
            $day=date("D", strtotime($dag));
            if($day == "Sun")
            {
                echo "<div class='bam' style='color:red;'>". $totaldays . " ". $day ." " . $i ." ".$namnsdag . "</div><br>";
            }
            else if($day == "Mon")
            {
                echo "<div class='bam'>" . "W ". $week ." " . $totaldays. " ". $day ." " . $i . " ". $namnsdag ."</div>";
            }
            else
            {
                echo "<div class='bam'>". " " . $totaldays. " " . $day ." " . $i . " ". $namnsdag ."</div>";
            }
            
        }
    
    $now= date($date);    
    $str = strtotime($now);
    
    $minusMonth= date("Y-m-d",strtotime("-1 month",$str));
    
    $plusMonth= date("Y-m-d",strtotime("+1 month",$str));
    
    
?>

<br>
<a href="<?echo '?date='.$minusMonth?>" name='leftClick' class='anc'>
<div id='left' class='btn'>Previous</div>
</a>
<a href="<?echo '?date='.$plusMonth?>" name='rightClick' class='anc'>
<div id='right' class='btn'>Next</div>
</a>

<form>
    <br>
    <label for="birthday">Birthday:</label><br>
    <input type="text" name="" id="birthday">
    <br>
    <br>
    <label for="namn">Name:</label><br>
    <input type="text" name="" id="namn"><br><br>
    <input type="submit" name="" id="">
</form>
</body>
</html>