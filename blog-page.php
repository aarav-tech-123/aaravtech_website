<?php

// --------------------
// Database connection
// --------------------
// ✅ Connect to local XAMPP MySQL database
$servername = "srv1017.hstgr.io";
$username = "u868210921_OWGYP";
$password = "pQTZ0sfkdM";
$dbname = "u868210921_RXjAJ";  // your DB name
 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
 
// --------------------
// Validate blog ID
// --------------------
if (!isset($_GET['slug'])) {
    die("Invalid blog slug");
}

$slug = $_GET['slug'];
$sql = "SELECT * FROM wp_posts WHERE post_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $slug);;

$stmt->execute();
$result = $stmt->get_result();
 
if ($result->num_rows === 0) {
    die("Blog not found!");
}
 
$blog = $result->fetch_assoc();
$stmt->close();
$conn->close();

?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<title><?php echo htmlspecialchars($blog['post_title']); ?> | AaravTech Blog</title>
<meta name="description" content="<?php echo substr(strip_tags($blog['post_content']), 0, 150); ?>">
<link rel="canonical" href="https://aaravtech.net/blog-page.php?id=<?php echo $blog_id; ?>" />
 
    <!-- CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/brands.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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
    
    /* Blog Hero Section */
    .blog-hero {
        padding: 180px 0 80px;
        position: relative;
        overflow: hidden;
        background: 
            radial-gradient(circle at 20% 80%, rgba(138, 43, 226, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(30, 14, 69, 0.1) 0%, transparent 50%),
            var(--gradient-bg);
        text-align: center;
    }
    
    .blog-hero-badge {
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
    }
    
    .blog-hero h1 {
        font-size: 48px;
        margin-bottom: 24px;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -1px;
    }
    
    .blog-hero h1 .gradient-text {
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
    
    .blog-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        color: rgba(246, 246, 250, 0.7);
        font-size: 16px;
        margin-bottom: 40px;
    }
    
    .blog-meta i {
        color: var(--accent);
        margin-right: 8px;
    }
    
    /* Blog Content Section */
    .blog-content-section {
        padding: 80px 0;
        position: relative;
        background: 
            radial-gradient(circle at 0% 0%, rgba(138, 43, 226, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 100% 100%, rgba(30, 14, 69, 0.1) 0%, transparent 50%),
            var(--gradient-bg);
    }
    
    .blog-content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        background: var(--gradient-card);
        border-radius: 20px;
        padding: 50px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }
    
    .blog-featured-image {
        width: 100%;
        border-radius: 15px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .blog-content {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(246, 246, 250, 0.9);
    }
    
    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4 {
        color: var(--bs-light);
        margin: 30px 0 20px;
        font-weight: 600;
    }
    
    .blog-content p {
        margin-bottom: 20px;
    }
    
    .blog-content a {
        color: var(--accent);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .blog-content a:hover {
        color: var(--accent-light);
        text-decoration: underline;
    }
    
    .blog-content ul,
    .blog-content ol {
        margin: 20px 0;
        padding-left: 30px;
    }
    
    .blog-content li {
        margin-bottom: 10px;
    }
    
    .blog-content blockquote {
        border-left: 4px solid var(--accent);
        padding-left: 20px;
        margin: 30px 0;
        font-style: italic;
        color: rgba(246, 246, 250, 0.8);
    }
    
    /* CTA Section */
    .cta-section {
        padding: 80px 0;
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
    }
    
    .cta-section h2 {
        font-size: 36px;
        margin-bottom: 20px;
        color: var(--bs-light);
        font-weight: 700;
        line-height: 1.2;
    }
    
    .cta-section p {
        font-size: 18px;
        max-width: 600px;
        margin: 0 auto 30px;
        color: rgba(246, 246, 250, 0.8);
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
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        position: relative;
        overflow: hidden;
        text-decoration: none;
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
        color: white;
        text-decoration: none;
    }
    
    /* Footer Styles */
    footer {
        position: relative;
        background: linear-gradient(180deg, #05000D 0%, #0B011C 100%);
        color: var(--bs-light);
        padding: 60px 0 30px;
        border-top: 1px solid rgba(138, 43, 226, 0.2);
        text-align: center;
    }
    
    .footer-shape {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 80%, rgba(138, 43, 226, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(30, 14, 69, 0.1) 0%, transparent 50%);
        z-index: 0;
    }
    
    .footer-container {
        position: relative;
        z-index: 1;
    }
    
    .footer-bottom {
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .footer-bottom p {
        color: rgba(246, 246, 250, 0.5);
        font-size: 14px;
        margin: 0;
    }
    
    /* Responsive Design */
    @media (max-width: 1100px) {
        .blog-hero h1 {
            font-size: 42px;
        }
        
        .cta-section h2 {
            font-size: 32px;
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
        
        .blog-hero {
            padding: 150px 0 60px;
        }
        
        .blog-hero h1 {
            font-size: 36px;
        }
        
        .blog-meta {
            flex-direction: column;
            gap: 10px;
        }
        
        .blog-content-wrapper {
            padding: 30px 20px;
        }
        
        .cta-section h2 {
            font-size: 28px;
        }
    }
    
    @media (max-width: 576px) {
        .blog-hero h1 {
            font-size: 32px;
        }
        
        .cta-section h2 {
            font-size: 24px;
        }
    }
</style>
</head>
 
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="/" class="logo">
                <span>AaravTech</span>
            </a>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="blogs.php" class="active">Blogs</a></li>
                    <li><a href="career.php">Career</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
            <button class="cta-button">Let's Talk <i class="fas fa-comments"></i></button>
        </div>
    </header>
 
    <!-- Blog Hero Section -->
    <section class="blog-hero">
        <div class="container">
            <div class="blog-hero-badge">
                <i class="fas fa-newspaper"></i> Blog Post
            </div>
            <h1><?php echo htmlspecialchars($blog['post_title']); ?></h1>
            <div class="blog-meta">
                <span><i class="fas fa-calendar-alt"></i> <?php echo date("F j, Y", strtotime($blog['post_date'])); ?></span>
                <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($blog['post_author']); ?></span>
            </div>
        </div>
    </section>
 
    <!-- Blog Content Section -->
    <section class="blog-content-section">
        <div class="container">
            <div class="blog-content-wrapper">
                <?php if (!empty($blog['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($blog['image']); ?>" 
                         alt="<?php echo htmlspecialchars($blog['post_title']); ?>" 
                         class="blog-featured-image">
                <?php endif; ?>
                
                <div class="blog-content">
                    <?php echo $blog['post_content']; ?>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Call To Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to boost your business growth?</h2>
                <p>Contact us today to get your digital strategy started!</p>
                <a href="contact.html" class="btn-primary">Get Started</a>
            </div>
        </div>
    </section>
 

 
    <!-- JS -->
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
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(11, 1, 28, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.background = 'linear-gradient(180deg, rgba(11, 1, 28, 0.95) 0%, rgba(11, 1, 28, 0.8) 100%)';
            }
        });
    </script>
</body>
</html>