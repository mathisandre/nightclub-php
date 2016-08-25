<!doctype html><!--[if lt IE 7 ]> 
<html lang="en" class="no-js ie6">
  <![endif]-->
  <!--[if IE 7 ]>    
  <html lang="en" class="no-js ie7">
    <![endif]-->
    <!--[if IE 8 ]>    
    <html lang="en" class="no-js ie8">
      <![endif]-->
      <!--[if IE 9 ]>    
      <html lang="en" class="no-js ie9">
        <![endif]-->
        <!--[if (gt IE 9)|!(IE)]><!--> 
        <html class="no-js">
          <!--<![endif]-->
          <head>  
            <!-- Basic website informations -->
            <title><?php echo lang('title'); ?></title>
            <meta name="description" content="<?php echo lang('meta_description'); ?>" />
            <meta name="keywords" content="<?php echo lang('meta_keywords'); ?>" />
            <meta charset="UTF-8" />
            <!-- Social networks -->
            <meta name="twitter:url" content="http://www.clubenfin.be" />
            <meta name="twitter:title" content="<?php echo lang('title'); ?>" />
            <meta name="twitter:description" content="<?php echo lang('og_description'); ?>" />
            <meta property="og:title" content="<?php echo lang('title'); ?>" />
            <meta property="org:description" content="<?php echo lang('og_description'); ?>" />
            <meta property="og:site_name" content="ClubEnfin" />
            <meta property="org:url" content="http://www.clubenfin.be" />
            <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/icons/shortcut.jpg" />
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <?php include('public/layouts/head_style.php'); ?>
          </head>
          <body class="home-page home page page-id-12 page-template-default invisibleAll style-skin-2">
              <?php require('public/layouts/architecture.php'); ?>
              <!--! end of #Top -->
              <div id="Middle">
                <div class="pageWrapper theContent clearfix">
                  <div class="inner-1">
                    <div class="inner-2 contentMargin">
                      <div id="home-page-layout_c1" class="clearfix">
                        <div id="home-page-layout_c1_col-1-1_1" class="col-1-1 clearfix">
                          <div class="i0 ugc"></div>
                        </div>
                        <!-- END id=home-page-layout_c1_col-1-1_1 class=col-1-1 -->
                      </div>
                      <!-- END id=home-page-layout_container_1 -->
                      <div id="home-page-layout_c2" class="clearfix">
                        <div id="home-page-layout_c2_col-2-3_1" class="col-3-4 clearfix">
                          <div class="i0 ugc"></div>
                          <div class="i1 ugc">
                            <div class="page ugc">
                             <h1 class="entry-title gold-color font-fantasy-title">
                             <?php echo lang('confirm_payment'); ?></h1>
                             <hr />
                             <ul class="recapitulatif_menu">
                              <li>
                              <?php echo lang('username_member'); ?> : <strong><?php echo $user->username; ?></strong></li>
                              <li>
                              <?php echo lang('name_men'); ?> : <strong><?php echo $user->firstname.' '.$user->name; ?></strong></li>
                              <li>
                              <?php echo lang('name_women'); ?> : <strong><?php echo $user->firstname_women.' '.$user->name_women; ?></strong>
                              </li>
                            </ul>
                            <hr />
                            <div class="alert alert-warning alert_payment">
                              <h2><?php echo lang('total'); ?> : 
                                <span class="gold-color">
                                  <?php echo number_format($amount, 2, ',', ' '); ?> €
                                </span>
                              </h2>
                            </div>
                             <?php echo form_open('payment/do_payment', array('id' => 'form_payment')); ?>
                                 <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                         data-key="<?php echo $stripe['publishable_key']; ?>"
                                         data-description="<?php echo $member_card_type; ?>"
                                         data-amount="<?php echo $amount_format; ?>"
                                         data-label="<?php echo lang('payment_label'); ?>"
                                         data-currency="eur"
                                         data-locale="auto"></script>
                               <?php echo form_close(); ?>
                            </div>
                          </div>
                        </div>
                        <!-- END id=home-page-layout_c2_col-2-3_1 class=col-2-3 -->
                       <div id="home-page-layout_c2_col-2-3_1" class="col-1-4 clearfix">
                         <div class="i0 ugc"></div>
                         <div class="i1 ugc">
                           <div class="page ugc">
                              <h2 class="entry-title"><?php echo lang('payment_accept_text'); ?></h2>
                              <div id="payment_accept">
                                <img src="<?php echo base_url(); ?>public/img/visa-mastercard-amex.png" alt="visa-mastercard-amex" />
                              </div> 
                           </div>
                         </div>
                       </div>
                      </div>
                      <!-- END id=home-page-layout_container_2 -->
                    </div>
                  </div>
                </div>
                <!--! end of .pageWrapper -->
              </div>
               <!--! end of #Middle -->
              <div id="Bottom">
                <footer style="background: transparent;">
                  <div class="pageWrapper theContent clearfix">
                    <div class="inner-1">
                      <div class="inner-2">
                        <div class="ugc clearfix">
                          <div class="staticBlockWrapper ugc" style="background: transparent;">
                            <div class="staticContent scid-1710">
                              <?php include('public/layouts/footer-infos.php'); ?>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </footer>
              </div>
              <!--! end of #Bottom -->
              <?php require('public/layouts/footer.php'); ?>
           </body>
          </html>
