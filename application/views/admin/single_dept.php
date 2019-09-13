<?php include 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>
<!------END !------->
<br> <br>
<?php echo "Welcome Super Admin :-  ". $_SESSION['user_id']; ?>
<div class="container-fluid">
    <table>
    <div class="row">
        <div class="col-lg-6">
        <td>
            <a href="<?php echo site_url("Admin/show_category") ?>" class="btn btn-lg btn-primary">Category of Fund</a>
        </td>
        <td>
            <a href="<?php echo site_url("Admin/show_schemes") ?>" class="btn btn-lg btn-primary">Category of Scheme</a>
        </td>
        <td>
        <a href="<?php echo site_url('User') ?>" class="btn btn-lg btn-primary">ALL SCHEME LIST ACROSS ALL DEPTS</a>
        </td>
         <td>
            <a href="<?php echo site_url("Admin/dashboard") ?>" class="btn btn-lg btn-primary">Dashboard</a>
        </td>
        <td>
            <a href="<?php echo site_url("Login/updatePwd") ?>" class="btn btn-lg btn-primary">A/C Setting</a>
        </td>
          <td>
            <a href="<?php echo site_url("Import") ?>" class="btn btn-lg btn-primary">Import Excel Data</a>
        </td>
        
        </div>
    </div></table></div>
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
 <td> <?= anchor ("User/dept_result/{$sin['user_id']}", $sin['user_id']); ?> </td>
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