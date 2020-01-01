<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('login_success'); ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    
    <?php echo $_SESSION['user_name'] ?>
    </div>
  </div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>
