<?php 
   $ci =&get_instance();
   $ci->load->model('homes');
     
?>

          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>Navigation</h3>
              <ul class="nav side-menu">
				<?php 
				$getModuleDetails=$ci->homes->getMenu();
				//echo $this->db->last_query();
				foreach($getModuleDetails->result() as $menuParent){
					//print_r($menuParent);
				?>
					<li>
						<a <?php if($menuParent->moduleLink!=""){ ?> href="<?php echo base_url().$menuParent->moduleLink; ?>" <?php } ?>><i class="fa <?php echo $menuParent->imageClass;?>"></i> <?php echo $menuParent->module; ?> 
							<?php if($menuParent->moduleLink==""){ ?> <span class="fa fa-chevron-down"></span> <?php } ?>
						</a>
						<ul class="nav child_menu" style="display: none">
						<?php 
							$getChildModuleDetails=$ci->homes->getMenu($menuParent->moduleId);
							if($getChildModuleDetails->num_rows() > 0){
								foreach($getChildModuleDetails->result() as $menuChild){ ?>
									<li><a href="<?php echo base_url().$menuChild->moduleLink; ?>"><?php echo $menuChild->module; ?></a></li>
								<?php 
								}
							}
						?>
						</ul>
					</li>
				<?php
				}
				?>

              </ul>
            </div>
            

          </div>