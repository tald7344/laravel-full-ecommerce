var items = (function ($, params) {
  'use strict';
  // Make all products image with the same height
  function fixImageHeight(classList) {
    let image = '';
    let singleProductImage = document.querySelectorAll(classList);
    singleProductImage.forEach((item) => {
      if (classList == '.product-home') {
        image = item.children[0];
        if (item.closest('.related-product-slider')) {
          let width = 240;
          if (window.innerWidth >= 476 && window.innerWidth < 576) width = 193;
          if (window.innerWidth < 476) width = 128;
          image.style.height = (width + 35) + 'px';
        } else {
          image.style.height = (image.clientWidth + 35) + 'px';
        }
      } else {
        image = item.children[0].children[0];
        image.style.height = (image.clientWidth + 15) + 'px';
      }
    });
  }


  function fixResultImageHeight(classList) {
    let singleProductImage = document.querySelectorAll(classList);
    singleProductImage.forEach((item) => {
      let image = item.children[0];
      image.style.height = (image.clientWidth + 15) + 'px';
    });
  }

  // Add To Cart Ajax Function
  function ajaxAddToCart(element) {
    let ajaxUrl = element.target.parentElement.dataset.url;
    let productId = element.target.parentElement.dataset.id;
    $.ajax({
      url: ajaxUrl,
      method: 'POST',
      data: {
        _token: params.token,
        id: productId
      },
      beforeSend: function () {
        $('.add-cart').css({'pointer-events' : 'none', 'filter': 'opacity(0.5)'});
      },
      error: function(response) {
        $('.add-cart').css({'pointer-events' : 'auto', 'filter': 'none'});
      },
      success: function(data, status) {
        if (status == 'success') {
          $('.add-cart').css({'pointer-events' : 'auto', 'filter': 'none'});
          // Add success message
          $('#custom-message').addClass('show');
          $('#custom-message .message-text').html(data.success);
          // display products in shopping cart box
          $('.minicart-product-list').html(JSON.parse(data.cartProducts));
          // display products Quantity
          $('.cart-badge').text(data.totalQty);
          // Display Products Total Prices
          $('.minicart .cart-sub-price').html(data.totalPrice);
        }
      },
    });
  }

  function ajaxAddToWishlist(element) {
    if (element.target.parentNode.classList.contains('wishlist-added')) return;
    let ajaxUrl = element.target.parentElement.dataset.url;
    let productId = element.target.parentElement.dataset.id;
    $.ajax({
      url: ajaxUrl,
      method: 'POST',
      data: {
        _token: params.token,
        id: productId
      },
      beforeSend: function () {
        $('.add-wishlist').css({'pointer-events' : 'none', 'filter': 'opacity(0.5)'});
      },
      error: function(response) {
        $('.add-wishlist').css({'pointer-events' : 'auto', 'filter': 'none'});
        // Add success message
        $('#custom-error-message').addClass('show');
        $('#custom-error-message .message-text').html(response.responseJSON.error);
      },
      success: function(data, status, xhr) {
        if (status == 'success') {
          $('#add_wishlist_' + productId).addClass('wishlist-added');
          $('.add-wishlist').css({'pointer-events' : 'auto', 'filter': 'none'});
          // Add success message
          $('#custom-message').addClass('show');
          $('#custom-message .message-text').html(data.success);
          // display products Quantity
          $('.wishlist-badge').html(data.totalQty);
        }
      },
    });
  }

  return {
    addCart: function() {
      $('.add-cart').on('click', function (e) {
        e.preventDefault();
        ajaxAddToCart(e);
      });
    },
    addWishlist: function() {
      $('.add-wishlist').on('click', function (e) {
        e.preventDefault();
        ajaxAddToWishlist(e);
      });
    },
    fixImageHeight: function (classList) {
      fixImageHeight(classList);
    },
    fixResultImageHeight: function (classList) {
      fixResultImageHeight(classList);
    }

  }
})(window.jQuery, _params);

$(document).ready(function () {
  // Close Custom Model
  $('.modal .close').click(function(){
    $(this).closest('.modal').removeClass('show');
  });
});
