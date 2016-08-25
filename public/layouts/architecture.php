<?php 
if(!isset($_COOKIE['cookie_dismissed'])) { ?>
  <div id="cookieInfos">
    <p><?php echo lang('cookie_text_navbar'); ?> <a href="<?php echo base_url(); ?>mentions/"><?php echo lang('more_infos'); ?></a></p>
    <a id="cookie_accept"><?php echo lang('accept_text'); ?></a>
  </div>
<?php } ?>

<div id="Wrapper">
  <div id="Top">
    <div class="clearfix">
      <div ID="headerWrapper">
        <div class="inner-1" >
          <div class="inner-2">
            <header>
              <div id="MainHeader" class="pageWrapper clearfix">
                <h1 id="Logo">
                  <a href="<?php echo base_url(); ?>main/">
                    <img src="<?php echo base_url(); ?>public/img/logo_light_2.png" alt="Logo Club Enfin" />
                  </a>
                </h1>
                <div id="MainMenu"  class="">
                  <div class="inner-1">
                    <div class="inner-2">
                      <nav >
                        <button id="MM_responsive_show">Menu</button>
                        <button id="MM_responsive_hide" class="btn black">Hide</button>
                        <div id="MM" class="slideMenu">
                          <?php require('public/layouts/menu_navbar.php'); ?>
                         <div style="clear:left"></div>
                        </div>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </header>
          </div>
        </div>
      </div>
    </div>
  </div>