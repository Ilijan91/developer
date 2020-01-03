<?php require APPROOT . '/views/inc/header.php'; ?>
  <h1 class="card-title">Results</h1>
  <?php flash('search_fail'); ?>
  <?php if($data['results']){foreach($data['results'] as $result) : ?>
    <div class='row mb-3'>
      <div class="col-md-6 card card-body mb-3 pull left"><?php echo $result->sub_type; ?></div>
      <div class="col-md-6 card card-body mb-3 pull right"><?php echo $result->type; ?></div>
    </div>
  <?php endforeach ;}else{?>
    <a href="<?php echo URLROOT; ?>/pages" class="btn btn-light"> <i class="fa fa-backward"></i> Search again</a>
  <?php } ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>