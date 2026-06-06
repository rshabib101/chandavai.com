<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attractive Animated Page</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* ব্যাকগ্রাউন্ড ক্যানভাস স্টাইল */
        #particle-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        }

        /* অনবরত সুন্দর অ্যানিমেশন (Float Effect) */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-btn {
            display: inline-block;
            transition: all 0.3s ease-in-out;
        }

        /* একেকটি বাটনের জন্য আলাদা টাইম ডিলে যাতে দেখতে সুন্দর লাগে */
        .animate-btn:nth-child(1) {
            animation: float 3s ease-in-out infinite;
        }

        .animate-btn:nth-child(2) {
            animation: float 3.2s ease-in-out infinite 0.2s;
        }

        .animate-btn:nth-child(3) {
            animation: float 2.8s ease-in-out infinite 0.4s;
        }

        .animate-btn:nth-child(4) {
            animation: float 3.5s ease-in-out infinite 0.1s;
        }

        .animate-btn:nth-child(5) {
            animation: float 3.1s ease-in-out infinite 0.3s;
        }

        .animate-btn:nth-child(6) {
            animation: float 2.9s ease-in-out infinite 0.5s;
        }

        .animate-btn:nth-child(7) {
            animation: float 3.3s ease-in-out infinite 0.2s;
        }

        .animate-btn:nth-child(8) {
            animation: float 3.4s ease-in-out infinite 0.6s;
        }

        /* হোভার করলে গ্লো এবং বড় হওয়ার ইফেক্ট */
        .animate-btn:hover {
            transform: scale(1.1) translateY(-5px) !important;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center m-0 p-4 overflow-x-hidden">

    <canvas id="particle-canvas"></canvas>

    <div class="max-w-4xl mx-auto text-center px-4 py-8 z-10">

        <h1 class="text-white text-3xl md:text-4xl font-extrabold mb-10 tracking-wide drop-shadow-md">
            Welcome to Dashboard
        </h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 justify-center items-center">

            <a href="/cow" class="animate-btn text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-blue-500/50">
                Cow
            </a>

            <a href="/survey" class="animate-btn text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-green-500/50 cursor-pointer">
                Survey
            </a>

            <a href="/fifa" class="animate-btn text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-cyan-500/50 cursor-pointer">
                Fifa Fixture 2026
            </a>

            <a href="/" class="animate-btn text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-teal-500/50 cursor-pointer">
                Home
            </a>

            <a href="#" class="animate-btn text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-lime-500/50 cursor-pointer">
                Lime
            </a>

            <a href="#" class="animate-btn text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-red-500/50 cursor-pointer">
                Red
            </a>

            <a href="#" class="animate-btn text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-pink-500/50 cursor-pointer">
                Pink
            </a>

            <a href="#" class="animate-btn text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-xl text-sm px-5 py-3 text-center shadow-lg shadow-purple-500/50 cursor-pointer">
                Purple
            </a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <script>
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');

        let particlesArray;

        // ক্যানভাস সাইজ স্ক্রিন অনুযায়ী সেট করা
        function setCanvasSize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        setCanvasSize();

        // কণার অবজেক্ট তৈরি
        class Particle {
            constructor(x, y, directionX, directionY, size, color) {
                this.x = x;
                this.y = y;
                this.directionX = directionX;
                this.directionY = directionY;
                this.size = size;
                this.color = color;
            }
            // কণা আঁকা
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                ctx.fillStyle = this.color;
                ctx.fill();
            }
            // কণা নড়াচড়া করানো
            update() {
                if (this.x > canvas.width || this.x < 0) {
                    this.directionX = -this.directionX;
                }
                if (this.y > canvas.height || this.y < 0) {
                    this.directionY = -this.directionY;
                }
                this.x += this.directionX;
                this.y += this.directionY;
                this.draw();
            }
        }

        // কণার অ্যারে তৈরি
        function init() {
            particlesArray = [];
            let numberOfParticles = (canvas.width * canvas.height) / 9000; // স্ক্রিন অনুযায়ী কণার সংখ্যা নির্ধারণ
            for (let i = 0; i < numberOfParticles; i++) {
                let size = (Math.random() * 3) + 1;
                let x = (Math.random() * ((innerWidth - size * 2) - size * 2)) + size * 2;
                let y = (Math.random() * ((innerHeight - size * 2) - size * 2)) + size * 2;
                let directionX = (Math.random() * 0.5) - 0.25;
                let directionY = (Math.random() * 0.5) - 0.25;
                let color = 'rgba(255, 255, 255, ' + (Math.random() * 0.5 + 0.2) + ')';

                particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
            }
        }

        // অ্যানিমেশন লুপ
        function animate() {
            requestAnimationFrame(animate);
            ctx.clearRect(0, 0, innerWidth, innerHeight);

            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
            }
        }

        // স্ক্রিন রিসাইজ করলে ক্যানভাস ঠিক করা
        window.addEventListener('resize', function() {
            setCanvasSize();
            init();
        });

        init();
        animate();
    </script>
</body>

</html>