<?php include 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>
<!------END !------->
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
 <td> <?= anchor ("Admin/fund_result/{$sin->fund_cat}",$sin->fund_cat) ?> </td>
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