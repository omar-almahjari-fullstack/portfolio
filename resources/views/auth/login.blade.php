<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="أحمد محمد - مطور Full-Stack متخصص في Flutter, Laravel, C#">
    <title>تسجيل الدخول | أحمد محمد</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* Auth Container */
        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }



        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .auth-logo-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: var(--darker);
            font-size: 1.5rem;
            margin-left: 15px;
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
        }

        .auth-title {
            font-size: 2.2rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* Form Styles */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--text);
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Tajawal', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .password-toggle {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .remember-me label {
            font-size: 0.9rem;
            color: var(--text-secondary);
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Buttons */
        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            width: 100%;
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

        .btn-google {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: var(--text);
            margin-top: 1rem;
        }

        .btn-google:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-google i {
            color: #DB4437;
            font-size: 1.2rem;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: var(--text-secondary);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--glass-border);
        }

        .divider::before {
            margin-left: 1rem;
        }

        .divider::after {
            margin-right: 1rem;
        }

        /* Auth Footer */
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .auth-footer a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Back to Home */
        .back-home {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .back-home-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-home-btn:hover {
            background: var(--gradient-1);
            color: var(--darker);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-container {
                padding: 1rem;
            }

            .auth-card {
                padding: 2rem 1.5rem;
            }

            .back-home {
                top: 1rem;
                right: 1rem;
            }

            .auth-title {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.5rem 1rem;
            }

            .form-options {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .auth-title {
                font-size: 1.6rem;
            }
        }

        /* Animation */
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

        .auth-card {
            animation: fadeInUp 0.6s ease;
        }
    </style>
</head>
<body>
    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Back to Home -->
    <div class="back-home">
        <a href="{{ url('/') }}" class="back-home-btn">
            <i class="fas fa-arrow-right"></i>
            العودة للرئيسية
        </a>
    </div>

    <!-- Auth Container -->
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <div class="auth-logo-icon">أ</div>
                </div>
                <h1 class="auth-title" id="authTitle">تسجيل الدخول</h1>
                <p class="auth-subtitle" id="authSubtitle">مرحباً بعودتك! يرجى إدخال بياناتك</p>
            </div>

            <form class="auth-form" id="authForm">
                <!-- Login Form (Default) -->
                <div id="loginForm">
                    <div class="form-group">
                        <label for="loginEmail" class="form-label">البريد الإلكتروني</label>
                        <input type="email" id="loginEmail" class="form-control" placeholder="ادخل بريدك الإلكتروني" required>
                    </div>

                    <div class="form-group">
                        <label for="loginPassword" class="form-label">كلمة المرور</label>
                        <input type="password" id="loginPassword" class="form-control" placeholder="ادخل كلمة المرور" required>
                        <button type="button" class="password-toggle" id="toggleLoginPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="rememberMe">
                            <label for="rememberMe">تذكرني</label>
                        </div>
                        <a href="#" class="forgot-password">نسيت كلمة المرور؟</a>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        تسجيل الدخول
                    </button>
                </div>

                <!-- Register Form (Hidden by default) -->
                <div id="registerForm" style="display: none;">
                    <div class="form-group">
                        <label for="registerName" class="form-label">الاسم الكامل</label>
                        <input type="text" id="registerName" class="form-control" placeholder="ادخل اسمك الكامل" required>
                    </div>

                    <div class="form-group">
                        <label for="registerEmail" class="form-label">البريد الإلكتروني</label>
                        <input type="email" id="registerEmail" class="form-control" placeholder="ادخل بريدك الإلكتروني" required>
                    </div>

                    <div class="form-group">
                        <label for="registerPassword" class="form-label">كلمة المرور</label>
                        <input type="password" id="registerPassword" class="form-control" placeholder="ادخل كلمة المرور" required>
                        <button type="button" class="password-toggle" id="toggleRegisterPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" id="confirmPassword" class="form-control" placeholder="أعد إدخال كلمة المرور" required>
                        <button type="button" class="password-toggle" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        إنشاء حساب
                    </button>
                </div>

                <div class="divider">أو</div>

                <button type="button" class="btn btn-google" id="googleSignIn" onclick="window.location.href='{{ url('/auth/google') }}'">
                    <i class="fab fa-google"></i>
                    متابعة مع Google
                </button>
            </form>



            <div class="auth-footer">
                <p id="authFooterText">
                    ليس لديك حساب؟
                    <a href="#" id="toggleAuthFormLink">إنشاء حساب</a>
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
/* -------------------- Particles -------------------- */
particlesJS('particles-js', {
    particles: {
        number: { value: 40, density: { enable: true, value_area: 800 }},
        color: { value: '#00ffff' },
        shape: { type: 'circle' },
        opacity: { value: 0.5, random: true },
        size: { value: 3, random: true },
        line_linked: {
            enable: true, distance: 150, color: '#00ffff', opacity: 0.4, width: 1
        },
        move: { enable: true, speed: 2 }
    },
    interactivity: {
        detect_on: 'canvas',
        events: {
            onhover: { enable: true, mode: 'grab' },
            onclick: { enable: true, mode: 'push' },
            resize: true
        }
    },
    retina_detect: true
});

/* -------------------- Elements -------------------- */
const authTitle = document.getElementById('authTitle');
const authSubtitle = document.getElementById('authSubtitle');
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const authFooterText = document.getElementById('authFooterText');
let isLoginForm = true;

/* -------------------- Manage Required -------------------- */
function setRequired(container, enabled) {
    const inputs = container.querySelectorAll("input");
    inputs.forEach(i => {
        if (enabled) i.setAttribute("required", "required");
        else i.removeAttribute("required");
    });
}

// عند التشغيل: login required – register not
setRequired(loginForm, true);
setRequired(registerForm, false);

/* -------------------- Toggle Forms -------------------- */
function toggleForms() {
    if (isLoginForm) {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        authTitle.textContent = "إنشاء حساب";
        authSubtitle.textContent = "انضم إلينا! يرجى إنشاء حساب جديد";

        // required
        setRequired(loginForm, false);
        setRequired(registerForm, true);

        authFooterText.innerHTML = 'لديك حساب بالفعل؟ <a href="#" id="toggleAuthFormLink">تسجيل الدخول</a>';
        isLoginForm = false;
    } else {
        registerForm.style.display = "none";
        loginForm.style.display = "block";
        authTitle.textContent = "تسجيل الدخول";
        authSubtitle.textContent = "مرحباً بعودتك! يرجى إدخال بياناتك";

        // required
        setRequired(registerForm, false);
        setRequired(loginForm, true);

        authFooterText.innerHTML = 'ليس لديك حساب؟ <a href="#" id="toggleAuthFormLink">إنشاء حساب</a>';
        isLoginForm = true;
    }

    // Re-attach event listener to new link
    document.getElementById('toggleAuthFormLink').addEventListener('click', function(e) {
        e.preventDefault();
        toggleForms();
    });
}

// Use event delegation instead of direct listener
document.addEventListener('click', function(e) {
    if (e.target.id === 'toggleAuthFormLink' || e.target.closest('#toggleAuthFormLink')) {
        e.preventDefault();
        toggleForms();
    }
});

/* -------------------- Password Toggle -------------------- */
function setupPasswordToggle(btn, field) {
    if (!btn || !field) return;
    btn.addEventListener('click', function () {
        const type = field.type === 'password' ? 'text' : 'password';
        field.type = type;
        this.innerHTML = type === 'password'
            ? '<i class="fas fa-eye"></i>'
            : '<i class="fas fa-eye-slash"></i>';
    });
}

setupPasswordToggle(document.getElementById("toggleLoginPassword"), document.getElementById("loginPassword"));
setupPasswordToggle(document.getElementById("toggleRegisterPassword"), document.getElementById("registerPassword"));
setupPasswordToggle(document.getElementById("toggleConfirmPassword"), document.getElementById("confirmPassword"));

/* -------------------- Form Submit (Login / Register) -------------------- */
document.getElementById("authForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    if (isLoginForm) {
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;

        if (!email || !password) return showMessage("يرجى ملء جميع الحقول", "error");

        showMessage("جاري تسجيل الدخول...", "info");

        try {
            const res = await fetch("{{ url('/login') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                credentials: 'include',
                body: JSON.stringify({ email, password })
            });

            const data = await res.json();

            if (!res.ok) {
                return showMessage(data.message || "خطأ في تسجيل الدخول", "error");
            }

            showMessage("تم تسجيل الدخول", "success");
            setTimeout(() => window.location.href = data.redirect || "/", 800);
        } catch (err) {
            console.error('Login error:', err);
            showMessage("حدث خطأ في الاتصال بالخادم", "error");
        }

    } else {
        const name = document.getElementById('registerName').value;
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;
        const confirm = document.getElementById('confirmPassword').value;

        if (!name || !email || !password || !confirm)
            return showMessage("يرجى ملء جميع الحقول", "error");

        if (password !== confirm)
            return showMessage("كلمات المرور غير متطابقة", "error");

        if (password.length < 6)
            return showMessage("كلمة المرور يجب أن تكون 6 أحرف على الأقل", "error");

        showMessage("جاري إنشاء الحساب...", "info");

        try {
            const res = await fetch("{{ url('/register') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                credentials: 'include',
                body: JSON.stringify({ name, email, password })
            });

            const data = await res.json();

            if (!res.ok) {
                return showMessage(data.message || "خطأ في إنشاء الحساب", "error");
            }

            showMessage("تم إنشاء الحساب بنجاح", "success");
            setTimeout(() => window.location.href = data.redirect || "/", 800);
        } catch (err) {
            console.error('Registration error:', err);
            showMessage("حدث خطأ في الاتصال بالخادم", "error");
        }
    }
});

/* -------------------- Message Toast -------------------- */
function showMessage(message, type) {
    const old = document.querySelector(".message-toast");
    if (old) old.remove();

    let bgColor = "#FF5252";
    if (type === "success") bgColor = "#4CAF50";
    else if (type === "info") bgColor = "#2196F3";

    const div = document.createElement("div");
    div.className = "message-toast " + type;
    div.style.cssText = `
        position: fixed; top: 20px; right: 50%; transform: translateX(50%);
        background: ${bgColor};
        color: white; padding: 1rem 2rem; border-radius: 50px;
        font-weight: 600; z-index: 9999; animation: fadeIn .5s;
    `;
    div.textContent = message;
    document.body.appendChild(div);

    setTimeout(() => div.remove(), 5000);
}
</script>

</body>
</html>

