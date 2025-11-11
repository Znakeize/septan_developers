<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('partials.animations-init')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Arial', sans-serif; background:#000; color:#fff; overflow-x:hidden; scroll-behavior:smooth; }
        nav { position: fixed; top: 0; width: 100%; background: rgba(0, 0, 0, 0.95); backdrop-filter: blur(10px); padding: 1rem 2rem; z-index: 1000; border-bottom: 1px solid #333; }
        .nav-container { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .logo a { display:inline-flex; align-items:center; gap:10px; text-decoration:none; }
        .logo img { height:32px; display:block; }
        .logo span { font-weight:900; letter-spacing:2px; color:#dc2626; }
        .back-link { color:#fff; text-decoration:none; font-weight:600; text-transform:uppercase; font-size:0.9rem; letter-spacing:1px; transition: color .3s ease; }
        .back-link:hover { color:#dc2626; }
        .hero-header { height:40vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(0, 0, 0, 0.9) 100%); position:relative; margin-top:60px; border-bottom:2px solid #dc2626; }
        .hero-header::before { content:''; position:absolute; inset:0; background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" fill="rgba(220,38,38,0.05)"/></svg>'); opacity:.3; }
        .hero-header h1 { font-size:4rem; font-weight:900; letter-spacing:8px; text-transform:uppercase; position:relative; z-index:1; }
        .hero-header h1 span { color:#dc2626; }
        .content-section { max-width: 1200px; margin: 0 auto; padding: 80px 20px; }
        .intro-text { font-size:1.2rem; line-height:2; color:#ccc; margin-bottom:60px; text-align:center; padding:0 20px; }
        .privacy-block { background:#111; border-left:5px solid #dc2626; padding:40px; margin-bottom:40px; transition: all .3s ease; }
        .privacy-block:hover { background: rgba(220, 38, 38, 0.05); transform: translateX(10px); }
        .privacy-block h2 { font-size:2rem; color:#dc2626; margin-bottom:20px; text-transform:uppercase; letter-spacing:3px; }
        .privacy-block h3 { font-size:1.4rem; color:#fff; margin:25px 0 15px 0; font-weight:700; }
        .privacy-block p { font-size:1.1rem; line-height:1.8; color:#ccc; margin-bottom:15px; }
        .privacy-block ul { margin:20px 0 20px 30px; color:#ccc; }
        .privacy-block ul li { font-size:1.1rem; line-height:1.8; margin-bottom:10px; }
        .highlight-box { background: rgba(220, 38, 38, 0.1); border:1px solid #dc2626; padding:20px; margin:20px 0; border-radius:4px; }
        .highlight-box p { margin:0; color:#fff; }
        .data-table { width:100%; border-collapse: collapse; margin:20px 0; background: rgba(0, 0, 0, 0.5); }
        .data-table th, .data-table td { border:1px solid #333; padding:15px; text-align:left; }
        .data-table th { background: rgba(220, 38, 38, 0.2); color:#dc2626; font-weight:700; text-transform:uppercase; letter-spacing:1px; }
        .data-table td { color:#ccc; }
        .last-updated { text-align:center; color:#666; font-style:italic; margin-top:60px; font-size:.9rem; }
        footer { background:#000; padding:40px 20px; border-top:1px solid #222; text-align:center; }
        .footer-links { margin-bottom:20px; }
        .footer-links a { color:#999; text-decoration:none; margin:0 15px; text-transform:uppercase; font-size:.9rem; letter-spacing:1px; }
        .footer-links a:hover { color:#dc2626; }
        .copyright { color:#666; font-size:.9rem; }
        @media (max-width: 768px) {
            .hero-header h1 { font-size:2rem; letter-spacing:3px; }
            .privacy-block { padding:25px; }
            .privacy-block h2 { font-size:1.5rem; }
            .data-table { font-size:.9rem; }
            .data-table th, .data-table td { padding:10px; }
        }
    </style>
</head>
<body>
    @include('partials.page-loader')
    <nav>
        <div class="nav-container">
            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan"><span>SEPTAN</span></a></div>
            <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>
        </div>
    </nav>

    <div class="hero-header">
        <h1>PRIVACY <span>POLICY</span></h1>
    </div>

    <div class="content-section">
        <p class="intro-text">
            At Septan Developers (Pvt) Ltd, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, store, and protect your data when you interact with our services.
        </p>

        <div class="privacy-block">
            <h2>1. Introduction</h2>
            <p>
                Septan Developers (Pvt) Ltd ("we," "us," "our") respects your privacy and is committed to protecting your personal data. This privacy policy will inform you about how we handle your personal data, your privacy rights, and how the law protects you.
            </p>
            <p>
                This policy applies to all services provided by Septan Developers, including architectural design, structural engineering, BIM services, interior design, 3D rendering, estimation, consultation, and project management.
            </p>
            <div class="highlight-box">
                <p><strong>Important:</strong> Please read this privacy policy carefully to understand our views and practices regarding your personal data and how we will treat it.</p>
            </div>
        </div>

        <div class="privacy-block">
            <h2>2. Information We Collect</h2>
            <h3>2.1 Personal Identification Information</h3>
            <p>We may collect the following types of personal information:</p>
            <ul>
                <li><strong>Contact Details:</strong> Name, email address, phone number, physical address</li>
                <li><strong>Business Information:</strong> Company name, position, business address</li>
                <li><strong>Project Information:</strong> Property details, site locations, project requirements</li>
                <li><strong>Financial Information:</strong> Billing address, payment details (processed securely through third-party payment processors)</li>
                <li><strong>Communication Records:</strong> Emails, phone call notes, meeting records</li>
                <li><strong>Technical Data:</strong> IP address, browser type, device information when you visit our website</li>
            </ul>

            <h3>2.2 How We Collect Information</h3>
            <p>We collect information through:</p>
            <ul>
                <li>Direct interactions: When you contact us, request services, or submit forms</li>
                <li>Website interactions: Through cookies and analytics when you browse our website</li>
                <li>Third parties: From contractors, partners, or public sources relevant to projects</li>
                <li>Site visits: Information gathered during property surveys and consultations</li>
            </ul>

            <h3>2.3 Information We Do NOT Collect</h3>
            <p>We do not knowingly collect:</p>
            <ul>
                <li>Information from children under 18 years of age</li>
                <li>Sensitive personal data unless specifically required for project purposes</li>
                <li>Unnecessary information beyond what is needed for our services</li>
            </ul>
        </div>

        <div class="privacy-block">
            <h2>3. How We Use Your Information</h2>
            <p>We use your personal information for the following purposes:</p>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Purpose</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Service Delivery</strong></td>
                        <td>To provide architectural, engineering, and design services as contracted</td>
                    </tr>
                    <tr>
                        <td><strong>Communication</strong></td>
                        <td>To respond to inquiries, provide updates, and discuss project details</td>
                    </tr>
                    <tr>
                        <td><strong>Contract Management</strong></td>
                        <td>To process agreements, manage projects, and handle payments</td>
                    </tr>
                    <tr>
                        <td><strong>Legal Compliance</strong></td>
                        <td>To comply with legal obligations and regulatory requirements</td>
                    </tr>
                    <tr>
                        <td><strong>Marketing</strong></td>
                        <td>To send newsletters and promotional materials (with your consent)</td>
                    </tr>
                    <tr>
                        <td><strong>Improvement</strong></td>
                        <td>To analyze and improve our services, website, and customer experience</td>
                    </tr>
                </tbody>
            </table>

            <h3>3.1 Legal Basis for Processing</h3>
            <p>We process your personal data based on:</p>
            <ul>
                <li><strong>Contract Performance:</strong> To fulfill our contractual obligations to you</li>
                <li><strong>Legitimate Interest:</strong> To operate our business and provide quality services</li>
                <li><strong>Legal Obligation:</strong> To comply with laws and regulations</li>
                <li><strong>Consent:</strong> Where you have given explicit consent for specific purposes</li>
            </ul>
        </div>

        <div class="privacy-block">
            <h2>4. Data Sharing and Disclosure</h2>
            <h3>4.1 Who We Share Data With</h3>
            <p>We may share your information with:</p>
            <ul>
                <li><strong>Project Consultants:</strong> Engineers, surveyors, and specialists working on your project</li>
                <li><strong>Contractors & Suppliers:</strong> For implementation of designs (with your consent)</li>
                <li><strong>Regulatory Authorities:</strong> When required for permits and approvals</li>
                <li><strong>Payment Processors:</strong> For secure transaction processing</li>
                <li><strong>IT Service Providers:</strong> For hosting, maintenance, and technical support</li>
                <li><strong>Legal Advisors:</strong> When necessary for legal compliance or protection of rights</li>
            </ul>

            <h3>4.2 When We Share Data</h3>
            <p>We only share data when:</p>
            <ul>
                <li>You have provided consent</li>
                <li>It is necessary for service delivery</li>
                <li>Required by law or regulatory authorities</li>
                <li>Essential for protecting legal rights or safety</li>
            </ul>

            <h3>4.3 International Transfers</h3>
            <p>
                While we primarily operate in Sri Lanka, some project collaborations may involve international data transfers. We ensure appropriate safeguards are in place for any cross-border data transfers.
            </p>

            <div class="highlight-box">
                <p><strong>No Data Selling:</strong> We never sell, rent, or trade your personal information to third parties for marketing purposes.</p>
            </div>
        </div>

        <div class="privacy-block">
            <h2>5. Data Security</h2>
            <h3>5.1 Security Measures</h3>
            <p>We implement robust security measures to protect your data:</p>
            <ul>
                <li><strong>Encryption:</strong> Data transmission is secured using SSL/TLS encryption</li>
                <li><strong>Access Controls:</strong> Limited access to authorized personnel only</li>
                <li><strong>Secure Storage:</strong> Data stored on secure servers with regular backups</li>
                <li><strong>Password Protection:</strong> Strong password policies and multi-factor authentication</li>
                <li><strong>Regular Audits:</strong> Periodic security assessments and updates</li>
                <li><strong>Employee Training:</strong> Staff trained on data protection and privacy practices</li>
            </ul>

            <h3>5.2 Data Breach Response</h3>
            <p>
                In the unlikely event of a data breach affecting your personal information, we will notify you promptly and take immediate action to contain the breach, assess the impact, and prevent future occurrences.
            </p>
        </div>

        <div class="privacy-block">
            <h2>6. Data Retention</h2>
            <p>We retain your personal data only as long as necessary for the purposes outlined in this policy:</p>
            <ul>
                <li><strong>Active Projects:</strong> Throughout project duration and for legal/warranty periods</li>
                <li><strong>Completed Projects:</strong> 7-10 years for legal, tax, and professional liability purposes</li>
                <li><strong>Marketing Data:</strong> Until you unsubscribe or request deletion</li>
                <li><strong>Website Analytics:</strong> Typically 26 months</li>
                <li><strong>Legal Requirements:</strong> As mandated by applicable laws and regulations</li>
            </ul>
            <p>
                After retention periods expire, we securely delete or anonymize your data. Project files and designs may be retained longer for portfolio and reference purposes with identifying information removed.
            </p>
        </div>

        <div class="privacy-block">
            <h2>7. Your Privacy Rights</h2>
            <p>You have the following rights regarding your personal data:</p>
            
            <h3>7.1 Right to Access</h3>
            <p>You can request a copy of the personal data we hold about you.</p>

            <h3>7.2 Right to Correction</h3>
            <p>You can request correction of inaccurate or incomplete personal data.</p>

            <h3>7.3 Right to Deletion</h3>
            <p>You can request deletion of your personal data, subject to legal retention requirements.</p>

            <h3>7.4 Right to Object</h3>
            <p>You can object to processing of your personal data for marketing or other purposes.</p>

            <h3>7.5 Right to Restrict Processing</h3>
            <p>You can request limitation of how we use your personal data.</p>

            <h3>7.6 Right to Data Portability</h3>
            <p>You can request transfer of your data to another service provider where technically feasible.</p>

            <h3>7.7 Right to Withdraw Consent</h3>
            <p>Where processing is based on consent, you can withdraw it at any time.</p>

            <h3>7.8 Exercising Your Rights</h3>
            <p>To exercise any of these rights, please contact us at:</p>
            <p>
                <strong>Email:</strong> septandevelopers@gmail.com<br>
                <strong>Phone:</strong> +94 76 3132675
            </p>
            <p>We will respond to your request within 30 days.</p>
        </div>

        <div class="privacy-block">
            <h2>8. Cookies and Website Analytics</h2>
            <h3>8.1 What Are Cookies</h3>
            <p>
                Cookies are small text files placed on your device when you visit our website. They help us understand how you use our site and improve your experience.
            </p>

            <h3>8.2 Types of Cookies We Use</h3>
            <ul>
                <li><strong>Essential Cookies:</strong> Necessary for website functionality</li>
                <li><strong>Analytics Cookies:</strong> Help us understand visitor behavior and improve our site</li>
                <li><strong>Functional Cookies:</strong> Remember your preferences and settings</li>
                <li><strong>Marketing Cookies:</strong> Track effectiveness of our marketing campaigns (with consent)</li>
            </ul>

            <h3>8.3 Managing Cookies</h3>
            <p>
                You can control and delete cookies through your browser settings. Note that disabling cookies may affect website functionality. Visit your browser's help section for instructions on managing cookies.
            </p>
        </div>

        <div class="privacy-block">
            <h2>9. Third-Party Links and Services</h2>
            <p>
                Our website may contain links to third-party websites, social media platforms, or services. We are not responsible for the privacy practices of these external sites. We encourage you to review their privacy policies before providing any personal information.
            </p>
            <p>Third-party services we may use include:</p>
            <ul>
                <li>Google Maps for location services</li>
                <li>Social media platforms (Facebook, Instagram, LinkedIn, TikTok, YouTube)</li>
                <li>Payment processing services</li>
                <li>Email marketing platforms</li>
            </ul>
        </div>

        <div class="privacy-block">
            <h2>10. Marketing Communications</h2>
            <h3>10.1 Opt-In</h3>
            <p>
                We will only send you marketing communications if you have opted in to receive them or if we have a legitimate interest to do so (e.g., following up on a service inquiry).
            </p>

            <h3>10.2 Content</h3>
            <p>Marketing communications may include:</p>
            <ul>
                <li>Service updates and new offerings</li>
                <li>Project showcases and portfolio updates</li>
                <li>Industry news and design trends</li>
                <li>Special promotions and events</li>
            </ul>

            <h3>10.3 Opt-Out</h3>
            <p>
                You can unsubscribe from marketing communications at any time by:
            </p>
            <ul>
                <li>Clicking the "unsubscribe" link in any email</li>
                <li>Contacting us directly at septandevelopers@gmail.com</li>
                <li>Updating your communication preferences in your account</li>
            </ul>
            <p>Note: You will still receive essential service-related communications even after opting out of marketing.</p>
        </div>

        <div class="privacy-block">
            <h2>11. Children's Privacy</h2>
            <p>
                Our services are not directed at children under 18 years of age. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with personal information, please contact us immediately so we can delete it.
            </p>
        </div>

        <div class="privacy-block">
            <h2>12. Changes to This Privacy Policy</h2>
            <p>
                We may update this privacy policy from time to time to reflect changes in our practices, technology, legal requirements, or other factors. We will notify you of any material changes by:
            </p>
            <ul>
                <li>Posting the updated policy on our website with a new "Last Updated" date</li>
                <li>Sending an email notification to registered clients</li>
                <li>Displaying a notice on our website</li>
            </ul>
            <p>
                We encourage you to review this policy periodically. Your continued use of our services after changes indicates acceptance of the updated policy.
            </p>
        </div>

        <div class="privacy-block">
            <h2>13. Contact Us</h2>
            <p>
                If you have any questions, concerns, or requests regarding this privacy policy or our data practices, please contact us:
            </p>
            <p>
                <strong>Septan Developers (Pvt) Ltd</strong><br>
                Ambalangoda, Sri Lanka
            </p>
            <p>
                <strong>Phone:</strong> +94 76 3132675<br>
                <strong>Email:</strong> septandevelopers@gmail.com
            </p>
            <p>
                <strong>Data Protection Officer:</strong> For specific data protection inquiries, you may request to speak with our designated Data Protection Officer.
            </p>

            <h3>Response Time</h3>
            <p>
                We aim to respond to all privacy-related inquiries within 48 hours for general questions and within 30 days for formal data access requests.
            </p>
        </div>

        <div class="privacy-block">
            <h2>14. Complaints and Regulatory Authority</h2>
            <p>
                If you believe we have not handled your personal data properly, you have the right to lodge a complaint with us first. We will investigate and respond to your complaint promptly.
            </p>
            <p>
                If you are not satisfied with our response, you may also have the right to lodge a complaint with the relevant data protection authority in Sri Lanka or your jurisdiction.
            </p>
        </div>

        <p class="last-updated">
            Last Updated: November 11, 2025<br>
            Effective Date: November 11, 2025
        </p>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-social">
                <a href="https://facebook.com/SeptanDevelopers" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/septan_developers" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com/company/septan-developers-pvt-ltd" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://tiktok.com/@septandevelopers" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://youtube.com/@SeptanDevelopers" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="footer-links">
                <a href="{{ route('legal.terms') }}">Terms</a>
                <a href="{{ route('legal.privacy') }}">Privacy</a>
            </div>
            <div class="copyright">
                &copy; 2025 Septan Developers. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @include('partials.animations-script')
    @include('partials.chatbot')
</body>
</html>


