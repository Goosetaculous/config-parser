<?php
    require_once "ClassConfig.php";
    $config = new FileRead();
    $config->UPLOAD_FILE();	
?>
<html>
   <body>
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="config" />
         <input type="submit"/>
      </form>
   </body>
</html>