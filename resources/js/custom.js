function setCookie(name, value, expire) {
  var exdate = new Date();
  exdate.setDate(exdate.getDate() + expire);
  document.cookie = name + "=" + value + "; expires="+ exdate.toUTCString();
}


$(document).ready(function() {

  function loading_show() {
    $('#loading').html("<img src='http://127.0.0.1/dashboard/resources/img/loading.gif'").fadeIn('fast');
  }

  function loading_hide() {
    $('#loading').fadeOut();
  }

  function loadData(page) {
    loading_show();

    $.ajax({
      type  : "POST",
      url   : "load_data.php",
      data  : "page"+page,
      success : function(msg) {
        $('#container').ajaxComplete(function(event, request, settings) {
          loading_hide();
          $('#container').html(msg);
        });
      }
    });
  }

});