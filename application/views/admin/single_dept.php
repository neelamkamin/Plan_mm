<?php include 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>
<!------THIS IS LAGDING VIEW OF SUPER ADMIN !------->
<br> <br>
<?php if($feedback = $this->session->flashdata('feedback')): 
        $feedback_class = $this->session->flashdata('feedback_class'); 
?>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
        
            <div class="alert alert-success">
              <?= $feedback ?> <!-- FOR DISPLAY OF FEEDBACK MSG  !-->
            </div>
          </div>
        </div>
<?php endif; ?>

<?php 
           $dept_id = $this->session->userdata('dept_id');
    echo "Welcome Super Admin :-  <b>". $dept_id ."</b>" ; 
?>
    <br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
                        <?php 
                              echo dash(); 

                              //echo "<pre>";
                                //print_r($tol);
                                //exit;
                         ?>
</div></div></div></div>

<div class="container">
    <table class="table table-hover">
       <thead style="color:green;">
            <tr>
                <td><b>Sl._No.</td>
                <td><b>DEPARTMENT_NAME</td>
                <td><b>TOTAL_BUDGET_ESTIMATE (in Lakhs)</b></td>
                <td><b>TOTAL_SCHEMES</b></td>
            </tr>
            </thead>
        <tbody>
            <tr>
                <? if ( count($tol)): ?>
        <?php   $count = $this->uri->segment(3,0); ?>
        <?php foreach ($tol as $key => $sin): ?>
            
 <td> <?= ++$count ?> </td>
 <td> <?= anchor ("Admin/dept_result/{$sin['dept_id']}", $sin['dept_id']); ?> </td>
 <td align="center"> Rs. <?= $sin['AMOUNT']; ?> Lakhs </td>
 <td align="center"> <?= $sin['TOTAL']; ?> Nos</td>
 </tr>

      <?php endforeach; ?>
            <? else: ?>
        <tr>
        </tr>

        <? endif; ?>
            </tr>
        </tbody>
    </table>

<?= $this->pagination->create_links(); ?>
</div>
</body>
</html>