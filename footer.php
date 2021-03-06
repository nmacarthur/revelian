<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );

$footer_blurb = get_field('footer_blurb', 'footer');
?>

<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
			<a id="site-logo" class="navbar-brand footer-brand" href="<?php echo network_home_url(); ?>">
				Revelian
			</a>
				<?php echo $footer_blurb; ?>
			</div>
			<div class="col-md-2 offset-md-1">
				<p class="footer-title">Explore</p>
			<?php wp_nav_menu(
						array(
							'theme_location'  => 'footer',
							'container_class' => 'navbar__navigation navbar__navigation--footer',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'walker'          => new understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>
			</div>
			<div class="col-md-3 offset-md-1 ">
			<p class="footer-title">Connect with Revelian</p>

			<?php wp_nav_menu(
						array(
							'theme_location'  => 'footer-social',
							'container_class' => 'navbar__navigation navbar__navigation--footer',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'secondary-menu',
							'walker'          => new understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>
			</div>
		</div>
	</div>
</footer>

<div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay"><i class="fal fa-times"></i></span>
  <div class="overlay-content">
	<form method="get"  autocomplete="off" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input class="full-page-search-input field" id="s" name="s" type="text" placeholder="<?php esc_attr_e( 'Search &hellip;', 'understrap' ); ?>" value="<?php the_search_query(); ?>">
	</form>
  </div>
</div>

<style>


</style>

<script>
	// Open the full screen search box 

jQuery('.search-open a').click(function(){
    document.getElementById("myOverlay").style.display = "block";
});

function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

// Close the full screen search box 
function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>


</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/flickity.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/fontawesome-all.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/parallax.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/typed.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/smooth-scroll.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/aos.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/mixitup.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/countUp.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/fuse.min.js"></script>



<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pixi.js/4.7.1/pixi.min.js"></script>

<script>
	var mix = document.querySelector('.mixer');
	if(mix){
		var mixer = mixitup('.mixer', {
			controls: {
			scope: 'local'
			}
		});
	}
</script>

<?php if(get_the_title() == "Home"): ?>
	<script type="text/javascript">


		let appContainer = document.getElementById('header');

		window.onload = loaded(appContainer);

		function setAppSize(app, width, height){
		app.renderer.resize(width, height);
		}

		function setImgSize(sprite, width, height, imgSize){

			let aspectRatio = (width / height);
			let imageRatio = (imgSize.width / imgSize.height);
			let scaleFactor;
			let offsetX;
			let offsetY;

			if(aspectRatio > imageRatio){
				sprite.width = width;
				scaleFactor = width / imgSize.width;
				sprite.height = (scaleFactor * imgSize.height);
				offsetY = (sprite.height - height) / 2;
				sprite.y = 0 - offsetY;
				sprite.x = 0;
			}else{
				sprite.height = height;
				scaleFactor = height / imgSize.height;
				sprite.width = scaleFactor * imgSize.width;
				offsetX = (sprite.width - width) / 2;
				sprite.x = 0 - offsetX;
				sprite.y = 0;

			}
		}

		function onResize(app, appContainer, sprite, width, height, imgSize){
			width = appContainer.offsetWidth;
			height = appContainer.offsetHeight;
			setAppSize(app, width, height);
			setImgSize(sprite, width, height, imgSize);
		}

		function followMouse(app, delta, speed, xp, yp, name){
			var delta = 1;

			speed = 0.8;
			var dt = speed; // fixed step
			var dt = 1.0 - Math.exp(1.0 - dt, delta); // if you have a delta time in frame.

			let position = name.position;
			const target = app.renderer.plugins.interaction.mouse.global;


			xp += ((target.x - xp)/6);
			yp += ((target.y - yp)/6);

			position.x = xp;
			position.y = yp;
		}

		function makeGraphics(name){

			var name = new PIXI.Graphics();

			// Set the fill color
			name.beginFill(0xffffff, 1); // Red

			// Draw a circle
			name.drawCircle(0,0,100,100); // drawCircle(x, y, radius)

			// Applies fill to lines and shapes since the last call to beginFill.
			name.endFill();

			// Add to Stage
			return name

		}

		async function loaded(appContainer){

			let height = appContainer.offsetHeight;
			let width = appContainer.offsetWidth;

			let xp = 0;
			let yp = 0;

			var speed = 0.8;

			let app = new PIXI.Application({forceFXAA: true, roundPixels:true});
			app.renderer = new PIXI.WebGLRenderer();
			var slider = [];
			var activeImg = 0;

			app.renderer.backgroundColor = 0x000000;

			setAppSize(app, width, height);

			<?php
					$backgroundImage_ = get_field('background_image');
					$image_ = $backgroundImage_['background_image'];
					$url_ = $image_['url'];

					$isSlider = get_field('background_image_is_slider');
					$slider = get_field('background_image_bg_slider');

						if($isSlider):
							?>
							<?

							if( have_rows('background_image_bg_slider') ):

								// loop through the rows of data
							while ( have_rows('background_image_bg_slider') ) : the_row();

								// display a sub field value
								$img = get_sub_field('slider_img');
								?>
									slider.push('<?php echo $img['url']; ?>');

								<?php

							endwhile;

						else :

							// no rows found

						endif;

						endif;
			?>


			if(slider.length > 0){
				var texture = [];
				var texture__clear = [];
				for(i = 0; i < slider.length; i++){
					texture[i] = PIXI.Texture.fromImage(slider[i]);
					texture__clear[i] = PIXI.Texture.fromImage(slider[i]);
				}

				var sprite = new PIXI.Sprite(texture[activeImg]);
				var sprite__2 = new PIXI.Sprite(texture[(activeImg + 1)]);

				var sprite__clear = new PIXI.Sprite(texture__clear[activeImg]);
				var sprite__2__clear = new PIXI.Sprite(texture__clear[(activeImg + 1)]);

				var blurFilter = new PIXI.filters.BlurFilter();

				sprite.filters = [blurFilter];
				sprite__2.filters = [blurFilter];

			}else{
				var texture = PIXI.Texture.fromImage('<?php echo $url_; ?>');
				var texture__clear = PIXI.Texture.fromImage('<?php echo $url_; ?>');

				var sprite = new PIXI.Sprite(texture);

				var sprite__clear = new PIXI.Sprite(texture__clear);

				var blurFilter = new PIXI.filters.BlurFilter();

				sprite.filters = [blurFilter];


			}

			var size = {'width':0,'height':0};

			var imgpromise = function (url) {
				return new Promise( async function(resolve,reject) {
				var newimage = new Image();
				newimage.src = url;
				newimage.onload = async function(){
					let promise = new Promise((resolve, reject) => {
						size.width = this.naturalWidth;
						size.height = this.naturalHeight;
						resolve();
					});
					let wait = await promise;
					resolve();
					}
				});
			}

			if(slider.length > 0){
					var imgSize = await imgpromise(slider[activeImg]);
			}else{
				var imgSize = await imgpromise('<?php echo $url_; ?>');
			}

			var imgHeight = sprite.height;
			var imgWidth = sprite.width;

			//Add the Sprite to the Stage

			app.stage.addChild(sprite__2);
			app.stage.addChild(sprite__2__clear);


			app.stage.addChild(sprite);
			app.stage.addChild(sprite__clear);


			sprite.zOrder = 1;
			sprite__clear.zOrder = 1;

				sprite__2.zOrder = 20;
				sprite__2__clear.zOrder = 20;

			sprite__2.alpha = 1;
			sprite__2__clear.alpha = 1;


			setImgSize(sprite, width, height, size);
			setImgSize(sprite__clear, width, height, size);

			setImgSize(sprite__2, width, height, size);
			setImgSize(sprite__2__clear, width, height, size);


			async function changeImage(){
				if(activeImg < (slider.length - 1)){
					activeImg += 1;
				}else{
					activeImg = 0;
				}

				imgSize = await imgpromise(slider[activeImg]);
				sprite__2.texture = texture[activeImg];
				sprite__2__clear.texture = texture[activeImg];
				setImgSize(sprite__2, width, height, size);
				setImgSize(sprite__2__clear, width, height, size);

				tween = TweenMax.to(sprite ,1.2, {alpha:0})
				tween2 = TweenMax.to(sprite__clear ,1.2, {alpha:0})

				tween3 = TweenMax.to(sprite__2 ,1.2, {alpha:1});
				tween4 = TweenMax.to(sprite__2__clear ,1.2, {alpha:1});

				setTimeout(async()=> {
					sprite.texture = texture[activeImg];
					sprite__clear.texture = texture[activeImg];
					imgSize = await imgpromise(slider[activeImg]);
					setImgSize(sprite, width, height, size);
					setImgSize(sprite__clear, width, height, size);
					sprite.alpha = 1;
					sprite__clear. alpha = 1;
					sprite__2.alpha = 0;
					sprite__2__clear.alpha = 0;

				},1600);

			}


			var circle = new PIXI.Graphics();

			// Set the fill color
			circle.beginFill(0xffffff, 1); // Red

			// Draw a circle
			circle.drawCircle(0,0,100,100); // drawCircle(x, y, radius)

			// Applies fill to lines and shapes since the last call to beginFill.
			circle.endFill();


			app.stage.addChild(circle);
			sprite__clear.mask = circle;
			sprite__2__clear.mask = circle;


			window.addEventListener('resize', function(){
				onResize(app, appContainer, sprite, width, height, size);
				onResize(app, appContainer, sprite__clear, width, height, size);
				onResize(app, appContainer, sprite__2, width, height, size);
				onResize(app, appContainer, sprite__2__clear, width, height, size);

			}, true);

			var delay = new Promise( function(resolve,reject) {
				setTimeout(() => {
					app.ticker.add(function(delta) {

						var speed = 0.8;
						var delta = 1;

						var dt = speed; // fixed step
						var dt = 1.0 - Math.exp(1.0 - dt, delta); // if you have a delta time in frame.

						let position = circle.position;
						const target = app.renderer.plugins.interaction.mouse.global;

						xp += ((target.x - xp)/6);
						yp += ((target.y - yp)/6);

						position.x = xp;
						position.y = yp;


					});
					resolve();
				},100);

				});

				var wait2 = delay;

			appContainer.appendChild(app.view);

			window.setTimeout(
				window.setInterval(function(){
				/// call your function here
					changeImage();
				}, 10000)
			, 3000);
		}

	</script>
<?php endif; ?>


<script>
	var tl = new TimelineLite();

	var menuItems = document.querySelector('#main-menu').children;

	for(i = 0; i < menuItems.length; i++){
		menuItems[i].addEventListener("click", (e) => {
			e.preventDefault();
			var mega_menu = document.querySelectorAll('.mega_menu');
			if(e.target)
			for(i=0; i < mega_menu.length; i++){
				//mega_menu[i].classList.remove('active');
				tl.to(mega_menu[i], 0.3, {
					top:20,
					opacity:0,
					zIndex:'-1',
					display:'',
					width:'100%',
					height:'100%',
					padding:50,
				});
			}

			//document.getElementById('dropdown').classList.add('active');
			if(e.target.title.split(' ').length > 1){
				var string = "";
				for(i = 0; i < e.target.title.split(' ').length; i++){
					string += '-' + e.target.title.split(' ')[i];
				}
				var menu = document.querySelector('[data-menu=' + string + ']');
			}else{
				var menu = document.querySelector('[data-menu=' + e.target.title + ']');
			}
			var line = document.querySelector('.navbar__mega--line');

			tl.to(line, 0.3, {
				width:'100%',
				left:0,
				x:'0:'
			}, '-=0.3');

			if(e.target.title != null){
				if(menu != null){
					tl.to(menu, 0.3, {
						top:0,
						opacity:1,
						zIndex:2,
						display:'flex',
						width:'100%',
						padding:50,
						height:'100%'
					},'-=0.2');
				}else{
					window.location.href=e.target;
				}
			}
			tl.add(() => {
			tl.to(document.getElementById('dropdown'), 0.3, {
				height: 'auto',
    			borderTop:'2px solid #fff',
			},'-=0.1')
		})

		});

	};

	document.addEventListener("click",(e) => {
		if(e.target.classList.contains('nav-link') || document.getElementById('dropdown').contains(e.target)){

		}else{
			//document.getElementById('dropdown').classList.remove('active');

			var menu = document.querySelectorAll('.mega_menu');
			for(i=0; i < menu.length; i++){
				tl.to(menu[i], 0.3, {
					top:20,
					opacity:0,
					display:'none',
					zIndex:-2,
					width:'100%'
				});
			}

			tl.to(document.getElementById('dropdown'), 0.3, {
			height:0,
			borderTop:'0px solid #fff',
			},'-=0.3')

			tl.to(document.querySelector('.navbar__mega--line'), 0.3, {
				width:'0%',
				left:'50%',
				x:'0%'
			},'-=0.2');
		}
	});

	AOS.init();

	var toggler = document.querySelector('[data-toggle="menu"]');
	$(toggler).click(function (){toggleMenu(toggler)});

	function toggleMenu(toggler){
		var classList = document.getElementById('expanding-nav').classList;
		if(classList.contains('active-menu')){
			classList.remove('active-menu')
			document.querySelector('#page').style.display = 'block';

			$('.burger__container').toggleClass('active');
		}else{
			classList.add('active-menu');
			document.querySelector('#page').style.display ='none';
			$('.burger__container').toggleClass('active');
		}
	}

	window.FontAwesomeConfig = {
		searchPseudoElements: true
	}

</script>

<?php
	$page_title = get_the_title( get_option('page_for_posts', true) );

if($page_title == "Blog"): ?>
	<script>
		$(document).ready(function(){
			$(".owl-carousel").owlCarousel({
				loop:true,
				nav:true,
				dots:true,
				items:1,
				singleItem:true,
				autoHeight:true,
				navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>']});
		});
	</script>
<?php else: ?>
	<script>
		$(document).ready(function(){
			$(".owl-carousel").owlCarousel({items:1, loop:true, nav:true, dots:false, navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>']});
			var a = new TweenLite(".fa-search", 0.6, {
				opacity:1,
				delay:0.6,
			})
		});
	</script>
<?php endif; ?>


<script>
	var headingNode = document.querySelector('.headingtext');
	if(headingNode){
		if(headingNode.firstChild != null && window.innerWidth >= '768'){
		var text = headingNode.firstChild.nodeValue;

		if(typeof text !== "undefined"){
			textArray = text.split(" ");
			var newString = "";

			newString += textArray[0];
			if(textArray.length > 1){
				for(var i = 1; i < textArray.length - 1; i++){
					newString += ' ' + textArray[i];
				}
				newString += '\xA0' + textArray[textArray.length - 1];

			}else{
				newStrng += textArray[0];
			}
		}

		headingNode.firstChild.nodeValue = newString;

		}
	}

</script>

<script>

	var name = '<?php echo get_bloginfo('name'); ?>';
	var array = name.split(" ");
	subsite = array[array.length - 1];
	console.log(subsite);
	if (subsite === 'Employer') {
		subsite = 'For employers';
	}
	else if (subsite === 'Jobseeker') {
		subsite = 'For jobseekers';
	} 
	else {
		subsite = 'Home';
	}

		document.querySelector('#dropdownMenuLink').innerHTML = subsite;
</script>


</body>

</html>
