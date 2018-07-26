<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
                                        
                                        <?php
                                        if($this->session->userdata('user')['is_admin_user'] == '1' &&
                                              ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') ||
                                                 $this->session->userdata('user')['admin_role'] == $this->config->item('user_admin_role')))
                                        {
                                        
                                        ?>
                                        
                                        <li>
						<a href="/student" class="dropdown-toggle">
							<i class="icon-user"></i>
							<span class="menu-text">Manage Employee </span>

							<b class="arrow icon-angle-down"></b>
						</a>

                                            <ul class="submenu" style="display:block;">
                                                 <li>
								<a href="<?php echo $this->config->base_url(); ?>user">
									<i class="icon-double-angle-right"></i>
									Employees
								</a>
							</li>
                                                         <li>
								<a href="<?php echo $this->config->base_url(); ?>user/create">
									<i class="icon-double-angle-right"></i>
									Create Employee
								</a>
							</li>
						
						</ul>
					</li>
                                        <?php } 
                                        if($this->session->userdata('user')['is_admin_user'] == '1' &&
                                              ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') ||
                                                 $this->session->userdata('user')['admin_role'] == $this->config->item('post_admin_role')))
                                        { ?>
                                        
                                         <li>
						<a href="/student" class="dropdown-toggle">
							<i class="icon-user"></i>
							<span class="menu-text">Manage Post</span>

							<b class="arrow icon-angle-down"></b>
						</a>

                                            <ul class="submenu" style="display:block;">
                                                 <li>
								<a href="<?php echo $this->config->base_url(); ?>post">
									<i class="icon-double-angle-right"></i>
									Posts
								</a>
							</li>
                                                        
                                                         <li>
								<a href="<?php echo $this->config->base_url(); ?>post/create">
									<i class="icon-double-angle-right"></i>
									Create Post
								</a>
							</li>
						
						</ul>
					</li>
                                        
                                        <?php } ?>
																													
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>