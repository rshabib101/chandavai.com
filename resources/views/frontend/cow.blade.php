<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cow Price Calculator</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CARD */
        .card {
            width: 420px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            color: white;
            animation: fadeIn 0.6s ease-in-out;
        }

        /* TITLE */
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* INPUT */
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            transform: scale(1.03);
            box-shadow: 0 0 10px #38bdf8;
        }

        /* BUTTON */
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #06b6d4, #3b82f6);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #38bdf8;
        }

        /* RESULT */
        .result {
            margin-top: 15px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            font-size: 15px;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* ANIMATION */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>

<body>

    <div class="card">
        <h2>🐄 Cow Price Calculator</h2>

        <!-- INPUTS (MON BASED) -->
        <input type="number" id="price" placeholder="Total Price (TK)">
        <input type="number" id="mon" placeholder="Weight (Mon = 40kg)">

        <button onclick="calc()">Calculate</button>

        <div class="result" id="result"></div>
    </div>

    <script>
        function calc() {
            let price = parseFloat(document.getElementById('price').value);
            let mon = parseFloat(document.getElementById('mon').value);

            if (!price || !mon) {
                document.getElementById('result').innerHTML =
                    "⚠ Please enter valid values!";
                return;
            }

            let totalKg = mon * 40;

            let perKg = price / totalKg;
            let perMon = price / mon;

            document.getElementById('result').innerHTML =
                "📦 Total KG: " + totalKg + " kg<br>" +
                "💰 Per KG: " + perKg.toFixed(2) + " TK<br>" +
                "🐄 Per Mon: " + perMon.toFixed(2) + " TK";
        }
    </script>

</body>

</html>