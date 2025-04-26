@extends('welcome', ['showUserUI' => false])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<div class="error-container">
    <!-- Particle JS Background -->
    <div id="particles-js"></div>
    
    <!-- Main Content -->
    <div class="error-content animate__animated animate__fadeIn">
        <!-- Animated Illustration -->
        <div class="error-illustration">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_kcsr6fcp.json" background="transparent" 
                speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        </div>

        <!-- Error Message -->
        <div class="error-message">
            <h1 class="error-title">Oops! Page Not Found</h1>
            <p class="error-description">The page you're looking for doesn't exist or has been moved.</p>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ url('/') }}" class="btn-primary">
                    <i class="fas fa-home"></i> Return Home
                </a>
                <a href="mailto:support@smkn1bontang.sch.id" class="btn-secondary">
                    <i class="fas fa-envelope"></i> Contact Support
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

<!-- Particles JS -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --error-color: #ff4754;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .error-container {
        position: relative;
        width: 100%;
        height: 100vh;
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
    }

    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .error-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 2rem;
        max-width: 800px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0 1rem;
    }

    .error-illustration {
        margin-bottom: 2rem;
    }

    .error-message {
        padding: 0 1rem;
    }

    .error-code {
        font-size: 6rem;
        font-weight: 800;
        background: linear-gradient(to right, var(--error-color), #ff6b6b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .error-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: white;
    }

    .error-description {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        max-width: 500px;
    }

    .search-container {
        width: 100%;
        margin-bottom: 2rem;
    }

    .search-bar {
        display: flex;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        padding: 0.5rem;
        max-width: 500px;
        margin: 0 auto;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .search-bar:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .search-bar input {
        flex: 1;
        background: transparent;
        border: none;
        padding: 0.75rem 1rem;
        color: white;
        font-size: 1rem;
        outline: none;
    }

    .search-bar input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: var(--secondary-color);
        transform: scale(1.05);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .footer-note {
        position: absolute;
        bottom: 1.5rem;
        z-index: 2;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .error-code {
            font-size: 4rem;
        }
        
        .error-title {
            font-size: 1.5rem;
        }
        
        .error-description {
            font-size: 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-primary, .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    // Initialize Particles.js
    document.addEventListener('DOMContentLoaded', function() {
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.2,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });

        // Play error sound (optional)
        const errorSound = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-alarm-digital-clock-beep-989.mp3');
        errorSound.volume = 0.3;
        errorSound.play().catch(e => console.log("Audio play failed:", e));
    });
</script>
@endsection