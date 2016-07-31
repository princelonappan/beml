<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
					<li>
						<a href="#">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					</li>
                                        
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
																													
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>