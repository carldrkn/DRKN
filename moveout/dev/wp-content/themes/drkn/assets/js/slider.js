window.drkn = window.drkn || {};

jQuery(function($){
	$('.slider-container').each(function(){
		drkn.slider = new (drkn.Slider.extend({
			initialize: function(){
				this.setupSlider()
			},
			prevSelector: '.prev',
			nextSelector: '.next'
		}))({
			el: this
		});
	});
});

function GetVendorPrefix(arrayOfPrefixes) {

	var tmp = document.createElement("div");
	var result = null;

	for (var i = 0; i < arrayOfPrefixes.length; ++i) {

		if (typeof tmp.style[arrayOfPrefixes[i]] != 'undefined')
		{
			result = arrayOfPrefixes[i];
			break;
		}
	}

	return result;
}

drkn.css = {};
drkn.css.transform = GetVendorPrefix(["transform", "msTransform", "MozTransform", "WebkitTransform", "OTransform"]);
drkn.css.transition = GetVendorPrefix(["transition", "msTransition", "MozTransition", "WebkitTransition", "OTransition"]);
drkn.css.animation = GetVendorPrefix(["animation", "msAnimation", "MozAnimation", "WebkitAnimation", "OAnimation"]);
drkn.css.grid = GetVendorPrefix(["gridRow", "msGridRow", "MozGridRow", "WebkitGridRow", "OGridRow"]);
drkn.css.hyphens = GetVendorPrefix(["hyphens", "msHyphens", "MozHyphens", "WebkitHyphens", "OHyphens"]);

drkn.model = new (Backbone.Model.extend({
	initialize: function(){
		var self = this;
		jQuery(window).bind('resize', function(){
			self.trigger('resize');
		});
	}
}))();

