<?php
/**
 * @package observo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'parts/featured-image-header' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'observo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php observo_entry_footer(); ?>
</article><!-- #post-## -->

<?php
$messageSent = false;
$formError = false;
$formErrorMessages = array();

if ( isset($_POST['formSubmit']) ) {
	if ( !isset($_POST['contact-name']) || empty($_POST['contact-name']) || trim($_POST['contact-name']) === '' ) {
		$formError = true;
		$formErrorMessages['emptyName'] = '<p>Please Enter Your Name</p>';
	} else {
		$senderName = trim($_POST['contact-name']);
	}

	if ( !isset($_POST['contact-email']) || empty($_POST['contact-email']) || trim($_POST['contact-email']) === '' ) {
		$formError = true;
		$formErrorMessages['emptyEmail'] = '<p>Please Enter Your Email Address</p>';
	} else if ( !filter_var(trim($_POST['contact-email']), FILTER_VALIDATE_EMAIL) ) {
		$formError = true;
		$formErrorMessages['invalidEmail'] = '<p>Please Enter A Valid Email Address</p>';
	} else {
		$senderEmail = trim($_POST['contact-email']);
	}

	if ( !isset($_POST['contact-message']) || empty($_POST['contact-message']) || trim($_POST['contact-message']) === '' ) {
		$formError = true;
		$formErrorMessages['emptyMessage'] = '<p>Please Enter A Message</p>';
	} else {
		$senderMessage = stripslashes(trim($_POST['contact-message']));
	}

	if($formError) {
		echo '<p class="result-message-error">Sorry, there are some errors...</p>';
	} else {			
		$siteName = get_bloginfo('name');
		$to = get_option('admin_email');
		$subject = 'Message From ' . $senderName . ' - ' . $siteName . ' Contact Form';
		$body = "Name: $senderName \n\nEmail: $senderEmail \n\nMessage: $senderMessage";
		$headers = 'From: '.$senderName.' <'.$senderEmail.'>' . "\r\n" . 'Reply-To: ' . $senderEmail;

		wp_mail($to, $subject, $body, $headers);
		$messageSent = true;
	}
}
?>

<?php
if ($messageSent) {
	echo '<p class="result-message-success">Thank You! We will respond to you shortly.</p>';
} else {
?>
<form action="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" id="ws-contact-form" method="post">
	<div class="contact-row">
		<label for="contact-name">Name</label>
		<input type="text" name="contact-name" id="contact-name" class="contact-name" value="<?php if(isset($_POST['contact-name'])) echo $_POST['contact-name'];?>">
		<?php if(isset($formErrorMessages['emptyName'])) { ?>
			<div class="form-error"><?php echo $formErrorMessages['emptyName']; ?></div> 
		<?php } ?>
	</div>
	<div class="contact-row">
		<label for="contact-email">Email</label>
		<input type="text" name="contact-email" id="contact-email" class="contact-email" value="<?php if(isset($_POST['contact-email'])) echo $_POST['contact-email'];?>">
		<?php if(isset($formErrorMessages['emptyEmail'])) { ?>
			<div class="form-error"><?php echo $formErrorMessages['emptyEmail']; ?></div> 
		<?php } ?>
		<?php if(isset($formErrorMessages['invalidEmail'])) { ?>
			<div class="form-error"><?php echo $formErrorMessages['invalidEmail']; ?></div> 
		<?php } ?>
	</div>
	<div class="contact-row">
		<label for="contact-message">Message</label>
		<textarea type="text" name="contact-message" id="contact-message" class="contact-message"><?php if(isset($_POST['contact-message'])) echo stripcslashes($_POST['contact-message']);?></textarea>
		<?php if(isset($formErrorMessages['emptyMessage'])) { ?>
			<div class="form-error"><?php echo $formErrorMessages['emptyMessage']; ?></div> 
		<?php } ?>
	</div>
	<div class="contact-row">
		<input type="hidden" name="formSubmit" id="formSubmit" value="true" />
		<input type="submit" class="contact-submit-button" value="Send Message">
	</div>
</form>
<?php
}
?>