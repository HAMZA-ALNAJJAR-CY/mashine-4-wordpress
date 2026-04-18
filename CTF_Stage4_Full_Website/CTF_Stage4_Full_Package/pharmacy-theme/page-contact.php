<?php
/**
 * Template Name: Contact
 * Description: Contact page template
 */

get_header();
?>

<div class="page-hero" style="background: linear-gradient(135deg, var(--pharmacy-green) 0%, var(--pharmacy-light-green) 100%); color: white; padding: 40px 20px; text-align: center; margin-bottom: 40px;">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <p style="margin-top: 10px; font-size: 18px;">Get in touch with our pharmacy team</p>
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

            <!-- Contact Form -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Send us a Message</h2>
                
                <form method="POST" class="contact-form" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); border-left: 5px solid var(--pharmacy-green);">
                    
                    <?php
                    // Handle form submission
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_nonce'])) {
                        if (wp_verify_nonce($_POST['contact_nonce'], 'pharmacy_contact_form')) {
                            $name = sanitize_text_field($_POST['contact_name'] ?? '');
                            $email = sanitize_email($_POST['contact_email'] ?? '');
                            $phone = sanitize_text_field($_POST['contact_phone'] ?? '');
                            $subject = sanitize_text_field($_POST['contact_subject'] ?? '');
                            $message = sanitize_textarea_field($_POST['contact_message'] ?? '');
                            
                            if ($name && $email && $message) {
                                $to = get_option('admin_email');
                                $mail_subject = "New Contact Form: " . $subject;
                                $mail_body = "Name: $name\n";
                                $mail_body .= "Email: $email\n";
                                $mail_body .= "Phone: $phone\n";
                                $mail_body .= "Subject: $subject\n\n";
                                $mail_body .= "Message:\n$message";
                                
                                if (wp_mail($to, $mail_subject, $mail_body)) {
                                    ?>
                                    <div class="alert-box" style="background: linear-gradient(135deg, rgba(26, 177, 76, 0.1), rgba(52, 211, 153, 0.1)); border-left-color: #1ab14c; margin-bottom: 20px;">
                                        <p style="color: #1ab14c; margin: 0; font-weight: 600;">✅ Thank you! Your message has been sent successfully.</p>
                                        <p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">We'll get back to you as soon as possible.</p>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="alert-box" style="margin-bottom: 20px;">
                                        <p style="color: #c0392b; margin: 0;">❌ Error sending message. Please try again.</p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="alert-box" style="margin-bottom: 20px;">
                                    <p style="color: #c0392b; margin: 0;">❌ Please fill out all required fields.</p>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="contact_name" style="display: block; margin-bottom: 8px; color: var(--pharmacy-green); font-weight: 600;">Name *</label>
                        <input type="text" id="contact_name" name="contact_name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="contact_email" style="display: block; margin-bottom: 8px; color: var(--pharmacy-green); font-weight: 600;">Email *</label>
                        <input type="email" id="contact_email" name="contact_email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="contact_phone" style="display: block; margin-bottom: 8px; color: var(--pharmacy-green); font-weight: 600;">Phone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="contact_subject" style="display: block; margin-bottom: 8px; color: var(--pharmacy-green); font-weight: 600;">Subject *</label>
                        <select id="contact_subject" name="contact_subject" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                            <option value="">Select a subject...</option>
                            <option value="Prescription Inquiry">Prescription Inquiry</option>
                            <option value="Service Question">Service Question</option>
                            <option value="Delivery Issue">Delivery Issue</option>
                            <option value="Insurance Question">Insurance Question</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Feedback">Feedback</option>
                            <option value="Employment">Employment</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="contact_message" style="display: block; margin-bottom: 8px; color: var(--pharmacy-green); font-weight: 600;">Message *</label>
                        <textarea id="contact_message" name="contact_message" required rows="6" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; font-family: inherit;"></textarea>
                    </div>

                    <?php wp_nonce_field('pharmacy_contact_form', 'contact_nonce'); ?>

                    <button type="submit" class="btn" style="background-color: var(--pharmacy-green); color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600;">Send Message</button>
                </form>
            </section>

            <!-- Information Sections -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Other Ways to Reach Us</h2>
                
                <div class="services-grid">
                    <div class="service-card">
                        <span class="service-icon">📞</span>
                        <h3>Phone</h3>
                        <p><strong style="color: var(--pharmacy-green); font-size: 18px;">1-800-PHARMACY</strong></p>
                        <p><small>(1-800-727-4262)</small></p>
                        <p style="font-size: 14px; margin-top: 10px;">Available Mon-Fri 8AM-8PM, Sat 9AM-6PM, Sun 10AM-5PM</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">📧</span>
                        <h3>Email</h3>
                        <p><strong style="color: var(--pharmacy-green);">contact@pharmacy.local</strong></p>
                        <p style="font-size: 14px; margin-top: 10px;">We respond to emails within 24 business hours</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">📍</span>
                        <h3>Visit Us</h3>
                        <p><strong style="color: var(--pharmacy-green);">123 Medical Avenue</strong></p>
                        <p>Downtown Medical Center<br>City, State 12345</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">⏰</span>
                        <h3>Hours</h3>
                        <p><strong>Regular Hours:</strong><br>Mon-Fri: 8AM-8PM<br>Sat: 9AM-6PM<br>Sun: 10AM-5PM</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">🚨</span>
                        <h3>Emergency</h3>
                        <p><strong style="color: var(--pharmacy-accent);">24/7 Emergency Support</strong></p>
                        <p style="font-size: 14px; margin-top: 10px;">For urgent pharmacy needs, call our emergency line available anytime</p>
                    </div>

                    <div class="service-card">
                        <span class="service-icon">💬</span>
                        <h3>Online Support</h3>
                        <p>Live chat and online support available during business hours</p>
                        <p style="font-size: 14px; margin-top: 10px;">Average response time: 5 minutes</p>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section style="margin-top: 50px;">
                <h2 style="color: var(--pharmacy-green); margin-bottom: 30px; font-size: 32px;">Frequently Asked Questions</h2>
                
                <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
                    <div style="padding: 20px; border-bottom: 1px solid #eee;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">How do I fill a prescription?</h4>
                        <p>You can fill a prescription in-store, by phone, or online through our website. Just provide your prescription details and we'll have it ready for you.</p>
                    </div>

                    <div style="padding: 20px; border-bottom: 1px solid #eee;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">Do you accept insurance?</h4>
                        <p>Yes! We accept most major insurance plans including Medicare, Medicaid, and private insurance. Contact us to verify your specific plan.</p>
                    </div>

                    <div style="padding: 20px; border-bottom: 1px solid #eee;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">How quickly can you deliver?</h4>
                        <p>Our delivery service typically delivers within 24 hours for most areas. Same-day delivery may be available for certain locations.</p>
                    </div>

                    <div style="padding: 20px; border-bottom: 1px solid #eee;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">Can I speak with a pharmacist?</h4>
                        <p>Absolutely! Our pharmacists are available for consultations during business hours. You can request a consultation when you visit or call.</p>
                    </div>

                    <div style="padding: 20px;">
                        <h4 style="color: var(--pharmacy-green); margin-bottom: 10px;">What about medication refills?</h4>
                        <p>You can request refills online, by phone, or in-person. Most refills are ready within 1 hour. We also offer automatic refill programs.</p>
                    </div>
                </div>
            </section>

        </main>

        <aside class="sidebar">
            <div class="widget">
                <h3 class="widget-title">Contact Info</h3>
                <div class="contact-info">
                    <strong>📍 Main Location</strong>
                    <p>123 Medical Avenue<br>Downtown Medical Center<br>City, ST 12345</p>
                </div>
                <div class="contact-info">
                    <strong>📞 Main Line</strong>
                    <p>1-800-PHARMACY<br>(1-800-727-4262)</p>
                </div>
                <div class="contact-info">
                    <strong>🚨 Emergency</strong>
                    <p>Available 24/7</p>
                </div>
            </div>

            <div class="widget">
                <h3 class="widget-title">Business Hours</h3>
                <dl class="hours-box">
                    <dt>Monday - Friday</dt>
                    <dd>8:00 AM - 8:00 PM</dd>
                    <dt>Saturday</dt>
                    <dd>9:00 AM - 6:00 PM</dd>
                    <dt>Sunday</dt>
                    <dd>10:00 AM - 5:00 PM</dd>
                </dl>
            </div>

            <div class="widget">
                <h3 class="widget-title">Quick Links</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="<?php echo site_url('/services'); ?>">Services</a></li>
                    <li><a href="<?php echo site_url('/about'); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url('/contact'); ?>">Contact</a></li>
                </ul>
            </div>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
