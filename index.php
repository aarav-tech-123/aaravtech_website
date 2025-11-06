<?php
// ✅ Enable debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Connect to local XAMPP MySQL database
$servername = "185.224.138.7";
$username = "u868210921_OWGYP";
$password = "pQTZ0sfkdM";
$dbname = "u868210921_RXjAJ"; // ⚠️ Change this to your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Fetch published blog posts
$sql = "SELECT ID, post_title, post_content, post_date, post_author,post_name
        FROM wp_posts
        WHERE post_type='post' AND post_status='publish'
        ORDER BY post_date DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("❌ SQL Error: " . $conn->error);
}

// // Create an array to store data
// $data = [];

// if ($result && $result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// }

// // Convert to JSON
// $jsonData = json_encode($data);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="img/favicon.png">
    <meta name="robots" content="index, follow">
    <title>Hire Best Digital Marketing Agency in India to Grow Fast!</title>
    <meta name="description"
        content="Aarav Tech Services is a top digital marketing agency in India. We offer SEO, PPC & social media to boost online visibility & ROI. Contact us today for result-driven success!">
    <!-- Open Graph Meta Tags for Aarav Tech -->
    <meta property="og:title" content="#1 Best Digital Marketing Agency India | Contact Us Now" />
    <meta property="og:description"
        content="Looking for fast, reliable digital growth? Choose Aarav Tech Services India’s best digital marketing agency to scale your brand with proven SEO & ad campaigns." />
    <meta property="og:image" content="https://aaravtech.net/img/company_logo.png" />
    <meta property="og:url" content="https://aaravtech.net/" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Aarav Tech Services LLP" />

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="#1 Best Digital Marketing Agency India | Contact Us Now" />
    <meta name="twitter:description"
        content="Looking for fast, reliable digital growth? Choose Aarav Tech Services India’s best digital marketing agency to scale your brand with proven SEO & ad campaigns." />
    <meta name="twitter:image" content="https://aaravtech.net/img/company_logo.png" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
    <!-- Google Fonts -->

    <link rel="canonical" href="https://aaravtech.net" />
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
    <!-- Google Font -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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

    <style>
        .header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* dark overlay for readability */
            z-index: 0;
        }

        .hero-section,
        .navbar,
        .stats-section {
            position: relative;
            z-index: 1;
        }
        .navbar-container.scrolled {
            background: #00000065;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MSPXHW6R" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <div class="navbar-container" style="  transition: all 0.4s ease-in-out;">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light px-lg-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0">
                <img src="img/company_logo_white.svg" alt="" id="toggleImg" style="transition: all ease .8s;" >
            </a>
            <button class="navbar-toggler navbar-toggler-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/" class="nav-item nav-link " style="color:var(--bs-white) !important" >Home</a>
                    <a href="about.html" class="nav-item nav-link navlink-white" style="color:var(--bs-white) !important" >About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color:var(--bs-white) !important" >Services</a>
                        <div class="dropdown-menu m-0">
                            <div class="submenu-wrapper">
                                <a href="#" class="dropdown-item submenu-parent">Digital Marketing</a>
                                <div class="submenu ">
                                    <a class="dropdown-item " href="seo-company-in-india.html">SEO</a>
                                    <a class="dropdown-item" href="social-media-optimization-services.html">SMO/SMM</a>
                                    <a class="dropdown-item" href="best-ppc-marketing-agency.html">PPC</a>
                                    <a class="dropdown-item" href="content-marketing-services.html">Content Marketing</a>
                                </div>
                            </div>
                            <div class="submenu-wrapper">
                                <a href="#" class="dropdown-item submenu-parent">Web Development</a>
                                <div class="submenu ">
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
                                <div class="submenu ">
                                    <a class="dropdown-item" href="back-office-support-services.html">Back Office Support</a>
                                    <a class="dropdown-item" href="call-centre-services.html">Call Centre Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="blogs.php" class="nav-item nav-link " style="color:var(--bs-white) !important" >Blogs</a>
                    <a href="career.php" class="nav-item nav-link" style="color:var(--bs-white) !important" >Career</a>
                    <a href="contact.html" class="nav-item nav-link" style="color:var(--bs-white) !important" >Contact</a>
                </div>
                <a href="tel:" class="glass-btn nav-link-btn" style="margin-right: 2rem; font-size: .8rem; padding:.8rem 1.6rem">Let's Talk</a>            </div>
        </nav>

    </div>

    <div class="container-fluid header position-relative  p-0 hero-section" style="margin-top:-94px; height: 110vh;" >
        <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100"
            style="object-fit: cover; z-index: -1;">
            <source src="img/bg-header.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>

        <div class="px-5 hero-section">
            <div class="hero-container" id="hero-container">
                <div class="hero-content wow fadeInLeft" data-wow-delay="0.1s">
                    <h1 class="display-4 wow fadeInUp hero-title" data-wow-delay="0.3s" style="color: #fff;">
                        Empower Businesses Through <span style="font-weight: 700;">Smart Processes</span> And Meaningful
                        <span style="font-weight: 700;">Digital Impact</span>
                    </h1>
                    <p class="wow fadeInUp hero-text" data-wow-delay="0.5s" style="color: #fff;">
                        In today's fast-paced digital world, a strong online presence is no longer optional—it's
                        essential for success.
                    </p>
                    <a href="contact.html" class=" glass-btn  wow fadeInUp " data-wow-delay="0.7s">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    <!-- About Start -->
    <section class="about-section container-fluid">
        <div class="about-container row" style="--bs-gutter-x:0;">
            <div class="about-img col-12 col-md-6 ">
                <img src="img/about-img2.png" alt="">
            </div>
            <div class="about-content col-12 col-md-6 ">
                <div class="about-text">
                        <p class="subheading">COMPANY PROFILE</h6>
                        <h5 class="display-5" style="color:var(--bs-white)">
                            Your Partner in Digital Transformation
                        </h5>
                        <p class="description">
                            We are Aarav Tech Services LLP, a dynamic team of tech innovators and creative problem-solvers dedicated to helping businesses like yours thrive in the digital age. We believe that technology should be an enabler, not a barrier. That's why we offer a comprehensive suite of services—from strategic digital marketing to custom development—to empower our clients and turn their vision into a digital reality.                        </p>    
                        <!-- <a href="#" class="glass-btn">Our Services</a> -->
                </div>
                <div class="about-content-img">
                    <img src="img/about-content-img2.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- About End -->

    <div class="services-WCU-container" >
        <section class="services-section">
            <div class="services-container">
                <div class="services-content">
                    <p class="subheading">OUR SERVICES</h6>
                    <h5 class="display-5" style="color:var(--bs-white)">Empowering Your Digital Success.</h5>
                    <p class="description">
                        We don't just offer services—we deliver integrated solutions designed to help your business thrive in the digital world. We act as your strategic partner, combining technology, creativity, and data to drive real, measurable growth.
                    </p>
                    <a href="#" class="glass-btn">Our Services</a>
                </div>
                <div class="service-cards-section">
                    <a href="digital-marketing.html">
                        <div class="service-card" style="height: 100%;">
                            <div class="service-card-icon">
                                <i class="fa-regular fa-lightbulb" style="color: white;"></i>
                            </div>
                            <h4>Digital Marketing</h4>
                            <p>Get your brand in front of the right people at the right time.
                            </p>
                        </div>
                    </a>
                    <a href="web-development.html">
                        <div class="service-card" style="height: 100%;">
                            <div class="service-card-icon">
                                <i class="bi bi-briefcase" style="color: white;"></i>
                            </div>
                            <h4>Web & Application Development</h4>
                            <p>Your website and app are the foundation of your digital identity.
                            </p>
                        </div>
                    </a>
                     <a href="bpo.html">
                        <div class="service-card" style="height: 100%;">
                            <div class="service-card-icon">
                                <i class="bi bi-megaphone" style="color: white;"></i>
                            </div>
                            <h4>BPO</h4>
                            <p>Streamline your operations, reduce costs, and focus on your core business.</p>
                        </div>
                    </a>
                    <!-- style="padding-top: 2rem;" -->
                    <a href="graphic-designing.html">
                        <div class="service-card" >
                            <div class="service-card-icon">
                                <i class="bi bi-trophy" style="color: white;"></i>
                            </div>
                            <h4>Graphics Designing</h4>
                            <p>Visuals are a powerful way to tell your brand's story.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
         
        <section>
                <div class="container mx-auto">
                    <div class="text-center">
                        <h2 class="main-heading leading-tight mb-4 animate-fade-in-up" style="color: var(--bs-white);">
                            Why Choose Aarav Tech Services?
                        </h2>
                        <p class="text-lg mx-auto mb-4" style="color: var(--bs-white);">
                            We're more than just a service provider. We're your strategic partner in digital success.
                        </p>
                    </div>

                    <div class="row justify-center">
                        <!-- Card 1: Tailored Strategy, Real Results -->
                        <div class="WCU-card-container">
                            <div class="WCU-card service-card">
                                <div>
                                    <div class="mb-4">
                                        <i class="fas fa-chart-simple fa-2xl " style="color: var(--bs-white);"></i>
                                    </div>
                                    <h3 class="mb-4" style="color: var(--bs-white);">Tailored Strategy, Real 
                                    </h3>
                                    <p style="color:var(--bs-white)">
                                        Every company is different. Our digital marketing and lead generation techniques
                                        are
                                        specific to your needs, whether you need increased traffic, conversion, or
                                        qualified
                                        leads.
                                    </p>
                                </div>
                            </div>
                            <div class="WCU-card service-card">
                                <div>
                                    <div class="mb-4">
                                        <i class="fas fa-cubes-stacked fa-2xl" style="color: var(--bs-white);"></i>
                                    </div>
                                    <h3 class="mb-4" style="color: var(--bs-white);">
                                        Smart, Streamlined Solutions
                                    </h3>
                                    <p style="color:var(--bs-white)">
                                         Need anything other than marketing? We provide efficient, consistent services of
                                        business process outsourcing that can be implemented from customer care to
                                        back-office processes, allowing your organization to grow and work smoothly.
                                    </p>
                                </div>
                            </div>
                            <div class="WCU-card service-card">
                                <div>
                                    <div class="mb-4">
                                        <i class="fa fa-hand-peace fa-2xl" style="color: var(--bs-white);"></i>
                                    </div>
                                    <h3 class="mb-4" style="color: var(--bs-white);">
                                        Engaging, Human Touch
                                    </h3>
                                    <p style="color:var(--bs-white)">
                                        We believe in building relationships—not just algorithms. Your brand will have a
                                        voice, and your message will not only be heard but will also appeal to the
                                        audience
                                        as well.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
    </div>


<div class="blog-cta-container">
    <section class="blog-section">
  <div class="container">
    <div class="section-header">
      <p class="subheading">Our Blogs</p>
      <h2 class="title" style="text-align: center;">Latest Insights & Stories</h2>
    </div>

    <div class="blog-slider-wrapper">
      <button class="slider-btn left">
        <i class="fa-solid fa-chevron-left"></i>
      </button>

      <div class="blog-slider">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                    $author_id = $row['post_author'];
                    $author_result = $conn->query("SELECT display_name FROM wp_users WHERE ID = $author_id");
                    $author = ($author_result && $author_result->num_rows > 0)
                        ? $author_result->fetch_assoc()['display_name']
                        : "Unknown";

                    $image_result = $conn->query("
                        SELECT meta_value FROM wp_postmeta
                        WHERE post_id = {$row['ID']} AND meta_key = '_thumbnail_id' LIMIT 1
                    ");
                    $thumbnail_id = ($image_result && $image_result->num_rows > 0)
                        ? $image_result->fetch_assoc()['meta_value']
                        : 0;

                    $img_url = '';
                    if ($thumbnail_id) {
                        $guid_result = $conn->query("SELECT guid FROM wp_posts WHERE ID = $thumbnail_id");
                        $img_url = ($guid_result && $guid_result->num_rows > 0)
                            ? $guid_result->fetch_assoc()['guid']
                            : '';
                    }
                ?>
                <div class="blog-card">
                    <h3 class="blog-title"><?php echo htmlspecialchars($row['post_title']) ?></h3>
                    <?php if ($img_url): ?>
                        <div class="blog-image">
                            <img src="<?php echo htmlspecialchars($img_url) ?>" alt="Blog 1" />
                            <div class="overlay"></div>
                        </div>
                    <?php else: ?>
                        <div class="blog-image">
                            <img src="img/about_us.png" alt="Blog 1" />
                            <div class="overlay"></div>
                        </div>
                    <?php endif; ?>
                    <div class="blog-content">
                    <p><?php echo substr(strip_tags($row['post_content']), 0, 120); ?>...</p>                        
                    <a href="#" class="read-more">Read More <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p style="color: rgba(246, 246, 250, 0.7); font-size: 18px;">No blogs found. Check back soon for new articles!</p>
            </div>
        <?php endif; ?>


      </div>

      <button class="slider-btn right">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>

    <section class="cta-section">
        <div class="cta-overlay"></div>
        <div class="cta-content">
            <h1>
            Let’s create <span class="highlight">creativity</span><br>
            inspiration <span class="highlight-alt">projects</span> together
            </h1>
            <p>Ready to transform your digital presence? Let's discuss how our expertise can help your business
                    thrive in the digital landscape.</p>
            <div class="cta-buttons">
            <a href="contact.html" class="glass-btn">Request a Quote</a>
            </div>
        </div>
    </section>
</div>


    <!-- <section class="footer-section">
        <div class="newsletter">
            <p class="section-label ">NEWSLETTER</p>
            <h2 style="color: #191133;">Subscribe Company Newsletter</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter Your Fullname">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="example@gmail.com">
                </div>
                <button class="submit-btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

        <div class="footer-links">
            <div class="column">
                <img src="img/Company logo.png" alt="" style="width: 200px;">
                <p style="width: 200px; text-align: justify;" class="mt-1">With a perfect blend of up-to date tools and
                    industry experience we make sure
                    that the clients achieve their goals.
                </p>
            </div>
            <div class="column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="index.php#testimonials">Testimonials</a></li>
                    <li><a href="career.php">Careers</a></li>
                </ul>
            </div>
            <div class="column">
                <h4>Services</h4>
                <ul>
                    <li><a href="digital-marketing.html">Digital Marketing</a></li>
                    <li><a href="term-of-use.html">Terms Of Use</a></li>
                    <li><a href="privacy-policy.html"></a>Privacy Policy</li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="column">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="https://www.facebook.com/AaravTechServicesLLP/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/aaravtech_services/?next=%2Fstudentaidprograms%2F"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/aarav-tech-services/?viewAsMember=true"><i
                            class="fab fa-linkedin"></i></a>
                </div>
                <div class="mt-3">
                    <p><a href="tel:+917318083502"><i class="fa fa-phone"></i>+91 7318083502</a></p>
                    <p><a href="mailto:support@aaravtech.net "><i class="fa fa-envelope"></i>support@aaravtech.net </a>
                    </p>
                    <p><a href=""><i class="fa fa-location-pin"></i>Kanpur Nagar, Uttar Pradesh, India</a></p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-logo" style="width: 50px;">ATS</div>
            <p>© 2025 <span></span>. Designed By <span><a href="https://aravtech.net">Aarav Tech Services LLP</a></span>
            </p>
        </div>
    </section>  -->
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

    <!-- Back to Top -->
    <a href="#" class="btn-back-to-top btn-red btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>


    <!-- Template JavaScript -->
    <script src="js/main.js"></script>
    <script>
        const slider = document.querySelector(".blog-slider");
        const leftBtn = document.querySelector(".slider-btn.left");
        const rightBtn = document.querySelector(".slider-btn.right");

        let scrollAmount = 0;
        const cardWidth = 380; // approximate width + gap

        rightBtn.addEventListener("click", () => {
            slider.scrollBy({ left: cardWidth, behavior: "smooth" });
        });

        leftBtn.addEventListener("click", () => {
            slider.scrollBy({ left: -cardWidth, behavior: "smooth" });
        });

        // Optional: auto-slide every few seconds
        setInterval(() => {
            slider.scrollBy({ left: cardWidth, behavior: "smooth" });
        }, 5000);



        // Update slidesToShow on window resize
   

        // const cards = document.querySelectorAll('.testimonial-card');
        // const prevBtn = document.querySelector('.nav-btn.left_test');
        // const nextBtn = document.querySelector('.nav-btn.right_test');

        // let current_card = 0;

        // function updateCards() {
        //     cards.forEach((card, index) => {
        //         card.classList.remove('active', 'prev', 'next');

        //         if (index === current_card) {
        //             card.classList.add('active');
        //         } else if (index === (current_card - 1 + cards.length) % cards.length) {
        //             card.classList.add('prev');
        //         } else if (index === (current_card + 1) % cards.length) {
        //             card.classList.add('next');
        //         }
        //     });
        // }

        // prevBtn.addEventListener('click', () => {
        //     current_card = (current_card - 1 + cards.length) % cards.length;
        //     updateCards();
        // });

        // nextBtn.addEventListener('click', () => {
        //     current_card = (current_card + 1) % cards.length;
        //     updateCards();
        // });

        // updateCards(); // initialize
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar-container');
            const hero = document.querySelector('#hero-container');

            const scrolled = window.scrollY > 100;

            // Only update classes if state changes
            navbar.classList.toggle('home-nav-scrolled', scrolled);
            hero.classList.toggle('hero-scrolled', scrolled);
            const navLinkBtns = document.querySelectorAll('.nav-link-btn');
            const navLinks = document.querySelectorAll('.nav-link')

            const img = document.getElementById('toggleImg');

            // if(scrolled){
            //     img.src =  'img/company_logo_primary.svg' ;
            //     navLinkBtns.forEach(item => {
            //         item.classList.add('btn', true);
            //         item.classList.add('btn-primary', true);
            //         item.classList.add('rounded-pill', true);
            //         item.classList.remove('glass-btn', true);
            //     });
            //     navLinks.forEach(item => {
            //         item.classList.remove('nav-link-white')
            //     })

            // } else {
            //     img.src =  'img/company_logo_white.svg' ;
            //     navLinkBtns.forEach(item => {
            //         item.classList.remove('btn', true);
            //         item.classList.remove('btn-primary', true);
            //         item.classList.remove('rounded-pill', true);
            //         item.classList.add('glass-btn', true);
            //     });
            //     navLinks.forEach(item => {
            //         item.classList.add('nav-link-white')
            //     })
            // }

        });



        // document.addEventListener('DOMContentLoaded', function() {
        // document.querySelectorAll('.submenu-parent').forEach(item => {
        //     console.log("query selector working");
        //     item.addEventListener('click', function(e) {
        //     e.preventDefault();
        //     console.log("clicked")
        //     const submenu = this.nextElementSibling;
        //     if (!submenu) return;
        //     submenu.classList.toggle('show');
        //     submenu.classList.toggle('mobile');

        //     // Close other submenus
        //     document.querySelectorAll('.submenu.show').forEach(openSubmenu => {
        //         if (openSubmenu !== submenu) {
        //         openSubmenu.classList.remove('show');
        //         openSubmenu.classList.remove('mobile');
        //         }
        //     });
        //     });
        // });
        // });

    </script>
    <script src="./index.js"></script>
</body>

</html>