<?php
/**
 * Template Name: Services
 * Description: Services page template
 */

get_header(); 
?>

<div class="page-hero" style="background: linear-gradient(135deg, var(--pharmacy-green) 0%, var(--pharmacy-light-green) 100%); color: white; padding: 40px 20px; text-align: center; margin-bottom: 40px;">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <p style="margin-top: 10px; font-size: 18px;">Comprehensive pharmacy services for your health needs</p>
    </div>
</div>

<div class="container">
    <div class="content-wrapper">
        <main class="main-content">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    ?>
                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>
                    <?php
                }
            }
            ?>

            <!-- Main Services -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Our Complete Services</h2>
                
                <div class="services-grid">
                    <div class="service-card">
                        <span class="service-icon">💉</span>
                        <h3>Prescription Filling</h3>
                        <p>Fast and accurate prescription filling with our experienced pharmacists. We work with most insurance plans and offer competitive pricing.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>30-minute turnaround</li>
                            <li>Insurance verification</li>
                            <li>Generic alternatives</li>
                            <li>Mail order options</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🩺</span>
                        <h3>Health Consultations</h3>
                        <p>Professional consultations with our licensed pharmacists on medication usage, side effects, and health concerns.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Medication counseling</li>
                            <li>Drug interaction checks</li>
                            <li>Allergy screening</li>
                            <li>Health education</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🏥</span>
                        <h3>Medical Consultations</h3>
                        <p>Our team works with healthcare providers to ensure optimal medication therapy management.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Therapy optimization</li>
                            <li>Provider coordination</li>
                            <li>Treatment compliance</li>
                            <li>Emergency support</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🧪</span>
                        <h3>Compounding Services</h3>
                        <p>Custom compounded medications tailored to individual patient needs when standard medications aren't suitable.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Custom formulations</li>
                            <li>Pediatric dosing</li>
                            <li>Allergen-free options</li>
                            <li>Flavor masking</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">💊</span>
                        <h3>Over-the-Counter Products</h3>
                        <p>Full range of OTC medications, vitamins, supplements, and health products backed by expert recommendations.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Vitamins & minerals</li>
                            <li>Cold & flu relief</li>
                            <li>Pain management</li>
                            <li>Wellness products</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">📦</span>
                        <h3>Delivery Service</h3>
                        <p>Fast and discreet medication delivery right to your home with secure packaging and tracking.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Same-day delivery</li>
                            <li>Secure packaging</li>
                            <li>Real-time tracking</li>
                            <li>Signature verification</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🎯</span>
                        <h3>Immunizations</h3>
                        <p>Convenient vaccination services including flu shots, pneumonia vaccines, and other immunizations.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Flu vaccinations</li>
                            <li>COVID-19 boosters</li>
                            <li>Pneumonia vaccines</li>
                            <li>Travel vaccinations</li>
                        </ul>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">📊</span>
                        <h3>Health Screenings</h3>
                        <p>Regular health check-ups and preventive screening services to maintain optimal wellness.</p>
                        <ul style="margin-left: 20px; margin-top: 15px;">
                            <li>Blood pressure checks</li>
                            <li>Cholesterol screening</li>
                            <li>Diabetes testing</li>
                            <li>BMI assessment</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Why Choose Us -->
            <section style="margin-top: 50px; background: linear-gradient(135deg, rgba(26, 127, 90, 0.1), rgba(42, 159, 111, 0.1)); padding: 40px; border-radius: 8px; border-left: 5px solid var(--pharmacy-green);">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px;">Why Choose Our Pharmacy?</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div>
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">🏆 Expert Pharmacists</h4>
                        <p>Highly trained and licensed professionals with years of experience in patient care.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">💯 Quality Assurance</h4>
                        <p>Rigorous quality control and verification for all medications and services.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">🤝 Personal Care</h4>
                        <p>Individualized attention and care tailored to your specific health needs.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">⏰ Convenient Hours</h4>
                        <p>Extended hours and emergency services for your convenience and peace of mind.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">💰 Affordable Pricing</h4>
                        <p>Competitive pricing with insurance acceptance and discount programs available.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">🔒 Privacy Protection</h4>
                        <p>Strict HIPAA compliance and confidentiality for all patient information.</p>
                    </div>
                </div>
            </section>

        </main>

        <aside class="sidebar">
            <div class="widget">
                <h3 class="widget-title">Service Hours</h3>
                <dl class="hours-box">
                    <dt>Monday - Friday</dt>
                    <dd>8:00 AM - 8:00 PM</dd>
                    <dt>Saturday</dt>
                    <dd>9:00 AM - 6:00 PM</dd>
                    <dt>Sunday</dt>
                    <dd>10:00 AM - 5:00 PM</dd>
                    <dt>Emergency</dt>
                    <dd>24/7 Available</dd>
                </dl>
            </div>

            <div class="widget">
                <h3 class="widget-title">Quick Contact</h3>
                <div class="contact-info">
                    <strong>📞 Phone</strong>
                    <p>1-800-PHARMACY<br><small>(1-800-727-4262)</small></p>
                </div>
                <div class="contact-info">
                    <strong>📧 Email</strong>
                    <p>services@pharmacy.local</p>
                </div>
                <a href="<?php echo site_url('/contact'); ?>" class="btn" style="display: block; text-align: center; margin-top: 15px;">Contact Us</a>
            </div>

            <div class="widget">
                <h3 class="widget-title">Insurance</h3>
                <p>We accept most major insurance plans including Medicare, Medicaid, and private plans. Ask our staff about payment options.</p>
            </div>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
