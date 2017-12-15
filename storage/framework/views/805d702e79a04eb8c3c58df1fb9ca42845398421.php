<!DOCTYPE <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php echo e(HTML::style('css/sample_responsive.css')); ?>

    <?php echo e(HTML::style('css/flex_layout.css')); ?>

<?php echo e(HTML::style('css/fluid_layout.css')); ?>

<?php echo e(HTML::style('css/show_hidden.css')); ?>

</head>
<body>
    <?php echo $__env->make("mpgnav", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>