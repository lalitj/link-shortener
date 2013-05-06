<table width="100%">
<tr align="left">
	<th>#</th>
	<th>url</th>
	<th>shortlink</th>
	<th>date</th>
	<th>views</th>
	<th>Admin</th>
	<th>Edit</th>
	<th>Delete</th>
</tr>
<?php
$c = 0;
foreach($urls as $keys => $url){ ?>
	<tr>
	<td><?php echo $c++; ?></td>
	<td><?php echo $url->url; ?></td>
	<td><?php echo $url->shortlink; ?></td>
	<td><?php echo $url->date; ?></td>
	<td><?php echo $url->views; ?></td>
	<td><?= $this->html->link('Admin', ['shortcode' => $url->shortlink, 'Urls::admin']) ?></td>
	<td><?= $this->html->link('Edit', ['Urls::edit','shortcode' => $url->shortlink]) ?></td>
	<td><?= $this->html->link('Delete', ['Urls::delete','shortcode' => $url->shortlink]) ?></td>
	</tr>
<?php }
?>
</table>