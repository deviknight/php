	<!-- reserve -->
						<div class="reserve">
							<div class="tabe">
								<img src="images/14.png" alt=" " />
							</div>
							<div class="book_table">
								<h3>Reserve Your Table</h3>
								<form>
									<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
									<input type="text" value="Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}" required="">
									<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
									<div class="section_room">
										<select id="country" onchange="change_country(this.value)" class="frm-field required">
												<option value="null">Number Of Persons</option>
												<option value="null">2</option>         
												<option value="AX">3</option>
												<option value="AX">More</option>
										</select>
									</div>
									<div class="clearfix"> </div>
									<input class="date" id="datepicker" type="text" value="5/11/2015" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '5/11/2015';}" required="">
									<input type="time" value="3:30 PM" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '3:30 PM';}" required="">
									<textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}" required="">Message..</textarea>
									<input type="submit" value="Reserve a Table">
								</form>
									<!---strat-date-piker---->
									<link rel="stylesheet" href="css/jquery-ui.css" />
									<script src="js/jquery-ui.js"></script>
									  <script>
											  $(function() {
												$( "#datepicker,#datepicker1" ).datepicker();
											  });
									  </script>
								<!---/End-date-piker---->
							</div>
						</div>
					<!-- //reserve -->
					<!-- contact -->
						<div id="contact" class="contact">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2564.958900464012!2d36.23097800000001!3d49.993379999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a0f009ab9f07%3A0xa21e10f67fa29ce!2sGeorgia+Education+Center!5e0!3m2!1sen!2sin!4v1436943860334" frameborder="0" style="border:0" allowfullscreen=""></iframe>
							<div class="map-color">
							</div>
							<div class="map-grids">
								<h3>Contact Us</h3>
								<div class="inp-form">
									<form>
										<textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}" required="">Message..</textarea>
										<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
										<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
										<input type="submit" value="Send">
									</form>
								</div>
								<h4>Newsletter</h4>
								<p>Enter your email and subscribe to our newsletter and never miss any updates</p>
								<div class="mail-sub">
									<form>
										<input type="email" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}" required="">
										<input type="submit" value="">
										<div class="clearfix"> </div>
									</form>
								</div>
								<div class="footer">
									<div class="footer-left">
										<p>© 2016 Fodder. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts.</a></p>
									</div>
									<div class="footer-right">
										<ul>
											<li><a href="#" class="facebook"> </a></li>
											<li><a href="#" class="twitter"> </a></li>
											<li><a href="#" class="p"> </a></li>
											<li><a href="#" class="g"> </a></li>
										</ul>
									</div>
									<div class="clearfix"> </div>
								</div>
							</div>
						</div>
					<!-- //contact -->
				</div>
			<!-- //about -->
			
		</div>
	</div>
<!-- //banner-body -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>