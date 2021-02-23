<?php require APPROOT . '\views\includes\head.php'; ?>

<div class="container">
    <h1><?php echo $data['title']; ?></h1>
</div>

<div class="pixelBoard">
    <?php foreach ($data['pixels'] as $pixel): ?>
        <span class="pixel <?php print $pixel->color; ?>" style="
                bottom: <?php print $pixel->coordinateY; ?>px;
                left: <?php print $pixel->coordinateX; ?>px;
                width: <?php print $pixel->size; ?>px;
                height: <?php print $pixel->size; ?>px;">
    </span>
    <?php endforeach; ?>
</div>


<?php
var_dump($data);
?>


<?php require APPROOT . '\views\includes\footer.php'; ?>
