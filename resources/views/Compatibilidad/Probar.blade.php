<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div class="grid grid-cols-5">
            
            <div>
                NOMBRE
            </div>
            <div>
                CUACK DAR
            </div>
            <div>
                JUGO RECIBIR
            </div>
            <div>
                JUGO DAR
            </div>
            <div>
                CUACK RECIBIR
            </div>
        
            @foreach($lenguajes as $leng)
                @php
                    $objPuntuacion_persona1 = $cuack->getPuntuacionObj($leng);
                    $objPuntuacion_persona2 = $jugo->getPuntuacionObj($leng);
                @endphp 

                <div>
                    {{$leng->nombre}}
                </div>
                <div>
                    {{$objPuntuacion_persona1->puntajeDar}}
                </div>
                <div>
                    {{$objPuntuacion_persona2->puntajeRecibir}}
                </div>
                <div>
                    {{$objPuntuacion_persona2->puntajeDar}}
                </div>
                <div>
                    {{$objPuntuacion_persona1->puntajeRecibir}}
                </div>
                
            @endforeach

  
        
    </div>

    LA COMPATIBILIDAD ES DE: 
    {{ json_encode($jugo->calcularCompatibilidad($cuack)  ) }}
    <br>
    {{ json_encode ( $cuack->calcularCompatibilidad($jugo) )}}
    
    


</body>

<style>

    .flex{
        display: flex
    }

</style>
</html>