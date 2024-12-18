
@extends('layouts.app')

@section('title','Welcome')

@section('content')

    <body>
        <div style="background-image: url(https://static.vecteezy.com/system/resources/previews/004/511/333/large_2x/abstract-technological-background-business-futuristic-innovation-background-vector.jpg);
        width: 100%;
        height: 80%;
        margin: 0 auto;
        background-size:cover;
        background-repeat: no-repeat;
        display: flex;
        position: absolute;
        background-position:center;"
        class="d-flex justify-content-around">
            <div style="float: left;  margin-top: 10%; ">
                <p style="font-family: 'Times New Roman'; text-align: center; font-size: 35px;">Sistema Deportes de Colcapirhua <br> </p>

                <p style="font-family: 'Times New Roman'; text-align: center; font-size: 25px;">Nuestro sistema ofrece la posibilidad de inscripciones a las distintas disciplinas deportivas  <br>De una manera mas sencilla y comoda... <br> Realiza tu inscripcion cuando quieras y donde quieras!!!</p>
            </div>
            <div style="float: left; padding-top: 12%" >
                <img src="{{asset('images/deportes.jpg')}}" alt="" style="border-radius: 10px; position: relative; width:100%; max-width:400px;">
            </div>

        </div >

        <div class="d-flex justify-content-sm-between" style="background-color: #1D3354;  display: flex; margin: 0 auto;
        position:fixed;
        width: 100%;
        height:100%;
        top: 90%;">
            <div style="padding-left: 2%; padding-top: 1%;">
                <p style="font-family: 'Times New Roman'; text-align:initial; color:white; ">
                Gobierno Autonomo Municipal Colcapirhua.<br> Cochabamba-Bolivia </p>
            </div>

            <div style="padding-top:1%">
                <img src="{{asset('images/logocolca.jpg')}}" width="40" height="60"  alt="">

            </div>

            <div style="padding-right: 2%; padding-top: 0.3%;">
                <p style="font-family: 'Times New Roman'; text-align:initial; color:white; ">
                    Calle Sucre  Plaza 15 de abril <br> Contactenos: 4467345</p>

            </div>
        </div>


    </body>
@endsection
