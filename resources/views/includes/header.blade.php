<div class="site-header">
	<div class="container">
		<a href="{{ url('/') }}" id="branding">
			<img src="/images/logo.png" alt="" class="logo">
			<div class="logo-text">
				<h1 class="site-title">GL Quadrics</h1>
				<small class="site-description">GL Quadric</small>
			</div>
		</a> <!-- #branding -->

		@livewire('cart-counter')
		<div class="main-navigation">
			<button class="toggle-menu"><i class="fa fa-bars"></i></button>
			<ul class="menu">
				<li class="menu-item home current-menu-item"><a href="{{ url('/') }}"><i class="icon-home"><img src="/images/icon-home.png"></i></a></li>
				<li class="menu-item"><a href="products.html">Accessories</a></li>
				<li class="menu-item"><a href="products.html">Promotions</a></li>
				<li class="menu-item"><a href="products.html">PC</a></li>
				<li class="menu-item"><a href="products.html">Playstation</a></li>
				<li class="menu-item"><a href="products.html">Xbox</a></li>
				<li class="menu-item"><a href="products.html">Wii</a></li>
			</ul> <!-- .menu -->
			<div class="search-form">
				<label><img src="/images/icon-search.png"></label>
				<input type="text" placeholder="Search...">
			</div> <!-- .search-form -->

			<div class="mobile-navigation"></div> <!-- .mobile-navigation -->
		</div> <!-- .main-navigation -->
	</div> <!-- .container -->
</div> <!-- .site-header -->