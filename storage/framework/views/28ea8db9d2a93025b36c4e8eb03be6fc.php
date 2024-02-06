<form action="<?php echo $url; ?>" <?php echo $attributes; ?>>
    <?php echo csrf_field(); ?>
    <button type="submit" class="<?php echo $basename; ?>__link">
        <span class="<?php echo $basename; ?>__label"><?php echo e($label); ?></span>
    </button>
</form>
<?php /**PATH E:\work\Artificially\SmartDriving\resources\views/vendor/cookie-consent/button.blade.php ENDPATH**/ ?>