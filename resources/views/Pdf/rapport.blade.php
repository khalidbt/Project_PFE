<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>



        body {
            top: 0px;
            left: 0px;
            width: 2480px;
            height: 3508px;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            opacity: 1;

            display:flex;
            flex-direction: column;
        }

        p {
            margin-left: 70px;
            margin-right: 70px;

        }


        h1 h2 h3 h4 h5 {
            margin-left: 70px;
            margin-right: 70px;
        }
        .wrapper {

            /* Layout Properties */
            top: 0px;
            left: 0px;
            width: 2480px;
            height: 3508px;

            /* UI Properties */
            background: #FFFFFF 0% 0% no-repeat padding-box;
            opacity: 1;


        }
        .logo {

            opacity: 1;


            width: 1984px;
            height: 200px;
            margin-left: 70px;
            margin-right: 7000px;

        }

        #logoImage {
            float: left;

            /* Layout Properties */


            width: 520px;
            height: 205px;
            /* UI Properties */
            opacity: 1;
        }

        #order-Initial-Info{


            margin-top: 50px ;
            height: 200px;
            margin-left: 70px;
            width: 1984px;
            margin-bottom: 0px;
            padding-bottom: 0px;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;

        }
        #paragraph1 {
            float: left;

            margin: 0px;
        }

        #paragraph2 {
            float: right;
            text-align: right;
            margin : 0px;

        }

        .titles {
            margin-top: 20px;

        }


        .titles h1 {
            top: 286px;
            left: 249px;
            width: 535px;
            height: 112px;
            /* UI Properties */
            text-align: left;

            letter-spacing: 0px;
            color: #161615;
            opacity: 1;
            display: inline;
            margin-top: 160px;
            margin-left: 100px;
            padding-bottom: 10px;
        }
        .titles h2 {

            /* Layout Properties */
            top: 394px;
            left: 247px;
            width: 1516px;
            height: 71px;
            /* UI Properties */
            text-align: left;

            letter-spacing: 0px;
            color: #8A8A8A;
            opacity: 1;
            margin-left: 70px;
            padding-top: 0px;
            margin-top: 0px;
        }

        #greeting {
            /* Layout Properties */
            top: 596px;
            left: 247px;
            width: 800px;
            height: 56px;
            /* UI Properties */
            text-align: left;
            font-weight: bold;
            letter-spacing: 0px;
            color: #272727;
            opacity: 1;
            font-size: 50px;
            margin-top: 40px;
            padding-top: 0px;
            padding-bottom: 0px;
            margin-bottom: 0px;
            margin-left: 100px;
        }

        #subject{


            left: 247px;
            width: 1156px;

            text-align: left;
            margin-left: 100px;
            letter-spacing: 0px;
            color: #333333;
            opacity: 1;
            padding-top: 0px;
            margin-top: 0px;
            padding-bottom: 0px;
        }
        .order-info {
            /* Layout Properties */

            width: 1984px;
            /*  height: 1000px;*/
            /* UI Properties */
            background: #F1F1F1 0% 0% no-repeat padding-box;
            border-radius: 6px;
            opacity: 1;
            margin-left: 70px;
            margin-right: 70px;
            padding: 30px;
            padding-bottom: 20px;
        }

        #footer{
            position:absolute;
            bottom: 0;
            height: 500px;

            width:  1984px;
            margin-left: 70px;
        }
        #other-info{

            height: 500px;

            width:  1984px;
            margin-left: 70px;
            margin-top: 100px;

        }

        .qrCode {
            /* Layout Properties */
            top: 827px;
            left: 1746px;
            width: 387px;
            height: 387px;
            /* UI Properties */
            background: white;
            box-shadow: 0px 3px 6px #00000029;
            border-radius: 4px;
            opacity: 1;
            float: right;
            display: flex;
            justify-content: center;
            margin-right: 70px;
            margin-top: 50px;
            text-align: center;


        }

        #qrcode {

            width: 350px;
            height: 350px;
            margin: 0 auto;
            position: center;
            margin-top: 20px;



        }

        #qrContainer{

            border-radius: 4px;
            opacity: 1;
            float: right;
            display: flex;
            justify-content: center;

            text-align: center;
            font-size: 40px;
            width: 700px;
            height: 600px;

        }

    </style>
