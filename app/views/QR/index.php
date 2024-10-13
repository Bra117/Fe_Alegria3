<?php
include 'backEnd.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<div class="wrapper">
      <header>
        <h1>QR Code Generator</h1>
        <p>type text or url to create QR code</p>
      </header>
      <div class="form">
        <input type="text" spellcheck="false" placeholder="Enter text or url">
        <button>Create QR Code</button>
      </div>
      <div class="qr-code">
        <img src="" alt="qr-code">
      </div>
    </div>
      <script src = "<?php echo APP;?>app/plugins/jquery/jquery.js"></script>
<?php
  if (isset($this->js)){
    foreach ($this->js as $js){
      echo '<script type="text/javascript" src="'.APP.'app/views/'.$js.'"></script>'; 
    }
  }
?>


</body>
</html>