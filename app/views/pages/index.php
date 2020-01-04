<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('login_success'); ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    
    <?php if(!isset($_SESSION['user_id'])){ 
          echo $data['text'];
          } else{
            echo $_SESSION['user_name']; 
          }
     ?>
    </div>
  </div> 
  <?php if(isset($_SESSION['user_id'])){ ?>
    <?php flash('search_none'); ?>
        <form action="<?php echo URLROOT; ?>/pages/results" method="get">
          <div class="form-group">
            <label for="search_text">Search for user type:</label>
            <input type="text" name="search_text" class="form-control form-control-lg">
          </div>
          <div class="form-group mb-5">
          <?php flash('search_select'); ?>
            <label for="search_select">Search by user Type:</label>
            <select name ="search_select" id="search_select" class="form-control">
            <option value=''>Select User type:</option>
              <option value='Front End Developer'>Front End Developer</option>
              <option value='Back End Developer'>Back End Developer</option>
            </select>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" name="submit" value="Search" class="btn btn-primary btn-block">
            </div>
          </div>
          
        </form>
     <?php } ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
