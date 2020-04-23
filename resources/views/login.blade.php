<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scum Nation || E-Store</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
								margin-bottom: 200px;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <style>
			body{
    		background-color: #1E242B;
			}

			p {
				font-size: 18px;
				color: white;
			}

			img {
				height: 250px;
			}

			#title{
				font-size: 28px;
				font-weight: bold;
			}
			#message {
				font-size: 24px;
				font-weight: bold;
			}
			span {
				font-weight: bold;
				color: #FF6C1B;
			}
    </style>
        <div class="flex-center position-ref full-height">
            <div class="content">
						<img src='/images/logo.svg' />
                <div class="title m-b-md">
                    @if($data['isLoggedIn'] == True)
                        <p id="title">Succesfully Logged in.</br> You will be redirected automatically.</p>
                    @else
                        <p id="title">Login Failed.</p>
                        <p id="message">{!! $data['message'] !!}</p>
                        <p><b>You will be redirected automatically.</b><p>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