</head>
<body>

<div class="wrapper">

    <?php  $extencion = 'png';
    $data = file_get_contents($logoImage);
    $img_base_64 = base64_encode($data);
    $path_img = 'data:image/' . $extencion . ';base64,' . $img_base_64;

    $data = file_get_contents($imageQr);
    $img_base_64 = base64_encode($data);
    $qrCode = 'data:image/' . $extencion . ';base64,' . $img_base_64;
    ?>
    <div class="logo"><img id="logoImage"  src="{{$path_img}}"  alt="logo"/></div>
    <div id="order-Initial-Info">


        <p id="paragraph1">Firma {{$company}} <br> {{$street}} <br> {{$zip_code." ". $city}} </p>
        <p id="paragraph2">Buchungsdatum: {{$created_at}} <br> Reservierungsdatum: {{$date}}</p>

    </div>

    <div class="titles">
        <h1>Reservierungsbestätigung</h1>
    </div>
    <div class="msg-Body">
        <p id="greeting">Hallo {{$salutation." ".$customer['last_name']}} ,</p>
        <p id="subject">wir bestätigen Ihnen hiermit Ihre Reservierung in unserem Haus.</p>
        <div class="order-info">
            <div id="qrContainer">
                <div class="qrCode"><img id="qrcode"  src="{{$qrCode}}"  alt="logo"/> </div>
            </div>
            <div class="orderInfo1">
                <p style="font-weight: bold ; font-size: 50px"> Buchungsinformationen: </p>
                <p>Name: {{$customer['first_name']." ".$customer['last_name']}} <br> Datum: {{$date}} <br> Uhrzeit: {{$time}} Uhr <br>Anzahl der Personen: {{$reservation->person}} </p>

            </div>

            <div class="items" >
                @if(count($items) > 0)
                    <p style="font-weight: bold ; font-size: 50px ; padding-bottom: 0px ; margin-bottom: 0px"> Artikel: </p>

                    @php $count = 0;@endphp
                    <div class="item" style="padding-top: 10px ; margin-top: 10px;">
                        <p style="padding-top: 10px ; margin-top: 10px">
                            @foreach ($items as $item)
                                @php $count++ @endphp

                                {{$item['quantity']}}.X.{{$item['name']}} - {{$item['price']}}€ <br>
                            @endforeach
                        </p>
                    </div>
                @endif

                @if(count($taxes) > 0)
                    <p>
                        <b>Zu zahlender Betrag</b>
                    </p>

                    @php $count = 0;@endphp
                    <div class="item" style="padding-top: 10px ; margin-top: 10px;">
                        <p style="padding-top: 10px ; margin-top: 10px">


                            @foreach ($taxes as $tax)
                                @php $count++ @endphp

                                {{$tax['name']}} : {{$tax['total']}} € <br>
                            @endforeach


                            <b> Gesamtbertag</b> <b> {{$total}}</b>


                        </p>

                    </div>
                @endif

            </div>

        </div>
    </div>
    <div id="other-info">

        <p>Wir wünschen Ihnen einen angenehmen Aufenthalt in unserem Haus.</p> <p>Mit freundlichen Grüßen </p><p style="font-weight: bold"> Team {{$company}}</p>
    </div>
    <div id="footer">
        <div style="width: 700px ; margin-left: 650px ; border-bottom: 1px solid black"></div>
        <p style="text-align: center">Bitte beachten Sie, dass Ihre Reservierung mit diesem Schreiben verbindlich ist. Sollten Sie Ihre Buchung stornieren wollen, geben Sie uns bitte unverzüglich bescheid. Bei mehrmaligem nicht Erscheinen, mit Reservierung, können Sie für diesen Service gesperrt werden.</p>
        <p style="font-weight: bold ; position : absolute; bottom: 0 ; text-align: center ; left: 30% ; right: 30%">powered by: 3POS GmbH</p>
    </div>
</div>
</body>
</html>
