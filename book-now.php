<?php
// book-now.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Consultation | Blessing Furniture Coimbatore</title>
    <meta name="description" content="Book a bespoke furniture design consultation with Blessing Furniture. Let's create something unique.">
    <?php include 'includes/head.php'; ?>
</head>
<body class="contact-page-body">

<?php include 'includes/header.php'; ?>

<main class="contact-page-wrapper">
    <div class="bg-texture-overlay"></div>
    
    <div class="container-fluid contact-container">
        <div class="row align-items-center justify-content-center min-vh-100 py-5">
            
            <div class="col-xl-8 col-lg-10 col-md-11 position-relative z-index-2">
                <div class="contact-showcase-box" data-aos="fade-up" data-aos-duration="1200">
                    <img class="lazyload decor-illustration decor-armchair d-none d-lg-block" loading="lazy" src="assets/images/contact/armchair.png" alt="Elegant Armchair Sketch" data-aos="fade-right" data-aos-delay="300">
                    <img class="lazyload decor-illustration decor-plant d-none d-lg-block" loading="lazy" src="assets/images/contact/plant.png" alt="Decorative Plant Sketch" data-aos="fade-up" data-aos-delay="600">
                    
                    <div class="contact-form-inner">
                        <div class="contact-header text-center mb-5">
                            <span class="subheading d-block mb-2">Book Now</span>
                            <h1 class="heading display-4 mb-3">Schedule a Consultation</h1>
                            <p class="description mx-auto">Ready to craft your custom furniture? Fill out the form below and our team will get in touch to start your project.</p>
                        </div>
                        
                        <form action="book-now-mail.php" method="POST" class="bespoke-form">
                            <input type="hidden" name="form_time" value="<?php echo time(); ?>">
                            <input type="text" name="firstname" style="display:none;" tabindex="-1" autocomplete="off">
                            <input type="hidden" name="submit_booking" value="1">
                            <div class="row gx-5">
                                <div class="col-md-6 form-group mb-4">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" id="name" name="name" class="form-control premium-input" required placeholder="eg. Artisan Smith">
                                </div>
                                <div class="col-md-6 form-group mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control premium-input" required placeholder="eg. info@domain.com">
                                </div>
                                <div class="col-md-6 form-group mb-4">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="form-control premium-input" required placeholder="+91">
                                </div>
                                <div class="col-md-6 form-group mb-4">
                                    <label for="service" class="form-label">Service Interest</label>
                                    <div class="select-wrapper position-relative">
                                        <select id="service" name="service" class="form-control premium-input custom-select" required>
                                            <option value="" disabled selected>Select an Interest...</option>
                                            <option value="Home Interior Consultation">Home Interior Consultation</option>
                                            <option value="Custom Furniture Build">Custom Furniture Build</option>
                                            <option value="Office / Commercial Setup">Office / Commercial Setup</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 form-group mb-5 mt-2">
                                    <label for="requirements" class="form-label">Any Specific Requirements?</label>
                                    <textarea id="requirements" name="requirements" rows="3" class="form-control premium-input text-area" placeholder="Optional: Tell us what you are looking for..."></textarea>
                                </div>
                                <div class="col-12 form-action text-center mt-2">
                                    <button type="submit" class="btn-craftsman">
                                        <span class="btn-text">Submit Booking</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/script.php'; ?>
</body>
</html>
