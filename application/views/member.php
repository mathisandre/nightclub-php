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
            <style>
            #global-content-form label {
              color: #fccb74;
              font-size: 18px;
            }

            #global-content-form .gold_color {
              color: #fccb74;
              font-size: 24px;
            }

            #select-module-car label {
              font-size: 15px;
              padding-right: 10px;
            }

            #select-module-car {
              padding: 20px 0px 20px 0px;
            }

            @media screen and (max-width: 600px) {
              .errors_fields {
                width: 90%;
              }
            }
            </style>
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
                              <div id="global-content-form">
                                <h1 class="entry-title gold-color font-fantasy-title"><?php echo $member_formule_text->title; ?></h1>
                                <?php 
                                if($this->session->userdata('id_member')) { ?>
                                  <?php echo $member_formule_text->text; ?>
                                  <h2 class="gold-color"><?php echo lang('member_already_text'); ?></h2>
                                <?php } else { 
                                  if(!$this->session->userdata('session_username')) {
                                    if($this->session->flashdata('errors_general')) { ?>
                                      <div class="alert alert-danger errors_fields">
                                        <?php echo lang('form_errors_general'); ?>
                                      </div>
                                    <?php } 
                                    if($this->session->flashdata('errors_email')) { ?>
                                      <div class="alert alert-danger errors_fields">
                                        <?php echo lang('form_errors_email'); ?>
                                      </div>
                                    <?php }

                                    if($this->session->flashdata('errors_email_exist')) { ?>
                                      <div class="alert alert-danger errors_fields">
                                        <?php echo lang('form_errors_email_exist'); ?>
                                      </div>
                                    <?php }

                                    if($this->session->flashdata('errors_pseudo_exist')) { ?>
                                      <div class="alert alert-danger errors_fields">
                                        <?php echo lang('form_errors_pseudo_exist'); ?>
                                      </div>
                                    <?php }

                                    if($this->session->flashdata('success_general')) { ?>
                                      <div class="alert alert-success errors_fields">
                                        <?php echo lang('form_success_general'); ?>
                                      </div>
                                    <?php } 

                                    if($this->session->flashdata('success_request')) { ?>
                                      <div class="alert alert-success errors_fields">
                                        <?php echo lang('email_text_wait'); ?>
                                      </div>
                                    <?php }

                                    echo $member_formule_text->text;
                                  
                                    echo form_open('member/save/'.$member_type, array('id' => 'form_member')); ?>

                                    <label><?php echo lang('username_member'); ?> 
                                        <span class="red">*</span>
                                    </label> 

                                    <?php echo form_input(array(
                                     'class' => 'form_register',
                                     'name' => 'username',
                                     'placeholder' => lang('username_member'),
                                     'value' => $this->session->flashdata('username'),
                                     'autocomplete' => 'off',
                                    )); ?>

                                    <label><?php echo lang('email_member'); ?> 
                                        <span class="red">*</span>
                                    </label> 

                                    <?php echo form_input(array(
                                     'class' => 'form_register',
                                     'name' => 'email',
                                     'type' => 'email',
                                     'placeholder' => lang('email_member'),
                                     'value' => $this->session->flashdata('email'),
                                     'autocomplete' => 'off',
                                    )); ?>

                                    <label><?php echo lang('password_member'); ?> 
                                        <span class="red">*</span>
                                    </label> 

                                    <?php echo form_input(array(
                                     'class' => 'form_register',
                                     'name' => 'password',
                                     'type' => 'password',
                                     'placeholder' => lang('password_member'),
                                     'value' => $this->session->flashdata('password'),
                                     'autocomplete' => 'off',
                                    )); ?>
                                    <label><?php echo lang('type_car'); ?>
                                      <span class="red">*</span>
                                    </label>

                                    <div id="select-module-car">
                                      <label><input type="radio" class="vehicleCheckChoice" checked value="car" name="type_car"/> <?php echo lang('auto'); ?></label> 
                                      <label><input type="radio" class="vehicleCheckChoice" value="camping_car" name="type_car"/> <?php echo lang('camping_car'); ?></label>
                                    </div>

                                    <div id="car-module-form">
                                      <label><?php echo lang('brand_car'); ?> 
                                          <span class="red">*</span>
                                      </label> 

                                      <?php echo form_input(array(
                                       'class' => 'form_register',
                                       'name' => 'brand_car',
                                       'placeholder' => lang('brand_car'),
                                       'value' => $this->session->flashdata('brand_car'),
                                       'autocomplete' => 'off',
                                      )); ?>

                                      <label><?php echo lang('model_car'); ?> 
                                          <span class="red">*</span>
                                      </label> 

                                      <?php echo form_input(array(
                                       'class' => 'form_register',
                                       'name' => 'model_car',
                                       'placeholder' => lang('model_car'),
                                       'value' => $this->session->flashdata('model_car'),
                                       'autocomplete' => 'off',
                                      )); ?>

                                      <label><?php echo lang('numberplate_car'); ?> 
                                          <span class="red">*</span>
                                      </label> 

                                      <?php echo form_input(array(
                                       'class' => 'form_register',
                                       'name' => 'numberplate_car',
                                       'placeholder' => lang('numberplate_car'),
                                       'value' => $this->session->flashdata('numberplate_car'),
                                       'autocomplete' => 'off',
                                      )); ?>
                                    </div>
                                    <div class="form_member" id="form_member1">

                                    <h3 class="gold_color"><?php echo lang('men'); ?></h3>

                                    <label><?php echo lang('name_label'); ?> 
                                        <span class="red">*</span>
                                    </label>  
                                    <br />

                                      <?php echo form_input(array(
                                        'class' => 'form_register',
                                        'name' => 'name',
                                        'id' => 'name',
                                        'placeholder' => lang('name_member'),
                                        'value' => $this->session->flashdata('name'),
                                        'autocomplete' => 'off',
                                      )); ?>

                                      <?php echo form_input(array(
                                        'class' => 'form_register',
                                        'name' => 'firstname',
                                        'id' => 'firstname',
                                        'placeholder' => lang('firstname_member'),
                                        'value' => $this->session->flashdata('firstname'),
                                        'autocomplete' => 'off',
                                      )); ?>

                                      <label>
                                      <?php echo lang('country_nationality'); ?>
                                      <span class="red">*</span>
                                      </label>  <br />

                                      <select name="country" id="country" class="form_register">
                                        <?php foreach($countries as $country) { ?>
                                        <option <?php if($country=='Belgium') { echo 'selected'; } ?> value="<?php echo $country; ?>"><?php echo $country; ?></option>
                                        <?php } ?>
                                      </select>

                                      <select name="nationality" id="nationality" class="form_register">
                                        <?php foreach($countries as $country) { ?>
                                        <option <?php if($country=='Belgium') { echo 'selected'; } ?> value="<?php echo $country; ?>"><?php echo $country; ?></option>
                                        <?php } ?>
                                      </select>

                                      <br>

                                      <label>
                                      <?php echo lang('birthday_member'); ?> 
                                      <span class="red">*</span>
                                      </label>

                                      <?php echo form_input(array(
                                        'type' => 'date',
                                        'class' => 'form_register',
                                        'name' => 'birthday',
                                        'placeholder' => lang('birthday_member'),
                                        'value' => $this->session->flashdata('birthday'),
                                        'autocomplete' => 'off',
                                      )); ?>

                                      <label>
                                      <?php echo lang('phone_member'); ?> 
                                      </label>

                                      <?php echo form_input(array(
                                        'class' => 'form_register',
                                        'name' => 'phone',
                                        'placeholder' => lang('phone_member'),
                                        'value' => $this->session->flashdata('phone'),
                                        'autocomplete' => 'off',
                                      )); ?>
                                    </div>

                                      <div class="form_member" id="form_member2">
                                          <h3 class="gold_color"><?php echo lang('women'); ?></h3>

                                        <label><?php echo lang('name_label'); ?> 
                                        <span class="red">*</span>
                                        </label>  
                                        <br />

                                        <?php echo form_input(array(
                                          'class' => 'form_register',
                                          'name' => 'name_women',
                                          'id' => 'name_women',
                                          'placeholder' => lang('name_member'),
                                          'value' => $this->session->flashdata('name_women'),
                                          'autocomplete' => 'off',
                                        )); ?>

                                        <?php echo form_input(array(
                                          'class' => 'form_register',
                                          'name' => 'firstname_women',
                                          'id' => 'firstname_women',
                                          'placeholder' => lang('firstname_member'),
                                          'value' => $this->session->flashdata('firstname_women'),
                                          'autocomplete' => 'off',
                                        )); ?>

                                        <label>
                                        <?php echo lang('country_nationality'); ?>
                                        <span class="red">*</span>
                                        </label>
                                        <br />

                                        <select name="country_women" id="country_women" class="form_register">
                                          <?php foreach($countries as $country) { ?>
                                          <option <?php if($country=='Belgium') { echo 'selected'; } ?> value="<?php echo $country; ?>"><?php echo $country; ?></option>
                                          <?php } ?>
                                        </select>

                                        <select name="nationality_women" id="nationality_women" class="form_register">
                                          <?php foreach($countries as $country) { ?>
                                          <option <?php if($country=='Belgium') { echo 'selected'; } ?> value="<?php echo $country; ?>"><?php echo $country; ?></option>
                                          <?php } ?>
                                        </select>

                                        <br />
                                        <label>
                                        <?php echo lang('birthday_member'); ?> 
                                        <span class="red">*</span>
                                        </label>

                                        <?php echo form_input(array(
                                          'type' => 'date',
                                          'class' => 'form_register',
                                          'name' => 'birthday_women',
                                          'placeholder' => lang('birthday_member'),
                                          'value' => $this->session->flashdata('birthday_women'),
                                          'autocomplete' => 'off',
                                        )); ?>

                                        <label>
                                        <?php echo lang('phone_member'); ?>
                                        </label>

                                        <?php echo form_input(array(
                                          'class' => 'form_register',
                                          'name' => 'phone_women',
                                          'placeholder' => lang('phone_member'),
                                          'value' => $this->session->flashdata('phone_women'),
                                          'autocomplete' => 'off',
                                        )); ?>

                                        <input type="submit" name="send_member" value="<?php echo lang('submit_button'); ?>" />
                                      </div>
                                    <?php echo form_close(); 
                                  } else { if($this->session->flashdata('error_upload')) { ?>
                                          <div class="alert alert-danger errors_fields">
                                            <?php echo lang('error_upload'); ?>
                                          </div>
                                        <?php } else { ?>
                                          <div class="alert alert-success errors_fields"><?php echo lang('upload_text'); ?></div>
                                        <?php }  ?>

                                        <?php echo form_open_multipart('member/create/'.$member_type, array('id' => 'form_upload_member')); ?>
                                        <label>Photo 1</label>
                                        <input type="file" name="memberUpload1" /> <br><br>
                                        <label>Photo 2</label>
                                        <input type="file" name="memberUpload2" /> <br><br>
                                        <input type="submit" value="<?php echo lang('submit_button'); ?>" />
                                        <?php echo form_close(); ?>
                                        <hr />
                                        <h3 id="cancel_request" class="cancel"><a href="<?php echo base_url()."member/cancel"; ?>"><?php echo lang('cancel'); ?></a></h3>
                                        <?php
                                  } ?>
                                <?php } ?>
                              </div>
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
              <script src="<?php echo base_url(); ?>public/js/script-car.js"></script>
           </body>
          </html>