/**
 * Admin Panel
 *
 */

 jQuery(document).ready(function($){
  
     var header_logo_uploader;
  
     $('#upload_header_logo_button').click(function(e) {
  
         e.preventDefault();
  
         //If the uploader object has already been created, reopen the dialog
         if (header_logo_uploader) {
             header_logo_uploader.open();
             return;
         }
  
         //Extend the wp.media object
         header_logo_uploader = wp.media.frames.file_frame = wp.media({
             title: 'Choose Image',
             button: {
                 text: 'Choose Image'
             },
             multiple: false
         });
  
         //When a file is selected, grab the URL and set it as the text field's value
         header_logo_uploader.on('select', function() {
             attachment = header_logo_uploader.state().get('selection').first().toJSON();
             $('#upload_header_logo').val(attachment.url);
         });
  
         //Open the uploader dialog
         header_logo_uploader.open();
  
     });
  
     var footer_logo_uploader;
  
     $('#upload_footer_logo_button').click(function(e) {
  
         e.preventDefault();
  
         //If the uploader object has already been created, reopen the dialog
         if (footer_logo_uploader) {
             footer_logo_uploader.open();
             return;
         }
  
         //Extend the wp.media object
         footer_logo_uploader = wp.media.frames.file_frame = wp.media({
             title: 'Choose Image',
             button: {
                 text: 'Choose Image'
             },
             multiple: false
         });
  
         //When a file is selected, grab the URL and set it as the text field's value
         footer_logo_uploader.on('select', function() {
             attachment = footer_logo_uploader.state().get('selection').first().toJSON();
             $('#upload_footer_logo').val(attachment.url);
         });
  
         //Open the uploader dialog
         footer_logo_uploader.open();
  
     });  
  
 });