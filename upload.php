<?php
    $success = 0;
    $uploadedFile = '';
//    $type= strrchr($file,".");
    //File upload path
    $uploadPath = 'uploads/';
    $targetPath = $uploadPath . basename( $_FILES['myfile']['name']);
//    if(($type=="jpg")||($type==".jpeg")||($type==".gif")||($type==".png")){
        if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $targetPath)){
            $success = 1;
            $uploadedFile = $targetPath;
        }
    
        sleep(1);
?>
        <script type="text/javascript">window.top.window.stopUpload(<?php echo $success; ?>,'<?php echo $uploadedFile; ?>');</script>

