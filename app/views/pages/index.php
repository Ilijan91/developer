<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
  
  <ul>
    <?php foreach($data['users'] as $user) : ?>
      <li> <?php echo $user->name;?></li>
      <li> <?php echo $user->created_at;?></li>

    <?php endforeach; ?>
  </ul>
    </div>
  </div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>
