<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $settings->site_description ?? $about->description ?? 'مطور Full-Stack متخصص في Flutter, Laravel, C#' }}">
    <meta name="keywords" content="{{ $settings->site_keywords ?? 'مطور, فلاتر, لارافل, سي شارب' }}">
    <meta name="author" content="{{ $about->name ?? 'عمر المحجري' }}">
    <title>{{ $settings->site_title ?? ($about->name ?? 'عمر المحجري') . ' | مطور حلول متكاملة' }}</title>

    <!-- Fonts & Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Tajawal:wght@400;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        /* CSS Variables - Multiple Themes */
        :root {
            /* Theme 1: Original Cyan */
            --primary: #00ffff;
            --primary-dark: #0099cc;
            --secondary: #00e5ff;
            --accent: #00cccc;
            --dark: #0a192f;
            --darker: #020c1b;
            --light: #f0f9ff;
            --text: #e6f1ff;
            --text-secondary: #8892b0;
            --gradient-1: linear-gradient(135deg, #00ffff 0%, #0099cc 100%);
            --gradient-2: linear-gradient(135deg, #00e5ff 0%, #0099cc 100%);
            --gradient-3: linear-gradient(135deg, #00cccc 0%, #0099cc 100%);
            --gradient-4: linear-gradient(135deg, #00ffff 0%, #00cccc 100%);
            --glass: rgba(5, 5, 5, 0.164);
            --glass-border: rgba(0, 255, 255, 0.2);
            --nav-bg: rgba(10, 25, 47, 0.95);
            --card-bg: rgba(5, 5, 5, 0.164);
            --success: #00ff88;
            --warning: #ffaa00;
            --error: #ff4444;
        }

        /* Theme 2: Golden Dark */
        .theme-golden {
            --primary: #FFD700;
            --primary-dark: #B8860B;
            --secondary: #FFEC8B;
            --accent: #DAA520;
            --dark: #1a1a1a;
            --darker: #0a0a0a;
            --light: #fffaf0;
            --text: #f8f8ff;
            --text-secondary: #c0c0c0;
            --gradient-1: linear-gradient(135deg, #FFD700 0%, #B8860B 100%);
            --gradient-2: linear-gradient(135deg, #FFEC8B 0%, #DAA520 100%);
            --gradient-3: linear-gradient(135deg, #DAA520 0%, #B8860B 100%);
            --gradient-4: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
            --glass: rgba(26, 26, 26, 0.8);
            --glass-border: rgba(255, 215, 0, 0.3);
            --nav-bg: rgba(10, 10, 10, 0.95);
            --card-bg: rgba(26, 26, 26, 0.8);
        }

        html, body {
         overflow-x: hidden;
         }
        /* Theme 3: Light Blue */
        .theme-light {
            --primary: #007bff;
            --primary-dark: #0056b3;
            --secondary: #6c757d;
            --accent: #17a2b8;
            --dark: #f8f9fa;
            --darker: #e9ecef;
            --light: #ffffff;
            --text: #212529;
            --text-secondary: #6c757d;
            --gradient-1: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            --gradient-2: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            --gradient-3: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            --gradient-4: linear-gradient(135deg, #007bff 0%, #17a2b8 100%);
            --glass: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(0, 123, 255, 0.2);
            --nav-bg: rgba(248, 249, 250, 0.95);
            --card-bg: rgba(255, 255, 255, 0.9);
        }

        /* Global Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            background: var(--darker);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
            transition: all 0.3s ease;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        /* Particles Background */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background: var(--darker);
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 900;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            font-weight: 900;
            color: var(--darker);
            font-size: 1.2rem;
            object-fit: cover;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-1);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        /* Theme Selector in Navbar */
        .theme-selector-nav {
            display: flex;
            gap: 0.5rem;
            margin-right: 1rem;
        }

        .theme-btn-nav {
            width: 25px;
            height: 25px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .theme-btn-nav.active {
            transform: scale(1.2);
            border-color: var(--text);
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        .theme-btn-nav.cyan {
            background: linear-gradient(45deg, #00ffff, #0099cc);
        }

        .theme-btn-nav.golden {
            background: linear-gradient(45deg, #FFD700, #B8860B);
        }

        .theme-btn-nav.light {
            background: linear-gradient(45deg, #007bff, #6c757d);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 1001;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            color: var(--primary);
        }

        /* Mobile Sidebar - Enhanced Design */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -350px;
            width: 320px;
            height: 100vh;
            background: var(--nav-bg);
            backdrop-filter: blur(30px);
            border-left: 1px solid var(--glass-border);
            z-index: 999;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            box-shadow: -10px 0 50px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
        }

        .mobile-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .mobile-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .mobile-sidebar::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        .mobile-sidebar.active {
            right: 0;
        }

        .mobile-sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--glass-border);
            position: relative;
        }

        .mobile-sidebar-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 50%;
            height: 2px;
            background: var(--gradient-1);
            border-radius: 1px;
        }

        .mobile-sidebar-logo {
            display: flex;
            align-items: center;
            font-size: 1.4rem;
            font-weight: 800;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .mobile-logo-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            font-weight: 900;
            color: var(--darker);
            font-size: 1rem;
            object-fit: cover;
        }

        .close-sidebar {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            color: var(--text);
            font-size: 1.3rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-sidebar:hover {
            background: var(--gradient-1);
            color: var(--darker);
            transform: rotate(90deg);
        }

        .mobile-nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            margin-bottom: 2rem;
        }

        .mobile-nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            padding: 1.2rem 1.5rem;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid transparent;
        }

        .mobile-nav-links a::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 3px;
            height: 0;
            background: var(--gradient-1);
            transition: all 0.3s ease;
        }

        .mobile-nav-links a:hover::before {
            height: 100%;
        }

        .mobile-nav-links a:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--glass-border);
            transform: translateX(-5px);
            color: var(--primary);
        }

        .mobile-nav-links a i {
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .mobile-nav-links a:hover i {
            transform: scale(1.2);
            color: var(--primary);
        }

        .mobile-theme-selector {
            margin-top: auto;
            padding-top: 2rem;
            border-top: 2px solid var(--glass-border);
            position: relative;
        }

        .mobile-theme-selector::before {
            content: '';
            position: absolute;
            top: -2px;
            right: 0;
            width: 50%;
            height: 2px;
            background: var(--gradient-1);
            border-radius: 1px;
        }

        .mobile-theme-selector h4 {
            margin-bottom: 1.5rem;
            color: var(--text);
            font-weight: 700;
            text-align: center;
            font-size: 1.1rem;
        }

        .mobile-theme-buttons {
            display: flex;
            gap: 1.2rem;
            justify-content: center;
            align-items: center;
        }

        .mobile-theme-btn {
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            border: 3px solid transparent;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .mobile-theme-btn.active {
            transform: scale(1.15);
            border-color: var(--text);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        .mobile-theme-btn::after {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border-radius: 50%;
            background: var(--gradient-1);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .mobile-theme-btn.active::after {
            opacity: 0.3;
        }

        .mobile-theme-btn.cyan {
            background: linear-gradient(45deg, #00ffff, #0099cc);
        }

        .mobile-theme-btn.golden {
            background: linear-gradient(45deg, #FFD700, #B8860B);
        }

        .mobile-theme-btn.light {
            background: linear-gradient(45deg, #007bff, #6c757d);
        }

        .mobile-sidebar-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--glass-border);
            text-align: center;
        }

        .mobile-sidebar-footer p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .mobile-social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .mobile-social-links a {
            width: 40px;
            height: 40px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .mobile-social-links a:hover {
            background: var(--gradient-1);
            color: var(--darker);
            transform: translateY(-3px);
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            z-index: 998;
            display: none;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .overlay.active {
            display: block;
            opacity: 1;
        }

        /* Hero Section - Redesigned */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 80px 0 40px;
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
            grid-template-columns: 1fr;
            text-align: center;
            gap: 3rem;
        }

        .hero-content {
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-greeting {
            font-size: 1.1rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .waving-hand {
            animation: wave 2s infinite;
        }

        @keyframes wave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: rotate(-10deg);
            }

            20%,
            40%,
            60%,
            80% {
                transform: rotate(10deg);
            }
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            font-weight: 400;
            line-height: 1.6;
        }

        .tech-stack {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tech-badge {
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            color: var(--darker);
            background: var(--gradient-1);
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .tech-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: var(--gradient-1);
            color: var(--darker);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: var(--darker);
        }

        /* Hero Visual - Redesigned */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .card {
            position: absolute;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card-1 {
            top: 0;
            right: 0;
            width: 200px;
            height: 120px;
            animation: float1 6s ease-in-out infinite;
        }

        .card-2 {
            bottom: 80px;
            right: 50px;
            width: 180px;
            height: 100px;
            animation: float2 7s ease-in-out infinite;
        }

        .card-3 {
            top: 150px;
            left: 0;
            width: 160px;
            height: 90px;
            animation: float3 5s ease-in-out infinite;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            color: var(--darker);
        }

        .card-text {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(-1deg);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(1deg);
            }
        }

        /* Stats Section - Redesigned */
        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 3rem;
            padding: 0 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem 1rem;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Bottom Navigation Bar - Interactive */
        .bottom-nav {
            position: fixed;
            bottom: 0px;
            right: 50%;
            transform: translateX(50%);
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 0.1rem;
            display: none;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .nav-items {
            display: flex;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.2rem;
            border: none;
            background: none;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 15px;
            position: relative;
            min-width: 70px;
        }

        .nav-item.active {
            color: var(--primary);
            background: var(--glass);
        }

        .nav-icon {
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
            transition: all 0.3s ease;
        }

        .nav-item.active .nav-icon {
            transform: translateY(-2px);
        }

        .nav-label {
            font-size: 0.7rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-indicator {
            position: absolute;
            top: -8px;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .nav-item.active .nav-indicator {
            opacity: 1;
        }

        /* Sections */
        .section {
            padding: 1rem 0;
            position: relative;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 500px;
            margin: 0 auto;
        }

        /* About Section - Improved */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-description {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .about-features {
            display: grid;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            padding: 1.2rem;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateX(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--darker);
            font-size: 1.2rem;
            margin-left: 1rem;
            flex-shrink: 0;
        }

        .feature-text h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
            color: var(--text);
        }

        .feature-text p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Services Section - Improved */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-1);
            transition: height 0.3s ease;
        }

        .service-card:hover::before {
            height: 100%;
            opacity: 0.05;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--darker);
            font-size: 2rem;
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .service-card h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .service-card p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.6;
        }


        /* Skills Section - Improved */
        .skills-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .skill-category {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .skill-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .skill-category h3 {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--text);
            text-align: center;
        }

        .skill-item {
            margin-bottom: 1.5rem;
        }

        .skill-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .skill-name {
            font-weight: 600;
            color: var(--text);
            font-size: 0.9rem;
        }

        .skill-level {
            color: var(--primary);
            font-weight: 700;
            font-size: 0.9rem;
        }

        .skill-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .skill-progress {
            height: 100%;
            background: var(--gradient-1);
            border-radius: 4px;
            transition: width 1.5s ease;
        }

        /* Portfolio Section - Improved */
        .portfolio-filter {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.8rem 1.5rem;
            border: 2px solid var(--primary);
            background: transparent;
            color: var(--primary);
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 0.9rem;
        }

        .filter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-1);
            transition: all 0.3s ease;
            z-index: -1;
            opacity: 0;
        }

        .filter-btn.active,
        .filter-btn:hover {
            color: var(--darker);
            border-color: transparent;
        }

        .filter-btn.active::before,
        .filter-btn:hover::before {
            opacity: 1;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .portfolio-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 300px;
            cursor: pointer;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .portfolio-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .portfolio-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: all 0.3s ease;
            color: white;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }

        .portfolio-item:hover .portfolio-img {
            transform: scale(1.1);
        }

        .portfolio-info h3 {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .portfolio-info p {
            text-align: center;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .portfolio-links {
            display: flex;
            gap: 1rem;
        }

        .portfolio-link {
            width: 45px;
            height: 45px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .portfolio-link:hover {
            background: var(--gradient-1);
            transform: translateY(-3px);
        }

        .portfolio-link.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ===== Project Modal ===== */
        .project-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.85);
            z-index: 99999;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 1rem;
            animation: fadeIn 0.25s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .project-modal-content {
            max-width: 750px;
            width: 100%;
            margin: auto;
            background: var(--darker);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--glass-border);
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .project-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .project-modal-close:hover {
            background: rgba(255,0,0,0.6);
            transform: rotate(90deg);
        }

        .project-modal-image-wrapper {
            width: 100%;
            max-height: 450px;
            overflow: hidden;
            background: rgba(0,0,0,0.3);
        }

        .project-modal-image {
            width: 100%;
            height: 100%;
            max-height: 450px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .project-modal-image:hover {
            transform: scale(1.05);
        }

        .project-modal-body {
            padding: 2rem;
        }

        .project-modal-title {
            color: var(--primary);
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .project-modal-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 3px;
            background: var(--gradient-1);
            border-radius: 2px;
        }

        .project-modal-desc {
            color: var(--text-secondary);
            line-height: 1.9;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .project-modal-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .project-modal-btn {
            padding: 0.8rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .project-modal-btn.btn-primary {
            background: var(--gradient-1);
            color: var(--darker);
        }

        .project-modal-btn.btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 255, 255, 0.3);
        }

        .project-modal-btn.btn-outline {
            background: transparent;
            border: 2px solid var(--glass-border);
            color: var(--text);
        }

        .project-modal-btn.btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .project-modal-body {
                padding: 1.5rem;
            }
            .project-modal-title {
                font-size: 1.3rem;
            }
            .project-modal-desc {
                font-size: 0.9rem;
                line-height: 1.7;
            }
            .project-modal-actions {
                flex-direction: column;
            }
            .project-modal-btn {
                width: 100%;
                justify-content: center;
            }
            .project-modal-image-wrapper {
                max-height: 300px;
            }
            .project-modal-image {
                max-height: 300px;
            }
        }

        /* Contact Section - Improved */
        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .contact-info {
            padding: 2rem;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 2rem;
            color: var(--text);
            text-align: center;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--darker);
            font-size: 1.2rem;
            margin-left: 1rem;
            flex-shrink: 0;
        }

        .contact-details h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
            color: var(--text);
        }

        .contact-details p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .contact-form {
            padding: 2rem;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
        }

        .contact-form h3 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 2rem;
            color: var(--text);
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--text);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.2);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        /* Chat System */
        .chat-container {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 400px;
            height: 650px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            display: none;
            flex-direction: column;
            z-index: 1000;
            font-family: 'Tajawal', sans-serif;
            overflow: hidden;
        }

        .chat-container.active {
            display: flex !important;
        }

        .chat-container.minimized {
            height: 60px !important;
        }

        .chat-container.minimized .chat-messages,
        .chat-container.minimized .chat-input {
            display: none !important;
        }

        .chat-header {
            background: var(--gradient-1);
            color: var(--darker);
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-user {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 1rem;
            position: relative;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid white;
        }

        .user-status {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 15px;
            height: 15px;
            background: var(--gradient-4);
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        .chat-actions {
            display: flex;
            gap: 0.5rem;
        }

        .chat-action {
            background: none;
            border: none;
            color: var(--darker);
            font-size: 1.2rem;
            cursor: pointer;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .chat-action:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .message {
            display: flex;
            flex-direction: column;
            max-width: 75%;
            animation: messageSlide 0.3s ease;
        }

        .message.sent {
            align-self: flex-end;
        }

        .message.received {
            align-self: flex-start;
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-content {
            padding: 0.8rem 1rem;
            border-radius: 18px;
            position: relative;
            word-wrap: break-word;
        }

        .message.received .message-content {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: var(--text);
            border-bottom-right-radius: 4px;
        }

        .message.sent .message-content {
            background: var(--gradient-1);
            color: var(--darker);
            border-bottom-left-radius: 4px;
        }

        .message-time {
            font-size: 0.65rem;
            opacity: 0.6;
            margin-top: 0.3rem;
            display: block;
            text-align: right;
        }

        .message.sent .message-time {
            text-align: left;
        }

        .chat-input {
            padding: 1.5rem;
            border-top: 1px solid var(--glass-border);
            display: flex;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.05);
        }

        .chat-input input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            color: var(--text);
            outline: none;
            font-family: 'Tajawal', sans-serif;
            font-size: 1rem;
        }

        .chat-input input::placeholder {
            color: var(--text-secondary);
        }

        .chat-input button {
            background: var(--gradient-1);
            color: var(--darker);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .chat-input button:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
        }

        .chat-toggle {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 70px;
            height: 70px;
            background: var(--gradient-1);
            border: none;
            border-radius: 50%;
            color: var(--darker);
            font-size: 1.8rem;
            cursor: pointer;
            box-shadow: 0 15px 40px rgba(0, 255, 255, 0.5);
            transition: all 0.3s ease;
            z-index: 999;
            animation: chatPulse 2s infinite;
        }

        @keyframes chatPulse {
            0% {
                box-shadow: 0 15px 40px rgba(0, 255, 255, 0.5);
            }

            50% {
                box-shadow: 0 15px 40px rgba(0, 255, 255, 0.8);
            }

            100% {
                box-shadow: 0 15px 40px rgba(0, 255, 255, 0.5);
            }
        }

        .chat-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 20px 50px rgba(0, 255, 255, 0.7);
        }

        .chat-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--gradient-2);
            color: var(--darker);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(0, 229, 255, 0.5);
        }

        /* Footer */
        footer {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-top: 1px solid var(--glass-border);
            padding: 4rem 0 2rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--secondary);
        }

        .footer-social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .footer-social-links a {
            width: 60px;
            height: 60px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.5rem;
        }

        .footer-social-links a:hover {
            background: var(--gradient-1);
            color: var(--darker);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 255, 255, 0.4);
        }

        .footer-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            /* .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            } */



            .hero-visual {
                order: -1;
            }



            .about-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .contact-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .theme-selector {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .theme-selector {
                display: inline;
            }

            .mobile-menu-btn {
                display: block;
            }

            .theme-selector-nav {
                display: none;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .bottom-nav {
                display: block;
            }

            .section {
                padding: 4rem 0;
            }

            .section-title {
                font-size: 2rem;
            }



            .card {
                padding: 1.5rem;
            }

            .card-1 {
                width: 150px;
                height: 100px;
            }

            .card-2 {
                width: 140px;
                height: 90px;
            }

            .card-3 {
                width: 130px;
                height: 80px;
            }

            .chat-container {
                width: 100%;
                height: 100%;
                bottom: 0;
                left: 0;
                border-radius: 0;
            }

            .chat-toggle {
                bottom: 1rem;
                left: 1rem;
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .chat-toggle {
                display: none;
            }

        }

        @media (max-width: 480px) {

            .theme-selector {
                display: inline;
            }

            .container {
                padding: 0 1rem;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .nav-item {
                padding: 0.6rem 1rem;
                min-width: 60px;
            }

            .nav-label {
                font-size: 0.6rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }

            .footer-social-links {
                gap: 1rem;
            }

            .footer-social-links a {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .bottom-nav {
                width: 480;
            }

        }

        /* Theme Selector */
        .theme-selector {
            position: fixed;
            top: 77px;
            left: 5px;
            z-index: 1001;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 0.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;

        }

        /* ===== تنسيق أيقونات التواصل الاجتماعي فقط ===== */

        .social-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.3rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary);
            color: var(--darker);
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0, 255, 255, 0.4);
        }
    </style>

    <style>
        /* ===== فقط التنسيقات الأساسية للهيرو سيكشن ===== */

        /* الخلفية الرئيسية */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            padding: 120px 0 80px;
            /* background: var(--darker); */
            overflow: hidden;
        }

        /* المحتوى الرئيسي */
        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        /* ===== المحتوى النصي ===== */
        .hero-content {
            animation: fadeInLeft 1s ease;
        }

        .hero-title {
            font-size: 3.8rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            line-height: 1.8;
            max-width: 90%;
        }

        /* ===== التقنيات ===== */
        .tech-stack {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .tech-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.2rem;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 255, 0.15);
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text);
            transition: all 0.3s ease;
            cursor: default;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .tech-item i {
            color: var(--primary);
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .tech-item:hover {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), rgba(170, 0, 255, 0.1));
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.2);
        }

        .tech-item:hover i {
            transform: scale(1.2);
        }

        /* ===== الأزرار ===== */
        .hero-buttons {
            display: flex;
            gap: 1.2rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }



        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: var(--darker);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.3);
        }

        /* ===== العنصر البصري مع الصورة ===== */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .visual-wrapper {
            position: relative;
            width: 100%;
            max-width: 550px;
        }

        /* إطار الصورة */
        .image-frame {
            position: relative;
            width: 100%;
            aspect-ratio: 1/1;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .frame-decoration {
            position: absolute;
            width: 50px;
            height: 50px;
            border: 3px solid var(--primary);
            z-index: 2;
            opacity: 0.5;
        }

        .top-left {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
        }

        .top-right {
            top: 20px;
            right: 20px;
            border-left: none;
            border-bottom: none;
        }

        .bottom-left {
            bottom: 20px;
            left: 20px;
            border-right: none;
            border-top: none;
        }

        .bottom-right {
            bottom: 20px;
            right: 20px;
            border-left: none;
            border-top: none;
        }

        .main-image {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.2), rgba(170, 0, 255, 0.2));
            z-index: 1;
            mix-blend-mode: overlay;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .main-image:hover .profile-image {
            transform: scale(1.05);
        }

        /* ===== Gallery Carousel ===== */
        .gallery-carousel {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .carousel-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .carousel-image.active {
            opacity: 1;
            position: relative;
        }

        .carousel-controls {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 10;
            background: rgba(0, 0, 0, 0.5);
            padding: 5px 15px;
            border-radius: 25px;
            backdrop-filter: blur(5px);
        }

        .carousel-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            padding: 5px;
            transition: color 0.3s;
        }

        .carousel-btn:hover {
            color: var(--primary);
        }

        .carousel-dots {
            display: flex;
            gap: 5px;
        }

        .carousel-dot {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }

        .carousel-dot.active {
            background: var(--primary);
            width: 20px;
            border-radius: 4px;
        }

        /* ===== الأنيميشن ===== */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ===== تحسينات التجاوب ===== */
        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-content {
                text-align: center;
            }

            .hero-subtitle {
                max-width: 100%;
            }

            .hero-buttons {
                justify-content: center;
            }

            .tech-stack {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }


            .hero {
                padding: 80px 0 80px;
            }

            /*/****************************************************************/

            /* .ds_non {
                display: none;
            } */

            .tech-stack {
                margin-top: 50px;
            }

            .hero-container {
                justify-content: center;
                position: relative;
                /* الحاوية الأم */
                width: 100%;
                height: 500px;
            }

            .hero-visual {
                position: absolute;
                top: 190px;
                left: 17px;
                z-index: 1;

            }

            .hero-content {
                position: absolute;
                top: 50px;
                left: 50px;
                padding: 0 35px 0 0;
                z-index: 2;
                /* في المقدمة */
            }


            /* العنوان */
            .hero-title {
                font-size: 2rem;
                /* تصغير النص للجوال */
                line-height: 1.3;
                margin-bottom: 15px;
                font-weight: 700;
            }

            .hero-title span {
                font-size: 2rem;
            }

            /* الوصف */
            .hero-subtitle {
                font-size: 1rem;
                /* تصغير النص */
                line-height: 1.6;
                margin-bottom: 20px;
                opacity: 0.9;
            }

            /* التقنيات */
            .tech-stack {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                justify-content: center;
                margin-bottom: 25px;
            }

            .tech-item {
                padding: 6px 12px;
                font-size: 0.85rem;
                border-radius: 20px;
            }

            .tech-item i {
                font-size: 0.9rem;
            }

            /* الأزرار */
            .hero-buttons {
                display: flex;
                flex-direction: column;
                /* الأزرار تحت بعض */
                gap: 10px;
                width: 100%;
            }

            .btn {
                width: 90%;
                margin: 0 15px;
                padding: 12px 20px;
                font-size: 0.95rem;
                justify-content: center;
            }

            /*/****************************************************************/
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
            }

            .tech-item {
                /* width: 100%; */
                justify-content: center;
            }

            .frame-decoration {
                width: 30px;
                height: 30px;
            }

            .hero {
                padding: 80px 0 80px;
            }

            /*/****************************************************************/
            .tech-stack {
                margin-top: 50px;
            }

            .ds_non {
                display: none;
            }

            .hero-container {
                position: relative;
                /* الحاوية الأم */
                width: 100%;
                height: 500px;

            }

            .hero-visual {
                position: absolute;
                top: 190px;
                left: 17px;
                z-index: 1;
                /* في الخلف */
                width: 90%;
            }

            .hero-content {
                position: absolute;
                top: 50px;
                left: 50px;
                z-index: 2;
                /* في المقدمة */
            }

            /*/****************************************************************/
        }
    </style>
     <style>
        /* ===== قسم الخبرات ===== */
        .experience-section {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--text);
            margin-bottom: 50px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #aa00ff);
            border-radius: 2px;
        }

        .timeline-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        .timeline-head {
            color: var(--text);
            font-size: 1.5rem;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-head i {
            color: var(--primary);
        }

        .timeline-items {
            position: relative;
            padding-right: 30px;
        }

        .timeline-items::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary), #aa00ff, transparent);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 40px;
        }

        .timeline-dot {
            position: absolute;
            right: -38px;
            top: 0;
            width: 16px;
            height: 16px;
            background: var(--primary);
            border-radius: 50%;
            border: 3px solid var(--darker);
            box-shadow: 0 0 20px var(--primary);
        }

        .timeline-content {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(0, 255, 255, 0.1);
            border-radius: 20px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateX(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.1);
        }

        .timeline-date {
            display: inline-block;
            background: rgba(0, 255, 255, 0.1);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }

        .timeline-content h4 {
            color: var(--text);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .timeline-company {
            display: block;
            color: var(--primary);
            font-size: 0.9rem;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .timeline-content p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
        }


        /* ===== تحسينات التجاوب ===== */
        @media (max-width: 992px) {
            .bio-grid {
                grid-template-columns: 1fr;
            }

            .bio-image {
                max-width: 500px;
                margin: 0 auto;
            }

            .timeline-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .header-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .about-page {
                padding-top: 80px;
            }

            .header-title {
                font-size: 2rem;
            }

            .bio-stats {
                flex-direction: column;
                gap: 15px;
            }

            .bio-actions {
                flex-direction: column;
            }


            .timeline-items::before {
                right: 15px;
            }

            .timeline-dot {
                right: 7px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 1.8rem;
            }

            .bio-title {
                font-size: 2rem;
            }

            .skill-category-card {
                padding: 20px;
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <style>
        /* الحاوية الرئيسية */
        .about-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ===== الجانب الأيمن - الصورة ===== */
        .about-image-side {
            position: relative;
        }

        .image-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .image-shape {
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            border: 2px solid var(--primary);
            border-radius: 30px;
            opacity: 0.3;
            animation: shapeMove 8s ease-in-out infinite;
        }

        @keyframes shapeMove {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(10px, 10px);
            }
        }

        .about-image {
            width: 100%;
            height: auto;
            border-radius: 30px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(0, 255, 255, 0.2);
            transition: all 0.5s ease;
            position: relative;
            z-index: 2;
        }

        .about-image:hover {
            transform: scale(1.02);
            border-color: var(--primary);
        }

        .image-dots {
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background-image: radial-gradient(var(--primary) 2px, transparent 2px);
            background-size: 15px 15px;
            opacity: 0.3;
            z-index: 1;
        }

        /* ===== الجانب الأيسر - المحتوى ===== */
        .about-content-side {
            padding: 20px;
        }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(0, 255, 255, 0.05);
            padding: 8px 20px;
            border-radius: 30px;
            margin-bottom: 25px;
            border: 1px solid rgba(0, 255, 255, 0.2);
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .badge-text {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }
        }

        .about-heading {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 25px;
            line-height: 1.3;
            position: relative;
            padding-bottom: 15px;
        }

        .about-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #aa00ff);
            border-radius: 2px;
        }

        .about-paragraph {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        /* قائمة المميزات */
        .features-list {
            display: grid;
            gap: 15px;
            margin: 35px 0;
        }

        .feature-block {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(0, 255, 255, 0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .feature-block:hover {
            background: rgba(0, 255, 255, 0.05);
            border-color: var(--primary);
            transform: translateX(-5px);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), #aa00ff);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--darker);
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .feature-info h4 {
            color: var(--text);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .feature-info p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* الإحصائيات السريعة */
        .quick-info {
            display: flex;
            gap: 25px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid rgba(0, 255, 255, 0.1);
        }

        .info-piece {
            text-align: center;
            flex: 1;
        }

        .info-number {
            display: block;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), #aa00ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 5px;
        }

        .info-label {
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ===== تحسينات التجاوب ===== */
        @media (max-width: 992px) {
            .about-wrapper {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .about-image-side {
                max-width: 400px;
                margin: 0 auto;
                order: -1;
            }

            .about-heading::after {
                right: 50%;
                transform: translateX(50%);
            }

            .about-content-side {
                text-align: center;
            }

            .welcome-badge {
                margin-right: auto;
                margin-left: auto;
            }

            .feature-block {
                text-align: right;
            }

            .quick-info {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .about-section {
                padding: 80px 0;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .about-heading {
                font-size: 1.8rem;
            }

            .quick-info {
                flex-direction: column;
                gap: 15px;
                max-width: 200px;
                margin-right: auto;
                margin-left: auto;
            }

            .image-dots {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 2rem;
            }

            .feature-block {
                flex-direction: column;
                text-align: center;
            }

            .feature-icon {
                margin-bottom: 10px;
            }

            .image-shape {
                display: none;
            }
        }
    </style>

     <style>
        /* ===== تنسيق الفوتر المتوافق مع الثيمات ===== */

        footer {
            background: var(--darker);
            padding: 70px 0 30px;
            color: var(--text);
            position: relative;
            overflow: hidden;
            border-top: 1px solid var(--glass-border);
        }

        .footer-content {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        /* ===== الشعار ===== */
        .footer-brand {
            margin-bottom: 25px;
        }

        .footer-logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .footer-logo-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--darker);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.3);
        }

        /* تحديث لون الظل حسب الثيم */
        .footer-logo-icon {
            box-shadow: 0 10px 25px var(--primary);
        }

        .footer-logo-text {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-tagline {
            color: var(--text-secondary);
            font-size: 1rem;
            letter-spacing: 1px;
        }

        /* ===== الوصف ===== */
        .footer-description {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 1rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        /* ===== الخط الفاصل المزخرف ===== */
        .footer-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 10px 0;
        }

        .divider-line {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .divider-icon {
            width: 40px;
            height: 40px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        /* ===== قسم التواصل الاجتماعي ===== */
        .footer-social {
            margin: 30px 0;
        }

        .social-title {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 400;
            margin-bottom: 20px;
            letter-spacing: 2px;
            opacity: 0.8;
        }

        .footer-social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.4rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .social-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: var(--gradient-1);
            transform: translate(-50%, -50%);
            transition: all 0.5s ease;
            z-index: -1;
        }

        .social-icon:hover::before {
            width: 100px;
            height: 100px;
        }

        .social-icon:hover {
            color: var(--darker);
            border-color: transparent;
            transform: translateY(-5px) rotate(5deg);
            box-shadow: 0 10px 25px var(--primary);
        }

        /* ===== خط فاصل بسيط ===== */
        .footer-line {
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            margin: 30px auto;
        }

        /* ===== القسم السفلي ===== */
        .footer-bottom {
            text-align: center;
        }

        .copyright {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 8px;
            opacity: 0.8;
        }

        .designer {
            color: var(--text-secondary);
            font-size: 0.9rem;
            opacity: 0.7;
        }

        .designer-name {
            color: var(--primary);
            font-weight: 600;
            position: relative;
            cursor: default;
        }

        .designer-name:hover {
            text-decoration: underline;
        }

        /* ===== أنيميشن الخلفية ===== */
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* ===== خلفية متحركة خفيفة ===== */
        footer::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            opacity: 0.03;
            animation: rotate 30s linear infinite;
        }

        /* ===== تحسينات التجاوب ===== */
        @media (max-width: 768px) {
            footer {
                padding: 30px 0 75px;
            }

            .footer-logo-text {
                font-size: 1.6rem;
            }

            .footer-logo-icon {
                width: 40px;
                height: 40px;
                font-size: 1.4rem;
            }

            .social-icon {
                width: 35px;
                height: 35px;
                font-size: 1.2rem;
            }

            .divider-line {
                width: 40px;
            }
        }

        @media (max-width: 480px) {
            .footer-logo-wrapper {
                flex-direction: column;
                gap: 10px;
            }

            .footer-description {
                font-size: 0.9rem;
            }

            .social-icon {
                width: 30px;
                height: 30px;
                font-size: 1.1rem;
            }

            .footer-social-links {
                gap: 12px;
            }

            .copyright,
            .designer {
                font-size: 0.85rem;
            }
        }
    </style>


</head>

<body>
    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Profile Image Modal -->
    <div id="profileImageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 99999; align-items: center; justify-content: center;">
        <div style="max-width: 90%; max-height: 90%; text-align: center; position: relative;">
            <span onclick="closeProfileModal()" style="position: absolute; top: 10px; right: 20px; color: white; font-size: 30px; cursor: pointer;">&times;</span>
            @if($heroImage)
            <img src="{{ asset('storage/' . $heroImage->image_path) }}" style="max-width: 100%; max-height: 85vh; border-radius: 15px; border: 4px solid var(--primary);">
            @else
            <img src="{{ asset('18697.jpg') }}" style="max-width: 100%; max-height: 85vh; border-radius: 15px; border: 4px solid var(--primary);">
            @endif
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" onclick="openProfileModal(); return false;" style="text-decoration: none; display: flex; align-items: center; gap: 10px; color: var(--text);">
                @if($heroImage)
                <img src="{{ asset('storage/' . $heroImage->image_path) }}" alt="الصورة الشخصية" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                @else
                <img src="{{ asset('18697.jpg') }}" alt="الصورة الشخصية" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                @endif
                <span style="font-weight: 700; font-size: 1.2rem;">{{ $about->name ?? 'عمر المحجري' }}</span>
            </a>

            <ul class="nav-links">
                <li><a href="#home">الرئيسية</a></li>
                <li><a href="#about">من أنا</a></li>
              <li><a href="#experience">الخبرات والتعلم</a></li>
                <li><a href="#services">خدماتي</a></li>
                <li><a href="#skills">مهاراتي</a></li>
                <li><a href="#portfolio">أعمالي</a></li>
                <li><a href="#contact">تواصل</a></li>
                <li id="authNavItem">
                    <a href="{{ url('/login') }}" id="authNavLink">
                        <i class="fas fa-user"></i> <span id="authNavText">تسجيل الدخول</span>
                    </a>
                </li>
                <li class="theme-selector-nav">
                    <button class="theme-btn-nav cyan active" data-theme="default"></button>
                    <button class="theme-btn-nav golden" data-theme="golden"></button>
                    <button class="theme-btn-nav light" data-theme="light"></button>
                </li>
            </ul>


            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>

        </div>
        <li class="theme-selector ">
            <button class="theme-btn-nav cyan active" data-theme="default"></button>
            <button class="theme-btn-nav golden" data-theme="golden"></button>
            <button class="theme-btn-nav light" data-theme="light"></button>
        </li>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <a href="#" onclick="openProfileModal(); return false;" class="mobile-sidebar-logo" style="text-decoration: none; color: var(--text);">
                @if($heroImage)
                <img src="{{ asset('storage/' . $heroImage->image_path) }}" alt="الصورة الشخصية" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                @else
                <img src="{{ asset('18697.jpg') }}" alt="الصورة الشخصية" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                @endif
                <span>{{ $about->name ?? 'عمر المحجري' }}</span>
            </a>
            <button class="close-sidebar" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <ul class="mobile-nav-links">
            <li><a href="#home" class="sidebar-link"><i class="fas fa-home"></i> الرئيسية</a></li>
            <li><a href="#about" class="sidebar-link"><i class="fas fa-user"></i> من أنا</a></li>
            <li><a href="#services" class="sidebar-link"><i class="fas fa-cogs"></i> خدماتي</a></li>
            <li><a href="#experience" class="sidebar-link"><i class="fas fa-certificate"></i> الخبرات والتعلم</a></li>
            <li><a href="#skills" class="sidebar-link"><i class="fas fa-chart-bar"></i> مهاراتي</a></li>
            <li><a href="#portfolio" class="sidebar-link"><i class="fas fa-briefcase"></i> أعمالي</a></li>
            <li><a href="#contact" class="sidebar-link"><i class="fas fa-envelope"></i> تواصل</a></li>
        </ul>

        <div class="mobile-theme-selector">
            <h4>اختر الثيم</h4>
            <div class="mobile-theme-buttons">
                <button class="mobile-theme-btn cyan active" data-theme="default"></button>
                <button class="mobile-theme-btn golden" data-theme="golden"></button>
                <button class="mobile-theme-btn light" data-theme="light"></button>
            </div>
        </div>

        <div class="mobile-sidebar-footer">
            <p>تواصل معي عبر</p>
            <div class="mobile-social-links">
                @foreach ($links as $l)
                    <a href="{{ $l->url }}" target="_blank"><i class="{{ $l->icon }}"></i></a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Hero Section -->
    {{-- <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-greeting">
                    <span class="waving-hand">👋</span>
                    مرحباً بكم في عالمي الرقمي
                </div>

                <h1 class="hero-title">
                    أنا <span style="color: var(--primary);">{{ $about->name ?? 'أحمد محمد' }}</span>
                </h1>

                <p class="hero-subtitle">
                    {{ $about->description ?? 'مطور Full-Stack متخصص في بناء حلول مبتكرة باستخدام Flutter، Laravel، و C#. أحول الأفكار إلى واقع رقمي مع الحفاظ على أعلى معايير الجودة.' }}
                </p>

                <div class="tech-stack">
                    @forelse($tech_stacks as $tech)
                    <div class="tech-badge">
                        <i class="{{ $tech->icon }}"></i>
                        {{ $tech->name }}
                    </div>
                    @empty
                    <div class="tech-badge">Flutter</div>
                    <div class="tech-badge">Laravel</div>
                    <div class="tech-badge">C#</div>
                    <div class="tech-badge">Firebase</div>
                    <div class="tech-badge">MySQL</div>
                    @endforelse
                </div>

                <div class="hero-buttons">
                    <a href="#portfolio" class="btn btn-primary">
                        <i class="fas fa-briefcase"></i>
                        شاهد أعمالي
                    </a>
                    <a href="#contact" class="btn btn-outline">
                        <i class="fas fa-envelope"></i>
                        تواصل معي
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="floating-cards">
                    <div class="card card-1">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="card-text">تطبيقات الجوال</div>
                        </div>
                    </div>
                    <div class="card card-2">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="card-text">تطوير الويب</div>
                        </div>
                    </div>
                    <div class="card card-3">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="card-text">حلول المؤسسات</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="hero-stats">
            <div class="stat-item" data-aos="fade-up">
                <div class="stat-number">{{ $projects_count ?? 0 }}+</div>
                <div class="stat-label">مشروع مكتمل</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number">{{ $experiences_count ?? 0 }}+</div>
                <div class="stat-label">سنوات خبرة</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number">{{ $links_count ?? 0 }}+</div>
                <div class="stat-label">عملاء / روابط</div>
            </div>
        </div>
    </section> --}}

    <!-- Hero Section - تصميم رسمي مع خلفية ومربعات -->
    <section class="hero" id="home">


        <div class="hero-container">
            <!-- المحتوى النصي -->
            <div class="hero-content" data-aos="fade-left">
                {{-- <div class="hero-greeting">
                    <span class="waving-hand">👋</span>
                    <span class="greeting-text">مرحباً بكم في عالمي الرقمي</span>
                </div> --}}


                <h1 class="hero-title">
                    أنا <span style="color: var(--primary);">{{ $about->name ?? 'عمر المحجري' }}</span>
                </h1>

                {{-- <p class="hero-subtitle">
                    {{ $about->description ?? 'مطور Full-Stack متخصص في بناء حلول مبتكرة باستخدام Flutter، Laravel، و C#. أحول الأفكار إلى واقع رقمي مع الحفاظ على أعلى معايير الجودة.' }}
                </p> --}}
                <p class="hero-subtitle" id="typing"></p>

                <script>
                    let i = 0;
                    let text = "{{ $about->description ?? 'مطور Full-Stack متخصص في بناء حلول مبتكرة' }}";

                    function type() {
                        if (i < text.length) {
                            document.getElementById("typing").innerHTML += text.charAt(i);
                            i++;
                            setTimeout(type, 70);
                        }
                    }

                    type();
                </script>

                <!-- التقنيات مع أيقونات -->
                <div class="tech-stack">
                    @forelse($tech_stacks as $tech)
                    <div class="tech-item">
                        <i class="{{ $tech->icon }}"></i>
                        <span>{{ $tech->name }}</span>
                    </div>
                    @empty
                    <div class="tech-item">
                        <i class="fab fa-flutter"></i>
                        <span>Flutter</span>
                    </div>
                    <div class="tech-item">
                        <i class="fab fa-laravel"></i>
                        <span>Laravel</span>
                    </div>
                    <div class="tech-item">
                        <i class="fas fa-code"></i>
                        <span>C#</span>
                    </div>
                    @endforelse
                </div>

                <!-- الأزرار -->
                <div class="hero-buttons">
                    <a href="#portfolio" class="btn btn-primary ds_non">
                        <i class="fas fa-briefcase"></i>
                        <span>شاهد أعمالي</span>
                    </a>
                    <a href="#contact" class="btn btn-outline ds_non">
                        <i class="fas fa-envelope"></i>
                        <span>تواصل معي</span>
                    </a>
                    @if($cvUrl)
                    <a href="{{ $cvUrl }}" target="_blank" class="btn btn-outline">
                        <i class="fas fa-download"></i>
                        <span>Download CV</span>
                    </a>
                    @else
                    <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;" title="لا توجد سيرة ذاتية متاحة">
                        <i class="fas fa-download"></i>
                        <span>Download CV</span>
                    </span>
                    @endif

                </div>
            </div>

            <!-- العنصر البصري مع صورة -->
            <div class="hero-visual" data-aos="fade-right">
                <div class="visual-wrapper">
                    <!-- إطار الصورة الرئيسية مع Gallery -->
                    <div class="image-frame">
                        <div class="frame-decoration top-left"></div>
                        <div class="frame-decoration top-right"></div>
                        <div class="frame-decoration bottom-left"></div>
                        <div class="frame-decoration bottom-right"></div>

                        <div class="main-image">
                            <div class="image-overlay"></div>
                            @if(isset($galleryImages) && $galleryImages->count() > 0)
                            <div class="gallery-carousel">
                                @foreach($galleryImages as $index => $img)
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->alt_text ?? 'صورة ' . ($index + 1) }}"
                                    class="profile-image carousel-image {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                @endforeach
                                @if($galleryImages->count() > 1)
                                <div class="carousel-controls">
                                    <button class="carousel-btn prev" onclick="changeSlide(-1)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                    <div class="carousel-dots">
                                        @foreach($galleryImages as $index => $img)
                                        <span class="carousel-dot {{ $index == 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></span>
                                        @endforeach
                                    </div>
                                    <button class="carousel-btn next" onclick="changeSlide(1)">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                </div>
                                @endif
                            </div>
                            @else
                            <img src="{{ asset('18697.jpg') }}" alt="{{ $about->name ?? 'عمر المحجري' }}"
                                class="profile-image">
                            @endif


                            <div class="main-image">
                            <div class="image-overlay"></div>
                            <img src="http://127.0.0.1:8000/18697.jpg" alt="عمر  المحجري" class="profile-image">
                        </div>
                        </div>
                    </div>

                    <!-- بطاقات إحصائية عائمة -->
                    {{-- <div class="floating-stats">
                        <div class="stat-card card-1">
                            <div class="stat-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">{{ $projects_count ?? 50 }}+</span>
                                <span class="stat-label">مشروع</span>
                            </div>
                        </div>

                        <div class="stat-card card-2">
                            <div class="stat-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">{{ $experiences_count ?? 5 }}+</span>
                                <span class="stat-label">سنوات</span>
                            </div>
                        </div>

                        <div class="stat-card card-3">
                            <div class="stat-icon">
                                <i class="fas fa-smile"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">{{ $links_count ?? 30 }}+</span>
                                <span class="stat-label">عميل</span>
                            </div>
                        </div>
                    </div> --}}

                    <!-- بطاقات الخدمات -->
                    {{-- <div class="floating-cards">
                        <div class="service-card card-dev">
                            <i class="fas fa-mobile-alt"></i>
                            <span>تطبيقات الجوال</span>
                        </div>
                        <div class="service-card card-web">
                            <i class="fas fa-code"></i>
                            <span>تطوير الويب</span>
                        </div>
                        <div class="service-card card-enterprise">
                            <i class="fas fa-database"></i>
                            <span>حلول مؤسسات</span>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- شريط الإحصائيات السفلي -->
        {{-- <div class="stats-bar">
            <div class="stats-container">
                <div class="stats-item">
                    <div class="stats-number">{{ $projects_count ?? 50 }}+</div>
                    <div class="stats-label">مشروع مكتمل</div>
                </div>
                <div class="stats-divider"></div>
                <div class="stats-item">
                    <div class="stats-number">{{ $experiences_count ?? 5 }}+</div>
                    <div class="stats-label">سنوات خبرة</div>
                </div>
                <div class="stats-divider"></div>
                <div class="stats-item">
                    <div class="stats-number">{{ $links_count ?? 30 }}+</div>
                    <div class="stats-label">عملاء سعداء</div>
                </div>
                <div class="stats-divider"></div>
                <div class="stats-item">
                    <div class="stats-number">24/7</div>
                    <div class="stats-label">دعم فني</div>
                </div>
            </div>
        </div> --}}
    </section>



    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <div class="nav-items">
            <button class="nav-item active" data-target="home">
                <div class="nav-indicator"></div>
                <i class="fas fa-home nav-icon"></i>
                <span class="nav-label">الرئيسية</span>
            </button>
            <button class="nav-item ds_non" data-target="about">
                <div class="nav-indicator"></div>
                <i class="fas fa-user nav-icon"></i>
                <span class="nav-label">من أنا</span>
            </button>
              <button class="nav-item" data-target="experience">
                <div class="nav-indicator"></div>
                <i class="fas fa-certificate nav-icon"></i>
                <span class="nav-label">الخبرات والتعلم</span>
            </button>
            <button class="nav-item" data-target="services">
                <div class="nav-indicator"></div>
                <i class="fas fa-cogs nav-icon"></i>
                <span class="nav-label">خدماتي</span>
            </button>

            <button class="nav-item" data-target="skills">
                <div class="nav-indicator"></div>
                <i class="fas fa-chart-bar nav-icon"></i>
                <span class="nav-label">مهاراتي</span>
            </button>
            <button class="nav-item" data-target="portfolio">
                <div class="nav-indicator"></div>
                <i class="fas fa-briefcase nav-icon"></i>
                <span class="nav-label">أعمالي</span>
            </button>
            <button class="nav-item ds_non" data-target="contact">
                <div class="nav-indicator"></div>
                <i class="fas fa-envelope nav-icon"></i>
                <span class="nav-label">تواصل</span>
            </button>
            <button class="nav-item" id="chat-nav-btn">
                <div class="nav-indicator"></div>
                <i class="fas fa-comments nav-icon"></i>
                <span class="nav-label">دردشة</span>
            </button>
        </div>
    </nav>

    <!-- About Section -->
    {{-- <section class="section about" id="about">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">من أنا</h2>
                <p class="section-subtitle">تعرف على رحلتي في عالم البرمجة والتطوير</p>
            </div>

            <div class="about-content">
                <div class="about-text" data-aos="fade-right">
                    <h3>مطور حلول رقمية متكاملة</h3>
                    <p class="about-description">
                        {{ $about->bio ?? 'أنا مطور برمجيات محترف بخبرة تزيد عن 5 سنوات في مجال تطوير تطبيقات الويب والجوال. أمتلك شغفاً كبيراً بالتكنولوجيا والابتكار، وأسعى دائماً لتقديم حلول مبتكرة تلبي احتياجات العملاء وتساهم في نجاح مشاريعهم.' }}
                    </p>

                    <p class="about-description">
                        {{ $about->description ?? 'تخصصت في تطوير تطبيقات Flutter متعددة المنصات، وأنظمة Laravel المتكاملة، وحلول C# للمؤسسات. أؤمن بأهمية الجودة والأمان والأداء في كل مشروع أعمل عليه.' }}
                    </p>

                    <div class="about-features">
                        @if (isset($about_features) && $about_features->count())
                            @foreach ($about_features as $i => $f)
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}">
                                    <div class="feature-icon">
                                        @if (!empty($f->icon))
                                            <i class="{{ $f->icon }}"></i>
                                        @else
                                            <i class="fas fa-cog"></i>
                                        @endif
                                    </div>
                                    <div class="feature-text">
                                        <h4>{{ $f->title }}</h4>
                                        <p>{{ $f->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>تطوير تطبيقات Flutter</h4>
                                    <p>بناء تطبيقات متعددة المنصات بأداء فائق</p>
                                </div>
                            </div>

                            <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="feature-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>تطوير Laravel</h4>
                                    <p>إنشاء أنظمة ويب متكاملة وآمنة</p>
                                </div>
                            </div>

                            <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="feature-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>حلول C#</h4>
                                    <p>تطوير تطبيقات سطح المكتب والمؤسسات</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="about-image" data-aos="fade-left">
                    <!-- يمكن إضافة صورة هنا -->
                </div>
            </div>
        </div>
    </section> --}}
    <!-- About Section - تصميم جديد للمحتوى الأساسي فقط -->
    <section class="" id="about">
        <div class="container">
            <!-- عنوان القسم -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">نبذة عني</h2>
                <div class="title-decoration">

                </div>
            </div>

            <!-- المحتوى الأساسي - نفس الـ content القديم بتصميم جديد -->
            <div class="about-wrapper">


                <!-- النص (نفس المحتوى) -->
                <div class="about-content-side" data-aos="fade-right">
                    <!-- welcome badge -->
                    <div class="welcome-badge">
                        <span class="badge-dot"></span>
                        <span class="badge-text">تعرف علي</span>
                    </div>

                    <!-- العنوان -->
                    <h3 class="about-heading">مطور حلول رقمية متكاملة</h3>

                    <!-- الوصف الأول -->
                    <p class="about-paragraph">
                        {{ $about->bio ?? 'أنا مطور برمجيات محترف بخبرة تزيد عن 5 سنوات في مجال تطوير تطبيقات الويب والجوال. أمتلك شغفاً كبيراً بالتكنولوجيا والابتكار، وأسعى دائماً لتقديم حلول مبتكرة تلبي احتياجات العملاء وتساهم في نجاح مشاريعهم.' }}
                    </p>

                    <!-- الوصف الثاني -->
                    <p class="about-paragraph">
                        {{ $about->description ?? 'تخصصت في تطوير تطبيقات Flutter متعددة المنصات، وأنظمة Laravel المتكاملة، وحلول C# للمؤسسات. أؤمن بأهمية الجودة والأمان والأداء في كل مشروع أعمل عليه.' }}
                    </p>

                    <!-- المميزات (نفس الفيتشرز) -->
                    <div class="features-list">
                        @if (isset($about_features) && $about_features->count())
                            @foreach ($about_features as $i => $f)
                                <div class="feature-block" data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}">
                                    <div class="feature-icon">
                                        @if (!empty($f->icon))
                                            <i class="{{ $f->icon }}"></i>
                                        @else
                                            <i class="fas fa-cog"></i>
                                        @endif
                                    </div>
                                    <div class="feature-info">
                                        <h4>{{ $f->title }}</h4>
                                        <p>{{ $f->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="100">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="feature-info">
                                    <h4>تطوير تطبيقات Flutter</h4>
                                    <p>بناء تطبيقات متعددة المنصات بأداء فائق</p>
                                </div>
                            </div>

                            <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                                <div class="feature-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="feature-info">
                                    <h4>تطوير Laravel</h4>
                                    <p>إنشاء أنظمة ويب متكاملة وآمنة</p>
                                </div>
                            </div>

                            <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                                <div class="feature-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="feature-info">
                                    <h4>حلول C#</h4>
                                    <p>تطوير تطبيقات سطح المكتب والمؤسسات</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- <!-- إحصائيات سريعة (إضافة بسيطة) -->
                    <div class="quick-info">
                        <div class="info-piece">
                            <span class="info-number">{{ $projects_count ?? 50 }}+</span>
                            <span class="info-label">مشروع</span>
                        </div>
                        <div class="info-piece">
                            <span class="info-number">{{ $experiences_count ?? 5 }}+</span>
                            <span class="info-label">سنوات</span>
                        </div>
                        <div class="info-piece">
                            <span class="info-number">{{ $links_count ?? 30 }}+</span>
                            <span class="info-label">عميل</span>
                        </div>
                    </div> --}}
                </div>

                <!-- الصورة (نفس المكان) -->
                <div class="about-image-side" data-aos="fade-left">
                    <div class="image-container">
                        <div class="image-shape"></div>
                        @if($aboutImage)
                        <img src="{{ asset('storage/' . $aboutImage->image_path) }}" alt="{{ $aboutImage->alt_text ?? $about->name }}"
                            class="about-image">
                        @else
                        <img src="{{ asset('2151005751.jpg') }}" alt="{{ $about->name ?? 'عمر المحجري' }}"
                            class="about-image">
                        @endif
                        <div class="image-dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Page - صفحة نبذة عني كاملة -->
    <section class="about-page" id="about">
        {{-- <!-- Header خاص بالصفحة -->
        <div class="about-header">
            <div class="container">
                <div class="header-content" data-aos="fade-up">
                    <span class="header-tag">نبذة عني</span>
                    <h1 class="header-title">مرحباً، أنا <span>{{ $about->name ?? 'أحمد محمد' }}</span></h1>
                    <div class="header-line"></div>
                    <p class="header-subtitle">مطور حلول رقمية متكاملة | Flutter • Laravel • C#</p>
                </div>
            </div>
        </div> --}}

        <!-- المحتوى الرئيسي -->
        <div class="about-main-content">
            <div class="container">
                <!-- القسم الأول: السيرة الذاتية -->
                {{-- <div class="bio-section" data-aos="fade-up">
                    <div class="bio-grid">
                        <div class="bio-image">
                            <div class="image-frame">
                                <img src="https://via.placeholder.com/500x600/667eea/ffffff?text=ABOUT"
                                    alt="{{ $about->name ?? 'أحمد محمد' }}" class="profile-img">
                                <div class="image-badge">
                                    <i class="fas fa-check-circle"></i>
                                    <span>متاح للعمل</span>
                                </div>
                            </div>
                        </div>

                        <div class="bio-text">
                            <h2 class="bio-title">من أنا؟</h2>
                            <div class="bio-description">
                                <p>
                                    {{ $about->bio ?? 'أنا مطور برمجيات محترف بخبرة تزيد عن 5 سنوات في مجال تطوير تطبيقات الويب والجوال. أمتلك شغفاً كبيراً بالتكنولوجيا والابتكار، وأسعى دائماً لتقديم حلول مبتكرة تلبي احتياجات العملاء وتساهم في نجاح مشاريعهم.' }}
                                </p>
                                <p>
                                    {{ $about->description ?? 'تخصصت في تطوير تطبيقات Flutter متعددة المنصات، وأنظمة Laravel المتكاملة، وحلول C# للمؤسسات. أؤمن بأهمية الجودة والأمان والأداء في كل مشروع أعمل عليه.' }}
                                </p>
                            </div>

                            <!-- إحصائيات -->
                            <div class="bio-stats">
                                <div class="stat-box">
                                    <span class="stat-number">{{ $projects_count ?? 50 }}+</span>
                                    <span class="stat-label">مشروع مكتمل</span>
                                </div>
                                <div class="stat-box">
                                    <span class="stat-number">{{ $experiences_count ?? 5 }}+</span>
                                    <span class="stat-label">سنوات خبرة</span>
                                </div>
                                <div class="stat-box">
                                    <span class="stat-number">{{ $links_count ?? 30 }}+</span>
                                    <span class="stat-label">عميل سعيد</span>
                                </div>
                            </div>

                            <!-- أزرار -->
                            <div class="bio-actions">
                                <a href="#contact" class="btn btn-primary">
                                    <i class="fas fa-envelope"></i>
                                    تواصل معي
                                </a>
                                <a href="#" class="btn btn-outline">
                                    <i class="fas fa-download"></i>
                                    تحميل السيرة الذاتية
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- القسم الثاني: الخبرات والتعليم -->
                <section class="experience-section" data-aos="fade-up" id="experience">
                    <h2 class="section-title">الخبرات والتعليم</h2>
                    <div class="timeline-grid">
                        <!-- الخبرات العملية -->
                        <div class="timeline-col">
                            <h3 class="timeline-head">
                                <i class="fas fa-briefcase"></i>
                                الخبرات العملية
                            </h3>

                            <div class="timeline-items">
                                @forelse ($experiences as $exp)
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <span class="timeline-date">{{ $exp->duration ?? '' }}</span>
                                        <h4>{{ $exp->title }}</h4>
                                        @if($exp->company)
                                        <span class="timeline-company">{{ $exp->company }}</span>
                                        @endif
                                        @if($exp->description)
                                        <p>{{ $exp->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <p style="color: var(--text-secondary);">لا توجد خبرات حتى الآن</p>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- التعليم والشهادات -->
                        <div class="timeline-col">
                            <h3 class="timeline-head">
                                <i class="fas fa-graduation-cap"></i>
                                التعليم والشهادات
                            </h3>

                            <div class="timeline-items">
                                @forelse ($certificates as $cert)
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <span class="timeline-date">{{ $cert->year ?? '' }}</span>
                                        <h4>{{ $cert->title }}</h4>
                                        @if($cert->issuer)
                                        <span class="timeline-company">{{ $cert->issuer }}</span>
                                        @endif
                                        @if($cert->image)
                                        <p style="margin-top: 10px;">
                                            <a href="#" onclick="event.preventDefault(); viewCertificate('{{ asset('storage/' . $cert->image) }}', '{{ $cert->title }}')" style="color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                                                <i class="fas fa-certificate"></i> عرض الشهادة
                                            </a>
                                        </p>
                                        @endif
                                        @if($cert->description)
                                        <p>{{ $cert->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <p style="color: var(--text-secondary);">لا توجد شهادات حتى الآن</p>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Certificate Modal -->
                <div id="certificateModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center;">
                    <div style="max-width: 90%; max-height: 90%; text-align: center;">
                        <span onclick="closeCertificateModal()" style="position: absolute; top: 20px; right: 20px; color: white; font-size: 30px; cursor: pointer;">&times;</span>
                        <h3 id="certModalTitle" style="color: white; margin-bottom: 20px;"></h3>
                        <img id="certModalImage" src="" style="max-width: 100%; max-height: 80vh; border-radius: 10px; border: 3px solid var(--primary);">
                    </div>
                </div>

                <script>
                function viewCertificate(imageUrl, title) {
                    document.getElementById('certModalImage').src = imageUrl;
                    document.getElementById('certModalTitle').textContent = title;
                    document.getElementById('certificateModal').style.display = 'flex';
                }

                function closeCertificateModal() {
                    document.getElementById('certificateModal').style.display = 'none';
                }

                document.getElementById('certificateModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeCertificateModal();
                    }
                });

                // Profile Image Modal Functions
                function openProfileModal() {
                    document.getElementById('profileImageModal').style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }

                function closeProfileModal() {
                    document.getElementById('profileImageModal').style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                document.getElementById('profileImageModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeProfileModal();
                    }
                });
                </script>

            </div>
        </div>
    </section>




    <!-- Services Section -->
    <section class="section services" id="services">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">خدماتي</h2>
                <p class="section-subtitle">حلول تقنية متكاملة تلبي جميع احتياجاتك</p>
            </div>

            <div class="services-grid">
                @foreach ($services as $idx => $service)
                    <div class="service-card" data-aos="fade-up" data-aos-delay="{{ 100 * ($idx + 1) }}">
                        <div class="service-icon">
                            @if (!empty($service->icon))
                                <i class="{{ $service->icon }}"></i>
                            @else
                                <i class="fas fa-cogs"></i>
                            @endif
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="section skills" id="skills">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">مهاراتي التقنية</h2>
                <p class="section-subtitle">المهارات والخبرات التي أتميز بها</p>
            </div>

            <div class="skills-container">
                @if (isset($skill_categories) && $skill_categories->count())
                    @foreach ($skill_categories as $idx => $cat)
                        <div class="skill-category" data-aos="fade-up" data-aos-delay="{{ 100 * ($idx + 1) }}">
                            <h3>{{ $cat->title }}</h3>

                            @forelse($cat->items as $item)
                                <div class="skill-item">
                                    <div class="skill-header">
                                        <span class="skill-name">{{ $item->name }}</span>
                                        <span class="skill-level">{{ $item->level }}</span>
                                    </div>
                                    <div class="skill-bar">
                                        <div class="skill-progress" style="width: {{ $item->level }}"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="skill-item">
                                    <div class="skill-header">
                                        <span class="skill-name">لا توجد مهارات بعد</span>
                                        <span class="skill-level">0%</span>
                                    </div>
                                    <div class="skill-bar">
                                        <div class="skill-progress" style="width: 0%"></div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    @endforeach
                @else
                    <!-- Fallback: original static layout -->
                    {{-- <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                        <h3>تطوير الواجهات الأمامية</h3>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">HTML/CSS</span>
                                <span class="skill-level">95%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">JavaScript</span>
                                <span class="skill-level">90%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">React/Vue</span>
                                <span class="skill-level">85%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                        <h3>تطوير الواجهات الخلفية</h3>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">PHP/Laravel</span>
                                <span class="skill-level">92%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">MySQL/PostgreSQL</span>
                                <span class="skill-level">88%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">REST APIs</span>
                                <span class="skill-level">90%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                        <h3>تطوير تطبيقات الجوال</h3>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">Flutter/Dart</span>
                                <span class="skill-level">93%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 93%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">Firebase</span>
                                <span class="skill-level">85%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">C#/.NET</span>
                                <span class="skill-level">87%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 87%"></div>
                            </div>
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>
    </section>


    <!-- Portfolio Section -->
    <section class="section portfolio" id="portfolio">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">معرض الأعمال</h2>
                <p class="section-subtitle">أحدث مشاريعي وإبداعاتي التقنية</p>
            </div>

            <div class="portfolio-filter" data-aos="fade-up" data-aos-delay="100">
                <button class="filter-btn active" data-filter="all">الكل</button>
                @php
                    $categories = $projects->pluck('categorie_project')->unique()->filter();
                @endphp
                @foreach($categories as $cat)
                    <button class="filter-btn" data-filter="{{ strtolower($cat) }}">{{ $cat }}</button>
                @endforeach
            </div>

            <div class="portfolio-grid">
                @foreach ($projects as $idx => $project)
                    <div class="portfolio-item"
     data-category="{{ strtolower($project->categorie_project) }}"
     data-aos="fade-up"
     data-aos-delay="{{ 100 * ($idx + 1) }}">
                        <img src="{{ $project->image ?? 'https://via.placeholder.com/400x300' }}"
                            alt="{{ $project->title }}" class="portfolio-img">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h3>{{ $project->title }}</h3>
                                <p>{{ Str::limit($project->description, 80) }}</p>
                                <div class="portfolio-links">
                                    <a class="portfolio-link" onclick="openProjectModal({{ $project->id }})">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="portfolio-link {{ !$project->url ? 'disabled' : '' }}"
                                       {{ $project->url ? 'href=' . $project->url . ' target=_blank' : '' }}>
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Project Modal -->
            <div id="projectModal" class="project-modal-overlay">
                <div class="project-modal-content">
                    <button class="project-modal-close" onclick="closeProjectModal()">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="project-modal-image-wrapper">
                        <img src="" id="projectModalImage" class="project-modal-image">
                    </div>

                    <div class="project-modal-body">
                        <h3 id="projectModalTitle" class="project-modal-title"></h3>
                        <p id="projectModalDescription" class="project-modal-desc"></p>

                        <div class="project-modal-actions">
                            <a href="#" id="projectModalLink" target="_blank" class="btn btn-primary project-modal-btn" style="display: none;">
                                <i class="fas fa-external-link-alt"></i> زيارة المشروع
                            </a>
                            <button onclick="closeProjectModal()" class="btn btn-outline project-modal-btn">
                                <i class="fas fa-times"></i> إغلاق
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            const projectsData = {
                @foreach ($projects as $project)
                {{ $project->id }}: {
                    title: {!! json_encode($project->title) !!},
                    description: {!! json_encode($project->description) !!},
                    image: {!! json_encode($project->image) !!},
                    url: {!! json_encode($project->url ?? '') !!}
                },
                @endforeach
            };

            function openProjectModal(id) {
                const p = projectsData[id];
                if (!p) return;

                document.getElementById('projectModalImage').src = p.image;
                document.getElementById('projectModalTitle').textContent = p.title;
                document.getElementById('projectModalDescription').textContent = p.description;

                const link = document.getElementById('projectModalLink');
                if (p.url) {
                    link.href = p.url;
                    link.style.display = 'inline-flex';
                } else {
                    link.style.display = 'none';
                }

                document.getElementById('projectModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closeProjectModal() {
                document.getElementById('projectModal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            document.getElementById('projectModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeProjectModal();
                }
            });
            </script>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact" id="contact">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">تواصل معي</h2>
                <p class="section-subtitle">لنبدأ مشروعك القادم معاً</p>
            </div>

            <div class="contact-content">
                <div class="contact-info" data-aos="fade-right">
                    <h3>معلومات التواصل</h3>
                    <p>يمكنك التواصل معي عبر أي من الوسائل التالية:</p>

                    @if($settings && $settings->contact_email)
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>البريد الإلكتروني</h4>
                            <p>{{ $settings->contact_email }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="social-links">
                        @if($settings)
                            @if($settings->facebook)
                                <a href="{{ $settings->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
                            @endif
                            @if($settings->twitter)
                                <a href="{{ $settings->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if($settings->instagram)
                                <a href="{{ $settings->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($settings->linkedin)
                                <a href="{{ $settings->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                            @endif
                            @if($settings->github)
                                <a href="{{ $settings->github }}" target="_blank"><i class="fab fa-github"></i></a>
                            @endif
                        @endif
                        @foreach ($links as $l)
                            <a href="{{ $l->url }}" target="_blank"><i class="{{ $l->icon }}"></i></a>
                        @endforeach
                    </div>
                </div>


                <div class="contact-form" data-aos="fade-left">
                    <h3>أرسل رسالة</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="الاسم الكامل"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" class="form-control"
                                placeholder="البريد الإلكتروني" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="subject" class="form-control" placeholder="الموضوع">
                        </div>
                        <div class="form-group">
                            <textarea id="message" class="form-control" rows="5" placeholder="رسالتك" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-paper-plane"></i> إرسال الرسالة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    {{-- <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="#home">الرئيسية</a>
                <a href="#about">من أنا</a>
                <a href="#services">خدماتي</a>
                <a href="#portfolio">أعمالي</a>
                <a href="#contact">تواصل</a>
            </div>
            <div class="footer-social-links">
                @foreach ($links as $l)
                    <a href="{{ $l->url }}" target="_blank"><i class="{{ $l->icon }}"></i></a>
                @endforeach
            </div>
            <p class="footer-text">&copy; 2024 {{ $about->name ?? 'أحمد محمد' }}. جميع الحقوق محفوظة | صمم بـ ❤️
                باستخدام أحدث التقنيات</p>
        </div>
    </footer> --}}

    <!-- Footer - تصميم احترافي عربي -->
    <footer>
        <div class="footer-content">
            <!-- خط فاصل مزخرف -->
            <div class="footer-divider">
                <span class="divider-line"></span>
                <span class="divider-icon"><i class="fas fa-code"></i></span>
                <span class="divider-line"></span>
            </div>
            <!-- الشعار والاسم -->
            <div class="footer-brand">
                <div class="footer-logo-wrapper">
                    <span class="footer-logo-icon">{{ substr($about->name ?? 'ع', 0, 1) }}</span>
                    <h2 class="footer-logo-text">{{ $about->name ?? 'عمر المحجري' }}</h2>
                </div>
                <p class="footer-tagline">{{ $about->bio ?? 'مطور حلول رقمية متكاملة' }}</p>
            </div>

            <!-- الوصف -->
            <p class="footer-description">
                {{ $settings->site_description ?? $about->description ?? 'مطور Full-Stack متخصص في بناء حلول مبتكرة' }}
            </p>

            <!-- أيقونات التواصل الاجتماعي -->
            <div class="footer-social">
                <h4 class="social-title">تابعني على</h4>
                <div class="footer-social-links">
                    @if($settings)
                        @if($settings->facebook)
                            <a href="{{ $settings->facebook }}" target="_blank" class="social-icon">
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif
                        @if($settings->twitter)
                            <a href="{{ $settings->twitter }}" target="_blank" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($settings->instagram)
                            <a href="{{ $settings->instagram }}" target="_blank" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($settings->linkedin)
                            <a href="{{ $settings->linkedin }}" target="_blank" class="social-icon">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        @endif
                        @if($settings->github)
                            <a href="{{ $settings->github }}" target="_blank" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                    @endif
                    @foreach ($links as $l)
                        <a href="{{ $l->url }}" target="_blank" class="social-icon">
                            <i class="{{ $l->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- خط فاصل بسيط -->
            <div class="footer-line"></div>

            <!-- الحقوق والتصميم -->
            <div class="footer-bottom">
                <p class="copyright">
                    © {{ date('Y') }} {{ $about->name ?? 'عمر المحجري' }}. جميع الحقوق محفوظة
                </p>
                <p class="designer">
                    صمم بـ <i class="fas fa-heart" style="color: #00ffff;"></i> بواسطة <span
                        class="designer-name">{{ $about->name ?? 'عمر المحجري' }}</span>
                </p>
            </div>
        </div>
    </footer>


    <!-- Chat System -->
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <div class="chat-user">
                <div class="user-avatar">
                    <img src="https://via.placeholder.com/50" alt="User">
                    <div class="user-status"></div>
                </div>
                <div>
                    <h4 style="margin: 0; font-weight: 700;">{{ $about->name ?? 'عمر المحجري' }}</h4>
                    <p style="margin: 0; opacity: 0.9;">متصل الآن - للدردشة</p>
                </div>
            </div>
            <div class="chat-actions">
                <button class="chat-action" id="minimizeChat">
                    <i class="fas fa-minus"></i>
                </button>
                <button class="chat-action" id="closeChat">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Login Required Message -->
        <div id="chatLoginRequired" style="display: none; padding: 2rem; text-align: center;">
            <i class="fas fa-lock" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h4 style="margin-bottom: 1rem;">يرجى تسجيل الدخول للدردشة</h4>
            <a href="{{ url('/login') }}" class="btn btn-primary" style="display: inline-block; text-decoration: none;">
                <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
            </a>
            <p style="margin-top: 1rem; font-size: 0.9rem; color: var(--text-secondary);">
                أو <a href="{{ url('/login') }}" style="color: var(--primary);">إنشاء حساب جديد</a>
            </p>
        </div>

        <div class="chat-messages" id="chatMessages">
        </div>

        <div class="chat-input" id="chatInputArea">
            <input type="text" placeholder="اكتب رسالتك..." id="messageInput">
            <button id="sendMessage">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <button class="chat-toggle" id="chatToggle">
        <i class="fas fa-comments"></i>
        <span class="chat-badge" id="chatBadge" style="display: none;">0</span>
    </button>

    <!-- JavaScript -->
    <script>


        // Gallery Carousel
        let currentSlide = 0;
        const images = document.querySelectorAll('.carousel-image');
        const dots = document.querySelectorAll('.carousel-dot');
        let autoSlideInterval;

        function showSlide(index) {
            if (images.length === 0) return;

            images.forEach(img => img.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            currentSlide = index;
            if (currentSlide >= images.length) currentSlide = 0;
            if (currentSlide < 0) currentSlide = images.length - 1;

            if (images[currentSlide]) images[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        }

        function changeSlide(direction) {
            showSlide(currentSlide + direction);
            resetAutoSlide();
        }

        function goToSlide(index) {
            showSlide(index);
            resetAutoSlide();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(() => changeSlide(1), 4000);
        }

        if (images.length > 0) {
            autoSlideInterval = setInterval(() => changeSlide(1), 4000);
        }

        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Particles.js Configuration
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 60,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#00ffff'
                },
                shape: {
                    type: 'circle'
                },
                opacity: {
                    value: 0.5,
                    random: true
                },
                size: {
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00ffff',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: true,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                }
            },
            retina_detect: true
        });

        // Mobile Sidebar Functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        let isSidebarOpen = false;

        function toggleSidebar() {
            isSidebarOpen = !isSidebarOpen;

            if (isSidebarOpen) {
                mobileSidebar.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                // تغيير الأيقونة إلى X
                mobileMenuBtn.innerHTML = '<i class="fas fa-times"></i>';
            } else {
                mobileSidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
                // إعادة الأيقونة إلى القائمة
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        }

        mobileMenuBtn.addEventListener('click', toggleSidebar);
        closeSidebar.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (isSidebarOpen) {
                    toggleSidebar();
                }
            });
        });

        // Theme Switching
        function setTheme(theme) {
            // Remove active class from all buttons
            document.querySelectorAll('.theme-btn-nav, .mobile-theme-btn').forEach(b => b.classList.remove('active'));

            // Remove all theme classes
            document.body.classList.remove('theme-golden', 'theme-light');

            // Add selected theme
            if (theme !== 'default') {
                document.body.classList.add(`theme-${theme}`);
            }

            // Update active buttons
            document.querySelectorAll(`[data-theme="${theme}"]`).forEach(btn => btn.classList.add('active'));

            // Update particles color based on theme
            updateParticlesColor(theme);
        }

        document.querySelectorAll('.theme-btn-nav, .mobile-theme-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const theme = this.getAttribute('data-theme');
                setTheme(theme);
            });
        });

        function updateParticlesColor(theme) {
            let color;
            switch (theme) {
                case 'golden':
                    color = '#FFD700';
                    break;
                case 'light':
                    color = '#007bff';
                    break;
                default:
                    color = '#00ffff';
            }

            // Update particles color
            if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                window.pJSDom[0].pJS.particles.color.value = color;
                window.pJSDom[0].pJS.particles.line_linked.color = color;
                window.pJSDom[0].pJS.fn.particlesRefresh();
            }
        }

        // Bottom Navigation
        const bottomNavItems = document.querySelectorAll('.nav-item');
        const sections = document.querySelectorAll('section');
        const chatNavBtn = document.getElementById('chat-nav-btn');
        const chatContainer = document.getElementById('chatContainer');
        const chatToggle = document.getElementById('chatToggle');

        bottomNavItems.forEach(item => {
            item.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                if (target) {
                    // Remove active class from all items
                    bottomNavItems.forEach(i => i.classList.remove('active'));

                    // Add active class to clicked item
                    this.classList.add('active');

                    // Scroll to target section
                    document.getElementById(target).scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Hide chat if open
                    chatContainer.classList.remove('active');
                } else if (this.id === 'chat-nav-btn') {
                    // Toggle chat
                    chatContainer.classList.toggle('active');
                    // Hide badge when opening chat
                    const chatBadge = document.getElementById('chatBadge');
                    if (chatContainer.classList.contains('active')) {
                        chatBadge.style.display = 'none';
                    }

                    // Remove active class from all items except chat
                    bottomNavItems.forEach(i => {
                        if (i.id !== 'chat-nav-btn') {
                            i.classList.remove('active');
                        }
                    });

                    // Add active class to chat button
                    this.classList.add('active');
                }
            });
        });

        // Update active nav item on scroll
        window.addEventListener('scroll', () => {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            bottomNavItems.forEach(item => {
                if (item.id !== 'chat-nav-btn') {
                    item.classList.remove('active');
                    if (item.getAttribute('data-target') === current) {
                        item.classList.add('active');
                    }
                }
            });
        });

        // Chat Toggle
        chatToggle.addEventListener('click', () => {
            chatContainer.classList.toggle('active');
            // Hide badge when opening chat
            const chatBadge = document.getElementById('chatBadge');
            if (chatContainer.classList.contains('active')) {
                chatBadge.style.display = 'none';
            }
        });

        // Chat Actions
        const minimizeChat = document.getElementById('minimizeChat');
        const closeChat = document.getElementById('closeChat');

        minimizeChat.addEventListener('click', () => {
            chatContainer.classList.toggle('minimized');
        });

        closeChat.addEventListener('click', () => {
            chatContainer.classList.remove('active');
        });

        // Portfolio Filter
        const filterBtns = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));

                // Add active class to clicked button
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');

                // Filter portfolio items
                portfolioItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Contact Form
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            if (!name || !email || !message) {
                showMessage('يرجى ملء جميع الحقول المطلوبة.', 'error');
                return;
            }

            showMessage('جاري إرسال الرسالة...', 'info');

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const res = await fetch('{{ url('/contact/send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name, email, subject, message })
                });

                const data = await res.json();

                if (!res.ok) {
                    showMessage(data.message || 'فشل إرسال الرسالة', 'error');
                    return;
                }

                showMessage('شكراً لك! تم إرسال رسالتك بنجاح وسأتصل بك قريباً.', 'success');
                this.reset();
            } catch (err) {
                console.error('Contact error:', err);
                showMessage('حدث خطأ في الاتصال بالخادم', 'error');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'var(--nav-bg)';
            } else {
                navbar.style.background = 'var(--nav-bg)';
            }
        });

        // Chat functionality
        const messageInput = document.getElementById('messageInput');
        const sendMessage = document.getElementById('sendMessage');
        const chatMessages = document.getElementById('chatMessages');
        const chatLoginRequired = document.getElementById('chatLoginRequired');
        const chatInputArea = document.getElementById('chatInputArea');

        let isAuthenticated = false;
        let currentUser = null;
        let pollInterval = null;
        let lastMessageCount = 0;
        let lastMessageTime = null;
        let authChecked = false;

        async function checkAuth() {
            try {
                const res = await fetch('/check-auth', {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();
                authChecked = true;

                if (data.authenticated) {
                    isAuthenticated = true;
                    currentUser = data.user;
                    showChat();
                    fetchMessages();
                    updateNavbarAuth();
                    startPolling();
                } else {
                    isAuthenticated = false;
                    currentUser = null;
                    showLoginRequired();
                    updateNavbarLogout();
                    stopPolling();
                }
            } catch (err) {
                console.error('Auth check failed:', err);
                authChecked = true;
                showLoginRequired();
            }
        }

        function updateNavbarAuth() {
            const authNavText = document.getElementById('authNavText');
            const authNavItem = document.getElementById('authNavItem');

            if (authNavText && currentUser && currentUser.name) {
                if (authNavText.textContent !== currentUser.name) {
                    authNavText.textContent = currentUser.name;
                }
            }
            if (authNavItem && !authNavItem.dataset.loggedIn) {
                authNavItem.dataset.loggedIn = 'true';
                authNavItem.onclick = function(e) {
                    e.preventDefault();
                    if (confirm('هل تريد تسجيل الخروج؟')) {
                        logout();
                    }
                };
                authNavItem.style.cursor = 'pointer';
                const link = authNavItem.querySelector('a');
                if (link) {
                    link.removeAttribute('href');
                    link.style.pointerEvents = 'none';
                }
            }
        }

        function updateNavbarLogout() {
            const authNavText = document.getElementById('authNavText');
            const authNavItem = document.getElementById('authNavItem');

            if (authNavText && authNavText.textContent !== 'تسجيل الدخول') {
                authNavText.textContent = 'تسجيل الدخول';
            }
            if (authNavItem && authNavItem.dataset.loggedIn !== 'false') {
                authNavItem.dataset.loggedIn = 'false';
                authNavItem.onclick = null;
                authNavItem.style.cursor = 'default';
                const link = authNavItem.querySelector('a');
                if (link) link.href = '/login';
            }
        }

        async function logout() {
            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                await fetch('/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    }
                });
                location.reload();
            } catch (err) {
                location.reload();
            }
        }

        function showLoginRequired() {
            if (chatLoginRequired && chatLoginRequired.style.display !== 'block') {
                chatLoginRequired.style.display = 'block';
            }
            if (chatMessages) {
                if (chatMessages.style.display !== 'none') {
                    chatMessages.style.display = 'none';
                    chatMessages.innerHTML = '';
                }
            }
            if (chatInputArea && chatInputArea.style.display !== 'none') {
                chatInputArea.style.display = 'none';
            }
        }

        function showChat() {
            if (chatLoginRequired && chatLoginRequired.style.display !== 'none') {
                chatLoginRequired.style.display = 'none';
            }
            if (chatMessages && chatMessages.style.display !== 'flex') {
                chatMessages.style.display = 'flex';
            }
            if (chatInputArea && chatInputArea.style.display !== 'flex') {
                chatInputArea.style.display = 'flex';
            }
        }

        function addMessage(text, type) {
            if (!chatMessages) return;
            const time = new Date().toLocaleTimeString('ar-SA', { hour: '2-digit', minute: '2-digit' });
            const html = '<div class="message ' + type + '"><div class="message-content"><p>' + text + '</p><span class="message-time">' + time + '</span></div></div>';
            chatMessages.insertAdjacentHTML('beforeend', html);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        async function fetchMessages() {
            if (!isAuthenticated) return;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                const res = await fetch('/chat/my-messages', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    credentials: 'include'
                });

                if (res.status === 401) {
                    isAuthenticated = false;
                    showLoginRequired();
                    return;
                }

                if (!res.ok) return;

                const msgs = await res.json();
                if (chatMessages) {
                    // Check if chat is visible to decide whether to show badge
                    const isChatVisible = chatContainer.classList.contains('active');

                    chatMessages.innerHTML = '';
                    msgs.forEach(m => {
                        const type = m.sender_type === 'user' ? 'sent' : 'received';
                        addMessage(m.message, type);
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    // Update badge - show if there are new messages and chat is closed
                    const unreadCount = msgs.filter(m => m.sender_type === 'admin').length;
                    const chatBadge = document.getElementById('chatBadge');

                    if (!isChatVisible && unreadCount > 0) {
                        chatBadge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                        chatBadge.style.display = 'flex';
                    } else if (isChatVisible) {
                        chatBadge.style.display = 'none';
                    }
                }
            } catch (err) {
                console.error('Failed to fetch messages:', err);
            }
        }

        async function sendChatMessage() {
            if (!isAuthenticated) {
                alert('يرجى تسجيل الدخول أولاً');
                return;
            }

            const text = messageInput ? messageInput.value.trim() : '';
            if (!text) return;

            // Add message to UI immediately
            addMessage(text, 'sent');
            if (messageInput) messageInput.value = '';
            if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                const res = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    credentials: 'include',
                    body: JSON.stringify({ message: text })
                });

                if (res.status === 401) {
                    isAuthenticated = false;
                    showLoginRequired();
                    return;
                }

                // Refresh messages after sending
                setTimeout(() => fetchMessages(), 500);
            } catch (err) {
                console.error('Failed to send:', err);
            }
        }

        function startPolling() {
            if (pollInterval) clearInterval(pollInterval);
            pollInterval = setInterval(() => {
                if (isAuthenticated) fetchMessages();
            }, 3000);
        }

        function stopPolling() {
            if (pollInterval) {
                clearInterval(pollInterval);
                pollInterval = null;
            }
        }

        // Event listeners
        if (sendMessage) {
            sendMessage.addEventListener('click', sendChatMessage);
        }
        if (messageInput) {
            messageInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    sendChatMessage();
                }
            });
        }

        // Initialize
        checkAuth();

        // Notifications - silent background fetch only (no toasts displayed)
        async function fetchNotifications() {
            try {
                const res = await fetch('/api/notifications');
                if (!res.ok) return;
            } catch (err) {
                // Silently ignore errors
            }
        }

        // Poll notifications in background without showing toasts
        setInterval(fetchNotifications, 6000);

        function addMessage(text, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;

            const time = new Date().toLocaleTimeString('ar-SA', {
                hour: '2-digit',
                minute: '2-digit'
            });

            messageDiv.innerHTML = `
                <div class="message-content">
                    <p>${text}</p>
                    <span class="message-time">${time}</span>
                </div>
            `;

            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        /* -------------------- Message Toast -------------------- */
        function showMessage(message, type) {
            const old = document.querySelector('.message-toast');
            if (old) old.remove();

            let bgColor = '#FF5252';
            if (type === 'success') bgColor = '#4CAF50';
            else if (type === 'info') bgColor = '#2196F3';

            const div = document.createElement('div');
            div.className = 'message-toast';
            div.style.cssText = `
                position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                background: ${bgColor}; color: white; padding: 1rem 2rem;
                border-radius: 50px; font-weight: 600; z-index: 99999;
                direction: rtl; font-family: Tajawal, sans-serif;
                box-shadow: 0 5px 20px rgba(0,0,0,0.4);
                animation: fadeIn 0.3s ease;
            `;
            div.textContent = message;
            document.body.appendChild(div);

            setTimeout(() => div.remove(), 5000);
        }
    </script>
    <script>
           $(document).on('click','.edit-record-btn',function(e){
            const data_content = $(this).data('filter');
            const route = 'select_project';

            const url = `${route}/${data_content}`;

            $.ajax({
                url: url,
                method: 'GET',
                  success: function(response) {
                    console.log(response);


                },
                error: function(xhr, status, error) {
            console.error("خطأ في Ajax:", status, error);
            console.error("تفاصيل الاستجابة:", xhr.responseText);

            let message = 'فشل في تحميل البيانات';

            // إذا كانت الاستجابة JSON ولديها رسالة خطأ، نستخدمها
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                // نحاول عرض نص الاستجابة الخام (يمكن أن تكون HTML أو نص خطأ)
                message = xhr.responseText;
            }

            // Swal.fire('خطأ', message, 'error');
            }

            })
        })

    </script>
</body>

</html>
