<?php

if(isset($_POST['submit'])){
    
    // Count total files
    $countfiles = count($_FILES['file']['name']);
    
    // Looping all files
    for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['file']['name'][$i];
        
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'][$i],'ENERO/'.$filename);
        
    }
}
?>
<style>
a {
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
	background-color:#f9f9f9;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:black;
	font-family:Arial;
	font-size:15px;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
a:hover {
	background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
	background-color:#e9e9e9;
}
a:active {
	position:relative;
	top:1px;
</style>

<form method='post' action='index2.php' enctype='multipart/form-data'>
 <input type="file" name="file[]" id="file" multiple>

 <input type='submit' name='submit' value='Upload'>
 <a href="index.php" class="button" target="_blank">download</a>
 <a href="index3.php" class="button" target="_blank">delete all files</a>
 </form>

