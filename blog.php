<?php
include('inc/header.php');
?>


<?php
if (isset($_GET['post'])){
    include ('inc/blog_post.php');
}else{
    include ('inc/blog.php');
}

?>

<?php
include('inc/footer.php');
?>
