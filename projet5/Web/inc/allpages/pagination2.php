<div class="divPag">
  <?php
  if($numberTotal>5)
  {
    if(preg_match('#lire-([0-9]+)-([0-9]+)-([0-9]+)#', $url , $params))
    {
      $cutUrl = explode("-", $url);
      $base = $cutUrl[0];
      $pag = $params[1];
      $id = $params[2];
      $comment = $params[3];
    
      for($i=1;$i<=$totalPages ;$i++)
      {
        if($i == $pageNow)
        {
          echo $i.' ';
        }
        else
        {
          echo '<a class="pagButton" href="'.$base.'-'.$i.'-'.$id.'-0'.'">'.$i.'</a>';
        }
      }
    }
    else
    {
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
    }
  }
  ?>
</div>