// Define some utility functions
function postForm(action, data) {
    return $.post('operations.php', {action: action, data: data});
  }
  
  function get(action) {
    return $.get('operations.php', {action: action});
  }
  
  // Event handlers for forms
  $('#category-form').submit(function(event) {
    event.preventDefault();
    const data = {
      name: $('#category-name').val(),
      image: $('#category-image').val()
    };
    postForm('addCategory', data).done(function(response) {
      alert(response);
    });
  });
  
  $('#product-form').submit(function(event) {
    event.preventDefault();
    const data = {
      name: $('#product-name').val(),
      description: $('#product-description').val(),
      images: $('#product-images').val().split(','),
      slug: $('#product-slug').val(),
      categoryId: $('#product-category-id').val()
    };
    postForm('addProduct', data).done(function(response) {
      alert(response);
    });
  });
  
  $('#distributor-form').submit(function(event) {
    event.preventDefault();
    const data = {
      name: $('#distributor-name').val(),
      place: $('#distributor-place').val()
    };
    postForm('addDistributor', data).done(function(response) {
      alert(response);
    });
  });
  
  // Event handlers for get requests
  $('#get-categories').click(function() {
    get('getCategories').done(function(response) {
      $('#category-results').html(response);
    });
  });
  
  $('#get-products').click(function() {
    get('getProducts').done(function(response) {
      $('#product-results').html(response);
    });
  });
  
  $('#get-distributors').click(function() {
    get('getDistributors').done(function(response) {
      $('#distributor-results').html(response);
    });
  });
  