<?php include('../includes/connection.php'); ?>
<?php include('../includes/session.php'); ?>
<?php include('../includes/home.php'); ?>
<?php include('header.php'); ?>

<style>
  .head {
    margin-top: 80px;
    font-weight: bold;
  }
  .head_button {
    border-radius: 50px; 
    font-weight: bold; 
    font-size: 25px; 
    padding-left: 30px; 
    padding-right: 30px; 
    margin-top: 50px; 
    margin-bottom: 30px;
  }
  .head2 {
    font-size: 28px;
    margin-top: 30px;
  }
  @media only screen and (max-width: 600px) {
    .head {
      margin-top: 20px;
    }
    .head2 {
      font-size: 20px;
    }
    .head_button {
      margin-top: 20px; 
      margin-bottom: 30px;
    }
    .d_button {
      flex-direction: column;
    }
    .d_button div {
      display: none;
    }
    .d_button button {
      margin: 0 0 10px !important;
    }
  }
</style>

<!-- content -->
<section>
  <div class="row">
    <div class="col-12 col-sm-6">
      <h1 class="text-secondary head">
        EVERY DROP COUNTS, HELP SAVE LIVES
      </h1>
      <h5 class="head2" style="line-height: 1.5;">
        Blood bank is a place where blood is collected from donors, typed, separated into components, stored, and prepared for transfusion to recipients.
      </h5>
      <div class="mt-3 d-flex d_button">
        <button class="btn btn-sm btn-raised btn-primary mb-2" onclick="window.location.href='donate_blood.php'" style="white-space: nowrap; border-radius: 50px; padding: 4px 16px; font-size: 20px;">Donate Blood</button>
        <div>&nbsp;&nbsp;</div>
        <button class="btn btn-sm btn-raised btn-secondary mb-2" onclick="window.location.href='get_blood.php'" style="white-space: nowrap; border-radius: 50px; padding: 4px 16px; font-size: 20px;">Search Blood</button>
      </div>
    </div>
    <div class="col-12 col-sm-6" style="padding: 16px;">
      <div class="w-100">
        <img src="../assets/images/home_img.png" alt="" style="width: 100%;">
      </div>
    </div>
  </div>
</section>
<!-- /content -->

<?php include('footer.php'); ?>