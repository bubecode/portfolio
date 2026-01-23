<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portfolio CMS</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.15) 0, transparent 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            color: #f8fafc;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.5);
        }

        .brand-title {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: #cbd5e1;
            margin-bottom: 8px;
            margin-left: 4px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 24px;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 14px !important;
            color: #fff !important;
            padding: 12px 16px !important;
            font-size: 15px !important;
            transition: all 0.3s ease !important;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.8) !important;
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
            outline: none !important;
        }

        .btn-signin {
            background: var(--primary-gradient);
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
            filter: brightness(1.1);
        }

        .btn-signin:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 14px;
            font-size: 14px;
            border: none;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            padding: 12px 16px;
        }

        /* Ambient Orbs */
        .orb {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .orb-1 {
            background: rgba(99, 102, 241, 0.2);
            top: -10%;
            left: -10%;
            animation: move-1 20s infinite alternate;
        }

        .orb-2 {
            background: rgba(168, 85, 247, 0.15);
            bottom: -10%;
            right: -10%;
            animation: move-2 25s infinite alternate;
        }

        @keyframes move-1 {
            0% { transform: translate(0, 0); }
            100% { transform: translate(100px, 50px); }
        }

        @keyframes move-2 {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-80px, -40px); }
        }
    </style>
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="brand-section">
                <div class="brand-logo">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h1 class="brand-title">Admin Access</h1>
                <p class="brand-subtitle">Welcome back, please sign in to continue.</p>
            </div>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger mb-4 text-center">
                    <i class="fas fa-circle-exclamation me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if(validation_errors()): ?>
                <div class="alert alert-danger mb-4 text-center">
                    <i class="fas fa-circle-exclamation me-2"></i>
                    <?php echo validation_errors('', ''); ?>
                </div>
            <?php endif; ?>

            <?php echo form_open('admin/auth/login'); ?>
                <div class="input-group-custom">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" required autofocus placeholder="name@company.com">
                </div>
                
                <div class="input-group-custom">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required placeholder="••••••••">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn-signin">
                        Sign In <i class="fas fa-arrow-right-long ms-2"></i>
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</body>
</html>
