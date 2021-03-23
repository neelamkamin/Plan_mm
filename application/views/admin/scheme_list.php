<?php include 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>
<!------END !------->

    <?php echo dash(); ?>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <td><b>Sl._No.</td>
                <td><b>CATEGORY_OF_SCHEMES</td>
                <td><b>TOTAL_AMOUNT (in Lakhs)</b></td>
            </tr>
            </thead>
        <tbody>
            <tr>
                <? if ( count($schemes)): ?>
        <?php   $count = $this->uri->segment(3,0); ?>
        <?php foreach ($schemes as $key => $schemes): ?>
            
 <td> <?= ++$count ?> </td>
 <td> <?= anchor ("Admin/category_result/{$schemes->category}",$schemes->category) ?> </td>
 <td> Rs. <?= $schemes->AMOUNT; ?> Lakhs </td>
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