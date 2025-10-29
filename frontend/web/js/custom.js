$(document).ready(function() {
    
    // Add to Cart Animation
    $('.btn-add-to-cart').click(function(e) {
        e.preventDefault();
        
        var $btn = $(this);
        var originalText = $btn.html();
        
        // Add loading state
        $btn.addClass('loading').html('<i class="fas fa-spinner fa-spin"></i> Adding...');
        
        var productId = $btn.data('id');
        var url = $btn.data('url');
        
        // Simulate API call (replace with actual AJAX)
        setTimeout(function() {
            $btn.removeClass('loading').html('<i class="fas fa-check"></i> Added!').addClass('btn-success').removeClass('btn-primary');
            
            // Update cart count
            var currentCount = parseInt($('#cart-quantity').text()) || 0;
            $('#cart-quantity').text(currentCount + 1);
            
            // Reset button after 2 seconds
            setTimeout(function() {
                $btn.html(originalText).removeClass('btn-success').addClass('btn-primary');
            }, 2000);
        }, 1000);
    });
    
    // Wishlist Toggle
    $('.wishlist-btn').click(function(e) {
        e.preventDefault();
        var $btn = $(this);
        var $icon = $btn.find('i');
        
        if ($icon.hasClass('far')) {
            $icon.removeClass('far').addClass('fas');
            $btn.removeClass('btn-outline-danger').addClass('btn-danger text-white');
        } else {
            $icon.removeClass('fas').addClass('far');
            $btn.removeClass('btn-danger text-white').addClass('btn-outline-danger');
        }
    });
    
    // Quick View Modal (placeholder)
    $('.quick-view').click(function(e) {
        e.preventDefault();
        alert('Quick view feature coming soon!');
    });
    
    // View Toggle (Grid/List)
    $('#grid-view').click(function() {
        $('#products-container').removeClass('list-view').addClass('grid-view');
        $('.product-item').removeClass('col-12').addClass('col-lg-4 col-md-6');
        $(this).addClass('btn-primary').removeClass('btn-outline-secondary');
        $('#list-view').removeClass('btn-primary').addClass('btn-outline-secondary');
    });
    
    $('#list-view').click(function() {
        $('#products-container').removeClass('grid-view').addClass('list-view');
        $('.product-item').removeClass('col-lg-4 col-md-6').addClass('col-12');
        $(this).addClass('btn-primary').removeClass('btn-outline-secondary');
        $('#grid-view').removeClass('btn-primary').addClass('btn-outline-secondary');
    });
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
    
    // Product card hover effects
    $('.product-card').hover(
        function() {
            $(this).find('.card-body').addClass('text-center');
        },
        function() {
            $(this).find('.card-body').removeClass('text-center');
        }
    );
    
    // Auto-hide alerts
    $('.alert').delay(5000).fadeOut('slow');
    
    // Loading states for all buttons
    $('.btn').not('.btn-add-to-cart').click(function() {
        var $btn = $(this);
        if (!$btn.hasClass('no-loading')) {
            var originalText = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin"></i> Loading...');
            
            setTimeout(function() {
                $btn.html(originalText);
            }, 1000);
        }
    });
    
});
