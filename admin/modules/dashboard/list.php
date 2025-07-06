<?php 
$icon       = 'droplet';
$module 		= 'dashboard';
$sub_module = '';
require_once '../../includes/modules/dashboard/list.php'; 
require_once '../../includes/check_session.php'; 
require_once '../../header.php'; 
?>

<!-- content code start here -->

<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="<?php echo $icon; ?>" style="margin-right: 8px;"></i> <?php echo ucfirst($module); ?><?php if ($sub_module) echo ' <i class="bx bx-right-arrow-alt"></i> '.ucfirst(implode(' ', explode('_', $sub_module))); ?>
  <div style="flex: 1;"></div>
</h5>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/a+.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $a_plus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/b+.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $b_plus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
	<div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/ab+.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $ab_plus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
	<div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/o+.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $o_plus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/a-.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $a_minus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/b-.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $b_minus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
	<div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/ab-.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $ab_minus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
	<div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
					<img src="../../assets/images/bloods/o-.png" alt="">
					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $o_minus; ?> bags</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="w-100">
            <p class="mb-0">TOTAL DONORS</p>
            <h5 class="mb-0 text-center"><b><?php echo $tot_donors; ?></b></h5>
						
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="w-100">
            <p class="mb-0">TOTAL REQUESTS</p>
            <h5 class="mb-0 text-center"><b><?php echo $tot_requests; ?></b></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="w-100">
            <p class="mb-0">APPROVED REQUESTS</p>
            <h5 class="mb-0 text-center"><b><?php echo $app_requests; ?></b></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="w-100">
            <p class="mb-0">TOTAL BLOOD UNITS (ml)</p>
            <h5 class="mb-0 text-center"><b><?php echo $tot_bloods; ?></b></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- content code end here -->

<?php 
require_once '../../footer.php'; 
?>