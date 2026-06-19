<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cow Price Calculator</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #10201a;
            --bg-mid: #17382c;
            --green: #22c55e;
            --mint: #86efac;
            --gold: #f59e0b;
            --cream: #fff7ed;
            --ink: #123026;
            --muted: #647067;
            --white: #ffffff;
            --border: rgba(255, 255, 255, 0.22);
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(134, 239, 172, 0.38), transparent 34rem),
                radial-gradient(circle at bottom right, rgba(245, 158, 11, 0.25), transparent 28rem),
                linear-gradient(135deg, var(--bg-dark), var(--bg-mid));
        }

        .page {
            width: 100%;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .calculator {
            width: min(100%, 980px);
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 26px 70px rgba(0, 0, 0, 0.32);
            animation: riseIn 0.55s ease both;
        }

        .hero {
            position: relative;
            min-height: 560px;
            padding: 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: var(--white);
            background:
                linear-gradient(160deg, rgba(18, 48, 38, 0.2), rgba(18, 48, 38, 0.86)),
                url("https://images.unsplash.com/photo-1516467508483-a7212febe31a?auto=format&fit=crop&w=900&q=80");
            background-size: cover;
            background-position: center;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.52), transparent 62%);
            pointer-events: none;
        }

        .hero > * {
            position: relative;
            z-index: 1;
        }

        .back-link {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.24);
            backdrop-filter: blur(14px);
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .back-link:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.24);
        }

        .hero-copy h1 {
            margin: 0;
            font-size: 46px;
            line-height: 1.05;
            letter-spacing: 0;
        }

        .hero-copy p {
            max-width: 360px;
            margin: 14px 0 0;
            color: rgba(255, 255, 255, 0.84);
            font-size: 16px;
            line-height: 1.65;
        }

        .quick-facts {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .fact {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(12px);
        }

        .fact span {
            display: block;
            color: rgba(255, 255, 255, 0.72);
            font-size: 12px;
        }

        .fact strong {
            display: block;
            margin-top: 5px;
            font-size: 18px;
        }

        .panel {
            padding: 42px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(255, 247, 237, 0.96));
        }

        .badge {
            width: fit-content;
            padding: 8px 12px;
            color: #166534;
            font-size: 13px;
            font-weight: 800;
            border-radius: 999px;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
        }

        h2 {
            margin: 16px 0 8px;
            color: var(--ink);
            font-size: 34px;
            line-height: 1.15;
            letter-spacing: 0;
        }

        .subtitle {
            margin: 0 0 28px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            gap: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #33443b;
            font-size: 14px;
            font-weight: 800;
        }

        .input-wrap {
            position: relative;
        }

        input {
            width: 100%;
            min-height: 56px;
            padding: 15px 52px 15px 16px;
            color: var(--ink);
            border: 1px solid #dbe7df;
            border-radius: 16px;
            outline: none;
            background: var(--white);
            font-size: 16px;
            box-shadow: 0 10px 28px rgba(18, 48, 38, 0.08);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.16), 0 14px 32px rgba(18, 48, 38, 0.1);
            transform: translateY(-1px);
        }

        .suffix {
            position: absolute;
            top: 50%;
            right: 16px;
            color: #6b7d72;
            font-size: 13px;
            font-weight: 800;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            margin-top: 6px;
        }

        button {
            min-height: 56px;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 900;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .calculate-btn {
            color: var(--white);
            background: linear-gradient(135deg, #16a34a, #0f766e);
            box-shadow: 0 16px 30px rgba(22, 163, 74, 0.28);
        }

        .reset-btn {
            min-width: 58px;
            color: #166534;
            background: #dcfce7;
        }

        button:hover {
            transform: translateY(-2px);
        }

        .calculate-btn:hover {
            box-shadow: 0 20px 34px rgba(22, 163, 74, 0.34);
        }

        .result {
            min-height: 128px;
            margin-top: 22px;
            padding: 18px;
            border: 1px solid #dbe7df;
            border-radius: 20px;
            background: var(--white);
            box-shadow: 0 14px 34px rgba(18, 48, 38, 0.09);
        }

        .result.empty {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718078;
            text-align: center;
            font-size: 14px;
            line-height: 1.55;
        }

        .result.error {
            min-height: auto;
            color: #991b1b;
            background: #fef2f2;
            border-color: #fecaca;
            font-weight: 800;
        }

        .result-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .result-card {
            padding: 14px;
            border-radius: 16px;
            background: #f8faf9;
            border: 1px solid #edf2ee;
        }

        .result-card span {
            display: block;
            color: #718078;
            font-size: 12px;
            font-weight: 800;
        }

        .result-card strong {
            display: block;
            margin-top: 8px;
            color: var(--ink);
            font-size: 18px;
            line-height: 1.2;
            overflow-wrap: anywhere;
        }

        .note {
            margin: 16px 0 0;
            color: #6b7d72;
            font-size: 13px;
            line-height: 1.55;
        }

        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 780px) {
            .page {
                min-height: auto;
                padding: 16px;
            }

            .calculator {
                grid-template-columns: 1fr;
                border-radius: 22px;
            }

            .hero {
                min-height: 320px;
                padding: 24px;
            }

            .hero-copy h1 {
                font-size: 36px;
            }

            .panel {
                padding: 26px 20px 24px;
            }

            h2 {
                font-size: 28px;
            }

            .result-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 440px) {
            .page {
                padding: 10px;
            }

            .hero {
                min-height: 270px;
                padding: 18px;
            }

            .hero-copy h1 {
                font-size: 30px;
            }

            .hero-copy p {
                font-size: 14px;
            }

            .quick-facts {
                grid-template-columns: 1fr;
            }

            .panel {
                padding: 22px 14px 18px;
            }

            .actions {
                grid-template-columns: 1fr;
            }

            .reset-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="page">
        <section class="calculator" aria-labelledby="calculator-title">
            <aside class="hero">
                <a class="back-link" href="/">Back Home</a>

                <div class="hero-copy">
                    <h1>Cow Price Calculator</h1>
                    <p>Enter the total price and weight in mon. The calculator will show total kg, per kg price, and per mon price instantly.</p>

                    <div class="quick-facts" aria-label="Quick facts">
                        <div class="fact">
                            <span>Weight unit</span>
                            <strong>1 Mon = 40 kg</strong>
                        </div>
                        <div class="fact">
                            <span>Best for</span>
                            <strong>Market price check</strong>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="panel">
                <div class="badge">Live calculation</div>
                <h2 id="calculator-title">Find the fair cow price</h2>
                <p class="subtitle">Use clean numbers only. Example: price 120000 and weight 8.5 mon.</p>

                <div class="form-grid">
                    <div>
                        <label for="price">Total Price</label>
                        <div class="input-wrap">
                            <input type="number" id="price" placeholder="Example: 120000" min="0" step="0.01" inputmode="decimal">
                            <span class="suffix">TK</span>
                        </div>
                    </div>

                    <div>
                        <label for="mon">Weight</label>
                        <div class="input-wrap">
                            <input type="number" id="mon" placeholder="Example: 8.5" min="0" step="0.01" inputmode="decimal">
                            <span class="suffix">Mon</span>
                        </div>
                    </div>

                    <div class="actions">
                        <button class="calculate-btn" type="button" onclick="calc()">Calculate</button>
                        <button class="reset-btn" type="button" onclick="resetCalc()" aria-label="Reset calculator">Reset</button>
                    </div>
                </div>

                <div class="result empty" id="result">
                    Your calculation result will appear here.
                </div>

                <p class="note">Formula: total kg = mon x 40, per kg = total price / total kg, per mon = total price / mon.</p>
            </div>
        </section>
    </main>

    <script>
        const priceInput = document.getElementById('price');
        const monInput = document.getElementById('mon');
        const result = document.getElementById('result');

        function formatMoney(value) {
            return Number(value).toLocaleString('en-US', {
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            });
        }

        function showEmpty() {
            result.className = 'result empty';
            result.innerHTML = 'Your calculation result will appear here.';
        }

        function calc() {
            const price = parseFloat(priceInput.value);
            const mon = parseFloat(monInput.value);

            if (!Number.isFinite(price) || !Number.isFinite(mon) || price <= 0 || mon <= 0) {
                result.className = 'result error';
                result.innerHTML = 'Please enter valid price and weight greater than 0.';
                return;
            }

            const totalKg = mon * 40;
            const perKg = price / totalKg;
            const perMon = price / mon;

            result.className = 'result';
            result.innerHTML = `
                <div class="result-grid">
                    <div class="result-card">
                        <span>Total KG</span>
                        <strong>${formatMoney(totalKg)} kg</strong>
                    </div>
                    <div class="result-card">
                        <span>Per KG</span>
                        <strong>${formatMoney(perKg)} TK</strong>
                    </div>
                    <div class="result-card">
                        <span>Per Mon</span>
                        <strong>${formatMoney(perMon)} TK</strong>
                    </div>
                </div>
            `;
        }

        function resetCalc() {
            priceInput.value = '';
            monInput.value = '';
            showEmpty();
            priceInput.focus();
        }

        [priceInput, monInput].forEach((input) => {
            input.addEventListener('input', () => {
                if (priceInput.value && monInput.value) {
                    calc();
                } else {
                    showEmpty();
                }
            });
        });
    </script>
</body>

</html>
