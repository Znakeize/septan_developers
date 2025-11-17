<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('partials.animations-init')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #000; color: #fff; overflow-x: hidden; scroll-behavior: smooth; }
        nav { position: fixed; top: 0; width: 100%; background: rgba(0, 0, 0, 0.95); backdrop-filter: blur(10px); padding: 1rem 2rem; z-index: 1000; border-bottom: 1px solid #333; }
        .nav-container { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .logo a { display:inline-flex; align-items:center; gap:10px; text-decoration:none; }
        .logo img { height:32px; display:block; }
        .logo span { font-weight:900; letter-spacing:2px; color:#dc2626; }
        .back-link { color:#fff; text-decoration:none; font-weight:600; text-transform:uppercase; font-size:0.9rem; letter-spacing:1px; transition: color .3s ease; }
        .back-link:hover { color:#dc2626; }
        .hero-header { height: 40vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(0, 0, 0, 0.9) 100%); position: relative; margin-top: 60px; border-bottom: 2px solid #dc2626; }
        .hero-header::before { content:''; position:absolute; inset:0; background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" fill="rgba(220,38,38,0.05)"/></svg>'); opacity:.3; }
        .hero-header h1 { font-size: 4rem; font-weight:900; letter-spacing:8px; text-transform:uppercase; position:relative; z-index:1; }
        .hero-header h1 span { color:#dc2626; }
        .content-section { max-width: 1200px; margin: 0 auto; padding: 80px 20px; }
        .intro-text { font-size:1.2rem; line-height:2; color:#ccc; margin-bottom:60px; text-align:center; padding:0 20px; }
        .terms-block { background:#111; border-left:5px solid #dc2626; padding:40px; margin-bottom:40px; transition: all .3s ease; }
        .terms-block:hover { background: rgba(220, 38, 38, 0.05); transform: translateX(10px); }
        .terms-block h2 { font-size:2rem; color:#dc2626; margin-bottom:20px; text-transform:uppercase; letter-spacing:3px; }
        .terms-block h3 { font-size:1.4rem; color:#fff; margin:25px 0 15px 0; font-weight:700; }
        .terms-block p { font-size:1.1rem; line-height:1.8; color:#ccc; margin-bottom:15px; }
        .terms-block ul { margin:20px 0 20px 30px; color:#ccc; }
        .terms-block ul li { font-size:1.1rem; line-height:1.8; margin-bottom:10px; }
        .highlight-box { background: rgba(220, 38, 38, 0.1); border:1px solid #dc2626; padding:20px; margin:20px 0; border-radius:4px; }
        .highlight-box p { margin:0; color:#fff; }
        .last-updated { text-align:center; color:#666; font-style:italic; margin-top:60px; font-size:.9rem; }
        footer { background:#000; padding:40px 20px; border-top: 1px solid #222; text-align:center; }
        .footer-links { margin-bottom:20px; }
        .footer-links a { color:#999; text-decoration:none; margin:0 15px; text-transform:uppercase; font-size:.9rem; letter-spacing:1px; }
        .footer-links a:hover { color:#dc2626; }
        .copyright { color:#666; font-size:.9rem; }
        @media (max-width: 768px) {
            .hero-header h1 { font-size: 2rem; letter-spacing: 3px; }
            .terms-block { padding:25px; }
            .terms-block h2 { font-size:1.5rem; }
        }
    </style>
    @include('partials.animations-init')
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
        <h1>TERMS OF <span>SERVICE</span></h1>
    </div>

    <div class="content-section">
        <p class="intro-text">
            Welcome to Septan Developers (Pvt) Ltd. By accessing or using our services, you agree to be bound by these Terms of Service. Please read them carefully before engaging with our architectural and construction design services.
        </p>

        <div class="terms-block">
            <h2>1. Acceptance of Terms</h2>
            <p>
                By engaging Septan Developers (Pvt) Ltd for any services including architectural design, structural engineering, Building Information Modeling (BIM), interior design, 3D rendering, estimation, consultation, or project management, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
            </p>
            <p>
                These terms constitute a legally binding agreement between you (the "Client") and Septan Developers (Pvt) Ltd (the "Company"). If you do not agree with any part of these terms, you must not use our services.
            </p>
        </div>

        <div class="terms-block">
            <h2>2. Services Provided</h2>
            <h3>2.1 Scope of Services</h3>
            <p>Septan Developers offers the following professional services:</p>
            <ul>
                <li><strong>Architectural Design:</strong> Conceptual and detailed architectural planning and design</li>
                <li><strong>Structural Design:</strong> Engineering solutions for safe and durable structures</li>
                <li><strong>Building Information Modeling (BIM):</strong> 3D modeling and project coordination</li>
                <li><strong>Interior Design:</strong> Functional and aesthetic interior space planning</li>
                <li><strong>3D Rendering & Visualization:</strong> High-quality visual representations of designs</li>
                <li><strong>Estimation & Consultation:</strong> Cost analysis and expert advisory services</li>
                <li><strong>Project Management:</strong> Oversight and coordination from planning to completion</li>
            </ul>

            <h3>2.2 Service Customization</h3>
            <p>
                Each project is unique and will be customized based on client requirements, site conditions, and applicable regulations. Specific deliverables, timelines, and fees will be outlined in individual project proposals and contracts.
            </p>
        </div>

        <div class="terms-block">
            <h2>3. Client Obligations</h2>
            <h3>3.1 Information Provision</h3>
            <p>Clients must provide:</p>
            <ul>
                <li>Accurate and complete project requirements and specifications</li>
                <li>All necessary site information, surveys, and existing documentation</li>
                <li>Timely feedback and approvals at designated project milestones</li>
                <li>Access to project sites as required for surveys and inspections</li>
            </ul>

            <h3>3.2 Decision Making</h3>
            <p>
                Clients are responsible for making timely decisions on design options, material selections, and other project-related matters. Delays caused by client indecision may result in project timeline extensions and additional fees.
            </p>
        </div>

        <div class="terms-block">
            <h2>4. Payment Terms</h2>
            <h3>4.1 Fee Structure</h3>
            <p>
                Professional fees are determined based on project scope, complexity, and estimated work hours. Fee structures may include fixed fees, hourly rates, or percentage of construction costs as specified in individual contracts.
            </p>

            <h3>4.2 Payment Schedule</h3>
            <p>Standard payment terms include:</p>
            <ul>
                <li>Initial deposit upon contract signing (typically 30-50% of total fee)</li>
                <li>Progress payments at specified project milestones</li>
                <li>Final payment upon project completion and delivery of final documents</li>
            </ul>

            <h3>4.3 Late Payments</h3>
            <p>
                Invoices are due within 14 days of issuance unless otherwise specified. Late payments may incur interest charges of 1.5% per month and may result in suspension of services until accounts are brought current.
            </p>

            <div class="highlight-box">
                <p><strong>Important:</strong> Work will not commence until the initial deposit is received, and project files will not be released until all outstanding payments are settled.</p>
            </div>
        </div>

        <div class="terms-block">
            <h2>5. Intellectual Property Rights</h2>
            <h3>5.1 Ownership of Designs</h3>
            <p>
                All designs, drawings, models, renderings, and other creative works produced by Septan Developers remain the intellectual property of the Company until full payment is received. Upon full payment, clients receive a license to use the designs for the specific project purpose.
            </p>

            <h3>5.2 Usage Rights</h3>
            <p>
                Clients may not reproduce, modify, or use designs for purposes other than the agreed project without written permission from Septan Developers. Unauthorized use or reproduction may result in legal action and additional fees.
            </p>

            <h3>5.3 Portfolio Use</h3>
            <p>
                Septan Developers reserves the right to use completed projects in promotional materials, portfolios, and marketing efforts unless specifically prohibited by client agreement.
            </p>
        </div>

        <div class="terms-block">
            <h2>6. Project Timeline & Revisions</h2>
            <h3>6.1 Timeline Estimates</h3>
            <p>
                Project timelines are estimates based on scope and complexity. Actual completion dates may vary due to factors including client feedback delays, regulatory approvals, unforeseen site conditions, or force majeure events.
            </p>

            <h3>6.2 Revision Policy</h3>
            <p>
                Each project phase includes a specified number of revision rounds as outlined in the contract. Additional revisions beyond the agreed scope will be charged at the prevailing hourly rate or as negotiated.
            </p>

            <h3>6.3 Scope Changes</h3>
            <p>
                Significant changes to project scope after work has commenced will require a revised contract with adjusted fees and timelines. All scope changes must be approved in writing by both parties.
            </p>
        </div>

        <div class="terms-block">
            <h2>7. Liability & Warranties</h2>
            <h3>7.1 Professional Standards</h3>
            <p>
                Septan Developers commits to providing services in accordance with professional industry standards and applicable building codes and regulations. However, we do not guarantee specific outcomes or approvals from regulatory authorities.
            </p>

            <h3>7.2 Limitation of Liability</h3>
            <p>
                Our liability for any claims arising from our services is limited to the total fees paid for the specific project. We are not liable for indirect, consequential, or incidental damages including but not limited to lost profits or project delays.
            </p>

            <h3>7.3 Third-Party Services</h3>
            <p>
                We are not responsible for work performed by contractors, builders, or other third parties based on our designs. Clients are responsible for ensuring proper implementation and construction supervision.
            </p>

            <div class="highlight-box">
                <p><strong>Disclaimer:</strong> While we strive for accuracy in all estimates and projections, actual construction costs may vary based on market conditions, material availability, and contractor pricing.</p>
            </div>
        </div>

        <div class="terms-block">
            <h2>8. Confidentiality</h2>
            <p>
                Septan Developers will maintain confidentiality of all client information, project details, and proprietary data. We will not disclose such information to third parties without client consent, except as required by law or for necessary project consultations with approved professionals.
            </p>
            <p>
                Clients similarly agree to maintain confidentiality regarding our proprietary methods, pricing structures, and business practices.
            </p>
        </div>

        <div class="terms-block">
            <h2>9. Termination</h2>
            <h3>9.1 Termination by Client</h3>
            <p>
                Clients may terminate services at any time with written notice. Upon termination, clients are responsible for payment of all work completed to date plus any non-refundable expenses incurred.
            </p>

            <h3>9.2 Termination by Company</h3>
            <p>
                Septan Developers may terminate services if:
            </p>
            <ul>
                <li>Client fails to make payments as agreed</li>
                <li>Client fails to provide necessary information or approvals</li>
                <li>Project scope changes make continuation unfeasible</li>
                <li>Client breaches these Terms of Service</li>
            </ul>

            <h3>9.3 Effects of Termination</h3>
            <p>
                Upon termination, all work products remain the property of Septan Developers until final payment is received. Clients may request copies of work completed to date upon settlement of all outstanding fees.
            </p>
        </div>

        <div class="terms-block">
            <h2>10. Dispute Resolution</h2>
            <h3>10.1 Negotiation</h3>
            <p>
                In the event of any dispute, both parties agree to first attempt resolution through good-faith negotiations.
            </p>

            <h3>10.2 Mediation</h3>
            <p>
                If negotiation fails, disputes will be submitted to mediation before pursuing legal action. Both parties agree to participate in mediation in good faith.
            </p>

            <h3>10.3 Governing Law</h3>
            <p>
                These Terms of Service are governed by the laws of Sri Lanka. Any legal proceedings shall be conducted in the appropriate courts of Sri Lanka.
            </p>
        </div>

        <div class="terms-block">
            <h2>11. Force Majeure</h2>
            <p>
                Neither party shall be liable for delays or failure to perform obligations due to circumstances beyond reasonable control, including but not limited to natural disasters, government actions, pandemics, strikes, or material shortages.
            </p>
        </div>

        <div class="terms-block">
            <h2>12. Amendments</h2>
            <p>
                Septan Developers reserves the right to modify these Terms of Service at any time. Updated terms will be posted on our website with the revision date. Continued use of our services after changes constitutes acceptance of modified terms.
            </p>
            <p>
                Individual project contracts may contain additional terms specific to that project, which will supersede these general terms where applicable.
            </p>
        </div>

        <div class="terms-block">
            <h2>13. Contact Information</h2>
            <p>
                For questions regarding these Terms of Service or any of our services, please contact us:
            </p>
            <p>
                <strong>Septan Developers (Pvt) Ltd</strong><br>
                Ambalangoda, Sri Lanka<br>
                Phone: +94 76 3132675<br>
                Email: septandevelopers@gmail.com
            </p>
        </div>

        <p class="last-updated">
            Last Updated: November 11, 2025
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
                &copy; 2025 Septan Developers. All rights reserved. <br><span style="font-weight:900;letter-spacing:2px;color:#dc2626;">SEPTAN</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @include('partials.animations-script')
    @include('partials.chatbot')
</body>
</html>


