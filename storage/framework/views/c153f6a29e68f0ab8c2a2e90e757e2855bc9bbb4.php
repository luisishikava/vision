<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vision Google</title>

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
                        <img src="<?php echo e(asset('image')); ?>/<?php echo e($image); ?>" class="img-preview" height="150px">
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
                    <span class="title">Referências</span>
                    <ul>
                    <?php if(isset($info['webDetection']['webEntities'])): ?>
                        <?php $__currentLoopData = $info['webDetection']['webEntities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($value['score']) && isset($value['description'])): ?>
                                <li>Score: <?php echo e($value['score']); ?> - <?php echo e($value['description']); ?> </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <li>Nenhuma referencia</li>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>


        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Emoção</span>
                    <ul>
                        <li>Detecção Confiança: <?php if(isset($info['faceAnnotations'][0]['detectionConfidence'])): ?> <?php echo e($info['faceAnnotations'][0]['detectionConfidence']); ?> <?php endif; ?></li>
                        <li>Alegria: <?php if(isset($info['faceAnnotations'][0]['joyLikelihood'])): ?> <?php echo e($info['faceAnnotations'][0]['joyLikelihood']); ?> <?php endif; ?></li>
                        <li>Tristeza: <?php if(isset($info['faceAnnotations'][0]['sorrowLikelihood'])): ?> <?php echo e($info['faceAnnotations'][0]['sorrowLikelihood']); ?> <?php endif; ?></li>
                        <li>Raiva: <?php if(isset($info['faceAnnotations'][0]['angerLikelihood'])): ?> <?php echo e($info['faceAnnotations'][0]['angerLikelihood']); ?> <?php endif; ?></li>
                        <li>Surpreso: <?php if(isset($info['faceAnnotations'][0]['surpriseLikelihood'])): ?> <?php echo e($info['faceAnnotations'][0]['surpriseLikelihood']); ?> <?php endif; ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagens iguais com URL diferentes</span>
                </div>
            </div>
        </div>

        <?php if(isset($info['webDetection']['fullMatchingImages'])): ?>
            <?php $__currentLoopData = $info['webDetection']['fullMatchingImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            <p><?php echo e($value['url']); ?></p>
                            <img src="<?php echo e($value['url']); ?>" class="img-preview" height="150px">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        
        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagens parcialmente</span>
                </div>
            </div>
        </div>
        
        <?php if(isset($info['webDetection']['partialMatchingImages'])): ?>
            <?php $__currentLoopData = $info['webDetection']['partialMatchingImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            <p><?php echo e($value['url']); ?></p>
                            <img src="<?php echo e($value['url']); ?>" class="img-preview" height="150px">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        
        <?php if(isset($info['webDetection']['pagesWithMatchingImages'])): ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <span class="title">Páginas com alguma semelhança</span>
                        <ul>
                            <?php $__currentLoopData = $info['webDetection']['pagesWithMatchingImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($value['url']) && isset($value['pageTitle'])): ?>
                            <li><a href="<?php echo e($value['url']); ?>"><?php echo e($value['url']); ?></a> - <strong><?php echo e($value['pageTitle']); ?></strong> </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <span class="title">Páginas com alguma semelhança</span>
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        
        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagens semelhantes</span>
                </div>
            </div>
        </div>
        
        <?php if(isset($info['webDetection']['visuallySimilarImages'])): ?>
            <?php $__currentLoopData = $info['webDetection']['visuallySimilarImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            <p><?php echo e($value['url']); ?></p>
                            <img src="<?php echo e($value['url']); ?>" class="img-preview" height="150px">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>




    </div>

</body>
<script src="<?php echo e(asset('js/jquery-3.2.1.slim.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>

</html><?php /**PATH C:\Apache24\htdocs\vision\resources\views/check-image-success.blade.php ENDPATH**/ ?>