<h2>Viewing #<?php echo $message->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $message->name; ?></p>
<p>
	<strong>Message:</strong>
	<?php echo $message->message; ?></p>

<?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?> |
<?php echo Html::anchor('messages', 'Back'); ?>