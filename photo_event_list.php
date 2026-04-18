<?php session_start();
include_once('./includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
// for deleting user
if(isset($_GET['id']))
{
    $idphoto_event=$_GET['id'];
    $msg=mysqli_query($con,"delete from photo_event where idphoto_event='$idphoto_event'");
    if($msg)
    {
        
        $dir = "./assets/photo_gallery/".$idphoto_event."/";

        // Open a directory, and read its contents
        if (is_dir($dir)){
          if ($dh = opendir($dir)){

              $sr = 1;
            while (($file = readdir($dh)) !== false){
                if($file != '.' && $file != '..'){
                    $url = './assets/photo_gallery/'.$idphoto_event.'/'.$file;            
                    if (file_exists($url)) {
                        if (unlink($url)) {                    
                        }
                    }
                }
            }
          }
          rmdir($dir);

        }
        
    echo "<script>alert('Data deleted');</script>";
    }
}
   ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Photo Event List</title>
        
        <link href="./css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
        <style>
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
            th { background-color: #f4f4f4; }
            .pagination { margin: 20px 0; }
            .pagination a { text-decoration: none; padding: 8px 12px; border: 1px solid #ddd; margin: 0 5px; }
            .pagination a.active { background-color: #007bff; color: white; }
        </style>
        
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
         <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Photo Event List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="manage-circulars.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Photo Event List</li>
                        </ol>
            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Photo Event List
                                <div class="btn btn-success btn-sm pull-right" onclick="window.location='photo_gallery.php'"> <i class="fas fa-plus"></i> Add</div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" >
                                   <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Title</th>
                                            <th> Description</th>
                                            <th> Visible</th>                                  
                                            <th>Action</th>
                                        </tr>
                                    </thead>
<!--                                    <tfoot>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Title</th>
                                            <th> Description</th>
                                            <th> Visible</th>                                  
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>-->
                                    <tbody>
                                        <?php 
                                            // Set pagination variables
                                            $limit = 10;  // Number of records per page
                                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $start = ($page - 1) * $limit;
                                            
                                            // Get total records
                                            $sql = "SELECT COUNT(*) AS total FROM photo_event";
                                            $result = mysqli_query($con,$sql);
                                            $row = mysqli_fetch_array($result);
                                            $totalRecords = $row['total'];
                                            $totalPages = ceil($totalRecords / $limit);
                                            
                                            
                                            $ret=mysqli_query($con,"select * from photo_event LIMIT $start, $limit");
                                          $cnt=1;
                                          while($row=mysqli_fetch_array($ret))
                                          {?>
                                          <tr>
                                          <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['pe_title'];?></td>
                                              <td><?php echo $row['pe_description'];?></td>                                  
                                              <td><?php echo $row["pe_visible"]==1 ? 'Yes':'No';?></td>       
                                              <td>

                                                  <a href="photo_gallery.php?id=<?php echo $row['idphoto_event'];?>" class="btn btn-primary btn-sm"> 
                                                        <i class="fas fa-edit"></i>
                                                  </a>
                                                 <a href="photo_event_list.php?id=<?php echo $row['idphoto_event'];?>"  class="btn btn-danger btn-sm" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                              </td>
                                          </tr>
                                          <?php $cnt=$cnt+1; }?>
                                      
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    <?php if ($page > 1) : ?>
                                        <a href="?page=<?php echo $page - 1; ?>">« Prev</a>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                        <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                    <?php endfor; ?>

                                    <?php if ($page < $totalPages) : ?>
                                        <a href="?page=<?php echo $page + 1; ?>">Next »</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
                
                
  <?php include('./includes/footer.php');?>
                
                
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./js/scripts.js"></script>
        
   
    </body>
</html>
<?php } ?>