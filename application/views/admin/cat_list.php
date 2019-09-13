<?php include 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>
<!------END !------->


<div class="container">
    <table>
    <div class="row">
        <div class="col-lg-6">
        <td>
            <a href="<?php echo site_url("Admin") ?>" class="btn btn-lg btn-primary">DEPT-WISE LIST</a>
        </td>
        <td>
        <a href="<?php echo site_url('User') ?>" class="btn btn-lg btn-primary">ALL PROJECT LIST ACROSS ALL DEPTS</a>
        </td>
        <td>
        <a href="<?php echo site_url('Admin/dashboard') ?>" class="btn btn-lg btn-primary">DEPT DASHBOARD</a>
        </td>
        <td>
            <a href="<?php echo site_url("User/extra") ?>" class="btn btn-lg btn-primary">Dept. Wise Project</a>
        </td>
         <td>
            <a href="<?php echo site_url("Import") ?>" class="btn btn-lg btn-primary">Import Excel</a>
        </td>
    
        </div>
    </div>
    </div>
<br>
    <?php echo dash(); ?>

<div class="container">
    <table class="table table-hover">
       <thead style="color:green;">
            <tr>
                <td><b>Sl._No.</td>
                <td><b>CATEGORY_OF_FUND</td>
                <td><b>TOTAL_AMOUNT (in Lakhs)</b></td>
            </tr>
            </thead>
        <tbody>
            <tr>
                <? if ( count($cat)): ?>
        <?php   $count = $this->uri->segment(3,0); ?>
        <?php foreach ($cat as $key => $sin): ?>
            
 <td> <?= ++$count ?> </td>
 <td> <?= anchor ("User/fund_result/{$sin->fund_cat}",$sin->fund_cat) ?> </td>
 <td> Rs. <?= $sin->AMOUNT; ?> Lakhs </td>
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