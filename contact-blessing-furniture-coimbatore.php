<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bespoke Custom Furniture | Blessing Furniture Coimbatore</title>
    <meta name="description" content="Get in touch with Blessing Furniture in Alandurai, Coimbatore. Let's craft your dream bespoke wooden furniture together. Book a design consultation today.">
    <meta name="keywords" content="contact Blessing Furniture, furniture shop Alandurai contact, custom furniture consultation Coimbatore, bespoke furniture maker contact">
    <?php include 'includes/head.php'; ?>
</head>
<body class="contact-page-body">

<?php include 'includes/header.php'; ?>

<main class="contact-page-wrapper">
    
    
    
        
    <section class="breadcrumb-secc" style="background-image: url(assets/images/banner/banner-image-4.webp);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="breadcrumb-content">
                        <h1 class="breadcumb-title">Contact Us</h1>
                        <ul class="breadcrumb-navigation">
                            <li><a href="index.php">home</a></li>
                             <li>Contact Us</li>
                        </ul>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>
      
    
    
    
    
    
    
    
    
    <!-- Subtle Background Texture -->
    <div class="bg-texture-overlay"></div>
    
    <div class="container-fluid contact-container">
        <div class="row align-items-center justify-content-center min-vh-100 py-5">
            
            <div class="col-xl-8 col-lg-10 col-md-11 position-relative z-index-2">
                
                <div class="contact-showcase-box" data-aos="fade-up" data-aos-duration="1200">
                    
                    <!-- Bespoke Illustrations absolutely positioned around form -->
                    <img class="lazyload decor-illustration decor-armchair d-none d-lg-block" loading="lazy" src="assets/images/contact/armchair.png" alt="Elegant Armchair Sketch" data-aos="fade-right" data-aos-delay="300">
                    <img class="lazyload decor-illustration decor-plant d-none d-lg-block" loading="lazy" src="assets/images/contact/plant.png" alt="Decorative Plant Sketch" data-aos="fade-up" data-aos-delay="600">
                    
                    <div class="contact-form-inner">
                        <div class="contact-header text-center mb-5">
                            <span class="subheading d-block mb-2">Bespoke Craftsmanship</span>
                            <h1 class="heading display-4 mb-3">Let's Craft Your Vision</h1>
                            <p class="description mx-auto">Bring us your ideas, and let our artisans shape them into timeless pieces. We serve discerning clients across Coimbatore and beyond.</p>
                        </div>
                        
                        <form action="mailfunction.php" method="POST" id="customContactForm" class="bespoke-form">
                            <input type="hidden" name="form_time" value="<?php echo time(); ?>">
                            <input type="text" name="firstname" style="display:none;" tabindex="-1" autocomplete="off">
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
                                            <option value="Custom Sofa & Seating">Custom Sofa & Seating</option>
                                            <option value="Custom Bedroom Furniture">Custom Bedroom Furniture</option>
                                            <option value="Custom Dining Sets">Custom Dining Sets</option>
                                            <option value="Custom Wardrobes & Storage">Custom Wardrobes & Storage</option>
                                            <option value="Furniture Restoration & Repair">Furniture Restoration & Repair</option>
                                            <option value="Design Consultation">Design Consultation</option>
                                            <option value="Other Customization">Other Customization</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 form-group mb-5 mt-2">
                                    <label for="requirements" class="form-label">Your Requirements</label>
                                    <textarea id="requirements" name="requirements" rows="3" class="form-control premium-input text-area" required placeholder="Tell us about the space, style, or specific dimensions you have in mind..."></textarea>
                                </div>
                                <div class="col-12 form-action text-center mt-2">
                                    <button type="submit" name="submit_contact" class="btn-craftsman">
                                        <span class="btn-text">Send Inquiry</span>
                                        <span class="btn-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </span>
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
