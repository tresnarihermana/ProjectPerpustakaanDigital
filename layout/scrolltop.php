<?php // scrolltop.php ?>
<style>
#scrollTopBtn {
  display: none;
  position: fixed;
  bottom: 40px;
  right: 40px;
  z-index: 1000;
  background-color:#363636;
  color: white;
  border: none;
  outline: none;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
}

#scrollTopBtn:hover {
  background-color: #0056b3;
}
</style>

<button id="scrollTopBtn" title="Scroll to top"><i class="fa fa-arrow-up"></i></button>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const scrollTopBtn = document.getElementById('scrollTopBtn');

  window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
      scrollTopBtn.style.display = 'block';
    } else {
      scrollTopBtn.style.display = 'none';
    }
  });

  scrollTopBtn.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
</script>
