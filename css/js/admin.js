$(document).ready(function(){
  //default admin content:
  $("#adminContent").load("./clients.html",function() {
    $(".admin-aside-link").click(function() {
      //load admin content:
      $("#adminContent").load("../admin/"+$(this).data("admin-link")+".html", function() {
      });
    });
  });
});
