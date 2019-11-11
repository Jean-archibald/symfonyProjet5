<div class="divPag">
  <?php
    for($i=1;$i<=$totalPages ;$i++)
    {
      if($i == $pageNow)
      {
        echo $i.' ';
      }
      else
      {
        echo '<a class="pagButton" href="'.$base.'-'.$i.'-0'.'">'.$i.'</a>';
      }
    }
  ?>
</div>