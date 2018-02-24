		<div class="main-container container-fluid ">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h1>
                                                                            <img src="<?php echo base_url("assests/images/logo.jpg"); ?>" />
										
									</h1>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-twitter green"></i>
													Please Enter Your Information
												</h4>

												<div class="space-6"></div>

												<form action="<?php echo $this->config->base_url(); ?>home/verify_login" method="POST" id='login_form'>
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" name='username' class="span12" placeholder="Email Or Employee ID" />
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" name='password' class="span12" placeholder="Password" />
																<i class="icon-lock"></i>
															</span>
														</label>

<?php
                    if($this->session->flashdata()){
  $message = $this->session->flashdata('item');
  ?>
<div style="float: left; margin-right: 95px;color: red;  margin-top: 0px;margin-bottom: 10px;font-size: 17px;" class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?></div>
<?php
}
?>
														<div class="clearfix">
															<label class="inline">
																<input type="checkbox" />
																<span class="lbl"> Remember Me</span>
															</label>
                                                                                                                    <button id="login_button" class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
															</button>
														</div>

														<div class="space-4"></div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar clearfix">
												<div>
													<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
														<i class="icon-arrow-left"></i>
														I forgot my password
													</a>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->

									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Retrieve Password
												</h4>

												<div class="space-6"></div>
												<p>
													Enter your email and to receive instructions
												</p>

												<form>
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="email" class="span12" placeholder="Email" />
																<i class="icon-envelope"></i>
															</span>
														</label>

														<div class="clearfix">
															<button onclick="return false;" class="width-35 pull-right btn btn-small btn-danger">
																<i class="icon-lightbulb"></i>
																Send Me!
															</button>
														</div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													Back to login
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/forgot-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->

		<!--basic scripts-->

		