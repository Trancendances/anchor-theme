<footer>
	<p><a href="http://www.trancendances.fr/">Trancendances</a> &copy; 2011-2016<br />
	Site réalisé par <a href="http://www.frenchlabs.net/" target="_blank" title="Frenchlabs">Frenchlabs</a> - <a href="http://www.trancendances.fr/legals" target="_blank" title="Mentions légales">Mentions légales</a></p>
</footer>
<script>
var base = '<?php echo theme_url(); ?>';
  document.write('<script src='+base+'javascripts/vendor/'
    + ('__proto__' in {} ? 'zepto' : 'jquery')
    + '.js><\/script>');
</script>

<script src="<?php echo theme_url('javascripts/foundation/foundation.js'); ?>"></script>
<script src="<?php echo theme_url('javascripts/foundation/foundation.topbar.js'); ?>"></script>
<!-- Other JS plugins can be included here -->

<script>
$(document).foundation();
</script>
</body>
</html>
