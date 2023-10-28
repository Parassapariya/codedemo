<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<?php
$con = mysqli_connect("localhost","root","","demo");



if(isset($_GET['id']))
{
     $sql = "DELETE FROM `test` WHERE id=".$_GET['id'];
        $res=mysqli_query($con,$sql);
	 echo 'Deleted successfully.';
}

$limit = 3; 
$sql="select * from `test`";
$res=mysqli_query($con,$sql);
$total_rows = mysqli_num_rows($res);    
$total_pages = ceil ($total_rows / $limit); 
   // update the active page number

   if (!isset ($_GET['page']) ) {  

    $page_number = 1;  

} else {  

    $page_number = $_GET['page'];  

}    
 // get the initial page number

 $initial_page = ($page_number-1) * $limit;   

 // get data of selected rows per page    

 $getQuery = "SELECT * FROM `test` LIMIT  $initial_page ,  $limit";  
//echo $getQuery;
 $result = mysqli_query($con, $getQuery);       
?>
<table border="2px">
    <?php
    $i=0;
    while($row=mysqli_fetch_assoc($result))
    {
        if($i % 3 == 0)
        {
    ?>
    <tr>
        <?php
        }
        ?>
       
        <td><?php echo $row['name'] ?><br>
        <button class="edit" ><a style="text-decoration:none" href="demo.php?id=<?php echo $row['id']  ?>">edit</a></button>
        <button class="remove" data-id="<?php echo $row['id']  ?>">delete</button></td>
    <?php
    $i++;
    if($i % 3 == 0)
    {
      ?>
      </tr>
      <?php  
    }
    ?>
    
    <?php
    
    }
      // show page number with link   

      for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

        echo '<a href = "newdemo.php?page=' . $page_number . '">' . $page_number . ' </a>';  

    }    
    ?>
</table>
<script>
     $(".remove").click(function(){

    var id = $(this).data("id");



if(confirm('Are you sure to delete this record ?'))

{

    $.ajax({

       url: 'newdemo.php',

       type: 'GET',

       data: {id: id},

       error: function() {

          alert('Something is wrong');

       },

       success: function(data) {

            $("#"+id).remove();
            location.reload();

       }

    });

}

});



</script>