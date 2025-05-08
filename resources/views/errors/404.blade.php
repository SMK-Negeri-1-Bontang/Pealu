@extends('welcome', ['showUserUI' => false])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div class="error-container">
    <!-- Animated Gradient Background -->
    <div class="gradient-bg"></div>
    
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
        <div class="square square-1"></div>
        <div class="triangle triangle-1"></div>
    </div>
    
    <!-- Main Content -->
    <div class="error-content animate__animated animate__fadeInUp">
        <!-- Error Code -->
        <div class="error-code animate__animated animate__bounceIn">404</div>
        
        <!-- Animated Illustration -->
        <div class="error-illustration">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_ghfpce1h.json" background="transparent" 
                speed="1" style="width: 280px; height: 280px;" loop autoplay></lottie-player>
        </div>

        <!-- Error Message -->
        <div class="error-message">
            <h1 class="error-title">Oops! Lost in Space</h1>
            <p class="error-description">The page you're looking for has been abducted or never existed.</p>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ url('/') }}" class="btn-primary animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-arrow-left"></i> Back to Earth
                </a>
                <a href="mailto:support@smkn1bontang.sch.id" class="btn-secondary">
                    <i class="fas fa-life-ring"></i> Request Rescue
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="footer-note">
        <p>© {{ date('Y') }} SMKN 1 Bontang. All rights reserved.</p>
    </div>
</div>

<!-- Lottie Animation -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --error-color: #ff4754;
        --space-purple: #6e45e2;
        --space-blue: #88d3ce;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

    .error-container {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
    }

    .gradient-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        z-index: 1;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        overflow: hidden;
    }

    .circle, .square, .triangle {
        position: absolute;
        opacity: 0.1;
        border-radius: 50%;
        animation: float 15s infinite linear;
    }

    .circle-1 {
        width: 300px;
        height: 300px;
        background: var(--space-blue);
        top: -50px;
        left: -50px;
        animation-delay: 0s;
    }

    .circle-2 {
        width: 150px;
        height: 150px;
        background: var(--space-purple);
        bottom: 50px;
        right: 100px;
        animation-delay: 2s;
        animation-duration: 12s;
    }

    .circle-3 {
        width: 200px;
        height: 200px;
        background: var(--accent-color);
        top: 40%;
        right: -50px;
        animation-delay: 4s;
        animation-duration: 18s;
    }

    .square {
        border-radius: 10px;
    }

    .square-1 {
        width: 100px;
        height: 100px;
        background: var(--error-color);
        bottom: -20px;
        left: 20%;
        animation-delay: 1s;
        animation-duration: 14s;
    }

    .triangle {
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-bottom: 100px solid var(--primary-color);
        top: 30%;
        left: 70%;
        animation-delay: 3s;
        animation-duration: 16s;
    }

    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-50px) rotate(180deg); }
        100% { transform: translateY(0) rotate(360deg); }
    }

    .error-content {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 2.5rem;
        max-width: 600px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        border-radius: 24px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0 1.5rem;
        overflow: hidden;
    }

    .error-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, var(--space-purple), var(--space-blue));
    }

    .error-illustration {
        margin-bottom: 1.5rem;
    }

    .error-code {
        font-size: 8rem;
        font-weight: 800;
        background: linear-gradient(to right, var(--space-purple), var(--space-blue));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: -1.5rem;
        line-height: 1;
        text-shadow: 0 5px 15px rgba(110, 69, 226, 0.3);
    }

    .error-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(to right, #fff, #ddd);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .error-description {
        font-size: 1.15rem;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 2.5rem;
        max-width: 450px;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 1.2rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        padding: 0.9rem 1.8rem;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        font-size: 1rem;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--space-purple), var(--primary-color));
        color: white;
        box-shadow: 0 4px 15px rgba(110, 69, 226, 0.4);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-color), var(--space-purple));
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(110, 69, 226, 0.5);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .footer-note {
        position: absolute;
        bottom: 2rem;
        z-index: 3;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
        text-align: center;
        width: 100%;
    }

    /* Glow effect */
    .error-content:hover {
        box-shadow: 0 0 30px rgba(110, 69, 226, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .error-code {
            font-size: 5rem;
            margin-bottom: -1rem;
        }
        
        .error-title {
            font-size: 1.8rem;
        }
        
        .error-description {
            font-size: 1rem;
            padding: 0 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 1rem;
            width: 100%;
        }
        
        .btn-primary, .btn-secondary {
            width: 100%;
            justify-content: center;
            padding: 0.8rem 1.5rem;
        }
        
        .error-content {
            padding: 2rem 1.5rem;
            margin: 0 1rem;
        }
    }

    @media (max-width: 480px) {
        .error-code {
            font-size: 4rem;
        }
        
        .error-title {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Play subtle sound effect
        const errorSound = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-software-interface-start-2574.mp3');
        errorSound.volume = 0.2;
        errorSound.play().catch(e => console.log("Audio play failed:", e));
        
        // Add mouse move parallax effect
        document.addEventListener('mousemove', function(e) {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            document.querySelector('.circle-1').style.transform = `translate(${x * 30}px, ${y * 30}px)`;
            document.querySelector('.circle-2').style.transform = `translate(${x * -20}px, ${y * -20}px)`;
            document.querySelector('.triangle').style.transform = `translate(${x * -15}px, ${y * -15}px)`;
        });
    });
</script>
@endsection