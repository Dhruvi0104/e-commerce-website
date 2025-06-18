<?php include 'header.php'; ?>

<style>
  .about-hero {
    background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
      url('imgs/Products/main2.jpg') center/cover no-repeat;
    height: 700px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
  }

  .about-hero h1 {
    font-size: 3.5rem;
    background: rgba(31, 33, 33, 0.35);
    padding: 15px 35px;
    border-radius: 12px;
  }

  .about-content {
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 25px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
  }

  .about-card {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
  }

  .about-card:hover {
    transform: translateY(-5px);
  }

  .about-card h3 {
    color: #1b8b3c;
    margin-bottom: 15px;
    font-size: 1.4rem;
  }

  .about-card p {
    font-size: 1.05rem;
    color: #444;
    line-height: 1.7;
  }

  .about-mission {
    margin: 80px auto;
    background: #e4f6ee;
    padding: 60px 30px;
    text-align: center;
    border-radius: 12px;
    max-width: 1000px;
  }

  .about-mission h2 {
    color: #1b8b3c;
    margin-bottom: 20px;
    font-size: 2rem;
  }

  .about-mission p {
    font-size: 1.15rem;
    color: #444;
    max-width: 800px;
    margin: auto;
  }

  @media (max-width: 768px) {
    .about-content {
      grid-template-columns: 1fr;
    }
    .about-hero h1 {
      font-size: 2.2rem;
    }
  }
</style>

<div class="about-hero">
  <h1>Discover Homeware Delights</h1>
</div>

<div class="about-content">
  <div class="about-card">
    <h3>Our Journey</h3>
    <p>Homeware Delights began with a simple goal — to make every home a haven. What started as a small idea has evolved into a trusted space for premium kitchenware, serveware, and home essentials curated for modern living.</p>
  </div>
  <div class="about-card">
    <h3>What We Offer</h3>
    <p>We bring you a curated collection of contemporary and traditional kitchen & home products that combine aesthetics with purpose. From storage to serveware, we focus on quality, utility, and beauty.</p>
  </div>
  <div class="about-card">
    <h3>Why Choose Us</h3>
    <p>Our products are handpicked for durability, design, and affordability. We ensure every item brings joy, comfort, and a touch of elegance to your everyday life.</p>
  </div>
  <div class="about-card">
    <h3>Customer First</h3>
    <p>Your satisfaction drives us. We’re dedicated to seamless service, fast delivery, and responsive support to make your shopping experience delightful and stress-free.</p>
  </div>
</div>

<div class="about-mission">
  <h2>Our Promise</h2>
  <p>We aim to inspire homes with products that simplify and elevate daily life. At Homeware Delights, we believe your space deserves thoughtful design and timeless utility — always.</p>
</div>

<?php include 'footer.php'; ?>
