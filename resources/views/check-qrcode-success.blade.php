<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRCODE</title>

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
                        <img src="{{asset('storage')}}/{{$image}}" class="img-preview" height="150px">
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
                            @foreach ($items as $key => $value)
                            <tr>
                                <td>{{$value['code']}}</td>
                                <td>{{$value['title']}}</td>
                                <td>{{$value['qtd']}}</td>
                                <td>{{$value['price']}}</td>
                                <td>{{$value['total']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

</html>