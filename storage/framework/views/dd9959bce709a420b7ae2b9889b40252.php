<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">


        <style>
        @font-face {
            font-family: 'Siegra';
            src: url('<?php echo e(asset('Siegra.ttf')); ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        </style>
        
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
        <?php echo Whitecube\LaravelCookieConsent\Facades\Cookies::renderScripts(); ?>
        <?php echo app('Illuminate\Foundation\Vite')('resources/ts/app.ts'); ?>
        <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->head; } ?>
    </head>
    <body class="font-sans antialiased">
        <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
        <?php echo Whitecube\LaravelCookieConsent\Facades\Cookies::renderView(); ?>
    </body>
</html>
<?php /**PATH E:\work\Artificially\SmartDriving\resources\views/app.blade.php ENDPATH**/ ?>