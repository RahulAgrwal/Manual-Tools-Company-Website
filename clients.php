    <!-- ======= Our Clients Section ======= -->

    <section id="clients" class="clients">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>
            <h2>Our <strong>Clients</strong></h2>
          </h2>
        </div>
        
        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">
          <?php
          $imageFolder = 'assets/img/clients/';
          $domesticImageSources = glob($imageFolder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

          foreach ($domesticImageSources as $imageSource) {
            $imageName = pathinfo($imageSource, PATHINFO_FILENAME);
          ?>
            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo">
                <img src="<?php echo $imageSource; ?>" class="img-fluid" alt="<?php echo $imageName; ?>" />
              </div>
            </div>
          <?php } ?>
        </div>

      </div>
    </section>
    <!-- End Our Clients Section -->