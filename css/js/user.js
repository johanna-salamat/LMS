$(document).ready(function(){
  //default user content:
  $("#userContent").load("./account.html",function() {
    $(".user-aside-link").click(function() {
      //load user content:
      $("#userContent").load("../user/"+$(this).data("user-link")+".html", function() {
      });
    });
    /**/
  });
});
