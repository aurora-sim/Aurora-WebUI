<?php if($displaySlideEffect) { ?>

<script type="text/javascript">
$(document).ready(function () {
	var colour = $("#overlay");
	var content = $("#hover");
	content.hide();
	colour.hide();
	$("#ContainerSlideEffect").hover(function() {
		content.stop().show().css({ "left" : "-450px" }).animate({left : 0}, 300);
		colour.stop().fadeTo(500, .9)
	}
	,function() {
		content.stop().animate({left : 250}, 300);
		colour.stop().fadeTo(500, 0)
	});
});

</script>

<div id="ContainerSlideEffect">
	<div id="overlay"></div>
  <div id="hover">
    <h1>Digital Concepts - DigiGrids 3D</h1>
    <p>Salles de Chat 3D 100% Gratuites!</p>
    <p><a href="index.php?page=register" title="Rejoins-nous dés aujourd'hui!">&raquo; Rejoins-nous dés aujourd'hui!</a></p>
  </div>
</div>
<?php } ?>

