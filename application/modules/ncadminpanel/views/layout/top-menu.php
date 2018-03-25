
<header>
    <div class="header_in">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                  <?php  if(get_admin_id() !=""  ) { ?>  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <?php } ?>
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="#"><img src="<?php echo admin_skin();?>images/logo/logo.png" alt="" /></a>
              </div>
              <?php  if(get_admin_id() !=""   ) { ?>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                <li><a href="<?php echo admin_url()."dashboard"?>"><?php echo get_label('dashboard');?></a></li>
                <li><a href="<?php echo admin_url()."causes"?>"> <?php echo get_label('causes_manage_label');?></a></li> 
                <li><a href="<?php echo admin_url()."donation"?>"> <?php echo get_label('donation_manage_label');?></a></li> 
                <li><a href="<?php echo admin_url()."volunteer"?>"> <?php echo get_label('volunteer_manage_labels');?></a></li> 
                <li><a href="<?php echo admin_url()."event"?>"> <?php echo get_label('event_manage_labels');?></a></li> 
                <li><a href="<?php echo admin_url()."enquiry"?>"> <?php echo get_label('enquiry_manage_label');?></a></li> 
				
                </ul>
                <ul class="nav navbar-nav navbar-right">
   
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo admin_url()."changepassword"; ?>"><?php echo get_label('top_menu_change_pass');?></a></li>
                      <li> <a href="<?php echo admin_url()."admin_logout/";?>" > <?php echo get_label('top_menu_logout');?></a></li>
                
                    </ul>
                  </li>
                </ul>
              </div> <?php } ?><!--/.nav-collapse -->
            </div>
          </nav>
        </div>
</header>

