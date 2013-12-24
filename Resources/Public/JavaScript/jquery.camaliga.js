/*
 * jQuery Camaliga v1.0.0
 * Copyright 2013 Kurt Gusbeth and enavu
 * Note: this JavaScript plugin is based on the carousel from enavu:
 * http://web.enavu.com/tutorials/making-a-jquery-infinite-carousel-with-nice-features/
 */
(function($) {
 
   $.camaliga = function(element, options) {
      this.options = {};
       
      element.data('camaliga', this);
      
      this.init = function(element, options) {
        this.options = $.extend({}, $.camaliga.defaultOptions, options); 
      
		if (element.is('[id]'))
		  this.options.ul_name = '#'+element.attr('id');
		else
		  this.options.ul_name = '.'+element.attr('class');
		this.options.li_name = ' '+this.options.li_name;
		this.options.count = $(this.options.ul_name+this.options.li_name).length;
		this.options.current = 1;
		var item_width = parseInt(this.options.item_width);
		if (item_width==0 || isNaN(item_width))
			item_width = $(this.options.ul_name+this.options.li_name).outerWidth();
		this.options.item_width = item_width;
		
		/*move the last list item before the first item. The purpose of this is
		if the user clicks to slide left he will be able to see the last item.*/
		if (this.options.infinite == 1) {
			$(this.options.ul_name+this.options.li_name+':first').before($(this.options.ul_name+this.options.li_name+':last'));
			$(this.options.ul_name).css({'left' : '-'+item_width+'px'});
		} else {
			if (this.options.left_scroll.length>0)
				$(this.options.left_scroll).addClass('camaliga_first');
			this.options.auto_slide = 0;
			this.options.hover_pause = 0;
			this.options.key_slide = 0;
		}
		
		//check if auto sliding is enabled
		if (this.options.auto_slide == 1){
			var ul_name = this.options.ul_name;
			var auto_slide_seconds = this.options.auto_slide_seconds;
			
			/*set the interval (loop) to call function slide with option 'right'
			and set the interval time to the variable we declared previously */
			var timer = setInterval(function(){$(ul_name).data('camaliga').slideTo('right')}, auto_slide_seconds);
		}
		
		//check if hover pause is enabled
		if (this.options.hover_pause == 1){
			var ul_name = this.options.ul_name;
			var auto_slide_seconds = this.options.auto_slide_seconds;
			
			//when hovered over the list
			$(ul_name).hover(function(){
				//stop the interval
				clearInterval(timer)
			},function(){
				//and when mouseout start it again
				timer = setInterval(function(){$(ul_name).data('camaliga').slideTo('right')}, auto_slide_seconds);
			});
		}
		
		//check if key sliding is enabled: funktioniert noch nicht!
		if(this.options.key_slide == 1){
			var ul_name = this.options.ul_name;
			
			//binding keypress function
			$(document).bind('keypress', function(e) {
				//keyCode for left arrow is 37 and for right it's 39 '
				if(e.keyCode==37){
						//initialize the slide to left function
						$(ul_name).data('camaliga').slideTo('left');
				}else if(e.keyCode==39){
						//initialize the slide to right function
						$(ul_name).data('camaliga').slideTo('right');
				}
			});
		}
      };
      
      //Public function
      this.slideTo = function(where) {
			var ul_name = this.options.ul_name;
			var li_name = this.options.li_name;
        	var infinite = this.options.infinite;
			var item_width = parseInt(this.options.item_width);
			
			/* using a if statement and the where variable check
			we will check where the user wants to slide (left or right)*/
			if(where == 'left'){
				if (infinite==0 && this.options.current==1) return;
				else if (infinite==0) {
					this.options.current--;
					if (this.options.current==1 && this.options.left_scroll.length>0)
						$(this.options.left_scroll).addClass('camaliga_first');
					if (this.options.current==this.options.count-1 && this.options.right_scroll.length>0)
						$(this.options.right_scroll).removeClass('camaliga_last');
				}
				//...calculating the new left indent of the unordered list (ul) for left sliding
				var left_indent = parseInt($(ul_name).css('left')) + item_width;
			}else{
				if (infinite==0 && this.options.current==this.options.count) return;
				else if (infinite==0) {
					this.options.current++;
					if (this.options.current==2 && this.options.left_scroll.length>0)
						$(this.options.left_scroll).removeClass('camaliga_first');
					if (this.options.current==this.options.count && this.options.right_scroll.length>0)
						$(this.options.right_scroll).addClass('camaliga_last');
				}
				//...calculating the new left indent of the unordered list (ul) for right sliding
				var left_indent = parseInt($(ul_name).css('left')) - item_width;
			}

			//make the sliding effect using jQuery's animate function... '
			$(ul_name+':not(:animated)').animate({'left' : left_indent},500,function(){
			  if (infinite==1) {
				/* when the animation finishes use the if statement again, and make an ilussion
				of infinity by changing place of last or first item*/
				if(where == 'left'){
					//...and if it slided to left we put the last item before the first item
					$(ul_name+li_name+':first').before($(ul_name+li_name+':last'));
				}else{
					//...and if it slided to right we put the first item after the last item
					$(ul_name+li_name+':last').after($(ul_name+li_name+':first'));
				}

				//...and then just get back the default left indent
				$(ul_name).css({'left' : '-'+item_width+'px'});
			  }
			});
      };
      
      this.init(element, options);
   };
  
   $.fn.camaliga = function(options) { //Using only one method off of $.fn  
      return this.each(function() {
         (new $.camaliga($(this), options));              
      });        
   };
    
   $.camaliga.defaultOptions = {
      li_name: 'li',
      left_scroll: '',
      right_scroll: '',
      auto_slide: 0,
	  hover_pause: 0,
	  key_slide: 0,
	  infinite: 1,
	  item_width: 0,
	  auto_slide_seconds: 7500	// milliseconds
   }
})(jQuery);