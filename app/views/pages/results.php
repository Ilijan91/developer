<?php require APPROOT . '/views/inc/header.php'; ?>
  <h1 class="card-title">Results of the search: <i><?php echo $data["title"];?></i> </h1>
  <?php flash('search_fail'); ?>
  <?php if($data['results']){ ?>
    <div class='row mb-6'>
      <div class="col-md-6 card card-body mb-3"><?php echo $data["title"] . " => number of users: " . $data['count']->total; ?> <?php echo $data['select'] . "s =>" . $data['countParent']->total_parent; ?></div>
      <div class="col-md-6 card card-body mb-3">List of users from search:
      <?php 
        foreach($data["users"] as $user){
          echo "<br>" . $user->name;
        }
      ?></div>
    </div>
  <?php }else{?>
    <a href="<?php echo URLROOT; ?>/pages" class="btn btn-light"> <i class="fa fa-backward"></i> Search again</a>
  <?php } ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>