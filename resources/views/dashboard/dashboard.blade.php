<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('jquery-3.6.0.min.js')}}"></script>
    <!-- Fonts & Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Tajawal:wght@400;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* CSS Variables - Cyan Theme */
        :root {
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
        }

        /* Global Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
    overflow-x: hidden;
}

        body {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            background: var(--darker);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1001;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: rgba(0, 255, 255, 0.2);
            transform: scale(1.05);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-left: 1px solid var(--glass-border);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 2rem;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 900;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-logo i {
            margin-left: 1rem;
            color: var(--primary);
        }

        .sidebar-user {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 2rem;
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: rgba(0, 255, 255, 0.1);
            border-radius: 15px;
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }

        .sidebar-user-info:hover {
            background: rgba(0, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .sidebar-user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 1rem;
            border: 2px solid var(--primary);
        }

        .sidebar-user-details {
            flex: 1;
        }

        .sidebar-user-name {
            font-weight: 700;
            margin-bottom: 0.2rem;
            font-size: 1.1rem;
        }

        .sidebar-user-role {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .sidebar-menu {
            list-style: none;
            flex: 1;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 2rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: var(--primary);
            background: rgba(0, 255, 255, 0.1);
        }

        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--gradient-1);
        }

        .sidebar-menu i {
            margin-left: 1rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-right: 280px;
            padding: 2rem;
            transition: margin-right 0.3s ease;
        }

        /* Top Bar */
        .top-bar {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 0.8rem 1.5rem 0.8rem 3rem;
            color: var(--text);
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.8rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: rgba(0, 255, 255, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: var(--gradient-2);
            color: var(--darker);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .user-menu:hover {
            background: rgba(0, 255, 255, 0.1);
        }

        .user-menu-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .dashboard-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-1);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .dashboard-card-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--darker);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .dashboard-card-value {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dashboard-card-label {
            color: var(--text-secondary);
            font-weight: 600;
        }

        .dashboard-card-change {
            position: absolute;
            top: 2rem;
            left: 2rem;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
        }

        .dashboard-card-change.positive {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .dashboard-card-change.negative {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Content Sections */
        .content-section {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn {
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-1);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .btn-primary {
            color: var(--darker);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 255, 255, 0.6);
        }

        /* Tables */
        .data-table {
            width: 100%;
            min-width: 720px;
            border-collapse: collapse;
            margin-top: 1rem;
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: right;
            border-bottom: 1px solid var(--glass-border);
            white-space: nowrap;
        }

        .data-table th {
            background: rgba(0, 255, 255, 0.1);
            font-weight: 700;
            color: var(--primary);
        }

        .data-table tr:hover {
            background: rgba(0, 255, 255, 0.05);
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .table-actions button {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .table-actions button:hover {
            background: rgba(0, 255, 255, 0.1);
            color: var(--primary);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 700;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: var(--text);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 255, 255, 0.2);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 150px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--dark);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Charts Container */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .chart-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
        }

        .chart-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        /* Notifications Panel */
        .notifications-panel {
            position: fixed;
            left: 2rem;
            top: 5rem;
            width: 350px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            z-index: 1500;
            transform: translateY(-20px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .notifications-panel.active {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .notifications-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notifications-title {
            font-weight: 700;
            font-size: 1.2rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .notifications-clear {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 0.9rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .notifications-clear:hover {
            color: var(--primary);
            background: rgba(0, 255, 255, 0.1);
        }

        .notifications-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--glass-border);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-item:hover {
            background: rgba(0, 255, 255, 0.05);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item.unread {
            background: rgba(0, 255, 255, 0.05);
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--darker);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .notification-details {
            flex: 1;
        }

        .notification-title {
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .notification-message {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 0.3rem;
        }

        .notification-time {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Chat System */
        .chat-panel {
            position: fixed;
            right: 0;
            top: 0;
            width: 380px;
            height: 100vh;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-left: 1px solid var(--glass-border);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1500;
            display: flex;
            flex-direction: column;
        }

        .chat-panel.active {
            transform: translateX(0);
        }

        .chat-panel-header {
            background: var(--gradient-1);
            color: var(--darker);
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
        }

        .chat-panel-close {
            background: none;
            border: none;
            color: var(--darker);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .chat-panel-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .chat-search {
            padding: 1rem;
            border-bottom: 1px solid var(--glass-border);
        }

        .chat-search input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            color: var(--text);
            text-align: right;
        }

        .chat-conversations {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .conversation-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .conversation-item:hover {
            background: rgba(0, 255, 255, 0.1);
        }

        .conversation-item.active {
            background: rgba(0, 255, 255, 0.2);
        }

        .conversation-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
            position: relative;
        }

        .conversation-status {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 15px;
            height: 15px;
            background: #00ff00;
            border-radius: 50%;
            border: 2px solid var(--dark);
        }

        .conversation-info {
            flex: 1;
        }

        .conversation-name {
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .conversation-message {
            font-size: 0.9rem;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .conversation-time {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .conversation-unread {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--gradient-2);
            color: var(--darker);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
        }

        /* Chat Window - Hidden by default */
        .chat-window {
            position: fixed;
            right: 0;
            top: 0;
            width: 380px;
            height: 100vh;
            background: var(--dark);
            border-left: 1px solid var(--glass-border);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1500;
            display: flex;
            flex-direction: column;
            opacity: 0;
            visibility: hidden;
        }

        .chat-window.active {
            transform: translateX(0);
            opacity: 1;
            visibility: visible;
        }

        .chat-window-header {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-window-user {
            display: flex;
            align-items: center;
        }

        .chat-window-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
            border: 2px solid var(--primary);
        }

        .chat-window-info h4 {
            font-weight: 700;
            margin-bottom: 0.2rem;
            color: var(--text);
        }

        .chat-window-info p {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .chat-window-actions {
            display: flex;
            gap: 0.5rem;
        }

        .chat-window-actions button {
            background: none;
            border: none;
            color: var(--text);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .chat-window-actions button:hover {
            background: rgba(0, 255, 255, 0.1);
        }

        .chat-back-btn {
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
        }

        .chat-back-btn:hover {
            background: rgba(0, 255, 255, 0.1);
        }

        .chat-close-btn {
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .chat-close-btn:hover {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            background: var(--darker);
        }

        .message {
            margin-bottom: 1.5rem;
            display: flex;
            animation: messageSlide 0.3s ease;
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message.received {
            justify-content: flex-start;
        }

        .message-content {
            max-width: 70%;
            padding: 1rem 1.5rem;
            border-radius: 20px;
            position: relative;
        }

        .message.received .message-content {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: var(--text);
        }

        .message.sent .message-content {
            background: var(--gradient-1);
            color: var(--darker);
        }

        .message-time {
            font-size: 0.75rem;
            opacity: 0.7;
            margin-top: 0.5rem;
            display: block;
        }

        .chat-input {
            padding: 1rem;
            border-top: 1px solid var(--glass-border);
            background: var(--glass);
            backdrop-filter: blur(20px);
            display: flex;
            gap: 1rem;
        }

        .chat-input input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
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

        /* Chat Button */
        .chat-button {
            position: fixed !important;
            bottom: 2rem;
            left: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--gradient-1);
            color: var(--darker);
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 255, 255, 0.4);
            transition: all 0.3s ease;
            display: flex !important;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .chat-button:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 255, 255, 0.6);
        }

        /* Sections from Original Code */
        .section {
            padding: 8rem 0;
            position: relative;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 3rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }

            .main-content {
                margin-right: 250px;
            }

            .chat-panel {
                width: 320px;
            }

            .chat-window {
                width: 320px;
            }

            .notifications-panel {
                width: 300px;
            }
        }

        @media (max-width: 992px) {
            .mobile-menu-btn {
                display: flex;
            }

            .sidebar {
                transform: translateX(100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }

            .dashboard-cards {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .chat-panel {
                width: 100%;
            }

            .chat-window {
                width: 100%;
            }

            .notifications-panel {
                left: 1rem;
                right: 1rem;
                width: auto;
            }
        }

        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                gap: 1rem;
            }

            .search-box input {
                width: 100%;
            }

            .charts-container {
                grid-template-columns: 1fr;
            }

            .chat-button {
                bottom: 1rem;
                left: 1rem;
            }

            .conversation-message {
                max-width: 150px;
            }

            .notifications-panel {
                top: 4rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 1rem;
            }

            .content-section {
                padding: 1.5rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .dashboard-cards {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 100%;
            }

            .notifications-panel {
                left: 0.5rem;
                right: 0.5rem;
            }
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
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-cube"></i>
                    لوحة التحكم
                </div>
            </div>

            <div class="sidebar-user">
                @if ($about)
                    <div class="sidebar-user-info">
                        @if ($about && $about->image)
                            <img src="data:image/jpeg;base64,{{ base64_encode($about->image) }}" alt="User Image"
                                class="sidebar-user-avatar" width="50" height="50">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Default Image">
                        @endif
                        <div class="sidebar-user-details">
                            <div class="sidebar-user-name">{{ $about->name }}</div>
                            <div class="sidebar-user-role"> {{ $about->bio }} </div>
                        </div>
                    </div>
                @else
                    <p>لا توجد بيانات عني حتى الآن.</p>

                @endif

            </div>

            <ul class="sidebar-menu">
                <li><a href="#" class="active" data-section="dashboard"><i class="fas fa-home"></i> الرئيسية</a>
                </li>
                <li><a href="#" data-section="profile"><i class="fas fa-user"></i> الملف الشخصي</a></li>
                <li><a href="#" data-section="services"><i class="fas fa-cogs"></i> الخدمات</a></li>
                <li><a href="#" data-section="skills"><i class="fas fa-chart-bar"></i> المهارات</a></li>
                <li><a href="#" data-section="portfolio"><i class="fas fa-briefcase"></i> المشاريع</a></li>
                <li><a href="#" data-section="experiences"><i class="fas fa-briefcase"></i> الخبرات</a></li>
                <li><a href="#" data-section="certificates"><i class="fas fa-certificate"></i> الشهادات</a></li>
                <li><a href="#" data-section="cv"><i class="fas fa-file-pdf"></i> السيرة الذاتية</a></li>
                <li><a href="#" data-section="tech-stack"><i class="fas fa-code"></i> التقنيات</a></li>
                <li><a href="#" data-section="portfolio-images"><i class="fas fa-images"></i> صور الموقع</a></li>
                <li><a href="#" data-section="blog"><i class="fas fa-blog"></i> المدونة</a></li>
                <li><a href="#" data-section="messages"><i class="fas fa-envelope"></i> الرسائل</a></li>
                <li><a href="#" data-section="analytics"><i class="fas fa-chart-line"></i> التحليلات</a></li>
                <li><a href="#" data-section="settings"><i class="fas fa-cog"></i> الإعدادات</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="top-bar-left">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="بحث...">
                    </div>
                </div>

                <div class="top-bar-right">
                    <button class="notification-btn" onclick="toggleNotifications()">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    @if ($about)
                        <div class="user-menu">
                            @if ($about && $about->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($about->image) }}" alt="User Image"
                                    class="sidebar-user-avatar" width="50" height="50">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Default Image">
                            @endif
                            <span>{{ $about->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                    @endif
                </div>
            </div>

            <!-- Dashboard Section -->
            <div id="dashboard-section" class="content-section">
                <h2 class="section-title">نظرة عامة</h2>

                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['projects_count'] }}</div>
                        <div class="dashboard-card-label">المشاريع</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['services_count'] }}</div>
                        <div class="dashboard-card-label">الخدمات</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['technologies_count'] }}</div>
                        <div class="dashboard-card-label">التقنيات</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['experiences_count'] }}</div>
                        <div class="dashboard-card-label">الخبرات</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['certificates_count'] }}</div>
                        <div class="dashboard-card-label">الشهادات</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['conversations_count'] }}</div>
                        <div class="dashboard-card-label">المحادثات</div>
                    </div>

                    <div class="dashboard-card" style="border-right: 3px solid var(--primary);">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['unread_notifications'] }}</div>
                        <div class="dashboard-card-label">الإشعارات غير المقروءة</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="dashboard-card-value">{{ $stats['active_images'] }}/{{ $stats['total_images'] }}</div>
                        <div class="dashboard-card-label">الصور النشطة</div>
                    </div>
                </div>

                <div class="charts-container">
                    <div class="chart-card">
                        <h3>توزيع المشاريع حسب الفئات</h3>
                        <canvas id="projectsChart"></canvas>
                    </div>

                    <div class="chart-card">
                        <h3>إحصائيات سريعة</h3>
                        <div style="padding: 1rem;">
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid var(--glass-border);">
                                <span>المشاريع</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['projects_count'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid var(--glass-border);">
                                <span>الخدمات</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['services_count'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid var(--glass-border);">
                                <span>الخبرات</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['experiences_count'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid var(--glass-border);">
                                <span>الشهادات</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['certificates_count'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid var(--glass-border);">
                                <span>التقنيات</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['technologies_count'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid var(--glass-border);">
                                <span>المحادثات</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['conversations_count'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.8rem 0;">
                                <span>الصور النشطة</span>
                                <span style="color: var(--primary); font-weight: 700;">{{ $stats['active_images'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div id="profile-section" class="content-section" style="display: none;">
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="section-header">
                        <h2 class="section-title">الملف الشخصي</h2>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> حفظ التغييرات
                        </button>
                    </div>

                    @if(session('success'))
                        <div style="background: rgba(0, 255, 136, 0.2); color: #00ff88; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>الصورة الشخصية</label>
                        @if($about && $about->image)
                            <div style="margin-bottom: 1rem;">
                                <img src="data:image/jpeg;base64,{{ base64_encode($about->image) }}" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary);" alt="Profile Image">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>الاسم الكامل</label>
                        <input type="text" class="form-control" name="name" value="{{ $about->name ?? old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>المسمى الوظيفي (Bio)</label>
                        <input type="text" class="form-control" name="bio" value="{{ $about->bio ?? old('bio') }}" placeholder="مثال: Full-Stack Developer">
                    </div>

                    <div class="form-group">
                        <label>نبذة تعريفية</label>
                        <textarea class="form-control" name="description" rows="5">{{ $about->description ?? old('description') }}</textarea>
                    </div>

                </form>
            </div>

            <!-- Services Section -->
            <div id="services-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">الخدمات</h2>
                    <button class="btn btn-primary" onclick="openModal('serviceModal')">
                        <i class="fas fa-plus"></i> إضافة خدمة
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الخدمة</th>
                                <th>الوصف</th>
                                <th>الأيقونة</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
      @foreach ($services as $item)
                            <tr id="service-{{$item->id}}">
                                <td data-label="الخدمة">{{$item->title}}</td>
                                <td data-label="الوصف">{{$item->description}}</td>
                                <td data-label="الأيقونة">{{$item->icon}}</td>
                                <td data-label="الحالة"><span style="color: #00ff00;">نشط</span></td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <button class="edit-service-btn" data-id="{{$item->id}}"><i class="fas fa-edit"></i></button>
                                        <button class="delete-service-btn" data-id="{{$item->id}}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
      @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Skills Section -->
            <div id="skills-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">المهارات</h2>
                    <button class="btn btn-primary" onclick="openModal('skillModal')">
                        <i class="fas fa-plus"></i> إضافة مهارة
                    </button>
                </div>
                <div class="skills-container">
                    @if (isset($skill_categories) && $skill_categories->count())
                        @foreach ($skill_categories as $idx => $cat)
                            <div class="skill-category" data-aos="fade-up" data-aos-delay="{{ 100 * ($idx + 1) }}">

                             <div class="" style="display: flex; justify-content: space-between; align-items: center;">

                                <h3>{{ $cat->title }}</h3>

                                 <div style="display: flex; gap: 5px;">
                                    <button class="edit-category-btn" data-id="{{ $cat->id }}" data-title="{{ $cat->title }}" style="padding:4px; font-size: 14px; background-color: rgba(0, 255, 255, 0.2); color: var(--primary); border: none; border-radius: 5px; cursor: pointer;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn_delete_category" style="padding:4px; font-size: 16px; background-color: rgba(255, 0, 0, 0.226);color: rgb(255, 0, 0); border: none; border-radius: 5px; cursor: pointer;" data-id="{{ $cat->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                 </div>

                                </div>

                                <button class="btn addSkillBtn" data-id="{{ $cat->id }}"
                                    style="margin-bottom:5px; font-size: 12px; background-color: transparent;">
                                    <i class="fas fa-plus"></i> إضافة مهارة
                                </button>




                                @forelse($cat->items as $item)
                                    <div class="skill-item" id="skill-item-{{ $item->id }}">
                                        <div class="skill-header">
                                            <span class="skill-name">{{ $item->name }}</span>
                                            <div style="display: flex; gap: 5px; align-items: center;">
                                                <button class="edit-skill-btn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-level="{{ $item->level }}" style="background: none; border: none; color: var(--primary); cursor: pointer;">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="dele_skill" data-id="{{ $item->id }}" style="background: none; border: none; color: red; cursor: pointer;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <span class="skill-level">{{ $item->level }}%</span>
                                            </div>
                                        </div>
                                        <div class="skill-bar">
                                            <div class="skill-progress" style="width: {{ $item->level }}%"></div>
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
                        <p>لا توجد فئات مهارات حتى الآن.</p>
                    @endif
                </div>
            </div>




            <!-- Portfolio Section -->
            <div id="portfolio-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">المشاريع</h2>
                    <button class="btn btn-primary" onclick="openModal('projectModal')">
                        <i class="fas fa-plus"></i> إضافة مشروع
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الصورة</th>
                                <th>المشروع</th>
                                <th>الفئة</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $item)

                            <tr>
                                <td data-label="الصورة"><img src="data:image/jpeg;base64,{{base64_encode($item->image)}}" style="width: 50px; height: 50px;" alt=""></td>
                                <td data-label="المشروع">{{ $item->title }}</td>
                                <td data-label="الفئة">{{ $item->categorie_project }}</td>
                                <td data-label="الحالة"><span style="color: #00ff00;">منشور</span></td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <button data-id="{{$item->id}}" class="edit-record-btn" data-form="#form_edit" data-modal="#editModalpro" ><i class="fas fa-edit"></i></button>
                                        <button data-id="{{$item->id}}" class="delete_project"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Experiences Section -->
            <div id="experiences-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">الخبرات العملية</h2>
                    <button class="btn btn-primary" onclick="openModal('experienceModal')">
                        <i class="fas fa-plus"></i> إضافة خبرة
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>المسمى الوظيفي</th>
                                <th>الشركة</th>
                                <th>المدة</th>
                                <th>الوصف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($experiences as $item)
                            <tr id="experience-{{ $item->id }}">
                                <td data-label="المسمى الوظيفي">{{ $item->title }}</td>
                                <td data-label="الشركة">{{ $item->company ?? '-' }}</td>
                                <td data-label="المدة">{{ $item->duration ?? '-' }}</td>
                                <td data-label="الوصف">{{ Str::limit($item->description, 50) }}</td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <button class="edit-experience-btn" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="delete-experience-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">لا توجد خبرات حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Certificates Section -->
            <div id="certificates-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">الشهادات والتخصصات</h2>
                    <button class="btn btn-primary" onclick="openModal('certificateModal')">
                        <i class="fas fa-plus"></i> إضافة شهادة
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الشهادة</th>
                                <th>الجهة المانحة</th>
                                <th>السنة</th>
                                <th>الصورة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($certificates as $item)
                            <tr id="certificate-{{ $item->id }}">
                                <td data-label="الشهادة">{{ $item->title }}</td>
                                <td data-label="الجهة المانحة">{{ $item->issuer ?? '-' }}</td>
                                <td data-label="السنة">{{ $item->year ?? '-' }}</td>
                                <td data-label="الصورة">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <span style="color: var(--text-secondary);">لا توجد صورة</span>
                                    @endif
                                </td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <button class="edit-certificate-btn" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="delete-certificate-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">لا توجد شهادات حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CV Section -->
            <div id="cv-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">السيرة الذاتية (CV)</h2>
                    <button class="btn btn-primary" onclick="openModal('cvModal')">
                        <i class="fas fa-plus"></i> رفع سيرة ذاتية جديدة
                    </button>
                </div>

                <div style="background: rgba(0, 255, 136, 0.1); border: 1px solid rgba(0, 255, 136, 0.3); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem;">
                    <p style="margin: 0; color: #00ff88;">
                        <i class="fas fa-info-circle"></i>
                        سيتم عرض آخر سيرة ذاتية محددة للنشر في الموقع الرئيسي. يمكنك رفع عدة إصدارات واختيار哪个 one to display.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>اسم الملف</th>
                                <th>الحالة</th>
                                <th>تاريخ الرفع</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cvs as $item)
                            <tr id="cv-{{ $item->id }}" style="{{ $item->is_active ? 'background: rgba(0, 255, 136, 0.1);' : '' }}">
                                <td data-label="الاسم">
                                    <i class="fas fa-file-pdf" style="color: #e74c3c; margin-left: 8px;"></i>
                                    {{ $item->name }}
                                </td>
                                <td data-label="اسم الملف">{{ $item->file_name ?? '-' }}</td>
                                <td data-label="الحالة">
                                    @if($item->is_active)
                                        <span style="background: #00ff88; color: #000; padding: 3px 10px; border-radius: 5px; font-size: 0.8rem;">
                                            <i class="fas fa-check"></i> نشط
                                        </span>
                                    @else
                                        <span style="background: rgba(255,255,255,0.1); color: #aaa; padding: 3px 10px; border-radius: 5px; font-size: 0.8rem;">
                                            غير نشط
                                        </span>
                                    @endif
                                </td>
                                <td data-label="تاريخ الرفع">{{ $item->created_at ? date('Y-m-d', strtotime($item->created_at)) : '-' }}</td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn-icon" title="معاينة">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="set-active-cv-btn" data-id="{{ $item->id }}" title="تحديد للنشر">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="edit-cv-btn" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="delete-cv-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">لا توجد سير ذاتية حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tech Stack Section -->
            <div id="tech-stack-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">التقنيات (Tech Stack)</h2>
                    <button class="btn btn-primary" onclick="openModal('techStackModal')">
                        <i class="fas fa-plus"></i> إضافة تقنية
                    </button>
                </div>

                <div style="background: rgba(0, 255, 136, 0.1); border: 1px solid rgba(0, 255, 136, 0.3); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem;">
                    <p style="margin: 0; color: #00ff88;">
                        <i class="fas fa-info-circle"></i>
                        هذه التقنيات تظهر في قسم Hero بالموقع الرئيسي. يمكنك إضافة تقنيات جديدة وتحديد ترتيب العرض.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الأيقونة</th>
                                <th>الاسم</th>
                                <th>الترتيب</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tech_stacks as $item)
                            <tr id="tech-stack-{{ $item->id }}" style="{{ !$item->is_active ? 'opacity: 0.6;' : '' }}">
                                <td data-label="#">{{ $item->id }}</td>
                                <td data-label="الأيقونة">
                                    <i class="{{ $item->icon }}" style="font-size: 1.5rem; color: var(--primary);"></i>
                                </td>
                                <td data-label="الاسم">{{ $item->name }}</td>
                                <td data-label="الترتيب">{{ $item->sort }}</td>
                                <td data-label="الحالة">
                                    @if($item->is_active)
                                        <span style="background: #00ff88; color: #000; padding: 3px 10px; border-radius: 5px; font-size: 0.8rem;">
                                            <i class="fas fa-check"></i> نشط
                                        </span>
                                    @else
                                        <span style="background: rgba(255,255,255,0.1); color: #aaa; padding: 3px 10px; border-radius: 5px; font-size: 0.8rem;">
                                            غير نشط
                                        </span>
                                    @endif
                                </td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <a href="/tech-stack/toggle/{{ $item->id }}" class="btn-icon" title="{{ $item->is_active ? 'إلغاء النشر' : 'نشر' }}">
                                            <i class="fas fa-{{ $item->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </a>
                                        <button class="edit-tech-stack-btn" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="delete-tech-stack-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center;">لا توجد تقنيات حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Portfolio Images Section -->
            <div id="portfolio-images-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">صور الموقع</h2>
                    <button class="btn btn-primary" onclick="openModal('portfolioImageModal')">
                        <i class="fas fa-plus"></i> رفع صورة جديدة
                    </button>
                </div>

                <div style="background: rgba(0, 255, 136, 0.1); border: 1px solid rgba(0, 255, 136, 0.3); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem;">
                    <p style="margin: 0; color: #00ff88;">
                        <i class="fas fa-info-circle"></i>
                        <strong>hero:</strong> صورة البطل (الملف الشخصي) |
                        <strong>about:</strong> صورة قسم "عني" |
                        <strong>gallery:</strong> معرض الصور
                    </p>
                </div>

                <!-- Hero Images -->
                <h3 style="margin: 1.5rem 0 1rem; color: var(--primary);">
                    <i class="fas fa-user-circle"></i> صور Hero (الملف الشخصي)
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                    @forelse($portfolio_images->where('type', 'hero') as $item)
                    <div id="portfolio-image-{{ $item->id }}" style="background: rgba(0,0,0,0.2); border-radius: 10px; padding: 10px; {{ !$item->is_active ? 'opacity: 0.5;' : '' }}">
                        <img src="{{ asset('storage/' . $item->image_path) }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                        <div style="margin-top: 10px; text-align: center;">
                            @if($item->is_active)
                                <span style="background: #00ff88; color: #000; padding: 3px 8px; border-radius: 5px; font-size: 0.75rem;">
                                    <i class="fas fa-check"></i> نشط
                                </span>
                            @else
                                <a href="/portfolio-image/set-active/{{ $item->id }}" class="btn-icon" title="تحديد للنشر" style="background: rgba(255,255,255,0.1); padding: 5px 10px; border-radius: 5px;">
                                    <i class="fas fa-check-circle"></i> تفعيل
                                </a>
                            @endif
                        </div>
                        <div style="margin-top: 8px; display: flex; gap: 5px; justify-content: center;">
                            <button class="edit-portfolio-image-btn btn-icon" data-id="{{ $item->id }}" title="تعديل" style="background: rgba(255,193,7,0.2);">
                                <i class="fas fa-edit" style="color: #ffc107;"></i>
                            </button>
                            <button class="delete-portfolio-image-btn btn-icon" data-id="{{ $item->id }}" title="حذف" style="background: rgba(220,53,69,0.2);">
                                <i class="fas fa-trash" style="color: #dc3545;"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--text-secondary);">
                        لا توجد صور Hero حتى الآن
                    </div>
                    @endforelse
                </div>

                <!-- About Images -->
                <h3 style="margin: 1.5rem 0 1rem; color: var(--primary);">
                    <i class="fas fa-address-card"></i> صور قسم "عني"
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                    @forelse($portfolio_images->where('type', 'about') as $item)
                    <div id="portfolio-image-{{ $item->id }}" style="background: rgba(0,0,0,0.2); border-radius: 10px; padding: 10px; {{ !$item->is_active ? 'opacity: 0.5;' : '' }}">
                        <img src="{{ asset('storage/' . $item->image_path) }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                        <div style="margin-top: 10px; text-align: center;">
                            @if($item->is_active)
                                <span style="background: #00ff88; color: #000; padding: 3px 8px; border-radius: 5px; font-size: 0.75rem;">
                                    <i class="fas fa-check"></i> نشط
                                </span>
                            @else
                                <a href="/portfolio-image/set-active/{{ $item->id }}" class="btn-icon" title="تحديد للنشر" style="background: rgba(255,255,255,0.1); padding: 5px 10px; border-radius: 5px;">
                                    <i class="fas fa-check-circle"></i> تفعيل
                                </a>
                            @endif
                        </div>
                        <div style="margin-top: 8px; display: flex; gap: 5px; justify-content: center;">
                            <button class="edit-portfolio-image-btn btn-icon" data-id="{{ $item->id }}" title="تعديل" style="background: rgba(255,193,7,0.2);">
                                <i class="fas fa-edit" style="color: #ffc107;"></i>
                            </button>
                            <button class="delete-portfolio-image-btn btn-icon" data-id="{{ $item->id }}" title="حذف" style="background: rgba(220,53,69,0.2);">
                                <i class="fas fa-trash" style="color: #dc3545;"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--text-secondary);">
                        لا توجد صور "عني" حتى الآن
                    </div>
                    @endforelse
                </div>

                <!-- Gallery Images -->
                <h3 style="margin: 1.5rem 0 1rem; color: var(--primary);">
                    <i class="fas fa-images"></i> معرض الصور
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    @forelse($portfolio_images->where('type', 'gallery') as $item)
                    <div id="portfolio-image-{{ $item->id }}" style="background: rgba(0,0,0,0.2); border-radius: 10px; padding: 10px;">
                        <img src="{{ asset('storage/' . $item->image_path) }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                        <p style="margin: 8px 0; font-size: 0.85rem; color: var(--text-secondary); text-align: center;">
                            {{ $item->alt_text ?? '-' }}
                        </p>
                        <div style="margin-top: 8px; display: flex; gap: 5px; justify-content: center;">
                            <button class="edit-portfolio-image-btn btn-icon" data-id="{{ $item->id }}" title="تعديل" style="background: rgba(255,193,7,0.2);">
                                <i class="fas fa-edit" style="color: #ffc107;"></i>
                            </button>
                            <button class="delete-portfolio-image-btn btn-icon" data-id="{{ $item->id }}" title="حذف" style="background: rgba(220,53,69,0.2);">
                                <i class="fas fa-trash" style="color: #dc3545;"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--text-secondary);">
                        لا توجد صور في المعرض حتى الآن
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Blog Section -->
            <div id="blog-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">المدونة</h2>
                    <button class="btn btn-primary" onclick="openModal('blogModal')">
                        <i class="fas fa-plus"></i> إضافة مقال
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>العنوان</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="العنوان">كيف تبدأ في تعلم Flutter</td>
                                <td data-label="التاريخ">15 يناير 2024</td>
                                <td data-label="الحالة"><span style="color: #00ff00;">منشور</span></td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <button><i class="fas fa-edit"></i></button>
                                        <button><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Messages Section -->
            <div id="messages-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h2 class="section-title">الرسائل</h2>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>المرسل</th>
                                <th>البريد الإلكتروني</th>
                                <th>الموضوع</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="المرسل">محمد علي</td>
                                <td data-label="البريد الإلكتروني">mohamed@example.com</td>
                                <td data-label="الموضوع">استفسار عن مشروع</td>
                                <td data-label="التاريخ">20 يناير 2024</td>
                                <td data-label="الحالة"><span style="color: #ffcc00;">جديد</span></td>
                                <td data-label="الإجراءات">
                                    <div class="table-actions">
                                        <button><i class="fas fa-eye"></i></button>
                                        <button><i class="fas fa-check"></i></button>
                                        <button><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Analytics Section -->
            <div id="analytics-section" class="content-section" style="display: none;">
                <h2 class="section-title">التحليلات</h2>

                <div class="charts-container">
                    <div class="chart-card">
                        <h3>إحصائيات الزوار</h3>
                        <canvas id="visitorsAnalyticsChart"></canvas>
                    </div>

                    <div class="chart-card">
                        <h3>مصادر الزوار</h3>
                        <canvas id="sourcesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings-section" class="content-section" style="display: none;">
                <h2 class="section-title">الإعدادات</h2>

                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf

                    @if(session('success'))
                        <div style="background: rgba(0, 255, 136, 0.2); color: #00ff88; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>عنوان الموقع</label>
                        <input type="text" name="site_title" class="form-control" value="{{ $settings->site_title ?? old('site_title', 'عمر المحجري | Full-Stack Developer') }}">
                    </div>

                    <div class="form-group">
                        <label>الوصف</label>
                        <textarea name="site_description" class="form-control" rows="3">{{ $settings->site_description ?? old('site_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>الكلمات المفتاحية</label>
                        <input type="text" name="site_keywords" class="form-control" value="{{ $settings->site_keywords ?? old('site_keywords') }}" placeholder="مثال: مطور, فلاتر, لارافل">
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني للتواصل</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ $settings->contact_email ?? old('contact_email') }}">
                    </div>

                    <hr style="margin: 2rem 0; border-color: var(--glass-border);">

                    <h3 style="margin-bottom: 1rem; color: var(--primary);">روابط السوشيال ميديا</h3>

                    <div class="form-group">
                        <label><i class="fab fa-facebook" style="color: #4267B2;"></i> Facebook</label>
                        <input type="url" name="facebook" class="form-control" value="{{ $settings->facebook ?? old('facebook') }}" placeholder="https://facebook.com/username">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-twitter" style="color: #1DA1F2;"></i> Twitter</label>
                        <input type="url" name="twitter" class="form-control" value="{{ $settings->twitter ?? old('twitter') }}" placeholder="https://twitter.com/username">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-instagram" style="color: #E4405F;"></i> Instagram</label>
                        <input type="url" name="instagram" class="form-control" value="{{ $settings->instagram ?? old('instagram') }}" placeholder="https://instagram.com/username">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-linkedin" style="color: #0077b5;"></i> LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control" value="{{ $settings->linkedin ?? old('linkedin') }}" placeholder="https://linkedin.com/in/username">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-github" style="color: #fff;"></i> GitHub</label>
                        <input type="url" name="github" class="form-control" value="{{ $settings->github ?? old('github') }}" placeholder="https://github.com/username">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> حفظ الإعدادات
                    </button>
                </form>
            </div>
        </main>
    </div>

    <!-- Notifications Panel -->
    <div class="notifications-panel" id="notificationsPanel">
        <div class="notifications-header">
            <h3 class="notifications-title">الإشعارات</h3>
            <button class="notifications-clear" onclick="clearNotifications()">مسح الكل</button>
        </div>
        <div class="notifications-list">
            <div class="notification-item unread">
                <div class="notification-content">
                    <div class="notification-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">مستخدم جديد</div>
                        <div class="notification-message">قام محمد علي بالتسجيل في الموقع</div>
                        <div class="notification-time">منذ 5 دقائق</div>
                    </div>
                </div>
            </div>
            <div class="notification-item unread">
                <div class="notification-content">
                    <div class="notification-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">رسالة جديدة</div>
                        <div class="notification-message">لديك رسالة جديدة من سارة أحمد</div>
                        <div class="notification-time">منذ 15 دقيقة</div>
                    </div>
                </div>
            </div>
            <div class="notification-item unread">
                <div class="notification-content">
                    <div class="notification-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">تحديث في الإحصائيات</div>
                        <div class="notification-message">زاد عدد الزوار بنسبة 12% هذا الشهر</div>
                        <div class="notification-time">منذ ساعة</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Service Modal -->
    <div id="serviceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة خدمة جديدة</h3>
                <button class="modal-close" onclick="closeModal('serviceModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{route('service_store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>اسم الخدمة</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>الأيقونة</label>
                    <input type="text" name="icon" class="form-control" placeholder="fas fa-icon">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة الخدمة
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div id="editServiceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل الخدمة</h3>
                <button class="modal-close" onclick="closeModal('editServiceModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editServiceForm" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" id="edit_service_id" name="id">
                <div class="form-group">
                    <label>اسم الخدمة</label>
                    <input type="text" id="edit_service_title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>الوصف</label>
                    <textarea id="edit_service_description" name="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>الأيقونة</label>
                    <input type="text" id="edit_service_icon" name="icon" class="form-control" placeholder="fas fa-icon">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="skillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة فئة مهارات جديدة</h3>
                <button class="modal-close" onclick="closeModal('skillModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('skills.category.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>اسم الفئة</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة الفئة
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل الفئة</h3>
                <button class="modal-close" onclick="closeModal('editCategoryModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editCategoryForm" method="POST">
                @csrf
                <input type="hidden" id="edit_category_id" name="id">
                <div class="form-group">
                    <label>اسم الفئة</label>
                    <input type="text" id="edit_category_title" name="title" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Skill Modal -->
    <div id="skillModal_co" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة مهارة جديدة</h3>
                <button class="modal-close" onclick="closeModal('skillModal_co')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('skills.item.store') }}" method="POST" id="skillItemForm">
                @csrf
                <input type="hidden" id="category_id_input" name="id">

                <div class="form-group">
                    <label>اسم المهارة</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>المستوى (%)</label>
                    <input type="number" name="level" class="form-control" min="0" max="100" value="50">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة مهارة
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Skill Item Modal -->
    <div id="editSkillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل المهارة</h3>
                <button class="modal-close" onclick="closeModal('editSkillModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editSkillForm" method="POST">
                @csrf
                <input type="hidden" id="edit_skill_id" name="id">
                <input type="hidden" id="edit_skill_category_id" name="category_id">

                <div class="form-group">
                    <label>اسم المهارة</label>
                    <input type="text" id="edit_skill_name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>المستوى (%)</label>
                    <input type="number" id="edit_skill_level" name="level" class="form-control" min="0" max="100">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Add Project Modal -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة مشروع جديد</h3>
                <button class="modal-close" onclick="closeModal('projectModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('project_store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>اسم المشروع</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea class="form-control" name="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>الفئة</label>
                    <select class="form-control" name="categorie_project">
                        <option value="Flutter">Flutter</option>
                        <option value="Laravel">Laravel</option>
                        <option value="C#">C#</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>صورة المشروع</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>رابط المشروع (اختياري)</label>
                    <input type="url" name="url" class="form-control" placeholder="https://example.com/project">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة المشروع
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="editModalpro" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل المشروع</h3>
                <button class="modal-close" onclick="closeModal('editModalpro')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="form_edit" action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label>الصورة الحالية</label>
                    <div style="margin-bottom: 1rem;">
                        <img src="" id="editProjectImage" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid var(--primary);">
                    </div>
                    <label>تغيير الصورة</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>اسم المشروع</label>
                    <input type="text" id="edit_project_title" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea id="edit_project_description" class="form-control" name="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>الفئة</label>
                    <select id="edit_project_category" class="form-control" name="categorie_project">
                        <option value="Flutter">Flutter</option>
                        <option value="Laravel">Laravel</option>
                        <option value="C#">C#</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>رابط المشروع (اختياري)</label>
                    <input type="url" id="edit_project_url" name="url" class="form-control" placeholder="https://example.com/project">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Experience Modal (Add) -->
    <div id="experienceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة خبرة جديدة</h3>
                <button class="modal-close" onclick="closeModal('experienceModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('experience.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>المسمى الوظيفي</label>
                    <input type="text" name="title" class="form-control" required placeholder="مثال: مطور Full-Stack">
                </div>

                <div class="form-group">
                    <label>اسم الشركة</label>
                    <input type="text" name="company" class="form-control" placeholder="مثال: شركة التقنيات">
                </div>

                <div class="form-group">
                    <label>المدة</label>
                    <input type="text" name="duration" class="form-control" placeholder="مثال: 2020 - 2022">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="تفاصيل الخبرة..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة الخبرة
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Experience Modal -->
    <div id="editExperienceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل الخبرة</h3>
                <button class="modal-close" onclick="closeModal('editExperienceModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editExperienceForm" method="POST">
                @csrf
                <input type="hidden" id="edit_experience_id" name="id">

                <div class="form-group">
                    <label>المسمى الوظيفي</label>
                    <input type="text" id="edit_experience_title" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>اسم الشركة</label>
                    <input type="text" id="edit_experience_company" name="company" class="form-control">
                </div>

                <div class="form-group">
                    <label>المدة</label>
                    <input type="text" id="edit_experience_duration" name="duration" class="form-control">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea id="edit_experience_description" name="description" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Certificate Modal (Add) -->
    <div id="certificateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة شهادة جديدة</h3>
                <button class="modal-close" onclick="closeModal('certificateModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('certificate.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>اسم الشهادة</label>
                    <input type="text" name="title" class="form-control" required placeholder="مثال: شهادة Laravel المتقدمة">
                </div>

                <div class="form-group">
                    <label>الجهة المانحة</label>
                    <input type="text" name="issuer" class="form-control" placeholder="مثال: Laravel Certified">
                </div>

                <div class="form-group">
                    <label>السنة</label>
                    <input type="text" name="year" class="form-control" placeholder="مثال: 2023">
                </div>

                <div class="form-group">
                    <label>صورة الشهادة</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>الوصف (اختياري)</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة الشهادة
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Certificate Modal -->
    <div id="editCertificateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل الشهادة</h3>
                <button class="modal-close" onclick="closeModal('editCertificateModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editCertificateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_certificate_id" name="id">

                <div class="form-group">
                    <label>اسم الشهادة</label>
                    <input type="text" id="edit_certificate_title" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>الجهة المانحة</label>
                    <input type="text" id="edit_certificate_issuer" name="issuer" class="form-control">
                </div>

                <div class="form-group">
                    <label>السنة</label>
                    <input type="text" id="edit_certificate_year" name="year" class="form-control">
                </div>

                <div class="form-group">
                    <label>صورة الشهادة الحالية</label>
                    <div style="margin-bottom: 1rem;">
                        <img src="" id="editCertificateImage" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid var(--primary);">
                    </div>
                    <label>تغيير الصورة</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>الوصف (اختياري)</label>
                    <textarea id="edit_certificate_description" name="description" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Certificate View Modal -->
    <div id="viewCertificateModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h3 class="modal-title" id="viewCertificateTitle">تفاصيل الشهادة</h3>
                <button class="modal-close" onclick="closeModal('viewCertificateModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div style="text-align: center;">
                <img src="" id="viewCertificateImage" style="max-width: 100%; max-height: 500px; border-radius: 10px; border: 2px solid var(--primary);">
            </div>
        </div>
    </div>

    <!-- CV Modal (Add) -->
    <div id="cvModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">رفع سيرة ذاتية جديدة</h3>
                <button class="modal-close" onclick="closeModal('cvModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('cv.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>اسم السيرة الذاتية</label>
                    <input type="text" name="name" class="form-control" placeholder="مثال: السيرة الذاتية 2024" required>
                </div>

                <div class="form-group">
                    <label>ملف PDF</label>
                    <input type="file" name="file" class="form-control" accept="application/pdf" required>
                    <small style="color: var(--text-secondary); margin-top: 5px; display: block;">
                        الصيغ المدعومة: PDF فقط | الحجم الأقصى: 5MB
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> رفع السيرة الذاتية
                </button>
            </form>
        </div>
    </div>

    <!-- Edit CV Modal -->
    <div id="editCvModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل السيرة الذاتية</h3>
                <button class="modal-close" onclick="closeModal('editCvModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editCvForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_cv_id" name="id">

                <div class="form-group">
                    <label>اسم السيرة الذاتية</label>
                    <input type="text" id="edit_cv_name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>الملف الحالي</label>
                    <div style="background: rgba(0,0,0,0.2); padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                        <i class="fas fa-file-pdf" style="color: #e74c3c; margin-left: 8px;"></i>
                        <span id="edit_cv_current_file">-</span>
                    </div>
                    <label>استبدال الملف (اختياري)</label>
                    <input type="file" name="file" class="form-control" accept="application/pdf">
                    <small style="color: var(--text-secondary); margin-top: 5px; display: block;">
                        اتركه فارغاً للإبقاء على الملف الحالي
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Blog Modal -->
    <div id="blogModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة مقال جديد</h3>
                <button class="modal-close" onclick="closeModal('blogModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form>
                <div class="form-group">
                    <label>العنوان</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>المحتوى</label>
                    <textarea class="form-control" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label>الصورة</label>
                    <input type="file" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة المقال
                </button>
            </form>
        </div>
    </div>

    <!-- Tech Stack Modal (Add) -->
    <div id="techStackModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">إضافة تقنية جديدة</h3>
                <button class="modal-close" onclick="closeModal('techStackModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('tech-stack.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>اسم التقنية</label>
                    <input type="text" name="name" class="form-control" placeholder="مثال: Flutter" required>
                </div>

                <div class="form-group">
                    <label>أيقونة Font Awesome</label>
                    <input type="text" name="icon" class="form-control" placeholder="مثال: fab fa-flutter أو fas fa-code" value="fas fa-code">
                    <small style="color: var(--text-secondary); margin-top: 5px; display: block;">
                        استخدم أيقونات Font Awesome: <a href="https://fontawesome.com/icons" target="_blank" style="color: var(--primary);">عرض الأيقونات</a>
                    </small>
                </div>

                <div class="form-group">
                    <label>الترتيب</label>
                    <input type="number" name="sort" class="form-control" placeholder="1" min="1">
                    <small style="color: var(--text-secondary); margin-top: 5px; display: block;">
                        استخدم رقم لترتيب العرض (الأصغر يظهر أولاً)
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة التقنية
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Tech Stack Modal -->
    <div id="editTechStackModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل التقنية</h3>
                <button class="modal-close" onclick="closeModal('editTechStackModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editTechStackForm" method="POST">
                @csrf
                <input type="hidden" id="edit_tech_stack_id" name="id">

                <div class="form-group">
                    <label>اسم التقنية</label>
                    <input type="text" id="edit_tech_stack_name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>أيقونة Font Awesome</label>
                    <input type="text" id="edit_tech_stack_icon" name="icon" class="form-control">
                    <small style="color: var(--text-secondary); margin-top: 5px; display: block;">
                        مثال: fab fa-laravel, fas fa-database, fab fa-js
                    </small>
                </div>

                <div class="form-group">
                    <label>الترتيب</label>
                    <input type="number" id="edit_tech_stack_sort" name="sort" class="form-control" min="1">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Portfolio Image Modal (Add) -->
    <div id="portfolioImageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">رفع صورة جديدة</h3>
                <button class="modal-close" onclick="closeModal('portfolioImageModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('portfolio-image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>نوع الصورة</label>
                    <select name="type" class="form-control" required>
                        <option value="hero">Hero - صورة الملف الشخصي</option>
                        <option value="about">About - صورة قسم "عني"</option>
                        <option value="gallery">Gallery - معرض الصور</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>الصورة</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    <small style="color: var(--text-secondary); margin-top: 5px; display: block;">
                        الصيغ المدعومة: JPG, PNG, GIF, WebP | الحجم الأقصى: 2MB
                    </small>
                </div>

                <div class="form-group">
                    <label>النص البديل (اختياري)</label>
                    <input type="text" name="alt_text" class="form-control" placeholder="وصف الصورة">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> رفع الصورة
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Portfolio Image Modal -->
    <div id="editPortfolioImageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">تعديل الصورة</h3>
                <button class="modal-close" onclick="closeModal('editPortfolioImageModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editPortfolioImageForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_portfolio_image_id" name="id">

                <div class="form-group">
                    <label>الصورة الحالية</label>
                    <div style="margin-bottom: 1rem;">
                        <img src="" id="editPortfolioImagePreview" style="width: 100%; max-height: 200px; object-fit: contain; border-radius: 10px; border: 2px solid var(--primary);">
                    </div>
                    <label>استبدال الصورة (اختياري)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>النص البديل</label>
                    <input type="text" id="edit_portfolio_image_alt" name="alt_text" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <!-- Chat Panel -->
    <div class="chat-panel" id="chatPanel">
        <div class="chat-panel-header">
            <span>المحادثات</span>
            <button class="chat-panel-close" id="closeChatPanel">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="chat-search">
            <input type="text" id="searchConversation" placeholder="بحث عن محادثة...">
        </div>

        <div class="chat-conversations" id="conversationsList">
            <div class="loading-conversations" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
                <i class="fas fa-spinner fa-spin" style="font-size: 1.5rem;"></i>
                <p style="margin-top: 0.5rem;">جاري تحميل المحادثات...</p>
            </div>
        </div>
    </div>

    <!-- Chat Window -->
    <div class="chat-window" id="chatWindow">
        <div class="chat-window-header">
            <button class="chat-back-btn" id="backToConversations">
                <i class="fas fa-arrow-right"></i>
            </button>
            <div class="chat-window-user">
                <img src="https://via.placeholder.com/40" alt="User" class="chat-window-avatar" id="chatUserAvatar">
                <div class="chat-window-info">
                    <h4 id="chatUserName">اختر محادثة</h4>
                    <p id="chatUserStatus">غير متصل</p>
                </div>
            </div>
            <div class="chat-window-actions">
                <button class="chat-close-btn" id="closeChatWindow">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="chat-messages" id="adminChatMessages">
        </div>

        <div class="chat-input">
            <input type="text" id="adminMessageInput" placeholder="اكتب ردك...">
            <button id="adminSendMessage">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Chat Button -->
    <button class="chat-button" onclick="toggleChat()">
        <i class="fas fa-comments"></i>
        <span id="chatUnreadBadge" style="position: absolute; top: -8px; right: -8px; background: #ff4444; color: white; border-radius: 50%; min-width: 22px; height: 22px; font-size: 11px; font-weight: bold; display: none; align-items: center; justify-content: center; padding: 0 5px;">0</span>
    </button>

    <script>
        const chatData = {};

        let currentChat = null;

        // Sidebar Navigation
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all links
                document.querySelectorAll('.sidebar-menu a').forEach(l => l.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');

                // Hide all sections
                document.querySelectorAll('.content-section').forEach(section => {
                    section.style.display = 'none';
                });

                // Show selected section
                const sectionId = this.getAttribute('data-section') + '-section';
                document.getElementById(sectionId).style.display = 'block';

                // Close sidebar on mobile after selection
                if (window.innerWidth <= 992) {
                    document.getElementById('sidebar').classList.remove('active');
                }
            });
        });

        // Modal Functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }

            // Close notifications when clicking outside
            if (event.target === document.body) {
                document.getElementById('notificationsPanel').classList.remove('active');
            }
        }

        // Toggle Sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Toggle Notifications
        function toggleNotifications() {
            const notificationsPanel = document.getElementById('notificationsPanel');
            notificationsPanel.classList.toggle('active');

            // Mark all as read when opening
            if (notificationsPanel.classList.contains('active')) {
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                });
                // Update badge
                const badge = document.querySelector('.notification-badge');
                if (badge) {
                    badge.style.display = 'none';
                }
            }
        }

        // Clear Notifications
        function clearNotifications() {
            const notificationsList = document.querySelector('.notifications-list');
            notificationsList.innerHTML =
                '<div class="notification-item"><div class="notification-content"><div class="notification-details"><div class="notification-title">لا توجد إشعارات</div></div></div></div>';
        }

        // Chat Functions
        function toggleChat() {
            const chatPanel = document.getElementById('chatPanel');
            chatPanel.classList.toggle('active');

            if (chatPanel.classList.contains('active')) {
                loadConversations();
                // Hide notification badge when opening chat
                const badge = document.getElementById('chatUnreadBadge');
                if (badge) badge.style.display = 'none';
                // Refresh conversations
                loadConversations();
            }

            // Close chat window if panel is closed
            if (!chatPanel.classList.contains('active')) {
                document.getElementById('chatWindow').classList.remove('active');
                // Restart polling for new messages
                startChatPolling();
            }
        }

        // Close chat panel
        document.getElementById('closeChatPanel').addEventListener('click', function() {
            document.getElementById('chatPanel').classList.remove('active');
            document.getElementById('chatWindow').classList.remove('active');
        });

        // Back to conversations
        document.getElementById('backToConversations').addEventListener('click', function() {
            document.getElementById('chatWindow').classList.remove('active');
            document.getElementById('chatPanel').classList.add('active');
            loadConversations();
        });

        // Close chat window
        document.getElementById('closeChatWindow').addEventListener('click', function() {
            document.getElementById('chatWindow').classList.remove('active');
            document.getElementById('chatPanel').classList.remove('active');
        });

        let currentChatUserId = null;

        // Load conversations list
        async function loadConversations() {
            const container = document.getElementById('conversationsList');
            if (!container) return;

            container.innerHTML = '<div class="loading-conversations" style="text-align: center; padding: 2rem; color: var(--text-secondary);"><i class="fas fa-spinner fa-spin" style="font-size: 1.5rem;"></i><p style="margin-top: 0.5rem;">جاري تحميل المحادثات...</p></div>';

            try {
                const res = await fetch('/chat/conversations', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'include'
                });

                if (!res.ok) {
                    const errorData = await res.json().catch(() => ({}));
                    throw new Error(errorData.message || 'HTTP ' + res.status);
                }

                const conversations = await res.json();

                if (!conversations || conversations.length === 0) {
                    container.innerHTML = '<div style="text-align: center; padding: 2rem; color: var(--text-secondary);"><i class="fas fa-comments" style="font-size: 2rem; margin-bottom: 1rem;"></i><p>لا توجد محادثات حتى الآن</p></div>';
                    return;
                }

                container.innerHTML = conversations.map(conv => `
                    <div class="conversation-item" data-user-id="${conv.id}" data-user-name="${conv.name}">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(conv.name)}&background=00ffff&color=0a192f" alt="User" class="conversation-avatar">
                        ${conv.unread_count > 0 ? '<div class="conversation-status"></div>' : ''}
                        <div class="conversation-info">
                            <div class="conversation-name">${conv.name}</div>
                            <div class="conversation-message">${(conv.last_message || '').substring(0, 40)}${(conv.last_message || '').length > 40 ? '...' : ''}</div>
                        </div>
                        <div class="conversation-time">${formatTime(conv.last_message_time)}</div>
                        ${conv.unread_count > 0 ? `<div class="conversation-unread">${conv.unread_count}</div>` : ''}
                    </div>
                `).join('');

                // Add click handlers
                container.querySelectorAll('.conversation-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const userId = this.getAttribute('data-user-id');
                        const userName = this.getAttribute('data-user-name');
                        openConversation(userId, userName);
                    });
                });

            } catch (err) {
                console.error('Failed to load conversations:', err);
                container.innerHTML = '<div style="text-align: center; padding: 2rem; color: var(--error);"><p>خطأ: ' + err.message + '</p></div>';
            }
        }

        // Format time
        function formatTime(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr);
            const now = new Date();
            const diff = now - date;

            if (diff < 60000) return 'الآن';
            if (diff < 3600000) return Math.floor(diff / 60000) + ' د';
            if (diff < 86400000) return Math.floor(diff / 3600000) + ' س';
            if (diff < 604800000) return Math.floor(diff / 86400000) + ' ي';
            return date.toLocaleDateString('ar-SA');
        }

        // Open conversation
        async function openConversation(userId, userName) {
            currentChatUserId = userId;

            // Update header
            const chatUserName = document.getElementById('chatUserName');
            const chatUserStatus = document.getElementById('chatUserStatus');
            if (chatUserName) chatUserName.textContent = userName;
            if (chatUserStatus) chatUserStatus.textContent = 'متصل الآن';

            // Hide panel and show chat window
            const chatPanel = document.getElementById('chatPanel');
            const chatWindow = document.getElementById('chatWindow');
            if (chatPanel) chatPanel.classList.remove('active');
            if (chatWindow) chatWindow.classList.add('active');

            // Load messages
            await loadConversationMessages(userId);

            // Mark as read
            try {
                await fetch(`/chat/conversation/${userId}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'include'
                });
            } catch (err) {
                console.error('Failed to mark as read:', err);
            }
        }

        // Load conversation messages
        async function loadConversationMessages(userId) {
            const container = document.getElementById('adminChatMessages');
            if (!container) return;

            container.innerHTML = '<div style="text-align: center; padding: 2rem; color: var(--text-secondary);"><i class="fas fa-spinner fa-spin"></i></div>';

            try {
                const res = await fetch(`/chat/conversation/${userId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'include'
                });

                const messages = await res.json();

                if (!messages || messages.length === 0) {
                    container.innerHTML = '<div style="text-align: center; padding: 2rem; color: var(--text-secondary);"><p>لا توجد رسائل</p></div>';
                    return;
                }

                container.innerHTML = messages.map(msg => `
                    <div class="message ${msg.sender_type === 'admin' ? 'sent' : 'received'}">
                        <div class="message-content">
                            <p>${msg.message}</p>
                            <span class="message-time">${formatTime(msg.created_at)}</span>
                        </div>
                    </div>
                `).join('');

                container.scrollTop = container.scrollHeight;

            } catch (err) {
                console.error('Failed to load messages:', err);
            }
        }

        // Send admin reply
        async function sendAdminReply() {
            const input = document.getElementById('adminMessageInput');
            if (!input) return;

            const message = input.value.trim();
            if (message === '' || !currentChatUserId) return;

            const container = document.getElementById('adminChatMessages');

            // Add message to UI
            const time = new Date().toLocaleTimeString('ar-SA', { hour: '2-digit', minute: '2-digit' });
            container.innerHTML += `
                <div class="message sent">
                    <div class="message-content">
                        <p>${message}</p>
                        <span class="message-time">${time}</span>
                    </div>
                </div>
            `;
            container.scrollTop = container.scrollHeight;
            input.value = '';

            try {
                const res = await fetch(`/chat/conversation/${currentChatUserId}/reply`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    credentials: 'include',
                    body: JSON.stringify({ message })
                });

                if (!res.ok) throw new Error('Failed to send');

            } catch (err) {
                console.error('Failed to send reply:', err);
                alert('حدث خطأ في إرسال الرسالة');
            }
        }

        // Admin send message handlers
        const adminSendBtn = document.getElementById('adminSendMessage');
        const adminInput = document.getElementById('adminMessageInput');

        if (adminSendBtn) {
            adminSendBtn.addEventListener('click', sendAdminReply);
        }
        if (adminInput) {
            adminInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendAdminReply();
                }
            });
        }

        // Chat Notifications
        let chatPollInterval = null;

        async function checkUnreadMessages() {
            try {
                const res = await fetch('/chat/conversations', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'include'
                });

                if (!res.ok) return;

                const conversations = await res.json();
                let totalUnread = 0;

                if (conversations && conversations.length > 0) {
                    conversations.forEach(conv => {
                        totalUnread += conv.unread_count || 0;
                    });
                }

                updateChatBadge(totalUnread);
            } catch (err) {
                console.error('Failed to check unread:', err);
            }
        }

        function updateChatBadge(count) {
            const badge = document.getElementById('chatUnreadBadge');
            if (!badge) return;

            count = parseInt(count) || 0;

            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }

        function startChatPolling() {
            checkUnreadMessages();
            if (chatPollInterval) clearInterval(chatPollInterval);
            chatPollInterval = setInterval(checkUnreadMessages, 5000);
        }

        function stopChatPolling() {
            if (chatPollInterval) {
                clearInterval(chatPollInterval);
                chatPollInterval = null;
            }
        }

        // Start chat notifications polling when page loads
        startChatPolling();

        // Initialize Charts

        // Projects Distribution Chart
        const projectsCtx = document.getElementById('projectsChart').getContext('2d');

        @php
            $chartLabels = $stats['project_categories']->pluck('categorie_project')->map(function($v) { return $v ?: 'غير مصنف'; });
            $chartData = $stats['project_categories']->pluck('total');
            $chartColors = ['#00ffff', '#00e5ff', '#00cccc', '#00b3b3', '#009999', '#008080'];
        @endphp

        new Chart(projectsCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: {!! json_encode($chartColors) !!},
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#8892b0',
                            padding: 15,
                            usePointStyle: true,
                            font: { size: 12 }
                        }
                    }
                }
            }
        });

        // Visitors Analytics Chart
        const visitorsAnalyticsCtx = document.getElementById('visitorsAnalyticsChart').getContext('2d');
        new Chart(visitorsAnalyticsCtx, {
            type: 'bar',
            data: {
                labels: ['الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
                datasets: [{
                    label: 'الزوار',
                    data: [320, 450, 380, 520, 490, 610, 580],
                    backgroundColor: '#00ffff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#8892b0'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#8892b0'
                        }
                    }
                }
            }
        });

        // Sources Chart
        const sourcesCtx = document.getElementById('sourcesChart').getContext('2d');
        new Chart(sourcesCtx, {
            type: 'pie',
            data: {
                labels: ['محركات البحث', 'وسائل التواصل', 'مباشر', 'مواقع أخرى'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: [
                        '#00ffff',
                        '#00e5ff',
                        '#00cccc',
                        '#0099cc'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#8892b0',
                            padding: 20
                        }
                    }
                }
            }
        });



        ///////////////////////////////////////////////////////////////////////


        $(document).on('click','.addSkillBtn',function() {

            let categoryId = $(this).data('id'); // يحصل على ID الفئة

            $('#category_id_input').val(categoryId); // يضعه في hidden input

            openModal('skillModal_co'); // يفتح المودل

        });

         $(document).on('click','.btn_delete_category',function() {

            let categoryId = $(this).data('id'); // يحصل على ID الفئة

            if (confirm('هل أنت متأكد من حذف هذه الفئة؟')) {
                // إرسال طلب الحذف إلى الخادم
                $.ajax({
                    url: '/category/delete/' + categoryId, // تأكد من أن هذا هو المسار الصحيح لحذف الفئة
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // إضافة رمز CSRF إذا لزم الأمر
                    },
                    success: function(response) {
                        // إعادة تحميل الصفحة أو إزالة العنصر من الواجهة
                        location.reload(); // أو يمكنك إزالة العنصر من الواجهة مباشرة
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء حذف الفئة.');
                    }
                });
            }
        });

        $(document).on('click','.dele_skill', function(){

            let id = $(this).data('id');

            if (confirm('هل أنت متأكد من حذف هذه الفئة؟')) {

                $.ajax({
                    url:'/item/delete/'+ id ,
                    type:'DELETE',
                    data:{
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(response){
                        alert(response.message);

                    location.reload();


                    },
                    error:function(xhr){
                        alert('عذرن لم يتم عمليه الحذف بنجاح');
                    }

                });

            };
        });


                $(document).on('click','.delete_project', function(){
                    let id= $(this).data('id');

                     if (confirm('هل أنت متأكد من حذف هذه الفئة؟')) {
                    $.ajax({
                     url:'/project/delete/'+id,
                      type:'DELETE',
                    data:{
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(response){
                       alert(response.message);
                     },
                      error:function(xhr){
                        alert('عذرن لم يتم عمليه الحذف بنجاح');
                    }
                });
            };

                });





        ////////////////////////////////////////////////////////////////
        //


        $(document).on('click', '.edit-record-btn', function(e) {



            const recordId = $(this).data('id');
            const route = '/edit_record_btn';
            const formId = $(this).data('form') || '#form_edit';
            const modalId = $(this).data('modal') || '#editModalpro';


            const url = `/${route}/${recordId}`;

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    fillEditForm(response.data, formId);
                    $(modalId).modal('show');
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

            });
        });


        function fillEditForm(responseData, formSelector) {
            const form = $(formSelector);

            Object.entries(responseData).forEach(([key, value]) => {
                const input = form.find(`[name="${key}"]`);


                // if (key === "beneficiary_id") {///////////////**************************************************************************************** */
                //     input.val(value);
                //     return;
                // }

                // عرض الصورة
                if (key === "image" && value) {
                    $('#previewImageEdit').attr('src', value);
                    return;
                }

                // عرض رابط PDF
                // if (key === "id_card_pdf_url" && value) {
                //     $('#btnViewPdf').show().off('click').on('click', function() {
                //         window.open(value, '_blank');
                //     });
                //     return;
                // }

                if (input.length > 0) {
                    const tagName = input.prop("tagName").toLowerCase();
                    const type = input.attr("type");

                    if (tagName === "input" || tagName === "textarea") {
                        if (type === "checkbox") {
                            input.prop("checked", !!value);
                        }
                        else if (type === "file") {
                            // تجاهل أي input type="file"
                            return;
                        }
                        else {
                            input.val(value ?? '');
                        }
                    }
                    else if (tagName === "select") {
                        input.val(value ?? '').trigger("change");
                    }
                    else {
                        input.val(value ?? '');
                    }
                }
            });
        }

        // Service Edit Handler
        $(document).on('click', '.edit-service-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/service/edit/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#edit_service_id').val(response.data.id);
                        $('#edit_service_title').val(response.data.title);
                        $('#edit_service_description').val(response.data.description);
                        $('#edit_service_icon').val(response.data.icon);
                        $('#editServiceForm').attr('action', '/service/update/' + response.data.id);
                        openModal('editServiceModal');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل البيانات');
                }
            });
        });

        // Service Delete Handler
        $(document).on('click', '.delete-service-btn', function() {
            const id = $(this).data('id');
            if (confirm('هل أنت متأكد من حذف هذه الخدمة؟')) {
                $.ajax({
                    url: '/service/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#service-' + id).remove();
                    },
                    error: function() {
                        alert('حدث خطأ في حذف الخدمة');
                    }
                });
            }
        });

        // Project Edit Handler
        $(document).on('click', '.edit-record-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/edit_record_btn/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        const data = response.data;
                        $('#edit_project_title').val(data.title);
                        $('#edit_project_description').val(data.description);
                        $('#edit_project_category').val(data.categorie_project);
                        $('#edit_project_url').val(data.url || '');

                        // Handle image
                        if (data.image) {
                            $('#editProjectImage').attr('src', data.image);
                        } else {
                            $('#editProjectImage').attr('src', 'https://via.placeholder.com/100');
                        }

                        $('#form_edit').attr('action', '/project/update/' + data.id);
                        openModal('editModalpro');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل البيانات');
                }
            });
        });

        // Project Delete Handler
        $(document).on('click', '.delete_project', function() {
            const id = $(this).data('id');
            if (confirm('هل أنت متأكد من حذف هذا المشروع؟')) {
                $.ajax({
                    url: '/project/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        $(this).closest('tr').remove();
                        location.reload();
                    }.bind(this),
                    error: function() {
                        alert('حدث خطأ في حذف المشروع');
                    }
                });
            }
        });

        // Edit Skill Item Handler
        $(document).on('click', '.edit-skill-btn', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const level = $(this).data('level');
            const categoryId = $(this).closest('.skill-category').find('.btn_delete_category').data('id');

            $('#edit_skill_id').val(id);
            $('#edit_skill_name').val(name);
            $('#edit_skill_level').val(level);
            $('#edit_skill_category_id').val(categoryId);
            $('#editSkillForm').attr('action', '/item/update/' + id);
            openModal('editSkillModal');
        });

        // Edit Skill Form Submit
        $(document).on('submit', '#editSkillForm', function(e) {
            e.preventDefault();
            const form = $(this);
            const id = $('#edit_skill_id').val();

            $.ajax({
                url: '/item/update/' + id,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    alert(response.message);
                    closeModal('editSkillModal');
                    location.reload();
                },
                error: function() {
                    alert('حدث خطأ في تحديث المهارة');
                }
            });
        });

        // Edit Category Handler
        $(document).on('click', '.edit-category-btn', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');

            $('#edit_category_id').val(id);
            $('#edit_category_title').val(title);
            $('#editCategoryForm').attr('action', '/category/update/' + id);
            openModal('editCategoryModal');
        });

        // Edit Category Form Submit
        $(document).on('submit', '#editCategoryForm', function(e) {
            e.preventDefault();
            const form = $(this);
            const id = $('#edit_category_id').val();

            $.ajax({
                url: '/category/update/' + id,
                method: 'POST',
                data: form.serialize(),
                success: function() {
                    closeModal('editCategoryModal');
                    location.reload();
                },
                error: function() {
                    alert('حدث خطأ في تحديث الفئة');
                }
            });
        });

        ///////

        // ==================== EXPERIENCES CRUD ====================

        // Edit Experience Handler
        $(document).on('click', '.edit-experience-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/experience/edit/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#edit_experience_id').val(response.data.id);
                        $('#edit_experience_title').val(response.data.title);
                        $('#edit_experience_company').val(response.data.company || '');
                        $('#edit_experience_duration').val(response.data.duration || '');
                        $('#edit_experience_description').val(response.data.description || '');
                        $('#editExperienceForm').attr('action', '/experience/update/' + response.data.id);
                        openModal('editExperienceModal');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل بيانات الخبرة');
                }
            });
        });

        // Delete Experience Handler
        $(document).on('click', '.delete-experience-btn', function() {
            if (!confirm('هل أنت متأكد من حذف هذه الخبرة؟')) return;
            const id = $(this).data('id');
            $.ajax({
                url: '/experience/delete/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status) {
                        $('#experience-' + id).remove();
                    }
                },
                error: function() {
                    alert('حدث خطأ في حذف الخبرة');
                }
            });
        });

        // ==================== CERTIFICATES CRUD ====================

        // View Certificate Image
        $(document).on('click', '.view-certificate-btn', function() {
            const imageUrl = $(this).data('image');
            const title = $(this).data('title');
            if (imageUrl) {
                $('#viewCertificateImage').attr('src', imageUrl);
                $('#viewCertificateTitle').text(title);
                openModal('viewCertificateModal');
            } else {
                alert('لا توجد صورة لهذه الشهادة');
            }
        });

        // Edit Certificate Handler
        $(document).on('click', '.edit-certificate-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/certificate/edit/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#edit_certificate_id').val(response.data.id);
                        $('#edit_certificate_title').val(response.data.title);
                        $('#edit_certificate_issuer').val(response.data.issuer || '');
                        $('#edit_certificate_year').val(response.data.year || '');
                        $('#edit_certificate_description').val(response.data.description || '');

                        if (response.data.Image_url) {
                            $('#editCertificateImage').attr('src', response.data.Image_url).show();
                        } else {
                            $('#editCertificateImage').hide();
                        }

                        $('#editCertificateForm').attr('action', '/certificate/update/' + response.data.id);
                        openModal('editCertificateModal');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل بيانات الشهادة');
                }
            });
        });

        // Delete Certificate Handler
        $(document).on('click', '.delete-certificate-btn', function() {
            if (!confirm('هل أنت متأكد من حذف هذه الشهادة؟')) return;
            const id = $(this).data('id');
            $.ajax({
                url: '/certificate/delete/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status) {
                        $('#certificate-' + id).remove();
                    }
                },
                error: function() {
                    alert('حدث خطأ في حذف الشهادة');
                }
            });
        });

        // ==================== CV CRUD ====================

        // Edit CV Handler
        $(document).on('click', '.edit-cv-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/cv/edit/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#edit_cv_id').val(response.data.id);
                        $('#edit_cv_name').val(response.data.name);
                        $('#edit_cv_current_file').text(response.data.file_name || '-');
                        $('#editCvForm').attr('action', '/cv/update/' + response.data.id);
                        openModal('editCvModal');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل بيانات السيرة الذاتية');
                }
            });
        });

        // Delete CV Handler
        $(document).on('click', '.delete-cv-btn', function() {
            if (!confirm('هل أنت متأكد من حذف هذه السيرة الذاتية؟')) return;
            const id = $(this).data('id');
            $.ajax({
                url: '/cv/delete/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status) {
                        $('#cv-' + id).remove();
                    }
                },
                error: function() {
                    alert('حدث خطأ في حذف السيرة الذاتية');
                }
            });
        });

        // Set Active CV Handler
        $(document).on('click', '.set-active-cv-btn', function() {
            const id = $(this).data('id');
            window.location.href = '/cv/set-active/' + id;
        });

        // ==================== TECH STACK CRUD ====================

        // Edit Tech Stack Handler
        $(document).on('click', '.edit-tech-stack-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/tech-stack/edit/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#edit_tech_stack_id').val(response.data.id);
                        $('#edit_tech_stack_name').val(response.data.name);
                        $('#edit_tech_stack_icon').val(response.data.icon);
                        $('#edit_tech_stack_sort').val(response.data.sort);
                        $('#editTechStackForm').attr('action', '/tech-stack/update/' + response.data.id);
                        openModal('editTechStackModal');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل بيانات التقنية');
                }
            });
        });

        // Delete Tech Stack Handler
        $(document).on('click', '.delete-tech-stack-btn', function() {
            if (!confirm('هل أنت متأكد من حذف هذه التقنية؟')) return;
            const id = $(this).data('id');
            $.ajax({
                url: '/tech-stack/delete/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status) {
                        $('#tech-stack-' + id).remove();
                    }
                },
                error: function() {
                    alert('حدث خطأ في حذف التقنية');
                }
            });
        });

        // ==================== PORTFOLIO IMAGES CRUD ====================

        // Edit Portfolio Image Handler
        $(document).on('click', '.edit-portfolio-image-btn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '/portfolio-image/edit/' + id,
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#edit_portfolio_image_id').val(response.data.id);
                        $('#edit_portfolio_image_alt').val(response.data.alt_text || '');
                        $('#editPortfolioImagePreview').attr('src', '/storage/' + response.data.image_path);
                        $('#editPortfolioImageForm').attr('action', '/portfolio-image/update/' + response.data.id);
                        openModal('editPortfolioImageModal');
                    }
                },
                error: function() {
                    alert('حدث خطأ في تحميل بيانات الصورة');
                }
            });
        });

        // Delete Portfolio Image Handler
        $(document).on('click', '.delete-portfolio-image-btn', function() {
            if (!confirm('هل أنت متأكد من حذف هذه الصورة؟')) return;
            const id = $(this).data('id');
            $.ajax({
                url: '/portfolio-image/delete/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status) {
                        $('#portfolio-image-' + id).remove();
                    }
                },
                error: function() {
                    alert('حدث خطأ في حذف الصورة');
                }
            });
        });
    </script>
</body>

</html>
