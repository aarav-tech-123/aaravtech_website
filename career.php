<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title>Job Openings & Career Opportunities at Aarav Tech Services</title>
    <meta name="description"
        content="Find all the job opportunities here and join one of the best digital marketing agency in india & get excellent opportunities to achieve higher goals. Visit Now!">
    <link rel="canonical" href="https://aaravtech.net/career.php" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        :root {
            --bs-bg-dark: #0B011C;
            --bs-light: #F6F6FA;
            --gradient-bg: linear-gradient(180deg, #05000D 0%, #0B011C 20%, #14072D 45%, #1E0E45 70%, #2C1C6E 100%);
            --accent: #8A2BE2;
            --accent-light: #9D4EDD;
            --gradient-primary: linear-gradient(135deg, #8A2BE2 0%, #6A0DAD 100%);
            --gradient-secondary: linear-gradient(135deg, #1E0E45 0%, #2C1C6E 100%);
            --gradient-card: linear-gradient(145deg, rgba(30, 14, 69, 0.8) 0%, rgba(43, 28, 110, 0.6) 100%);
            --gradient-text: linear-gradient(90deg, #8A2BE2, #9D4EDD, #B66DF0);
            --gradient-pricing: linear-gradient(135deg, rgba(138, 43, 226, 0.1) 0%, rgba(30, 14, 69, 0.2) 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: var(--gradient-bg);
            color: var(--bs-light);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        h1 {
            color: var(--bs-light);
        }

        .breadcrumb-item {
            font-size: .8rem;
        }
        
        /* Header Styles */
        header {
            background: linear-gradient(180deg, rgba(11, 1, 28, 0.95) 0%, rgba(11, 1, 28, 0.8) 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(138, 43, 226, 0.2);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.4s ease;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 28px;
            color: var(--bs-light);
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        
        .logo span {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 32px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: var(--bs-light);
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            padding: 8px 0;
            font-size: 16px;
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-text);
            transition: width 0.3s ease;
        }
        
        nav ul li a:hover::after,
        nav ul li a.active::after {
            width: 100%;
        }
        
        nav ul li a:hover,
        nav ul li a.active {
            color: var(--accent);
        }
        
        .cta-button {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(138, 43, 226, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .cta-button:hover::before {
            left: 100%;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(138, 43, 226, 0.4);
        }
        
        /* Hero Section */
        .hero {
            padding: 180px 0 120px;
            position: relative;
            overflow: hidden;
            background: 
                radial-gradient(circle at 20% 80%, rgba(138, 43, 226, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(30, 14, 69, 0.1) 0%, transparent 50%),
                var(--gradient-bg);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(138, 43, 226, 0.2) 0%, rgba(106, 13, 173, 0.1) 100%);
            color: var(--accent);
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            border: 1px solid rgba(138, 43, 226, 0.3);
            backdrop-filter: blur(10px);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(138, 43, 226, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(138, 43, 226, 0); }
            100% { box-shadow: 0 0 0 0 rgba(138, 43, 226, 0); }
        }
        
        .hero h1 {
            font-size: 60px;
            margin-bottom: 24px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }
        
        .hero h1 .gradient-text {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            background-size: 200% auto;
            animation: textShine 3s linear infinite;
        }
        
        @keyframes textShine {
            to {
                background-position: 200% center;
            }
        }
        
        .hero p {
            font-size: 20px;
            margin: 0 0 40px;
            color: rgba(246, 246, 250, 0.8);
            font-weight: 400;
            text-align:center;
        }
        
        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 16px 38px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(138, 43, 226, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            position: relative;
            overflow: hidden;
            width: fit-content;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(138, 43, 226, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--bs-light);
            border: 2px solid var(--accent);
            padding: 16px 38px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        
        .btn-outline:hover {
            background: rgba(138, 43, 226, 0.1);
            transform: translateY(-3px);
        }
        
        /* Career Section */
        .career-section {
            padding: 120px 0;
            position: relative;
            background: 
                radial-gradient(circle at 0% 0%, rgba(138, 43, 226, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(30, 14, 69, 0.1) 0%, transparent 50%),
                var(--gradient-bg);
        }
        
        .career-intro {
            text-align: center;
            margin-bottom: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .subheading {
            color: var(--accent);
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .career-intro h1 {
            font-size: 42px;
            margin-bottom: 24px;
            font-weight: 700;
            line-height: 1.2;
        }
        
        .career-intro p {
            margin-bottom: 20px;
            color: rgba(246, 246, 250, 0.8);
            font-size: 18px;
            line-height: 1.7;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Job Listings */
        .job-listing-card {
            background: var(--gradient-card);
            border-radius: 20px;
            padding: 40px 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
            z-index: 1;
            backdrop-filter: blur(10px);
            height: 100%;
        }
        
        .job-listing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: transparent;
        }
        
        .job-listing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            opacity: 0;
            transition: opacity 0.4s;
            z-index: -1;
        }
        
        .job-listing-card:hover::before {
            opacity: 0.05;
        }
        
        .job-listing-card h4 {
            font-size: 24px;
            margin-bottom: 16px;
            color: var(--bs-light);
            font-weight: 600;
        }
        
        .job-meta {
            color: var(--accent);
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .job-listing-card p {
            color: rgba(246, 246, 250, 0.7);
            margin-bottom: 25px;
            font-size: 16px;
            line-height: 1.7;
        }
        
        .apply-btn {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(138, 43, 226, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        
        .apply-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .apply-btn:hover::before {
            left: 100%;
        }
        
        .apply-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(138, 43, 226, 0.4);
            color: white;
            text-decoration: none;
        }
        
        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 70px;
        }
        
        .section-title h2 {
            font-size: 48px;
            color: var(--bs-light);
            margin-bottom: 16px;
            font-weight: 700;
        }
        
        .section-title h2 .gradient-text {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: textShine 3s linear infinite;
        }
        
        .section-title p {
            color: rgba(246, 246, 250, 0.7);
            max-width: 700px;
            margin: 0 auto;
            font-size: 18px;
            font-weight: 400;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            background: 
                radial-gradient(circle at 30% 70%, rgba(138, 43, 226, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(30, 14, 69, 0.1) 0%, transparent 50%),
                linear-gradient(135deg, rgba(11, 1, 28, 0.9) 0%, rgba(30, 14, 69, 0.7) 100%);
        }
        
        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .cta-section h1 {
            font-size: 48px;
            margin-bottom: 24px;
            color: var(--bs-light);
            font-weight: 700;
            line-height: 1.2;
        }
        
        .cta-section h1 .highlight {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .cta-section p {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto 40px;
            color: rgba(246, 246, 250, 0.8);
        }
        
        
        /* Responsive Design */
        @media (max-width: 1100px) {
            .hero h1 {
                font-size: 50px;
            }
            
            .section-title h2 {
                font-size: 42px;
            }
            
            .cta-section h1 {
                font-size: 42px;
            }
            

        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                padding: 15px 0;
            }
            
            nav ul {
                margin: 20px 0 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav ul li {
                margin: 8px 12px;
            }
            
            .hero {
                padding: 150px 0 60px;
            }
            
            .hero h1 {
                font-size: 40px;
            }
            
            .hero p {
                font-size: 18px;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary, .btn-outline {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }
            
            .section-title h2 {
                font-size: 36px;
            }
            
            .cta-section h1 {
                font-size: 36px;
            }

        }
        
        @media (max-width: 576px) {
            .hero h1 {
                font-size: 36px;
            }
            
            .section-title h2 {
                font-size: 32px;
            }
            
            .cta-section h1 {
                font-size: 32px;
            }
        }
    </style>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MSPXHW6R');</script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MSPXHW6R" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="container-fluid header position-relative p-0">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light px-lg-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0">
                <img src="img/company_logo_white.svg" alt="" id="toggleImg" style="transition: all ease .8s;">
            </a>
            <button class="navbar-toggler navbar-toggler-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/" class="nav-item nav-link" style="color:var(--bs-white) !important">Home</a>
                    <a href="about.html" class="nav-item nav-link" style="color:var(--bs-white) !important">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color:var(--bs-white) !important">Services</a>
                        <div class="dropdown-menu m-0">
                            <div class="submenu-wrapper">
                                <a href="#" class="dropdown-item submenu-parent">Digital Marketing</a>
                                <div class="submenu">
                                    <a class="dropdown-item" href="seo-company-in-india.html">SEO</a>
                                    <a class="dropdown-item" href="social-media-optimization-services.html">SMO/SMM</a>
                                    <a class="dropdown-item" href="best-ppc-marketing-agency.html">PPC</a>
                                    <a class="dropdown-item" href="content-marketing-services.html">Content Marketing</a>
                                </div>
                            </div>
                            <div class="submenu-wrapper">
                                <a href="#" class="dropdown-item submenu-parent">Web Development</a>
                                <div class="submenu">
                                    <a class="dropdown-item" href="custom-website-development-services.html">Custom Website Development</a>
                                    <a class="dropdown-item" href="ui-ux-design-services.html">UI/UX Design</a>
                                    <a class="dropdown-item" href="web-and-mobile-app-development.html">Web/Mobile App Development</a>
                                </div>
                            </div>
                            <div class="submenu-wrapper">
                                <a href="logo-design-services.html" class="dropdown-item">Logo Design</a>
                            </div>
                            <div class="submenu-wrapper">
                                <a href="#" class="dropdown-item submenu-parent">BPO</a>
                                <div class="submenu">
                                    <a class="dropdown-item" href="back-office-support-services.html">Back Office Support</a>
                                    <a class="dropdown-item" href="call-centre-services.html">Call Centre Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="blogs.php" class="nav-item nav-link" style="color:var(--bs-white) !important">Blogs</a>
                    <a href="career.php" class="nav-item nav-link" style="color:var(--bs-white) !important">Career</a>
                    <a href="contact.html" class="nav-item nav-link" style="color:var(--bs-white) !important">Contact</a>
                </div>
                <a href="tel:" class="glass-btn nav-link-btn" style="margin-right: 2rem; font-size: .8rem; padding:.8rem 1.6rem">Let's Talk</a>
            </div>
        </nav>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container hero-content">
                <div class="hero-badge">
                    <i class="fas fa-rocket"></i> Career Opportunities
                </div>
                <h1>Shape the Future of <span class="gradient-text">Digital with Us</span></h1>
                <p>Work in a highly-paced team environment and develop with a company that embraces innovation, teamwork and career advancement. Our possibilities are amazing and varied in terms of roles where your talents and ideas can be really impactful. We promote an inclusive work culture in Aarav Tech Services LLP to support learning, creativity, and career growth. No matter how experienced you are or whether you are a fresh graduate, you will get a good environment to develop your future. Research our available opportunities and start pursuing a promising career at our company.</p>
                <div class="hero-buttons">
                    <button class="btn-primary">Get Started</button>
                </div>
            </div>
        </section>
    </div>

    <!-- Career Section -->
    <div class="career-section">
        <div class="container">
            <div class="career-intro">
                <p class="subheading">JOIN OUR TEAM</p>
                <h1>Shape the Future of Digital with Us</h1>
                <p>At <strong>Aarav Tech Services LLP</strong>, we believe in fostering a culture of innovation, creativity, and collaboration. We are constantly looking for passionate and talented individuals who are eager to make a meaningful impact. If you're ready to grow your career and work on exciting projects, you've come to the right place.</p>
                <a href="#open-positions" class="btn-primary">View Open Positions</a>
            </div>

            <hr class="my-5" style="border-color: rgba(255, 255, 255, 0.1);">

            <div class="section-title" id="open-positions">
                <h2>Current <span class="gradient-text">Openings</span></h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="job-listing-card">
                        <h4>Senior Digital Marketing Specialist</h4>
                        <p class="job-meta">Full-time | Remote | Experience: 5+ years</p>
                        <p>We're seeking a seasoned digital marketer to lead our client campaigns. The ideal candidate will have extensive experience in SEO, SEM, social media, and content strategy with a proven track record of delivering measurable results.</p>
                        <a href="mailto:careers@aaravtech.net?subject=Application for Senior Digital Marketing Specialist" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="job-listing-card">
                        <h4>Front-End Web Developer</h4>
                        <p class="job-meta">Full-time | On-site | Experience: 2+ years</p>
                        <p>We are looking for a creative and skilled Front-End Developer to join our web team. You will be responsible for building user-friendly and responsive websites, working with technologies like HTML, CSS, JavaScript, and modern frameworks.</p>
                        <a href="mailto:careers@aaravtech.net?subject=Application for Front-End Web Developer" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="job-listing-card">
                        <h4>Graphic Designer</h4>
                        <p class="job-meta">Full-time | Hybrid | Experience: 3+ years</p>
                        <p>Join our design team to create stunning visuals for our clients. We're looking for a designer with a strong portfolio in brand identity, marketing materials, and digital graphics who is proficient in Adobe Creative Suite.</p>
                        <a href="mailto:careers@aaravtech.net?subject=Application for Graphic Designer" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="job-listing-card">
                        <h4>BPO Operations Manager</h4>
                        <p class="job-meta">Full-time | On-site | Experience: 4+ years</p>
                        <p>Lead our BPO team and ensure the smooth operation of all outsourced services. The ideal candidate will have experience in managing teams, optimizing workflows, and maintaining high standards of quality and efficiency.</p>
                        <a href="mailto:careers@aaravtech.net?subject=Application for BPO Operations Manager" class="apply-btn">Apply Now</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="fs-5" style="color: rgba(246, 246, 250, 0.8);">Didn't find a suitable position? Feel free to send your resume to <a href="mailto:careers@aaravtech.net" style="color: var(--accent); font-weight: bold;">hr@aaravtech.net</a>. We are always on the lookout for great talent!</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Let's Create Something Amazing Together</h2>
                <p>Ready to transform your digital presence? Let's discuss how our expertise can help your business
                    thrive in the digital landscape.</p>
                <div class="hero-buttons">
                    <a href="contact.html" class="btn-primary">Request a Quote <i class="fas fa-paper-plane"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-shape">
        </div>

        <div class="container-fluid footer-container" style="padding: 0 2rem;">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-logo">
                        <!-- SVG Logo -->
                        <!-- <svg width="50" height="50" viewBox="0 0 50 50">
                            <defs>
                                <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#4dabf7" />
                                    <stop offset="100%" stop-color="#1a2a6c" />
                                </linearGradient>
                            </defs>
                            <rect x="5" y="5" width="40" height="40" rx="8" fill="url(#logoGradient)" />
                            <path d="M15,15 L35,15 L35,35 L15,35 Z" fill="none" stroke="white" stroke-width="2" />
                            <circle cx="25" cy="25" r="8" fill="none" stroke="white" stroke-width="2" />
                            <path d="M20,20 L30,30 M30,20 L20,30" stroke="white" stroke-width="2" />
                        </svg> -->
                        <div class="footer-logo-text">AaravTechServices</div>
                    </div>
                    <p>We provide cutting-edge technology solutions to help businesses thrive in the digital age. Our team of experts delivers innovative software and consulting services.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/AaravTechServicesLLP/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/aaravtech_services/"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.linkedin.com/company/aarav-tech-services/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="/"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="about.html"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="blogs.php"><i class="fas fa-chevron-right"></i> Blogs</a></li>
                        <li><a href="career.php"><i class="fas fa-chevron-right"></i>Career</a></li>
                        <li><a href="contact.html"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Our Services</h3>
                    <ul class="footer-links">
                        <li><a href="custom-website-development-services.html"><i class="fas fa-chevron-right"></i> Web Development</a></li>
                        <li><a href="web-and-mobile-app-development.html"><i class="fas fa-chevron-right"></i> Mobile Apps</a></li>
                        <li><a href="graphic-designing.html"><i class="fas fa-chevron-right"></i>Graphic Designing</a></li>
                        <li><a href="digital-marketing.html"><i class="fas fa-chevron-right"></i> Digital Marketing</a></li>
                        <li><a href="ui-ux-design-services.html"><i class="fas fa-chevron-right"></i> UI/UX Design</a></li>
                        <li><a href="bpo.html"><i class="fas fa-chevron-right"></i>BPO Services</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Kanpur Nagar, Uttar Pradesh, India</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+91 7318083502</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>support@aaravtech.net</span>
                        </li>
                    </ul>
                    
                    <h4 style="margin-top: 20px; margin-bottom: 10px;">Newsletter</h4>
                    <p style="font-size: 0.9rem;">Subscribe to our newsletter for the latest updates.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p style="margin-bottom:0;">&copy; 2023 AaravTech. All Rights Reserved.</p>
                <p style="margin-bottom:0;">|</p>
                <div class="footer-bottom-links">
                    <a href="privacy-policy.html">Privacy Policy</a>
                    <a href="terms-and-conditions.html">Terms of Service</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="js/main.js"></script>
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>