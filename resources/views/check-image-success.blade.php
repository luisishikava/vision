<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vision Google</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}?" rel="stylesheet">

</head>

<body>
    <div id="vision" class="container mg-top-40">

        <h1>Resultado API</h1>

        <div class="card-group">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagem</span>
                    <div class="text-center">
                        <p>{{$image}}</p>
                        <img src="{{asset('image')}}/{{$image}}" class="img-preview" height="150px">
                    </div>
                </div>
            </div>

            <div class="card column c-md">
                <div class="card-block">
                    <span class="title">Quantidade Caracteres</span>
                    <div class="text-center qty-chac">
                        <p>{{$countString}}</p>
                    </div>
                </div>
            </div>

            <div class="card column">
                <div class="card-block">
                    <span class="title">Linguagem</span>
                    <div class="text-center">
                    <ul>
                        @if (isset($fullText))
                            @foreach ($fullText->info()['pages'][0]["property"]["detectedLanguages"] as $key => $value)
                                @if (isset($value['languageCode']) && isset($value['confidence']))
                                    <li>{{ $value['languageCode']}} - {{$value['confidence'] }} </li>
                                @endif
                            @endforeach
                        @else
                            <li>Nenhuma referencia</li>
                        @endif
                        </ul>
                   
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Strings coletadas da Imagem</span>
                    @if (isset($fullText))
                        <textarea class="form-control" rows="5">{{var_dump($fullText->text())}}</textarea>
                    @else
                        <li>Nenhuma string encontrada</li>
                    @endif
                </div>
            </div>
        </div>
        

        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Referências</span>
                    <ul>
                    @if (isset($info['webDetection']['webEntities']))
                        @foreach ($info['webDetection']['webEntities'] as $key => $value)
                            @if (isset($value['score']) && isset($value['description']))
                                <li>Score: {{ $value['score']}} - {{$value['description'] }} </li>
                            @endif
                        @endforeach
                    @else
                        <li>Nenhuma referencia</li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>


        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Emoção</span>
                    <ul>
                        <li>Detecção Confiança: @if(isset($info['faceAnnotations'][0]['detectionConfidence'])) {{$info['faceAnnotations'][0]['detectionConfidence']}} @endif</li>
                        <li>Alegria: @if(isset($info['faceAnnotations'][0]['joyLikelihood'])) {{$info['faceAnnotations'][0]['joyLikelihood']}} @endif</li>
                        <li>Tristeza: @if(isset($info['faceAnnotations'][0]['sorrowLikelihood'])) {{$info['faceAnnotations'][0]['sorrowLikelihood']}} @endif</li>
                        <li>Raiva: @if(isset($info['faceAnnotations'][0]['angerLikelihood'])) {{$info['faceAnnotations'][0]['angerLikelihood']}} @endif</li>
                        <li>Surpreso: @if(isset($info['faceAnnotations'][0]['surpriseLikelihood'])) {{$info['faceAnnotations'][0]['surpriseLikelihood']}} @endif</li>
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

        @if(isset($info['webDetection']['fullMatchingImages']))
            @foreach ($info['webDetection']['fullMatchingImages'] as $value)
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            <p>{{$value['url']}}</p>
                            <img src="{{$value['url']}}" class="img-preview" height="150px">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        
        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagens parcialmente</span>
                </div>
            </div>
        </div>
        
        @if(isset($info['webDetection']['partialMatchingImages']))
            @foreach ($info['webDetection']['partialMatchingImages'] as $value)
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            <p>{{$value['url']}}</p>
                            <img src="{{$value['url']}}" class="img-preview" height="150px">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        
        @if(isset($info['webDetection']['pagesWithMatchingImages']))
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <span class="title">Páginas com alguma semelhança</span>
                        <ul>
                            @foreach ($info['webDetection']['pagesWithMatchingImages'] as $key => $value)
                            @if (isset($value['url']) && isset($value['pageTitle']))
                            <li><a href="{{ $value['url']}}">{{ $value['url']}}</a> - <strong>{{$value['pageTitle'] }}</strong> </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @else
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
        @endif

        
        <div class="card-group mg-top-20">
            <div class="card column">
                <div class="card-block">
                    <span class="title">Imagens semelhantes</span>
                </div>
            </div>
        </div>
        
        @if(isset($info['webDetection']['visuallySimilarImages']))
            @foreach ($info['webDetection']['visuallySimilarImages'] as $value)
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            <p>{{$value['url']}}</p>
                            <img src="{{$value['url']}}" class="img-preview" height="150px">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="card-group mg-top-20">
                <div class="card column">
                    <div class="card-block">
                        <div class="text-center">
                            Nenhuma imagem encontrada.
                        </div>
                    </div>
                </div>
            </div>
        @endif




    </div>

</body>
<script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

</html>