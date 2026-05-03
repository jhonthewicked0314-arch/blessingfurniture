<?php
// success.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success | Blessing Furniture Coimbatore</title>
    <meta name="description" content="Thank you for contacting Blessing Furniture. Your inquiry has been received.">
    <?php include 'includes/head.php'; ?>
    <style>
        .success-page-body {
            background-color: var(--contact-bg, #FDF8F2);
            overflow-x: hidden;
        }
        .success-wrapper {
            position: relative;
            background-color: var(--contact-bg, #FDF8F2);
            overflow: hidden;
            padding: 5rem 0;
            min-height: 70vh;
            display: flex;
            align-items: center;
        }
        .success-box {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 4rem;
            box-shadow: 0 30px 60px -15px rgba(59, 42, 30, 0.08), 
                        0 0 0 1px rgba(200, 159, 86, 0.15);
            text-align: center;
            position: relative;
            z-index: 5;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background-color: rgba(200, 159, 86, 0.1);
            color: #C89F56;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .success-icon svg {
            width: 40px;
            height: 40px;
        }
        .success-title {
            font-family: 'Playfair Display', serif;
            color: #3B2A1E;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .success-text {
            font-family: 'Inter', sans-serif;
            color: #594D42;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .btn-return {
            background: #3B2A1E;
            color: #ffffff;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-return:hover {
            background: #C89F56;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(200, 159, 86, 0.4);
        }
        
        @media (max-width: 767.98px) {
            .success-box {
                padding: 3rem 1.5rem;
            }
            .success-title {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body class="success-page-body">

<?php include 'includes/header.php'; ?>

<main class="success-wrapper">
    <div class="bg-texture-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.4; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23c89f56\' fill-opacity=\'0.08\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); pointer-events: none;"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="success-box" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="success-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h1 class="success-title">Thank You!</h1>
                    <p class="success-text">Your inquiry has been successfully sent. A copy of the details has been emailed to you. Our artisans will review your requirements and get back to you shortly.</p>
                    <a href="index.php" class="btn-return">Return to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/script.php'; ?>
</body>
</html>
