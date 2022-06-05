<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calender</title>
    <link rel="stylesheet" href="./main.css">
</head>
<body>
<h1>Calender</h1>

<div class="container">

<!-- 
    ↓↓↓ 取得月份的參數 ↓↓↓
-->
<?php
    // 判斷1月跟12月 避免跳到0月跟13月
    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $month = date('n'); //取得當前月
        $year = date("Y"); //取得當前年
}

switch ($month) {
    case 1: //1月的話
        $prevMonth = 12; //1月的上一個月是12月份 所以直接帶入12
        $prevYear = $year - 1; //1月的上一個月是去年 所以年份要-1
        $nextMonth = $month + 1;
        $nextYear = $year;
        break;
    case 12: //12月的話
        $prevMonth = $month - 1;
        $prevYear = $year;
        $nextMonth = 1; //12月的下一個月是1月 所以直接帶入1
        $nextYear = $year + 1; //12月的下一個月是明年 所以要+1
        break;
    default: 
        $prevMonth = $month - 1;
        $prevYear = $year;
        $nextMonth = $month + 1;
        $nextYear = $year;
    }   
?>

<!-- 
    ↓↓↓ 控制切換月份的按鈕 ↓↓↓
-->
<div class="nav">
    <span>
        <a href="index.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>" class="lastmonth"><< Last Month</a>
    </span>
    <span class="a1"><?= $year .'&nbsp'. '年' .'&nbsp'. $month .'&nbsp'.'月份'; ?></span>
    <span>
        <a href="index.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>" class="nextmonth">Next Month >></a>
    </span>
</div>

<!-- 
    ↓↓↓ 萬年曆內容 ↓↓↓ 
-->
<?php
    $firstDay = $year . "-" . $month . "-1";//第一天日期
    $firstWeekday = date("w", strtotime($firstDay));//一號是星期幾
    $monthDays = date("t", strtotime($firstDay));//算這個月的總天數
    $lastDay = $year . "-" . $month . "-" . $monthDays;//算這個月的最後一天日期
    $today = date("Y-m-d");//得到今天日期
    $lastWeekday = date("w", strtotime($lastDay));//最後一天是星期幾
    $dateHouse = [];

for ($i = 0; $i < $firstWeekday; $i++) {
    $dateHouse[] = "";//一號以前,印空白
}

for ($i = 0; $i < $monthDays; $i++) {
    $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
    //日期函數的年月日換算成字串 字串印出來以後要+1
    $dateHouse[] = $date;
}

for ($i = 0; $i < (6 - $lastWeekday); $i++) {
    $dateHouse[] = "";//最後一天以後,印空白
}
?>

<!-- 
    ↓↓↓ 當月的table ↓↓↓ 
-->
<div class="table">
    <div class='header'>Sun</div>
    <div class='header'>Mon</div>
    <div class='header'>Tue</div>
    <div class='header'>Wed</div>
    <div class='header'>Thu</div>
    <div class='header'>Fri</div>
    <div class='header'>Sat</div>
    <?php
    foreach ($dateHouse as $k => $day) {
        $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : ""; //判定是否為假日

        if (!empty($day)) {
            $dayFormat = date("j", strtotime($day)); //只顯示"日"
            echo "<div class='{$hol}'>{$dayFormat}</div>";
        } else {
            echo "<div class='{$hol}'></div>";
        }
    }
    ?>
</div>
</div>
<div class="square">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="circle">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>
</html>