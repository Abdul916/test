<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            min-height: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 25px solid #333333;
            text-align: center;
            border-radius: 0px;
        }
        .footer {
            background-color: #333333;
            color: #ffffff;
            font-size: 14px;
            line-height: 1.5;
            margin-top: 50px;
            text-align: left;
            padding-top: 2px;
            padding-bottom: 2px;
        }
        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <a href="http://localhost/sharingsugar_latest" target="_blank">
                <img src="http://localhost/sharingsugar_latest/assets/images/favicon.png" border="0" alt="sharingsugar_latest" style="padding:25px 25px 25px 25px; width:200px;">
            </a>
        </div>
        <div class="content" style="padding:0px 50px 0px 50px;">
            <p>Hello <strong>{{user_name}}</strong>,</p>
            <p>Femme Rose just visit your profile</p>
            <a href="">Visit Profile</a>
            <p>If you have any questions, please do not hesitate to contact us. You can refer to our contact page here:</p>
            <a href="">Contact us</a>
            <p><strong>Thank You !</strong></p>
            <p><strong>Sharing Sugar</strong></p>
        </div>
        <div class="footer">
            <br><strong>Organization: <a href="#">Sharing Sugar</a></strong><br>
            <strong>Location: 641 E San Ysidro Blvd B3328, San Ysidro CA, 92173</strong><br>
            <strong>If you want to unsubscribe <a href="#">Click here</a></strong>
        </div>
    </div>
</body>
</html>




