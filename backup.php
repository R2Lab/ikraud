<?php
include_once 'includv.php';
pagehead(' - Archive');
$ri=13;
$row=array(1=>'.htaccess','backup.php','index.php','qweba.php','register.php','robots.txt','loginout.php','newsout.php','css/style.css','css/stylez.css',
          11=>'adminko.php','includv.php','user_panel.php');
if(extension_loaded('zip'))
 {
  $zip=new ZipArchive();
  $dt=date('Y-m-d_H-i-s');
  $zip_name='ikr_'.$dt.'.zip';
  if ($zip->open($zip_name, ZipArchive::CREATE)!==TRUE)
   {
    exit("Cannot create <$zip_name>\n");
   }
  for ($i=1;$i<=$ri;$i++)
   {
    $zip->addFile($row[$i]);
   }
  $zip->close();
  echo $ri.' files was Archived';
 }
pagefoot();
?>
