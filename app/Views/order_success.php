<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .checkmark-circle {
            width: 150px;
            height: 150px;
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin: 20px auto;
        }
        .checkmark-circle .background {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #28a745;
            position: absolute;
        }
        .checkmark-circle .checkmark {
            border-radius: 5px;
        }
        .checkmark-circle .checkmark.draw:after {
            -webkit-animation-delay: 100ms;
            -moz-animation-delay: 100ms;
            animation-delay: 100ms;
            -webkit-animation-duration: 2s;
            -moz-animation-duration: 2s;
            animation-duration: 2s;
            -webkit-animation-timing-function: ease;
            -moz-animation-timing-function: ease;
            animation-timing-function: ease;
            -webkit-animation-name: checkmark;
            -moz-animation-name: checkmark;
            animation-name: checkmark;
            -webkit-transform: scaleX(-1) rotate(135deg);
            -moz-transform: scaleX(-1) rotate(135deg);
            transform: scaleX(-1) rotate(135deg);
            -webkit-animation-fill-mode: forwards;
            -moz-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }
        .checkmark-circle .checkmark:after {
            opacity: 1;
            height: 75px;
            width: 37.5px;
            -webkit-transform-origin: left top;
            -moz-transform-origin: left top;
            transform-origin: left top;
            border-right: 15px solid white;
            border-top: 15px solid white;
            border-radius: 2.5px !important;
            content: '';
            left: 25px;
            top: 75px;
            position: absolute;
        }

        @keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }
            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }
            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }
        
        .fade-in {
            animation: fadeIn 1.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col items-center justify-center min-h-screen text-center p-4">

    <div class="checkmark-circle mb-6">
        <div class="background"></div>
        <div class="checkmark draw"></div>
    </div>

    <div class="fade-in">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Order Placed Successfully!</h1>
        <p class="text-gray-600 text-lg mb-8">Thank you for your order. Your food is being prepared.</p>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto mb-8 border-l-4 border-green-500 text-left">
            <h2 class="text-xl font-semibold mb-2 text-gray-800">Delivery Estimate</h2>
            <div class="flex items-center text-gray-700">
                <i class="fas fa-clock text-green-500 mr-3 text-2xl"></i>
                <span class="text-3xl font-bold">35 - 45</span>
                <span class="ml-2 text-xl self-end mb-1">mins</span>
            </div>
            <p class="text-xs text-gray-400 mt-2">Time may vary due to traffic or weather conditions.</p>
        </div>

        <div class="space-x-4">
            <a href="<?= base_url() ?>" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-full font-bold hover:bg-gray-300 transition">
                Back to Home
            </a>
            <a href="<?= base_url('profile') ?>" class="bg-green-600 text-white px-6 py-3 rounded-full font-bold hover:bg-green-700 shadow-lg hover:shadow-xl transition">
                Track Order
            </a>
        </div>
    </div>

</body>
</html>
