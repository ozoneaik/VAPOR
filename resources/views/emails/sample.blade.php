{{-- <p>{{ $content['body'] }}</p> --}}


    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Sarabun', sans-serif;
        }

        .my-button {
            height: 50px;
            width: 190px;
            border: none;
            border-radius: 10px;
            background-color: #fddd4e;
            font-weight: bold;
            color: black;
            font-size: 18px
        }
        .my-button:hover {
            background-color: #dab500; /* Change the background color on hover */
            color: white;
        }
    </style>
</head>
<body>
<div class="" style="background-color: #ededed;">

    <div class="card">
        <div class="header" style="background-color: #35a0da;padding: 10px;padding-left: 50px;border-radius: 10px 10px 0 0">
            <img width="100px" src="https://scontent.fbkk5-7.fna.fbcdn.net/v/t39.30808-6/298810071_567987751663058_9009200209719869804_n.png?_nc_cat=108&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=1oBnPPqjSIMAX_7eXMh&_nc_ht=scontent.fbkk5-7.fna&oh=00_AfAXASf9ZhSL9gWlsv-v5UuI417WrBksCeo_lnUqzBW-Rw&oe=65280CCA" alt="">
        </div>
        <div class="" style="background-color: white;padding:50px;border-radius: 0px 0px 10px 10px;">
            <h1 style="margin-bottom: 1rem;color: #022EAC">ระบบการลาบริษัท<br>BIG DATA AGENCY CO., LTD.</h1>
            <h1 style="margin-bottom: 1rem;color: #333333"></h1>

            <p style="color: gray">เวลา : {{ \Carbon\Carbon::now()->format('d/m/Y H:i น.') }}</p>

            <p style="margin-bottom: 1.5rem">{{ $content['body'] }}</p>
            <a href="{{$content['route']}}" target="_blank">
                <button class="my-button">เข้าสู่เว็บไซต์</button>
            </a>

{{--            <a href="" target="_blank">--}}
{{--                <button class="my-button">เข้าสู่เว็บไซต์</button>--}}
{{--            </a>--}}
        </div>
    </div>
</div>

</body>
</html>

