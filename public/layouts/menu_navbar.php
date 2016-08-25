<ul id="menu-main-menu" class="menu">
  <?php foreach(lang('menu_items') as $menu_item) { ?>
    <?php 
    if($menu_item['id']=='login' && $this->session->userdata('id_member')) {
      continue;
    }
    ?>
    <li class="menu-item menu-item-type-post_type menu-item-object-page">
      <a href="<?php echo base_url().$menu_item['url']; ?>"><?php echo $menu_item['title']; ?></a>
    </li>
    <?php
 } ?>

  <?php if($current_lang=='fr') { ?>
    <li class="menu-item menu-item-language menu-item-language-current menu-item-has-children">
      <a href="<?php echo base_url(); ?>lang/switchLanguage/nl"><img class="iclflag" src="<?php echo base_url(); ?>public/theme/wp-content/plugins/sitepress-multilingual-cms/res/flags/nl.png" width="18" height="12" alt="nl" title="Nederlands" /></a>
    </li>
  <?php } else { ?>
    <li class="menu-item menu-item-language">
          <a href="<?php echo base_url(); ?>lang/switchLanguage/fr"><img class="iclflag" src="<?php echo base_url(); ?>public/theme/wp-content/plugins/sitepress-multilingual-cms/res/flags/fr.png" width="18" height="12" alt="fr" title="Français" /></a></li>
  <?php } 
  /* Logout */
  if($this->session->userdata('id_member')) { ?>
      <li class="menu-item menu-item-type-post_type menu-item-object-page">
        <a href="<?php echo base_url().'member/logout/'; ?>" style="color: red;"><?php echo lang('logout'); ?></a>
      </li>
   <?php } ?>
</ul>
