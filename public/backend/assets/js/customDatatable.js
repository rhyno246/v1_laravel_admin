
$(document).on('click' , 'input[name=main-checkbox]' , function(){
    if(this.checked){
      $('input[name=ids]').each(function(){
        this.checked = true
      })
    }else{
      $('input[name=ids]').each(function(){
        this.checked = false
      })
    }
    toggleDeleteButton ();
  })
  
  $(document).on('change' , 'input[name=ids]' , function(){
    if($('input[name=ids]').length == $('input[name=ids]:checked').length){
      $('input[name=main-checkbox]').prop('checked', true);
    }else{
      $('input[name=main-checkbox]').prop('checked', false);
    }
    toggleDeleteButton ();
  })
  
  function toggleDeleteButton () {
    if($('input[name=ids]:checked').length > 0){
      $('.deleteSeleted').text('Xóa (' +  $('input[name=ids]:checked').length + ') dữ liệu').removeClass('d-none');
    }else{
      $('.deleteSeleted').addClass('d-none');
    }
  }
  
  
  
  var table = $(".table-page").dataTable({
    "columnDefs": [
      { 
        "sortable": false, 
        "targets": [2,3]
      }
    ]
  });
  $('.table-page').on('page.dt', function () {
    $('input[name=ids]').each(function () {
        this.checked = false;
    })
    $('input[name=main-checkbox]').prop('checked', false);
    $('.deleteSeleted').addClass('d-none');
  })
  