$(document).ready(function(){
  //default home content:
  $("#mainHeader").load("../application/views/layout/header.php",function() {
    $("#mainContent").load("./layout/home.html");
    $(".header-link").click(function() {
      //load home content:
      $("#mainContent").load("../Koala/"+$(this).data("link")+".html", function() {
      });
    });
  });
  $("#mainFooter").load("../Koala/footer.html");
});
