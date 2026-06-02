<!DOCTYPE html>
<html>

<head>
    <title>Envele Reseller Program</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
        }

        .container {
            max-width: 650px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #111;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #1877f2;
            box-shadow: 0 0 5px rgba(24, 119, 242, 0.2);
        }

        textarea {
            resize: none;
            height: 100px;
        }

        label {
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1877f2, #0d6efd);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(24, 119, 242, 0.3);
        }

        .success {
            text-align: center;
            color: green;
            margin-bottom: 10px;
        }

        .note {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>🖤 Envele Apparel Reseller Program</h2>

        <p class="note">Fill all information carefully to join our reseller program</p>

        @if(session('success'))
        <p class="success">{{ session('success') }}</p>
        @endif

        <form method="POST" action="/survey/store">
            @csrf

            <label>Full Name</label>
            <input type="text" name="full_name" required>

            <label>Mobile Number (WhatsApp)</label>
            <input type="text" name="mobile" required>

            <label>Facebook Profile Link</label>
            <input type="text" name="facebook" required>

            <label>District / Area</label>
            <input type="text" name="district" required>

            <label>Profession</label>
            <select name="profession" required>
                <option value="">Select</option>
                <option>Student</option>
                <option>Job Holder</option>
                <option>Business Owner</option>
                <option>Freelancer</option>
                <option>Housewife</option>
            </select>

            <label>Have you done online business before?</label>
            <select name="business_before" required>
                <option value="">Select</option>
                <option>Yes</option>
                <option>No</option>
            </select>

            <label>Platform</label>
            <select name="platform" required>
                <option value="">Select</option>
                <option>Facebook</option>
                <option>TikTok</option>
                <option>Instagram</option>
                <option>Shop</option>
            </select>

            <label>Product Interest</label>
            <select name="product" required>
                <option value="">Select</option>
                <option>Old Money Polo</option>
                <option>Oversized T-shirt</option>
                <option>Jersey</option>
            </select>

            <label>Monthly Target</label>
            <select name="monthly_target" required>
                <option value="">Select</option>
                <option>10–20 pcs</option>
                <option>20–50 pcs</option>
                <option>100–200 pcs</option>
            </select>

            <label>Stock Type</label>
            <select name="stock_type" required>
                <option value="">Select</option>
                <option>Yes</option>
                <option>No</option>
                <option>Pre-Order</option>
            </select>

            <label>Package Selection</label>
            <select name="package" required>
                <option value="">Select</option>
                <option>Starter</option>
                <option>Silver</option>
                <option>Gold</option>
                <option>Dealer</option>
            </select>

            <label>Why do you want to join us?</label>
            <textarea name="reason" required></textarea>

            <label>
                <input type="checkbox" name="agreement" value="1" required>
                I agree to all rules & policies
            </label>

            <br><br>

            <button type="submit">🚀 Submit Application</button>

        </form>

    </div>

</body>

</html>