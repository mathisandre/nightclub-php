<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                <img id="logo_navbar" src="<?php echo base_url(); ?>public/img/logo_light.png" alt="Logo" />
            </a>
        </li>
        <?php 
        foreach($items as $k => $v) {
            echo '<li><a href="'.base_url().$v['link'].'">'.$v['name'].'</a></li>';
        } 
        ?>
    </ul>
</div>

<div class="navbar navbar-inverse" id="navbar_mobile">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="#">Club Enfin</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php 
        foreach($items as $k => $v) {

            if(strtolower($k)==$this->uri->segment(1)) {
                echo '<li class="active"><a href="'.base_url().$v['link'].'">'.$v['name'].'</a></li>';
            } else {
                echo '<li><a href="'.base_url().$v['link'].'">'.$v['name'].'</a></li>';
            }
        } 
        ?>
        </ul>
    </div>
  </div>
</div>
