
<?php include_once("header.php");?>
						<div id="menu" class="menu1">
							<div class="mnu1">
							<h3>Menu</h3>
								<div class="gallery">
									<div class="sap_tabs">			
										<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
											<ul class="resp-tabs-list">
												<!--<li class="resp-tab-item"><span>Dinner</span></li>-->
												<?php include_once("list_product.php");?>
																
											</ul>	
											<div class="clearfix"> </div>	
											<div class="resp-tabs-container">
												<div class="tab-1 resp-tab-content">
													 <div class="load_more">	
														<script>
															$(document).ready(function () {
																size_li = $("#myList li").size();
																x=2;
																$('#myList li:lt('+x+')').show();
																$('#loadMore').click(function () {
																	x= (x+1 <= size_li) ? x+1 : size_li;
																	$('#myList li:lt('+x+')').show();
																});
																$('#showLess').click(function () {
																	x=(x-1<0) ? 1 : x-1;
																	$('#myList li').not(':lt('+x+')').hide();
																});
															});
														</script>
														<ul id="myList">
															<li>
																<div class="l_g">
																 <div class="col-md-4 img-top">
																		<div class="img-top1">
																		   <a href="images/2-.jpg">
																			<img src="images/2.jpg" class="img-responsive" alt="" />
																			<h4>dinner</h4>
																		   </a>
																		</div>
																	</div>
																	
														<div class="clearfix"> </div>
													</div>	
												</div>	
											</div>		
										</div>
									</div>
								</div>
								<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
								<script type="text/javascript">
												$(document).ready(function () {
													$('#horizontalTab').easyResponsiveTabs({
														type: 'default', //Types: default, vertical, accordion           
														width: 'auto', //auto or any width like 600px
														fit: true   // 100% fit in a container
													});
												});
												
								</script>
				<!--script-->
					<script src="js/jquery.chocolat.js"></script>		
					<!--light-box-files -->
					<script type="text/javascript">
					$(function() {
								$('.img-top a').Chocolat({overlayColor:'#000',leftImg:'images/leftw.gif',rightImg:'images/rightw.gif',closeImg:'images/closew.gif'});
							});
					</script>
							</div>
						</div>
					<!-- //menu -->
					<?php include_once("footer.php");?>
				