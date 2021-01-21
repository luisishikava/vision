<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRCODE</title>

    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>?" rel="stylesheet">

</head>

<body>
    <div id="vision" class="container mg-top-40">

        <h1>Resultado API</h1>

        <div class="card-group">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagem</span>
                    <div class="text-center">
                        <p><?php echo e($image); ?></p>
                        <img src="<?php echo e(asset('storage')); ?>/<?php echo e($image); ?>" class="img-preview" height="150px">
                    </div>
                </div>
            </div>
            
            <div class="card column c-md">
                <div class="card-block">
                    <span class="title">Quantidade Caracteres</span>
                    <div class="text-center qty-chac">
                        <p><?php echo e($countString); ?></p>
                    </div>
                </div>
            </div>

            <div class="card column">
                <div class="card-block">
                    <span class="title">Linguagem</span>
                    <div class="text-center">
                    <ul>
                        <?php if(isset($fullText)): ?>
                            <?php $__currentLoopData = $fullText->info()['pages'][0]["property"]["detectedLanguages"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($value['languageCode']) && isset($value['confidence'])): ?>
                                    <li><?php echo e($value['languageCode']); ?> - <?php echo e($value['confidence']); ?> </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <li>Nenhuma referencia</li>
                        <?php endif; ?>
                        </ul>
                   
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Strings coletadas da Imagem</span>
                    <?php if(isset($fullText)): ?>
                        <textarea class="form-control" rows="5"><?php echo e(var_dump($fullText->text())); ?></textarea>
                    <?php else: ?>
                        <li>Nenhuma string encontrada</li>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        

        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Itens</span>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Item</th>
                                <th scope="col">Qtde</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value['code']); ?></td>
                                <td><?php echo e($value['title']); ?></td>
                                <td><?php echo e($value['qtd']); ?></td>
                                <td><?php echo e($value['price']); ?></td>
                                <td><?php echo e($value['total']); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="<?php echo e(asset('js/jquery-3.2.1.slim.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>

</html><?php /**PATH C:\Apache24\htdocs\vision\resources\views/check-qrcode-success.blade.php ENDPATH**/ ?>