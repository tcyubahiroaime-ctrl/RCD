<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Payment Confirmed | Success</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: linear-gradient(145deg, #0b1120 0%, #111827 100%);
            color: #eef2ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* animated background glow orbs */
        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2), transparent 70%);
            top: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15), transparent 70%);
            bottom: -120px;
            right: -80px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* main card container */
        .success-card {
            position: relative;
            z-index: 10;
            max-width: 550px;
            width: 100%;
            background: rgba(18, 25, 45, 0.75);
            backdrop-filter: blur(12px);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.5), 0 0 0 0.5px rgba(255, 255, 255, 0.05) inset;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 2rem 2rem 2.2rem;
            text-align: center;
        }

        .success-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px -18px black;
            border-color: rgba(16, 185, 129, 0.3);
        }

        /* icon container with modern checkmark */
        .icon-wrapper {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .check-circle {
            background: linear-gradient(135deg, #10b981, #059669);
            width: 85px;
            height: 85px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.4), 0 0 0 6px rgba(16, 185, 129, 0.2);
            animation: floatGlow 2s infinite alternate ease-in-out;
        }

        .check-circle svg {
            width: 48px;
            height: 48px;
            stroke: white;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
        }

        @keyframes floatGlow {
            0% {
                transform: scale(1);
                box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.4), 0 0 0 6px rgba(16, 185, 129, 0.2);
            }
            100% {
                transform: scale(1.02);
                box-shadow: 0 20px 35px -6px rgba(16, 185, 129, 0.6), 0 0 0 8px rgba(16, 185, 129, 0.35);
            }
        }

        /* heading style */
        .gradient-heading {
            font-size: 2.1rem;
            font-weight: 700;
            background: linear-gradient(120deg, #F3F9FF 0%, #A5F0CD 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 0.6rem;
            letter-spacing: -0.3px;
        }

        .badge-sub {
            display: inline-block;
            background: rgba(16, 185, 129, 0.18);
            backdrop-filter: blur(4px);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #b0f3d6;
            border: 1px solid rgba(16, 185, 129, 0.3);
            margin-bottom: 1.2rem;
        }

        .message-text {
            font-size: 1.1rem;
            line-height: 1.5;
            color: #cfdef5;
            background: rgba(0, 0, 0, 0.2);
            padding: 0.9rem 1.2rem;
            border-radius: 1.2rem;
            margin: 1rem 0 1.5rem 0;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .highlight {
            font-weight: 600;
            color: #6ee7b7;
        }

        /* action buttons group */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: linear-gradient(95deg, #f59e0b, #d97706);
            color: #0f0f1a;
            font-weight: 600;
            padding: 0.85rem 1.8rem;
            border-radius: 60px;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.25s ease;
            box-shadow: 0 5px 12px rgba(245, 158, 11, 0.25);
            border: none;
            cursor: pointer;
        }

        .btn-home:hover {
            background: linear-gradient(95deg, #fbbf24, #f59e0b);
            transform: scale(1.02);
            box-shadow: 0 8px 18px rgba(245, 158, 11, 0.45);
            color: #000000;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #e2e8ff;
            font-weight: 500;
            padding: 0.85rem 1.6rem;
            border-radius: 60px;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 215, 120, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        /* support small note */
        .footnote {
            margin-top: 2rem;
            font-size: 0.75rem;
            color: #6c7a9e;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            padding-top: 1.3rem;
        }

        .footnote svg {
            opacity: 0.7;
        }

        /* responsive adjustments */
        @media (max-width: 500px) {
            .success-card {
                padding: 1.5rem;
            }
            .gradient-heading {
                font-size: 1.7rem;
            }
            .check-circle {
                width: 70px;
                height: 70px;
            }
            .check-circle svg {
                width: 38px;
                height: 38px;
            }
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            .btn-home, .btn-secondary {
                justify-content: center;
            }
        }

        /* subtle shimmer effect */
        @keyframes softShine {
            0% {
                background-position: -100% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        .shimmer-text {
            background: linear-gradient(90deg, #f0f9ff, #caf0e6, #f0f9ff);
            background-size: 200% auto;
            animation: softShine 4s linear infinite;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="success-card">
    <div class="icon-wrapper">
        <div class="check-circle">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    
    <h1 class="gradient-heading">Payment <span class="shimmer-text">Request Sent!</span></h1>
    <div class="badge-sub">✦ priority processing ✦</div>
    
    <div class="message-text">
        📬 <span class="highlight">Our admin team</span> has been notified.<br>
        We’ll review your request and <strong>contact you shortly</strong> via email or phone.
    </div>
    
    <div class="action-buttons">
        <a href="index.php" class="btn-home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 9L12 3L21 9L12 15L3 9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <path d="M5 12V19H19V12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <path d="M12 19V15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            Back to Home
        </a>
        <a href="#" class="btn-secondary" id="trackStatusBtn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6"/>
                <path d="M12 8V12L15 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
            Track request
        </a>
    </div>
    
    <div class="footnote">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="1.5"/>
            <path d="M12 16V12M12 8H12.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <span>Admin will reach out within 24 hours</span>
    </div>
</div>

<!-- simple notification script for demo "track request" (non-intrusive) -->
<script>
    (function() {
        // optional smooth interactivity: show a friendly toast / alert? but we'll do a subtle console & mini modal?
        // better: show a gentle non-intrusive notification (browser native? not disturbing)
        const trackBtn = document.getElementById('trackStatusBtn');
        if (trackBtn) {
            trackBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // elegant visual feedback without redirect: show a small info bubble
                const existingToast = document.querySelector('.custom-toast-msg');
                if(existingToast) existingToast.remove();
                
                const toast = document.createElement('div');
                toast.className = 'custom-toast-msg';
                toast.innerText = '🔔 Your request is in queue — admin will contact you shortly.';
                toast.style.cssText = `
                    position: fixed;
                    bottom: 25px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: #1f2a48e6;
                    backdrop-filter: blur(12px);
                    color: #e2e8f0;
                    padding: 10px 20px;
                    border-radius: 60px;
                    font-size: 0.85rem;
                    font-weight: 500;
                    z-index: 999;
                    border: 1px solid #10b98166;
                    box-shadow: 0 6px 16px rgba(0,0,0,0.3);
                    font-family: inherit;
                    pointer-events: none;
                    transition: opacity 0.2s;
                `;
                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }, 2800);
            });
        }

        // additional micro-interaction: ripple effect on home button (just for style)
        const homeBtn = document.querySelector('.btn-home');
        if(homeBtn) {
            homeBtn.addEventListener('click', (e) => {
                // let the link work, but we can add a tiny click spark (optional)
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.backgroundColor = 'rgba(255,255,200,0.5)';
                ripple.style.width = '10px';
                ripple.style.height = '10px';
                ripple.style.transform = 'scale(0)';
                ripple.style.transition = 'transform 0.3s ease-out, opacity 0.4s';
                ripple.style.pointerEvents = 'none';
                const rect = e.target.closest('.btn-home').getBoundingClientRect();
                ripple.style.left = `${e.clientX - rect.left - 5}px`;
                ripple.style.top = `${e.clientY - rect.top - 5}px`;
                e.target.closest('.btn-home').style.position = 'relative';
                e.target.closest('.btn-home').appendChild(ripple);
                setTimeout(() => {
                    ripple.style.transform = 'scale(20)';
                    ripple.style.opacity = '0';
                }, 10);
                setTimeout(() => ripple.remove(), 300);
            });
        }
    })();
</script>
</body>
</html>