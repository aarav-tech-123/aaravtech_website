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

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    die("Invalid blog ID");

}

$blog_id = intval($_GET['id']);
 
// --------------------

// Fetch blog post

// --------------------

$sql = "SELECT * FROM wp_posts WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $blog_id);

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
<link href="css/style.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
</head>
 
<body>
 
    <!-- Navbar (same as main site) -->
<nav class="navbar navbar-expand-lg fixed-top navbar-light px-lg-5 py-3 py-lg-0">
<a href="/" class="navbar-brand p-0">
<img src="img/company_logo.png" alt="">
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
<span class="fa fa-bars"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<div class="navbar-nav ms-auto py-0">
<a href="/" class="nav-item nav-link">Home</a>
<a href="about.html" class="nav-item nav-link">About</a>
<a href="blogs.php" class="nav-item nav-link active">Blogs</a>
<a href="career.php" class="nav-item nav-link">Career</a>
<a href="contact.html" class="nav-item nav-link">Contact</a>
</div>
<a href="tel:" class="btn btn-primary rounded-pill text-white py-2 px-4 ms-3">Let's Talk</a>
</div>
</nav>
 
    <!-- Blog Hero Section -->
<div class="container-fluid bg-light py-5 mt-5">
<div class="container text-center">
<h1 class="display-5 fw-bold"><?php echo htmlspecialchars($blog['post_title']); ?></h1>
<p class="text-muted">
<i class="fas fa-calendar-alt"></i>
<?php echo date("F j, Y", strtotime($blog['post_date'])); ?>

                |
<i class="fas fa-user"></i>
<?php echo htmlspecialchars($blog['post_author']); ?>
</p>
</div>
</div>
 
    <!-- Blog Content Section -->
<div style="max-width:73rem; margin:0 auto">
<?php if (!empty($blog['image'])): ?>
<img src="uploads/<?php echo htmlspecialchars($blog['image']); ?>" 

                     alt="<?php echo htmlspecialchars($blog['post_title']); ?>" 

                     class="img-fluid mb-4 rounded shadow">
<?php endif; ?>
 
                <div class="blog-content fs-5 text-dark">
<?php echo $blog['post_content']; ?>
</div>
 
 
    <!-- Call To Action -->
<section class="cta-section outer-section mt-5" style="background-image: url('img/sl_070722_51460_26.jpg');">
<div class="cta-content text-center text-white py-5">
<h2>Ready to boost your business growth?</h2>
<p>Contact us today to get your digital strategy started!</p>
<a href="contact.html" class="btn btn-primary rounded-pill px-4 py-2">Get Started</a>
</div>
</section>
 
    <!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-5">
<p class="mb-0">© <?php echo date("Y"); ?> AaravTech Services. All rights reserved.</p>
</footer>
 
    <!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
 
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
</body>
</html>

 