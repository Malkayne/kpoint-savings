<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPoint Savings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            overflow-x: hidden;
            font-family: 'Arial', sans-serif;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .balloon {
            position: absolute;
            font-size: 3rem;
            animation: floatUpDown 3s ease-in-out infinite;
            z-index: 10;
        }

        .balloon:nth-child(odd) {
            animation-delay: -1.5s;
        }

        @keyframes floatUpDown {
            0%, 100% { transform: translateY(0px) rotate(-2deg); }
            50% { transform: translateY(-30px) rotate(2deg); }
        }

        .balloon-red { color: #ff4757; left: 10%; animation-duration: 2.5s; }
        .balloon-blue { color: #3742fa; left: 20%; animation-duration: 3.2s; }
        .balloon-green { color: #2ed573; left: 30%; animation-duration: 2.8s; }
        .balloon-yellow { color: #ffa502; left: 40%; animation-duration: 3.5s; }
        .balloon-purple { color: #a55eea; left: 50%; animation-duration: 2.3s; }
        .balloon-pink { color: #ff3838; left: 60%; animation-duration: 3.1s; }
        .balloon-orange { color: #ff6348; left: 70%; animation-duration: 2.9s; }
        .balloon-cyan { color: #1dd1a1; left: 80%; animation-duration: 3.3s; }

        .marquee-container {
            background: rgba(255, 255, 255, 0.9);
            border: 3px solid #ff6b6b;
            border-radius: 15px;
            margin: 20px 0;
            padding: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .marquee {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            animation: scroll-left 15s linear infinite;
        }

        @keyframes scroll-left {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .flying-element {
            position: absolute;
            animation: flyAround 6s ease-in-out infinite;
            font-size: 2.5rem;
            z-index: 5;
        }

        @keyframes flyAround {
            0% { transform: translateX(-100px) translateY(0px) rotate(0deg); }
            25% { transform: translateX(200px) translateY(-50px) rotate(90deg); }
            50% { transform: translateX(400px) translateY(20px) rotate(180deg); }
            75% { transform: translateX(200px) translateY(50px) rotate(270deg); }
            100% { transform: translateX(-100px) translateY(0px) rotate(360deg); }
        }

        .trophy { color: #f39c12; top: 20%; animation-delay: 0s; }
        .star { color: #e74c3c; top: 40%; animation-delay: -2s; }
        .diamond { color: #9b59b6; top: 60%; animation-delay: -4s; }

        .celebration-text {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ff6b6b;
            animation: confettiFall 3s linear infinite;
        }

        @keyframes confettiFall {
            0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }

        .confetti:nth-child(2n) { background: #4ecdc4; animation-delay: -0.5s; }
        .confetti:nth-child(3n) { background: #45b7d1; animation-delay: -1s; }
        .confetti:nth-child(4n) { background: #96ceb4; animation-delay: -1.5s; }
        .confetti:nth-child(5n) { background: #feca57; animation-delay: -2s; }

        .savings-badge {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.5rem;
            font-weight: bold;
            animation: bounce 1s ease infinite;
            display: inline-block;
            margin: 10px;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .firework {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            animation: fireworkExplode 2s ease-out infinite;
        }

        @keyframes fireworkExplode {
            0% { transform: scale(0); opacity: 1; }
            50% { transform: scale(20); opacity: 0.8; }
            100% { transform: scale(40); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="balloon balloon-red">🎈</div>
    <div class="balloon balloon-blue">🎈</div>
    <div class="balloon balloon-green">🎈</div>
    <div class="balloon balloon-yellow">🎈</div>
    <div class="balloon balloon-purple">🎈</div>
    <div class="balloon balloon-pink">🎈</div>
    <div class="balloon balloon-orange">🎈</div>
    <div class="balloon balloon-cyan">🎈</div>

    <div class="confetti" style="left: 10%;"></div>
    <div class="confetti" style="left: 20%;"></div>
    <div class="confetti" style="left: 30%;"></div>
    <div class="confetti" style="left: 40%;"></div>
    <div class="confetti" style="left: 50%;"></div>
    <div class="confetti" style="left: 60%;"></div>
    <div class="confetti" style="left: 70%;"></div>
    <div class="confetti" style="left: 80%;"></div>
    <div class="confetti" style="left: 90%;"></div>

    <div class="firework" style="top: 20%; left: 15%; background: #ff6b6b; animation-delay: 0s;"></div>
    <div class="firework" style="top: 30%; left: 85%; background: #4ecdc4; animation-delay: -1s;"></div>
    <div class="firework" style="top: 70%; left: 25%; background: #feca57; animation-delay: -0.5s;"></div>

    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center">
                <div class="celebration-text">
                    <h1 class="display-1 text-primary mb-4">
                        KPOINT SAVINGS
                    </h1>
                    <h2 class="text-success mb-4">
                        <i class="fas fa-rocket"></i> <i class="fas fa-rocket"></i>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="marquee-container">
                    <div class="marquee">
                        💰 KPOINT SAVINGS 💰 🚀
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="marquee-container">
                    <div class="marquee" style="animation-direction: reverse;">
                        ⭐ KPOINT SAVINGS ⭐ 💎 🎈
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center my-5">
            <div class="col-12 text-center">
                <div class="savings-badge">💰</div>
                <div class="savings-badge">🎁</div>
                <div class="savings-badge">🏆</div>
            </div>
        </div>

        <div class="row justify-content-center my-5">
            <div class="col-12 text-center">
                <a href="/register" class="text-decoration-none">
                    <button class="btn btn-success btn-lg px-5 py-3 me-3" onclick="celebrate()">
                        <i class="fas fa-star"></i> Start Saving Now <i class="fas fa-star"></i>
                    </button>
                </a>
                <a href="/home" class="text-decoration-none">
                    <button class="btn btn-lg px-5 py-3" style="background-color: #8e44ad; border-color: #8e44ad; color: white;" onclick="celebrate()">
                        <i class="fas fa-home"></i> Go to Home <i class="fas fa-home"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add more dynamic balloons
        function createBalloon() {
            const balloon = document.createElement('div');
            balloon.className = 'balloon';
            balloon.innerHTML = '🎈';
            balloon.style.left = Math.random() * 90 + '%';
            balloon.style.top = Math.random() * 80 + '%';
            balloon.style.color = `hsl(${Math.random() * 360}, 70%, 50%)`;
            balloon.style.animationDuration = (Math.random() * 2 + 2) + 's';
            document.body.appendChild(balloon);
            
            setTimeout(() => {
                balloon.remove();
            }, 10000);
        }

        // Create floating elements
        function createFloatingElement(emoji) {
            const element = document.createElement('div');
            element.className = 'flying-element';
            element.innerHTML = emoji;
            element.style.left = '-100px';
            element.style.top = Math.random() * 70 + '%';
            element.style.animationDelay = Math.random() * 2 + 's';
            document.body.appendChild(element);
            
            setTimeout(() => {
                element.remove();
            }, 6000);
        }

        // Celebration function
        function celebrate() {
            for(let i = 0; i < 10; i++) {
                setTimeout(() => createBalloon(), i * 200);
            }
            
            const emojis = ['🏆', '⭐', '💎', '🎊', '🎉', '💰', '🎁'];
            for(let i = 0; i < 5; i++) {
                setTimeout(() => {
                    createFloatingElement(emojis[Math.floor(Math.random() * emojis.length)]);
                }, i * 500);
            }
        }

        // Explosion effect
        function explode() {
            for(let i = 0; i < 20; i++) {
                const firework = document.createElement('div');
                firework.className = 'firework';
                firework.style.left = Math.random() * 100 + '%';
                firework.style.top = Math.random() * 100 + '%';
                firework.style.background = `hsl(${Math.random() * 360}, 70%, 50%)`;
                firework.style.animationDelay = Math.random() * 1 + 's';
                document.body.appendChild(firework);
                
                setTimeout(() => {
                    firework.remove();
                }, 2000);
            }
        }

        // Auto-generate elements
        setInterval(createBalloon, 3000);
        setInterval(() => {
            const emojis = ['🏆', '⭐', '💎', '🎊'];
            createFloatingElement(emojis[Math.floor(Math.random() * emojis.length)]);
        }, 4000);

        // Add random fireworks
        setInterval(() => {
            if(Math.random() > 0.7) {
                explode();
            }
        }, 5000);

        // Initial celebration on load
        window.addEventListener('load', () => {
            setTimeout(celebrate, 1000);
        });
    </script>
</body>
</html>