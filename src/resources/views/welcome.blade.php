<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stellantis - Requests</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #243782;
            color: white;
            padding: 2px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        #id1 {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            text-transform: capitalize;
            letter-spacing: 3px;
            font-weight: 700;
            margin: 15px;
            transition: transform 0.3s ease;
        }

        #id1:hover {
            transform: translateY(-2px);
        }

        #id1 span {
            color: #90ebe398;
            font-weight: bold;
            font-size: 2rem;
        }

        .logo {
            width: 150px;
            height: 40px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .main-content {
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            padding: 60px 0;
        }

        .title h2 {
            font-size: 28px;
            color: #243782;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .title h2::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            bottom: -10px;
            left: 0;
            background: linear-gradient(to right, #243782, #90ebe398);
            transform: scaleX(0);
            transform-origin: left;
            animation: underline 1.5s ease-out forwards;
        }

        @keyframes underline {
            to {
                transform: scaleX(1);
            }
        }

        .title::before,
        .title::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 2px;
            background-color: #243782;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.3;
        }

        .title::before {
            left: 20%;
        }

        .title::after {
            right: 20%;
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .request-button {
            background-color: #243782;
            color: white;
            padding: 20px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 18px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(36, 55, 130, 0.2);
        }

        .request-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .request-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(36, 55, 130, 0.3);
        }

        .request-button:hover::before {
            left: 100%;
        }

        @media (max-width: 768px) {
            .logo {
                width: 120px;
            }

            .request-button {
                width: 90%;
                padding: 15px 30px;
            }

            .title::before,
            .title::after {
                width: 30px;
            }

            .title::before {
                left: 10%;
            }

            .title::after {
                right: 10%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#" id="id1"><span>RE</span><br>quests</a>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Stellantis Logo">
        </div>
    </div>

    <div class="main-content">
        <div class="title">
            <h2>Créez votre demande</h2>
        </div>

        <div class="buttons-container">
            <a href="./demande" class="request-button">Ici</a>
        </div>
    </div>
</body>
</html>