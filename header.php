<div class="main-navigation">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                <img src="<?php echo get_option('wp_admin')['logom']; ?>" alt="logo">
            </a>
            <div class="mobile-menu-right">
                <div class="mobile-menu-list">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="main_nav">
                  <?php
                  wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'depth'           => 3, 
                    'container'       => false,
                    'menu_class'      => 'navbar-nav', 
                    'fallback_cb'     => '__return_false',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                  ));
                  ?>
                <div class="header-nav-right">
                </div>
            </div>
        </div>
    </nav>
</div>
