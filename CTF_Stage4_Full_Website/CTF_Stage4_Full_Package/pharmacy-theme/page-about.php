<?php
/**
 * Template Name: About
 * Description: About page template
 */

get_header();
?>

<div class="page-hero" style="background: linear-gradient(135deg, var(--pharmacy-green) 0%, var(--pharmacy-light-green) 100%); color: white; padding: 40px 20px; text-align: center; margin-bottom: 40px;">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <p style="margin-top: 10px; font-size: 18px;">Dedicated to Community Health Since 2010</p>
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

            <!-- Our Story -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Our Story</h2>
                <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); border-left: 5px solid var(--pharmacy-green);">
                    <p style="font-size: 16px; line-height: 1.8; margin-bottom: 15px;">
                        Founded in 2010, Secret Pharmacy has grown to become one of the most trusted healthcare providers in the community. What started as a small neighborhood pharmacy with a vision to provide exceptional care has evolved into a comprehensive pharmacy network serving thousands of patients daily.
                    </p>
                    <p style="font-size: 16px; line-height: 1.8; margin-bottom: 15px;">
                        Our commitment to excellence, patient care, and community health has remained constant throughout our growth. We believe that quality pharmacy services should be accessible, affordable, and delivered with compassion.
                    </p>
                    <p style="font-size: 16px; line-height: 1.8;">
                        Today, we continue to innovate and expand our services to meet the evolving healthcare needs of our patients. From traditional prescription filling to advanced compounding and immunization services, we're here to support your health journey.
                    </p>
                </div>
            </section>

            <!-- Our Mission & Values -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Mission & Values</h2>
                
                <div class="services-grid">
                    <div class="service-card">
                        <span class="service-icon">🎯</span>
                        <h3>Our Mission</h3>
                        <p>To provide exceptional pharmaceutical care and services that improve patient health outcomes and quality of life while maintaining the highest standards of professionalism and ethics.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">❤️</span>
                        <h3>Patient Care</h3>
                        <p>We prioritize patient well-being above all else, providing personalized care and taking time to understand individual health needs and concerns.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🔒</span>
                        <h3>Integrity</h3>
                        <p>We operate with complete honesty and integrity, maintaining strict ethical standards in all patient interactions and professional relationships.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">💡</span>
                        <h3>Innovation</h3>
                        <p>We continuously seek innovative solutions to improve pharmacy services and stay at the forefront of healthcare technology and practices.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🤝</span>
                        <h3>Community</h3>
                        <p>We're deeply committed to serving our community and contributing to public health through education, outreach, and accessible healthcare services.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🏆</span>
                        <h3>Excellence</h3>
                        <p>We strive for excellence in every aspect of our operations, from staff training to customer service and medication safety.</p>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Our Pharmacy Team</h2>
                
                <div class="services-grid">
                    <div class="service-card">
                        <span class="service-icon">👨‍⚕️</span>
                        <h3>Dr. James Mitchell</h3>
                        <p><strong style="color: var(--pharmacy-green);">Clinical Pharmacist & Owner</strong></p>
                        <p>20+ years of experience in pharmaceutical care and practice management. Specializes in medication therapy management and patient counseling.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">👩‍⚕️</span>
                        <h3>Dr. Sarah Johnson</h3>
                        <p><strong style="color: var(--pharmacy-green);">Clinical Pharmacist</strong></p>
                        <p>15+ years in hospital and retail pharmacy. Expert in compounding and immunization services. Patient advocate and health educator.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">👨‍💼</span>
                        <h3>Michael Chen</h3>
                        <p><strong style="color: var(--pharmacy-green);">Senior Pharmacy Technician</strong></p>
                        <p>Certified pharmacy technician with 12 years of experience in prescription preparation and inventory management.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">👩‍💼</span>
                        <h3>Emily Rodriguez</h3>
                        <p><strong style="color: var(--pharmacy-green);">Customer Service Manager</strong></p>
                        <p>Dedicated to patient satisfaction and ensuring excellent customer service experience. Also handles insurance coordination.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">👨‍💻</span>
                        <h3>David Lee</h3>
                        <p><strong style="color: var(--pharmacy-green);">IT & Operations Manager</strong></p>
                        <p>Manages pharmacy systems and ensures HIPAA compliance, data security, and operational efficiency.</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">👩‍🔬</span>
                        <h3>Lisa Thompson</h3>
                        <p><strong style="color: var(--pharmacy-green);">Compounding Specialist</strong></p>
                        <p>Expert in pharmaceutical compounding and custom formulation. Ensures quality and safety in all compounded medications.</p>
                    </div>
                </div>
            </section>

            <!-- Certifications & Accreditation -->
            <section style="margin-top: 50px; background: linear-gradient(135deg, rgba(26, 127, 90, 0.1), rgba(42, 159, 111, 0.1)); padding: 40px; border-radius: 8px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px;">Certifications & Accreditation</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div style="text-align: center; padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">✅ State Licensed</h4>
                        <p>All pharmacists and technicians are state licensed and NABP certified.</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">✅ HIPAA Compliant</h4>
                        <p>Full HIPAA compliance and patient privacy protection protocols.</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">✅ DEA Registered</h4>
                        <p>Registered with DEA and State Board of Pharmacy.</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">✅ Joint Commission</h4>
                        <p>Accredited by The Joint Commission (TJC) for quality assurance.</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">✅ Sterile Compounding</h4>
                        <p>USP <Sterile> Compounding certification and standards compliance.</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">✅ Insurance Networks</h4>
                        <p>Participating provider with all major insurance networks and plans.</p>
                    </div>
                </div>
            </section>

        </main>

        <aside class="sidebar">
            <div class="widget">
                <h3 class="widget-title">Contact Information</h3>
                <div class="contact-info">
                    <strong>📍 Location</strong>
                    <p>123 Medical Avenue<br>Downtown Medical Center<br>City, State 12345</p>
                </div>
                <div class="contact-info">
                    <strong>📞 Phone</strong>
                    <p>1-800-PHARMACY</p>
                </div>
                <div class="contact-info">
                    <strong>📧 Email</strong>
                    <p>info@pharmacy.local</p>
                </div>
            </div>

            <div class="widget">
                <h3 class="widget-title">Awards</h3>
                <ul>
                    <li>🏆 Best Pharmacy 2023</li>
                    <li>⭐ 5-Star Patient Reviews</li>
                    <li>🎖️ Community Excellence Award</li>
                    <li>🥇 Innovation in Healthcare</li>
                </ul>
            </div>

            <div class="widget">
                <h3 class="widget-title">Visit Us</h3>
                <p>Located in the heart of downtown, easily accessible by public transportation. Ample free parking available.</p>
                <a href="<?php echo site_url('/contact'); ?>" class="btn" style="display: block; text-align: center; margin-top: 15px;">Get Directions</a>
            </div>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
