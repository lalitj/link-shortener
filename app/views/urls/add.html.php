<h1> URL to shrink: </h1>
<p style="color:red"><?php echo $error; ?></p>
<?= $this->form->create($url); ?>

<?= $this->form->text('url'); ?>
<?= $this->form->submit('Add Link'); ?>
<?= $this->form->end(); ?>
<?php /**
<form id="form1" name="form1" method="post" action="">
  <input name="url" type="text" id="url" value="http://" size="" />
  <input type="submit" name="Submit" value="Go" />
</form>
*/ ?>