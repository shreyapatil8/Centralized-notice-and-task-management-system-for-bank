<?php session_start();
include_once('./includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
    $data = $errors = $uploadedFiles = array();
    
    
    
    if(isset($_POST['save']))
    {
        $required = 1;
        $pe_title = $_POST['pe_title'];
        $pe_description = $_POST['pe_description'];
        $pe_visible = isset($_POST['pe_visible'])?1:0;
        
        if($_POST['pe_title'] == ""){
            $data['pe_title'] = 'This field is required';
            $required = 0;
        }
     
        
        if($required == 1){
            if(isset($_POST['idphoto_event']) && $_POST['idphoto_event'] !=""){
                $sql = "update photo_event set pe_title='$pe_title', pe_description='$pe_description', pe_visible='$pe_visible' WHERE idphoto_event=".$_POST['idphoto_event'];
                $msg = mysqli_query($con,$sql);
                $last_id = $_POST['idphoto_event'];
            }else{
                $sql = "insert into photo_event (pe_title, pe_description, pe_visible) values('$pe_title','$pe_description',$pe_visible)";
                $msg = mysqli_query($con,$sql);
                $last_id = mysqli_insert_id($con);
            }
            
            
            if($msg)
            {
                        
                        $uploadDir = "assets/photo_gallery/".$last_id."/"; // Upload directory
                        
                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }
                        
                        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
                        $maxSize = 2 * 1024 * 1024; // 2MB limit
                        $fileuploadcnt = 0;
                        // Loop through each uploaded file
                        
                        
                        foreach ($_FILES['userfile']['tmp_name'] as $key => $tmpName) {
                            if($_FILES['userfile']['name'][$key] != ""){
                            $fileName = $_FILES['userfile']['name'][$key];
                            $fileSize = $_FILES['userfile']['size'][$key];
                            $fileTmp = $_FILES['userfile']['tmp_name'][$key];
                            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                            // Generate a unique file name
                            $newFileName = "image_" .time().'_'.($key+1).'.png';

                            // Validation checks
                            if (!in_array($fileExt, $allowedTypes)) {
                                $errors[] = "$fileName is not a valid image file.";
                                continue;
                            }
                            if ($fileSize > $maxSize) {
                                $errors[] = "$fileName exceeds the 2MB size limit.";
                                continue;
                            }

                            // Move the file to the upload directory
                            if (move_uploaded_file($fileTmp, $uploadDir . $newFileName)) {
                                $uploadedFiles[] = $newFileName;
                                $fileuploadcnt++;
                            } else {
                                $errors[] = "Failed to upload $fileName.";
                            }
                            }
                            
                        }
                       
                       
                                                
                    
                    
                    $data['errors'] = $errors;
                    $data['uploadedFiles'] = $uploadedFiles;
                    $data['uploadedfilecnt'] = $fileuploadcnt;
                    
                
                
                
                $data['msgsuccess'] = "Record Insert successfully";
                //echo "<script>alert('Record Insert successfully');</script>";
                if(isset($_GET['id'])){
                    //echo "<script type='text/javascript'> document.location = 'photo_event_list.php'; </script>";
                }
            }        
        }
    }else if(isset ($_GET['id'])){
        $ret=mysqli_query($con,"select * from photo_event where idphoto_event=".$_GET['id']);         
        $photo_event = mysqli_fetch_assoc($ret);
        
        if(isset($_GET['image']) != ""){
            $url = './assets/photo_gallery/'.$_GET['id'].'/'.$_GET['image'];            
            if (file_exists($url)) {
                if (unlink($url)) {                    
                }
            }
            echo "<script type='text/javascript'> document.location = 'photo_gallery.php?id=".$_GET['id']."'; </script>";
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
        <title>Photo Gallery</title>        
        <link href="./css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Photo Event Add</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="manage-circulars.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Photo Event Add</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <form action="photo_gallery.php" method="post" enctype="multipart/form-data">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                              Photo Gallery                        
                            </div> 
                            <div class="card-body">
                                <div class="row clearfix">
                                    <input type="hidden" name="idphoto_event" value="<?= isset($photo_event)?$photo_event['idphoto_event']:'' ?>"/>
                                        <div class="col-md-6">
                                            <label for="pe_title" class="control-label"><span class="text-danger">*</span>Title</label>
                                            <div class="form-group">
                                                <input type="text" name="pe_title" value="<?= isset($photo_event)?$photo_event['pe_title']:'' ?>" class="form-control" id="pe_title" />
                                                <span class="text-danger"><?= isset($data['pe_title'])?$data['pe_title']:'' ?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="pe_visible" class="control-label">Visible</label>
                                            <div class="form-group">
                                                <input type="checkbox" name="pe_visible" value="1" style="width: 25px;height: 25px;" id="pe_visible" <?= isset($photo_event)&&$photo_event['pe_visible']==1? 'checked':'' ?>  />
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 hiddens">
                                            <label for="pe_description" class="control-label">Description</label>
                                            <div class="form-group">
                                                <textarea name="pe_description" class="form-control" id="pe_description" ><?= isset($photo_event)?$photo_event['pe_description']:'' ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="userfile" class="control-label"><span class="text-danger">*</span>Upload Photos</label>
                                            <div class="form-group">
                                                <input type="file" name="userfile[]" class="form-control" id="userfile" multiple="" />
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="clearfix" style="margin-bottom: 10px;"></div>          
                                        
                                        <div class="col-md-12">
                                            <?php
                                                if(isset($data['uploadedfilecnt']) && $data['uploadedfilecnt'] > 0){
                                            ?>
                                            <div class="alert alert-success">Total <?= $data['uploadedfilecnt'] ?> Image Files uploaded successfully.</div>                                                        
                                            <?php }else if(isset($data['uploadedfilecnt']) && $data['uploadedfilecnt'] == 0 && isset ($data['msgsuccess'])){ ?>
                                            <div class="alert alert-success"> <?= $data['msgsuccess'] ?> </div>
                                            <?php } ?>
                                        </div>

                                        <div class="col-md-12">
                                            <?php
                                                if(isset($data['errors']) && !empty($data['errors'])){
                                                foreach ($data['errors'] as $err){
                                            ?>
                                            <div class="alert alert-danger"><?= $err ?></div>                            
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        
                                        
                                </div>
                            </div>
                                
                                <div class="card-footer">
                                    <button type="submit" name="save" value="save" class="btn btn-success btn-block">
                                        <i class="fa fa-check"></i> Save
                                    </button>

                                    <div class="btn btn-warning btn-block" onclick="window.location='./photo_event_list.php'"><i class="fa fa-arrow-left"></i> Back </div>
                                            
                                </div>
                                
                            </form>
                            
                        </div>

                       
    <div class="col-md-12">
        <div class="">
            <div class="row gallery">
            <?php 
                if(isset($photo_event)){
                    $dir = "./assets/photo_gallery/".$photo_event["idphoto_event"]."/";

                    // Open a directory, and read its contents
                    if (is_dir($dir)){
                      if ($dh = opendir($dir)){
                          
                          $sr = 0;
                        while (($file = readdir($dh)) !== false){
                            if($file != '.' && $file != '..'){          
            ?>
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <a href="<?= ($dir.$file) ?>" target="_blank"><img src="<?= ($dir.$file) ?>" class="img-fluid gallery-img" data-index="0"></a>
                    </div>
                    <div class="card-footer">
                        <a href="<?= 'photo_gallery.php?id='.$photo_event["idphoto_event"].'&image='.$file ?>" onclick="return confirm('Do you really want to delete this record?');" class="btn btn-danger" style="width: 100%;" ><i class="fa fa-trash"></i> Remove Image</a>
                    </div>
                </div>
            </div>
        
            <?php
                            }
                        }
                        closedir($dh);
                        
                        
                      }
                    }
                }
                
                ?>  
            
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        
    </body>
</html>
<?php } ?>
