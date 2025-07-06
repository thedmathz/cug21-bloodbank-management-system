<?php 
$icon       = 'face';
$module 		= 'feedback';
$sub_module = '';
require_once '../../includes/modules/feedback/list.php'; 
require_once '../../includes/check_session.php'; 
require_once '../../header.php'; 
?>

<!-- content code start here -->

<h5 class="d-flex align-items-end" style="margin-bottom: 15px;">
  <i class="<?php echo $icon; ?>" style="margin-right: 8px;"></i> <?php echo ucfirst($module); ?>s<?php if ($sub_module) echo ' <i class="bx bx-right-arrow-alt"></i> '.ucfirst(implode(' ', explode('_', $sub_module))); ?>
  <div style="flex: 1;"></div>
</h5>

<div class="card radius-10">
	<div class="card-body">
		<div class="table-responsive">
      <form action="list.php" method="post">
        <table class="table align-middle mb-0">

          <thead class="table-light">

            <tr>
              <th class="text-start">Last Name</th>
              <th class="text-start">First Name</th>
              <th class="text-start">Middle Name</th>
              <th class="text-center">Date Insterted</th>
              <th class="text-center">Feeback</th>
            </tr>

          </thead>

          <tbody>

            <?php 
            if ($feedbacks) {
              foreach ($feedbacks as $pros) {
                ?>

                <tr class="text-center">
                  <td class="text-start" style="vertical-align: baseline" ><?php echo $pros['lname']; ?></td>
                  <td class="text-start" style="vertical-align: baseline"><?php echo $pros['fname']; ?></td>
                  <td class="text-start" style="vertical-align: baseline"><?php echo $pros['mname']; ?></td>
                  <td class="text-center" style="vertical-align: baseline"><?php echo $pros['date_inserted']; ?></td>
                  <td class="text-start" style="white-space: break-spaces;"><?php echo $pros['feedback']; ?></td>
                </tr>

                <?php
              }
            } else {
              ?>

              <tr class="text-center">
                <td class="text-center text-danger" colspan="5" >No Record Found</td>
              </tr>

              <?php
            }
            ?>

          </tbody>

        </table>
      </form>
		</div>
	</div>
</div>

<!-- content code end here -->

<?php 
require_once '../../footer.php'; 
?>