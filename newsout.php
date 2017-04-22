<?php
require_once 'includv.php';
$z='Select * from news';
$r=mysql_query($z,DBLink);
function news1out($a,$b,$c,$d)
 {
  echo '<tr><td>';
  echo '<img src="/img/news/'.$a.'" width="80px" style="float:left;border:1px solid black"><h3>'.$b.'</h3><hr><p>'.$c.'</p><p style="text-align:right">'.$d.'</p>';
  echo '</td></tr>';
 }
echo '<table border="1" cellspacing="0" width="100%">';
while ($row=mysql_fetch_array($r,MYSQL_ASSOC))
 {  news1out($row['foto'],$row['nazva'],$row['txt'],$row['avtor']);
 }
echo "</table>";?>