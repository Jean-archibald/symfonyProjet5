<?php
echo $information, '<br />';
$numberPerPage = 5;
$totalPages = ceil($numberTotal/$numberPerPage);

if(isset($pag) AND !empty($pag) AND $pag > 0 AND $pag <= $totalPages)
{
  $id = intval($pag);
  $pageNow = $pag;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$numberPerPage;
?>