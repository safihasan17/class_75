<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Newsletter</h4>
                        <?php echo get_theme_mod('mynewtheme_footer_main_text'); ?>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Explore</h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location'     => 'footer-menu-1',
                        'menu_class'         => 'list-unstyled',
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Contact Info</h4>
                    <a href=""><i class="fa fa-map-marker-alt me-2"></i> 123 Street, New York, USA</a>
                    <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                    <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                    <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                    <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                    <div class="d-flex align-items-center">
                        <a class="btn btn-light btn-md-square me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-light btn-md-square me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-light btn-md-square me-2" href=""><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-light btn-md-square me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item-post d-flex flex-column">
                    <h4 class="text-white mb-4">Popular Post</h4>
                    <div class="d-flex flex-column mb-3">
                        <p class="text-uppercase text-primary mb-2">Investment</p>
                        <a href="#" class="text-body">Revisiting Your Investment & Distribution Goals</a>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <p class="text-uppercase text-primary mb-2">Business</p>
                        <a href="#" class="text-body">Dimensional Fund Advisors Interview with Director</a>
                    </div>
                    <div class="footer-btn text-start">
                        <a href="#" class="btn btn-light rounded-pill px-4">View All Post <i class="fa fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <?php echo get_theme_mod('mynewtheme_footer_text'); ?>
            <?php echo get_theme_mod('mynewtheme_footer_info'); ?>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

<!-- All JS is enqueued via functions.php -> inc/load-css-js.php -->
<?php wp_footer(); ?>
</body>

</html>