<?php
$con = mysqli_connect("localhost","root","","demo");


if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="select * from `test`";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($res);
    $id=$row['id'];
    $name=$row['name'];
    $red=$row['red'];
    $chk=explode(",",$row['chk']);
    
    
}

if(isset($_POST['btnsub']))
{
    $red=$_POST['fav_language'];

    $nm=$_POST['nm'];
    $newnm=str_replace("'","\'","$nm");
    $checkBox = implode(',', $_POST['q1']);
    $file_name=$_FILES['img']['name'];
	$file_temp=$_FILES['img']['tmp_name'];
	$nm=rand();
    $end=explode(".",$file_name);
	$ext=end($end);
	$nfile=$nm.".".$ext;
	$file_destination="matirial/".$nfile;
	if(move_uploaded_file($file_temp,$file_destination))
	{
        $sql="INSERT INTO `test`(`red`,`chk`,`name`,`image`) VALUES ('$red','$checkBox','$newnm','$file_destination') ";
        $res=mysqli_query($con,$sql);
    }
}

if(isset($_POST['btnupdate']))
{
    $id=$_POST['id'];
    $red=$_POST['fav_language'];

    $nm=$_POST['nm'];
    $newnm=str_replace("'","\'","$nm");
    $checkBox = implode(',', $_POST['q1']);
    $sql="UPDATE `test` SET `red`='$red',`chk`='$checkBox',`name`='$newnm' WHERE `id`='$id'";
    $res=mysqli_query($con,$sql);
    header("location:newdemo.php");
}
?>
<html>
    <body>
        <form action="demo.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php  echo (isset($id)) ? $id : ''; ?>">

            <!---textbox--->
            <input type="text" id="tt" value="<?php echo (isset($name)) ? $name : '';?>" name="nm">
            <label for="tt">name</label><br>

            <!---radio--->
            <input type="radio" id="html" name="fav_language" value="HTML"
            <?php
            if(isset($_GET['id']))
            {
                if($red == "HTML")
                {
                    echo "checked";
                }
            }
          
            ?>
            >
            <label for="html">HTML</label><br>
            <input type="radio"  id="html1" name="fav_language" value="html"
            <?php
            if(isset($_GET['id']))
            {
                if($red == "html")
                {
                    echo "checked";
                }
            }
          
            ?>
            >


            <!---checkbox--->
            <label for="html1">html</label> <br>
            
            <input type="checkbox"  id="html2" name="q1[]" value="q1"
            <?php
            if(isset($_GET['id']))
            {
                if(in_array("q1",$chk))
                {
                    echo "checked";
                }
            }
          
            ?>
            >
            <label for="html2">1</label> <br>
            <input type="checkbox"  id="html3" name="q1[]" value="q2"
            <?php
            if(isset($_GET['id']))
            {
                if(in_array("q2",$chk))
                {
                    echo "checked";
                }
            }
          
            ?>
            >
            <label for="html3">2</label> <br>
            <input type="checkbox"  id="html4" name="q1[]" value="q3"
            <?php
            if(isset($_GET['id']))
            {
             
            }
          
            ?>
            >
            <label for="html4">3</label> <br>
            
           

            <!--image-->
            <input type="file" name="img" id="img">

            <!--button chnage task-->
            <?php
            if(isset($_GET['id']))
            {
            ?>
              <input type="submit" name="btnupdate" value="update">
            <?php
            }else
            {
                ?>
                <input type="submit" name="btnsub" >
                <?php
            }
            ?>
          
        </form>
    </body>
</html>