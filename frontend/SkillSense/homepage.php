<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>skillsense. – Discover Projects</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --purple: #8789f0;
      --blue: #696cff;
      --light-grey: #f9f9f9;
    }
    body { background-color: #ffffff; font-family: 'Segoe UI', sans-serif; padding-top: 80px; }
    .navbar { position: fixed; top: 0; width: 100%; z-index: 1000; transition: background-color 0.3s, box-shadow 0.3s; background-color: transparent; }
    .navbar.scrolled { background-color: #fff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
    .navbar-brand { font-weight: bold; font-size: 1.6rem; color: var(--blue); }
    .nav-link { color: #333 !important; transition: color 0.3s; }
    .nav-link:hover { color: var(--blue) !important; }
    .btn-signin { background-color: var(--blue); border: none; color: #fff; padding: 6px 14px; border-radius: 20px; font-size: 14px; transition: background 0.3s ease; }
    .btn-signin:hover { background-color: var(--purple); }
    .hero { text-align: center; padding: 80px 20px 40px; }
    .hero h1 { font-weight: 700; font-size: 2.7rem; color: #222; }
    .hero p { color: #777; }
    .search-box { max-width: 600px; margin: 20px auto; position: relative; }
    .search-box input { padding: 12px 20px; border-radius: 30px; border: 1px solid #ddd; width: 100%; outline: none; background-color: #f1f1f1; }
    .search-box i { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: #aaa; }
    .tags { margin-top: 10px; }
    .tags span { margin: 5px; font-size: 13px; background: #eee; border-radius: 20px; padding: 6px 12px; cursor: pointer; transition: background 0.3s; }
    .tags span:hover { background: #ddd; }
    .filter-tabs { display: flex; justify-content: center; flex-wrap: wrap; margin: 30px 0; gap: 12px; }
    .filter-tabs .tab { font-size: 14px; padding: 6px 14px; border-radius: 20px; background: #f1f1f1; cursor: pointer; transition: all 0.3s; }
    .filter-tabs .tab:hover { background: var(--purple); color: #fff; }
    .project-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 10px; padding: 0 2rem; }
    .card.project { position: relative; border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06); background: #fff; transition: all 0.2s ease; cursor: pointer; }
    .card.project:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12); }
    .project-img { height: 180px; object-fit: cover; width: 100%; transition: transform 0.3s ease; }
    .card.project:hover .project-img { transform: scale(1.05); }
    .hover-info { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 1rem; background: linear-gradient(to top, rgba(105, 108, 255, 0.8), rgba(135, 137, 240, 0.2)); color: #fff; opacity: 0; transition: opacity 0.3s ease; }
    .card.project:hover .hover-info { opacity: 1; }
    .hover-info .designer { display: flex; align-items: center; margin-bottom: 0.5rem; }
    .hover-info .designer img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 10px; }
    .hover-info .details { display: flex; justify-content: space-between; font-size: 13px; }
    .signin-cta { background: linear-gradient(135deg, #f8f9fa, #ffffff); border: 1px solid #ddd; border-radius: 24px; text-align: center; padding: 40px 20px; margin: 60px auto 20px; max-width: 700px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05); }
    .signin-cta h3 { font-size: 24px; font-weight: 600; }
    .signin-cta p { margin: 10px 0 20px; color: #666; }
    .signin-cta .btn-dark { background-color: var(--blue); border: none; }
    .footer { text-align: center; font-size: 14px; color: #888; padding: 40px 20px; margin-top: 60px; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">skillsense.</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav me-3">
        <li class="nav-item"><a class="nav-link" href="#">Explore</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Hire Designers</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
      </ul>
      <a class="btn btn-signin" href="register.php"><i class="bi bi-person-circle me-1"></i>Sign In</a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <h1>Discover Top Projects</h1>
  <p>Find the best portfolios and talents in one place.</p>
  <div class="search-box">
    <input type="text" placeholder="Search projects, skills, talents...">
    <i class="bi bi-search"></i>
  </div>
  <div class="tags">
    <span>Web Design</span>
    <span>UI/UX</span>
    <span>Development</span>
    <span>Branding</span>
    <span>Photography</span>
  </div>
</section>

<!-- Filter Tabs -->
<div class="filter-tabs">
  <div class="tab">All</div>
  <div class="tab">Popular</div>
  <div class="tab">Newest</div>
  <div class="tab">Recommended</div>
</div>

<!-- Project Grid -->
<div class="project-grid">
  <div class="card project">
    <img src="https://source.unsplash.com/400x300/?design,website" class="project-img" alt="Project Image">
    <div class="hover-info">
      <div class="designer">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Designer">
        <span>John Doe</span>
      </div>
      <div class="details">
        <span>Web Design</span>
        <span>$500</span>
      </div>
    </div>
  </div>

  <div class="card project">
    <img src="https://source.unsplash.com/400x300/?app,design" class="project-img" alt="Project Image">
    <div class="hover-info">
      <div class="designer">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Designer">
        <span>Jane Smith</span>
      </div>
      <div class="details">
        <span>UI/UX</span>
        <span>$450</span>
      </div>
    </div>
  </div>
</div>

<!-- CTA Section -->
<div class="signin-cta">
  <h3>Ready to showcase your portfolio?</h3>
  <p>Sign up now and connect with top employers and clients!</p>
  <a class="btn btn-dark" href="register.php" data-bs-toggle="modal" data-bs-target="#roleModal">Get Started</a>
</div>

<!-- Footer -->
<footer class="footer">
  &copy; 2025 SkillSense. All rights reserved.
</footer>


<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scroll Effect for Sticky Navbar -->
<script>
  window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  });
</script>
</body>
</html>
