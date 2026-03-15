<?php
    include_once('./includes/config.php');
    $limit = 10;  // Number of records per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    
    
    $ret=mysqli_query($con,"select * from photo_event where pe_visible=1 LIMIT $start, $limit");
    $sr = 0;                                
    while($row=mysqli_fetch_array($ret)){
        echo '<div class="ribbon"> &nbsp; &nbsp;'.$row['pe_title'].' &nbsp; &nbsp; </div> <div class="clearfix"></div>';
        $dir = "assets/photo_gallery/".$row["idphoto_event"]."/";
        
        // Open a directory, and read its contents
        if (is_dir($dir)){
          if ($dh = opendir($dir)){
            
            while (($file = readdir($dh)) !== false){
                if($file != '.' && $file != '..'){   
                  echo '<div class="col-md-3 mb-3 col-12">';
                  echo '<img src="'.('admin/'.$dir.$file).'" class="img-fluid gallery-img" data-index="'.$sr++.'">';
                  echo '</div>';
                }
            }
            echo '<div class="clearfix"></div>';
          }
        }
        
      
        
    }
