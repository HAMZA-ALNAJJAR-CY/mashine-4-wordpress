<?php get_header(); ?>

<div class="hero-section">
    <div class="container">
        <span class="hero-icon">💊</span>
        <h1><?php bloginfo('name'); ?></h1>
        <p><?php bloginfo('description'); ?></p>
    </div>
</div>

<div class="container">
    <div class="content-wrapper">
        <main class="main-content">
            <!-- Services Grid -->
            <section class="services-section">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Our Services</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <span class="service-icon">💉</span>
                        <h3>Prescription Services</h3>
                        <p>Licensed pharmacists ready to fill your prescriptions with accuracy and care.</p>
                    </div>
                    <div class="service-card">
                        <span class="service-icon">🏥</span>
                        <h3>Medical Consultations</h3>
                        <p>Professional pharmacy consultations for medication questions and health advice.</p>
                    </div>
                    <div class="service-card">
                        <span class="service-icon">🩺</span>
                        <h3>Health Screenings</h3>
                        <p>Regular health check-ups and wellness programs for the community.</p>
                    </div>
                    <div class="service-card">
                        <span class="service-icon">🧪</span>
                        <h3>Compounding</h3>
                        <p>Custom medication compounding tailored to individual patient needs.</p>
                    </div>
                    <div class="service-card">
                        <span class="service-icon">💊</span>
                        <h3>OTC Medications</h3>
                        <p>Full range of over-the-counter medications and health products.</p>
                    </div>
                    <div class="service-card">
                        <span class="service-icon">📦</span>
                        <h3>Delivery Service</h3>
                        <p>Fast and reliable medication delivery to your doorstep.</p>
                    </div>
                </div>
            </section>

            <!-- News/Posts -->
            <section class="posts-section" style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Latest Updates</h2>
                
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        ?>
                        <article class="post">
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-meta">
                                By <?php the_author(); ?> on <?php echo get_the_date(); ?>
                            </div>
                            <div class="post-content">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
                        </article>
                        <?php
                    }
                } else {
                    echo '<p>No posts found.</p>';
                }
                ?>
            </section>

            <!-- Info Boxes -->
            <section style="margin-top: 50px;">
                <div class="info-box">
                    <h4>📍 Visit Us</h4>
                    <p>Our pharmacy is located in the heart of the city, easily accessible by public transportation. We serve patients with compassion and expertise.</p>
                </div>
                
                <div class="info-box">
                    <h4>⏰ Operating Hours</h4>
                    <p>Monday - Friday: 8:00 AM - 8:00 PM<br>
                       Saturday: 9:00 AM - 6:00 PM<br>
                       Sunday: 10:00 AM - 5:00 PM<br>
                       Emergency service available 24/7</p>
                </div>
            </section>
        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <?php
            if (is_active_sidebar('right-sidebar')) {
                dynamic_sidebar('right-sidebar');
            } else {
                // Default sidebar content if no widgets
                ?>
                <div class="widget">
                    <h3 class="widget-title">Quick Links</h3>
                    <ul>
                        <li><a href="#">Prescription Refill</a></li>
                        <li><a href="#">Health Services</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Insurance</a></li>
                    </ul>
                </div>

                <div class="widget">
                    <h3 class="widget-title">Emergency</h3>
                    <div class="contact-info">
                        <strong>24/7 Support</strong>
                        <p>Phone: 1-800-PHARMACY</p>
                        <p>Email: help@pharmacy.local</p>
                    </div>
                </div>

                <div class="widget">
                    <h3 class="widget-title">Pharmacy Team</h3>
                    <p>Our experienced team of licensed pharmacists is dedicated to providing the highest quality care and service.</p>
                </div>
                <?php
            }
            ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
