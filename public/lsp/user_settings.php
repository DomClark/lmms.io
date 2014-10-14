<?php
global $LSP_URL;

function apply_settings($password, $password2, $realname) {
	global $LSP_URL;
	if( $password != $password2 ) { 
		display_error('Password mismatch');
		return false;
	} else {
		change_user(SESSION(), $realname, $password);
		display_success('Account settings have been updated', array('<a href="">User Settings</a>', 'Success'), $LSP_URL . "?account=settings");
		return true;
	}
}

if ((POST('settings') != "apply" ) || (!apply_settings(POST('password'), POST('password2'), POST('realname')))) {
	echo '<div class="col-md-9">';
	create_title('<a href="">User Settings</a>');
	$form = new form("$LSP_URL?account=settings", 'User Settings', 'fa-gear'); ?>
	<div class="form-group">
	<label for="username" class="text-muted">User Name:</label>
	<input type="text" name="username" class="form-control" value="<?php echo SESSION(); ?>" disabled="disabled" />
	<p class="help-block">User name cannot be changed</p>
	</div>
	<div class="form-group">
	<label for="realname">Full Name:</label>
	<input type="text" name="realname" class="form-control" value="<?php echo get_user_realname(SESSION()); ?>" />
	</div>
	<div class="form-group">
	<label for="password">Password:</label>
	<input type="password" name="password" class="form-control"/>
	</div>
	<div class="form-group">
	<label for="password2">Confirm Password:</label>
	<input type="password" class="form-control" name="password2" />
	</div>
	<button class="btn btn-primary" type="submit" name="settings" value="apply">
	<span class="fa fa-check"></span>&nbsp;Apply</button>
	<a href="<?php echo $LSP_URL; ?>" class="btn btn-warning"><span class="fa fa-close"></span>&nbsp;Cancel</a>
	<?php $form->close(); echo '</div>';
}
?>