(function($){

	drkn.Slider = Backbone.View.extend({

		/**
		 * Required
		 */
		sliderSelector: '.slider',
		animationDuration: 1500,

		/**
		 * Optional
		 */
		infiniteSlider: true,
		slideInterval: null, // Time between slides if infinite slider
		isActive: function(){ return true },

		nextSelector: null,
		prevSelector: null,

		/**
		 * Local vars
		 */
		$slider: null,
		$curImage: null,
		timeoutId: null,
		css3: null,


		/**
		 * Methods
		 */
		setupSlider: function(){

			this.$slider = this.$( this.sliderSelector );

			if ( !this.$slider.length )
				return;

			if ( this.$slider.children().length === 1 ) {
				if ( this.prevSelector )
					this.$(this.prevSelector).remove();
				if ( this.nextSelector )
					this.$(this.nextSelector).remove();
			}

			this.$curSlide = this.$slider.children().first();

			this.css3 = Modernizr.csstransitions && Modernizr.csstransforms;

			if ( this.infiniteSlider )
			{
				if ( this.$slider.children().length == 1)
					return;

				this.$slider.append( this.$curSlide.clone() );
			}

			if ( this.prevSelector )
				this.$(this.prevSelector).click(this.callback(this.slideLeft));

			if ( this.nextSelector )
				this.$(this.nextSelector).click(this.callback(this.slideRight));

			var self = this;

			if ( this.slideInterval ) {
				this.timeoutId = setTimeout(function(){
					self.slideRight();
				}, this.slideInterval + 3000);
			}

			this.listenTo( drkn.model, 'resize', this.sliderResize);
			this.sliderResize();

		},

		slideRight: function( instant, callback ){

			if ( this.animating )
				return;

			if ( !this.$slider.length )
				return;

			if ( window.blurred === true || !this.isActive() )
				return this.setTimeout();

			if ( typeof instant == 'function' )
				instant = false, callback = instant;

			var $nextSlide = this.$curSlide.next();

			if ( !$nextSlide.length )
				return;

			this.animating = true;

			this.$curSlide = $nextSlide;

			var i = this.$curSlide.index();

			var self = this;
			this.animate( ( -100 * i ) + '%', function(){

				var last = !self.$curSlide.next().length;

				if ( last && self.infiniteSlider ) {
					self.$curSlide = self.$slider.children().first();
					self.$slider.css( self.getField(), self.getValue(0) );
				}

				if ( last && !this.infiniteSlider ) {
					self.$el.addClass('last-slide');
				}

				if ( !self.infiniteSlider )
					self.$el.removeClass('first-slide');

				if ( self.slideInterval ) {
					self.setTimeout();
				}

				if ( callback )
					callback();

				this.animating = false;
			} );

		},

		slideLeft: function( instant, callback ){

			if ( this.animating )
				return;

			if ( !this.$slider.length )
				return;

			if ( window.blurred === true || !this.isActive() )
				return this.setTimeout();

			if ( typeof instant == 'function' )
				instant = false, callback = instant;

			var $prevSlide = this.$curSlide.prev();

			this.animating = true;

			if ( !$prevSlide.length ) {
				var position = -100 * ( this.$slider.children().length - 1) ;
				console.log('moving', this.$slider.get()[0], this.getField(), this.getValue( position + '%' ));
				this.$slider.css( this.getField(), this.getValue( position + '%' ) );
				this.$curSlide = this.$slider.children().last();
				setTimeout(this.callback(function(){
					this.animating = false;
					this.slideLeft();
				}), 50);
				return;
			}
			else
				this.$curSlide = $prevSlide;

			var i = this.$curSlide.index();

			console.log('i', i);

			var self = this;
			this.animate( ( -100 * i ) + '%', function(){

				if ( !self.infiniteSlider && !self.$curSlide.prev().length )
					self.$el.addClass('first-slide');

				if ( !self.infiniteSlider )
					self.$el.removeClass('last-slide');

				if ( callback )
					callback();

				this.animating = false;

			} );

		},

		setCallback: function( callback ){

			var self = this,
				transitionend = this.getTransitionendName(),
				callbacked = false;

			var _callback = function(e){

				if ( !callbacked ) {

					self.$slider.unbind( transitionend );
					callback.apply(self);
					callbacked = true;
				}

			};

			this.$slider.bind( transitionend, _callback );
			setTimeout( _callback, this.animationDuration + 1000 );

		},

		getField: function() {

			if ( this.css3 )
				return drkn.css.transform;
			else
				return 'left';

		},

		getValue: function( pos ) {

			if ( this.css3 )
				return 'translateX(' + pos + ')';
			else
				return pos;

		},

		setTimeout: function(){
			var self = this;
			this.timeout = setTimeout(function(){
				self.slideRight();
			}, this.slideInterval);
		},

		animate: function( position, callback ){

			var name = this.getField(), value = this.getValue( position );

			if ( this.css3 ) {

				this.$slider.addClass('transition');
				this.$slider.css( this.getField(), this.getValue( position ) );

				this.setCallback(function(){

					this.$slider.removeClass('transition');

					callback.apply(this);

				});
			}
			else
			{

				var css = {};
				css[name] = value;

				var self = this;
				this.$slider.animate(css, this.animationDuration, 'linear', function(){
					callback.apply(self);
				});

			}

		},

		getTransitionendName: function(){

			var bodyStyle = document.body.style;

			// repurposed helper
			var cssPrefix = function(suffix) {
				if (!suffix) { return ''; }

				var i, len;

				if (suffix.indexOf('-') >= 0) {
					var parts = (''+suffix).split('-');

					for (i=1, len=parts.length; i<len; i++) {
						parts[i] = parts[i].substr(0, 1).toUpperCase()+parts[i].substr(1);
					}
					suffix =  parts.join('');
				}

				if (suffix in bodyStyle) {
					return suffix;
				}

				suffix = suffix.substr(0, 1).toUpperCase()+suffix.substr(1);

				var prefixes = ['webkit', 'Moz', 'ms', 'O'];
				for (i=0, len=prefixes.length; i<len; i++) {
					if (prefixes[i]+suffix in bodyStyle) {
						return prefixes[i]+suffix;
					}
				}

				return '';
			};

			var transition = cssPrefix('transition');

			var transitionend = {
				'transition': 'transitionend',
				'webkitTransition': 'webkitTransitionEnd',
				'MozTransition': 'transitionend',
				'OTransition': 'oTransitionEnd'
			}[transition];

			return transitionend;
		},

		sliderResize: function() {
			var self = this;
			this.$slider.children().each(function( n ){
				$(this).css('width', $(window).width());
				$(this).css( self.getField(), self.getValue( ( n * 100 ) + '%' ) );
			});
		},

		callback: function( func ){
			var self = this;
			return function(){
				return func.apply(self, arguments);
			};
		}

	});

})(jQuery);