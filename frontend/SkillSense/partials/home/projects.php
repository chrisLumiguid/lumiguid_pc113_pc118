<?php
// partials/projects.php
?>
<div class="project-grid container pb-5">
  <?php for ($i = 1; $i <= 6; $i++): ?>
    <div class="card project">
      <img src="https://picsum.photos/400/250?random=<?php echo $i; ?>" class="project-img" alt="Project Image">
      <div class="hover-info">
        <div class="designer">
          <img src="https://i.pravatar.cc/40?img=<?php echo $i; ?>" alt="Avatar">
          <span>Designer <?php echo $i; ?></span>
        </div>
        <div class="details">
          <span><i class="bi bi-eye"></i> <?php echo number_format($i * 1.3, 1); ?>k</span>
          <span><i class="bi bi-heart-fill text-danger"></i> <?php echo $i * 48; ?></span>
        </div>
      </div>
    </div>
  <?php endfor; ?>
</div>