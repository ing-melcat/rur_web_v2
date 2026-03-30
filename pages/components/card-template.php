<div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
  <div class="card" style="width: 22rem;">
    <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo $name; ?>">
    <div class="card-body">
      <h5 class="card-title"><?php echo $name; ?></h5>

      <!-- Loop through badges -->
      <?php if (!empty($badges)): ?>
        <?php foreach ($badges as $badge): ?>
          <span class="badge <?php echo $badge['class']; ?>">
            <?php echo $badge['text']; ?>
          </span>
        <?php endforeach; ?>
      <?php endif; ?>

      <p class="card-text mb-2"><?php echo $description; ?></p>

      <!-- New rows with short labels -->
      <?php if (!empty($linkedin)): ?>
        <div class="mb-2 d-flex justify-content-between">
          <span class="fw-bold">LinkedIn:</span>
          <a href="<?php echo $linkedin; ?>" target="_blank">View Profile</a>
        </div>
      <?php endif; ?>

      <?php if (!empty($github)): ?>
        <div class="mb-2 d-flex justify-content-between">
          <span class="fw-bold">GitHub:</span>
          <a href="<?php echo $github; ?>" target="_blank">Repository</a>
        </div>
      <?php endif; ?>

      <?php if (!empty($contact)): ?>
        <div class="mb-2 d-flex justify-content-between">
          <span class="fw-bold">Contact:</span>
          <a href="<?php echo $contact; ?>">Email</a>
        </div>
      <?php endif; ?>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <a href="<?php echo $link; ?>" class="card-link">More information...</a>
      </li>
    </ul>
  </div>
</div>
