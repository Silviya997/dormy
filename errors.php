<?php 
if (count($errors) > 0) : ?>
  <small class="error" style="color:red">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
	  </small>
<?php  endif ?>

