<?php if(get_current_user_id()==0){  ?>
<script>
window.location.href = "<?php echo site_url(); ?>";
</script>
<?php } ?>
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="card mb-3">
                                <div class="card-body">
	<form action="#" method="post" name="addpost" id="addpost" enctype="multipart/form-data" >
                                        <div class="row">
                                       <div class="col-md-4 col-lg-4">	
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <div class="img_new_delete" id="img_error" >
 <!-- <img id="blah" style="display:none;" src="#" />-->
<div id="review_images1" >
</div>
<a id="uploadbtn1"  href="javascript:;" onclick="opengalley1()">
<img  src="<?php echo site_url(); ?>/wp-content/themes/videos/assets/images/upload.jpg" style="width:100%;" alt="" /></a>
<a href="javascript:;" onclick="opengalley1()" class="form-control-file btn btn_green btn-sm btn-block mt-2" ><i class="fas fa-upload"></i> Upload</a>  
 <!-- <input  type="file" name="thumbimage[]" id="thumbimage" accept="image/*"  class="form-control-file btn btn_green btn-sm btn-block mt-2">
-->
									</div>
									<center><img id="loader_upload_img1" src="<?php echo plugin_dir_url(''); ?>theme_options/assets/images/loadingimg.gif" style="height: 70px; display: none;">
									</center>

                                        </div>
                                        </div>
										 
                                        <div class="col-md-4 col-lg-4">	
                                        <div class="form-group">
                                            <label>Upload Video</label>
                                            <div class="img_new_delete" id="video_error" >

<div id="review_images" >
</div><a id="uploadbtn"  href="javascript:;" onclick="opengalley()">
<img  src="<?php echo site_url(); ?>/wp-content/themes/videos/assets/images/upload.jpg" style="width:100%;" alt="" /></a>
<a href="javascript:;" onclick="opengalley()" class="file_multi_video btn btn-danger btn-sm btn-block mt-2" ><i class="fas fa-upload"></i> Upload</a>
<!--
	<input required type="file" name="file[]" class="file_multi_video btn btn-danger btn-sm btn-block mt-2" accept="video/*" class="form-control-file">-->

											</div>
											<center>
											<img id="loader_upload_img" src="<?php echo plugin_dir_url(''); ?>theme_options/assets/images/loadingimg.gif" style="height: 70px; display: none;">
<div class="progress" id="oldcsv" >
    <div class="progress-bar" id="oldcsvbar" ></div>
</div>
<div class="uploadmessage" id="uploadStatusold"></div>										

										</center>


                                        </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12"></div>
                                        <div class="col-md-8 col-lg-8">	
                                        <div class="form-group">
                                            <label for="userName">Video Title<span class="text-danger">*</span></label>
                                            <input  type="text" name="post_title" id="post_title" class="form-control" >
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-8 col-lg-8">	
                                        <div class="form-group">
                                        <label for="pass1">Video Category<span class="text-danger"></span></label>
                                       <select class="form-control select2" id="example3" name="pcta[]" multiple="multiple">
									   <?php
$category_parent_ids="";
$taxonomy = 'category';
$orderby = 'id';
$show_count = 0; 
$pad_counts = 0; 
$hierarchical = 1; 
$title = '';
$empty = 0;


$args = array(
'taxonomy' => $taxonomy,
'orderby' => $orderby,
'show_count' => $show_count,
'pad_counts' => $pad_counts,
'hierarchical' => $hierarchical,
'title_li' => $title,
'hide_empty' => $empty
);
$all_categories = get_categories( $args );
	?>
			<?php 
		if(!empty($all_categories)){
		foreach($all_categories as $cat){ ?>
									   
                                        <option value="<?php echo $cat->term_id;  ?>" ><?php echo $cat->name;  ?></option>
										
							<?php } } ?>			
                                    	</select>
                                        </div>
                                        </div>
										
									
                                        <div class="col-md-8 col-lg-8">	
                                        <div class="form-group">
                                        <label for="pass1">Video Tag<span class="text-danger"></span></label>
                                       <select class="form-control select21" id="example31" name="ptag[]" multiple="multiple">
		<?php 
$tags = get_tags(array(
  'hide_empty' => false
));
if(!empty($tags)){
foreach ($tags as $tag) {
?>

									   
                                        <option value="<?php echo $tag->slug;  ?>" ><?php echo $tag->name;  ?></option>
										
							<?php } } ?>			
                                    	</select>
                                        </div>
                                        </div>									


                                        <div class="col-md-8 col-lg-8">	
                                        <div class="form-group">
                                            <label>About</label>
                                            <div>
                                                <textarea name="post_description" id="post_description" class="form-control text_wrap_form"></textarea>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-lg-12">	
                                        <div class="form-group m-b-0">
                                            <button class="btn btn-primary black_wrap5" type="submit">Submit</button>
                                        </div>
                                        </div>
										</div>
<input type="hidden" id="image_data" name="image_data" value="" />
<input type="hidden" id="image_data2" name="image_data2" value="" />

</form>
<img id="loader_img" src="<?php echo plugin_dir_url(''); ?>theme_options/assets/images/loader.gif" style="height: 50px; display: none;">
<p id="targetLayer" ></p>
                                </div>
                            </div>
                        </div>

<?php /* ?>	
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<strong>Create </strong> Blog
</div>
<div class="card-body card-block">
<form action="#" method="post" name="addpost" id="addpost" enctype="multipart/form-data" class="form-horizontal">
<div class="row form-group">
<div class="col col-md-3">
<label for="text-input" class=" form-control-label">Title</label>
</div>
<div class="col-12 col-md-9">
<input type="text" name="post_title" id="post_title"  class="form-control">
</div>
</div>

<div class="row form-group">
<div class="col col-md-3">
<label for="textarea-input" class=" form-control-label">Description</label>
</div>
<div class="col-12 col-md-9">
<textarea name="post_description" id="post_description" rows="9" class="form-control"></textarea>
</div>
</div>





<div class="row form-group">
<div class="col col-md-3">
<label class=" form-control-label">Select Categorys</label>
</div>
<div class="col col-md-9">
<div class="form-check-inline form-check">
	<?php
$category_parent_ids="";
$taxonomy = 'category';
$orderby = 'id';
$show_count = 0; 
$pad_counts = 0; 
$hierarchical = 1; 
$title = '';
$empty = 0;


$args = array(
'taxonomy' => $taxonomy,
'orderby' => $orderby,
'show_count' => $show_count,
'pad_counts' => $pad_counts,
'hierarchical' => $hierarchical,
'title_li' => $title,
'hide_empty' => $empty
);
$all_categories = get_categories( $args );
	?>
		<?php 
		if(!empty($all_categories)){
		foreach($all_categories as $cat){ ?>

<label for="cat_<?php echo $cat->term_id; ?>" class="form-check-label ">
<input type="checkbox" value="<?php echo $cat->term_id;  ?>" name="pcta[]" id="cat_<?php echo $cat->term_id;  ?>"  class="form-check-input">
<?php echo $cat->name;  ?>
</label>
<?php } } ?>

</div>
</div>
</div>

 <div class="row form-group">
<div class="col col-md-3">
<label class=" form-control-label">Select Tags</label>
</div>
<div class="col col-md-9">
<div class="form-check-inline form-check">
<?php 
$tags = get_tags(array(
  'hide_empty' => false
));
if(!empty($tags)){
foreach ($tags as $tag) {
?>
<label for="ptag_<?php echo $tag->slug; ?>" class="form-check-label ">
<input type="checkbox" name="ptag[]" id="ptag_<?php echo $tag->slug; ?>" value="<?php echo $tag->slug;  ?>"  class="form-check-input">
<?php echo $tag->name;  ?>
</label>
<?php 
}	
}
?>
</div>
</div>
</div>





<div class="row form-group">
<div class="col col-md-3">
<label for="file-input" class=" form-control-label">
Image Upload
</label>
</div>
<div class="col-12 col-md-9">
<input type="file" name="thumbimage[]" id="thumbimage" accept="image/*"  class="form-control-file">
<img id="blah" style="height:70px; width:70px;display:none;border: solid 3px #000;margin: 10px;" src="#" />

</div>
</div>

<div class="row form-group">
<div class="col col-md-3">
<label for="file-input" class=" form-control-label">
Image Upload (Multiple)
</label>
</div>
<div class="col-12 col-md-9">
<button type="button"  onclick="opengalley();" class="btn  btn-sm bt_add1" >Choose File</button>
<button type="button" onclick="submitFile();" id="uploadbtn" class="btn  btn-sm bt_add2" >Upload</button>

<img id="loader_upload_img" src="<?php echo plugin_dir_url(''); ?>theme_options/assets/images/loader.gif" style="height: 50px; display: none;">

<div id="review_images" >
</div>
</div>
</div>



<div class="row form-group">
<div class="col col-md-3">
<label for="file-input" class=" form-control-label">
Video Upload
</label>
</div>
<div class="col-12 col-md-9">
<input type="file" name="file[]" class="file_multi_video" accept="video/*" class="form-control-file">
<video width="400" controls id="vd" style="display:none;" >
  <source src="#" id="video_here">
    Your browser does not support HTML5 video.
</video>
</div>
</div>



<div class="row form-group">
<div class="col col-md-3">
<label for="file-input" class=" form-control-label"></label>
</div>
<div class="col-12 col-md-9">
<button type="submit" class="btn btn-primary btn-sm bt_add">Submit</button>
</div>
</div>
<input type="hidden" id="image_data" name="image_data" value="" />
</form>
<img id="loader_img" src="<?php echo plugin_dir_url(''); ?>theme_options/assets/images/loader.gif" style="height: 50px; display: none;">
<p id="targetLayer" ></p>



	 
</div>
</div>
</div>
</div>
<?php */ ?>
	
<form name="upload_files" id="upload_files" action="" method="" >

<input style="opacity:0;"  type="file"  accept="video/*"  name="upload_image[]" id="upload_image" multiple />
<input type="hidden" id="image_data1" name="image_data1" value="" />
<input id="fileup" style="opacity:0;" type="submit" value="sub" style="" />
</form> 

<form name="upload_files1" id="upload_files1" action="" method="" >

<input style="opacity:0;"  type="file" accept="image/*"  name="upload_image[]" id="upload_image1" multiple />
<input type="hidden" id="image_data11" name="image_data11" value="" />
<input id="fileup" style="opacity:0;" type="submit" value="sub" style="" />
</form> 
		
			

<script>

var j = jQuery.noConflict();
j(document).on("change", ".file_multi_video", function(evt) {
	
  j("#vd").show();
  var $source = j('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});


j(document).ready(function(){

var k=0;
function displayHello() {
 k++;
 if(k<99){
 j("#oldcsvbar").width(k+'%');
 j("#oldcsvbar").html(k+'%');
 }
}

	
j("#upload_files").on('submit',(function(e){
e.preventDefault();
j('#loader_upload_img').show();
setInterval( displayHello , 1000);
j.ajax({
url: "<?php echo plugin_dir_url(''); ?>theme_options/upload_image.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
  beforeSend: function(){
                j("#oldcsvbar").width('0%');
             
            },
            error:function(){
                j('#uploadStatusold').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
success: function(php_script_response){
	k=100;

	var stringified = JSON.stringify(php_script_response);
var obj = JSON.parse(stringified);
	console.log(php_script_response);
	var obj =j.parseJSON(php_script_response);
	j('#uploadbtn').hide();
				if(obj.type==0){
				j('#update_pro').html("<span style='color:red;'>"+obj.message+"</span>");
				j('#loader_upload_img').hide();
				}else{
				j('#review_images').append(obj.message);
				j('#image_data').val(obj.message_data);
				j('#image_data1').val(obj.message_data);
				j('#loader_upload_img').hide();
				//setTimeout(function(){ window.location = "<?php echo get_permalink(); ?>"; }, 3000);
				j("#upload_files")[0].reset()
				 j("#oldcsvbar").width(k+'%');
                j("#oldcsvbar").html(k+'%');	
					} 


},
error: function(){} 	        
});
}));



j("#upload_files1").on('submit',(function(e){
e.preventDefault();
j('#loader_upload_img1').show();
j.ajax({
url: "<?php echo plugin_dir_url(''); ?>theme_options/upload_image1.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(php_script_response){


	var stringified = JSON.stringify(php_script_response);
var obj = JSON.parse(stringified);
	console.log(php_script_response);
	var obj =j.parseJSON(php_script_response);
	j('#uploadbtn1').hide();
				if(obj.type==0){
				j('#update_pro').html("<span style='color:red;'>"+obj.message+"</span>");
				j('#loader_upload_img1').hide();
				}else{
				j('#review_images1').append(obj.message);
				j('#image_data2').val(obj.message_data);
				j('#image_data11').val(obj.message_data);
				j('#loader_upload_img1').hide();
				//setTimeout(function(){ window.location = "<?php echo get_permalink(); ?>"; }, 3000);
				j("#upload_files1")[0].reset()
					} 


},
error: function(){} 	        
});
}));


	

 }); 
 j(document).ready(function(){
	 j('#review_images').on('click', '.remove_image', function() {

		 var remove_image_id = j(this).attr('id');
		 var image_data = j("#image_data").val();
		 j('#loader_upload_img').show();
		   j.ajax({
            type:'POST',
            url:'<?php echo plugin_dir_url(''); ?>theme_options/delete_image.php',
            data:{remove_image_id:remove_image_id,image_data:image_data},
            success:function(html){
				var stringified = JSON.stringify(html);
var obj = JSON.parse(stringified);
	
		var obj =j.parseJSON(html);
		
                j('#post_'+obj.remove_image_id).remove();
                j('#image_data').val(obj.message);
				j('#image_data1').val(obj.message);
				j('#loader_upload_img').hide();
				
            }
        });
		
	});	
	
});


</script>

<script>
var j = jQuery.noConflict();
j(document).ready(function (e){
j("#addpost").on('submit',(function(e){
e.preventDefault();

var image_data=j("#image_data2").val();
var image_data2=j("#image_data").val();
var post_title=j("#post_title").val();
var example3=j("#example3").val();
var example31=j("#example31").val();


if(image_data==""){
j("#img_error").addClass('error');
 j('html, body').animate({scrollTop:0}, 'slow');	
}else if(image_data2==""){
j("#video_error").addClass('error');
	j("#img_error").removeClass("error");
	 j('html, body').animate({scrollTop:0}, 'slow');
}else if(post_title==""){
	  j("#post_title").addClass('error');
	  j("#img_error").removeClass("error");
	  j("#video_error").removeClass("error");
	  
 j('html, body').animate({scrollTop:0}, 'slow');
	  
}else{	
 j("#post_title").removeClass("error");
 j("#img_error").removeClass("error");
	  j("#video_error").removeClass("error");
j('#loader_img').show();	
j.ajax({
url: "<?php echo plugin_dir_url(''); ?>theme_options/add_listing.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
		var stringified = JSON.stringify(data);
var obj = JSON.parse(stringified);
var obj =j.parseJSON(data);
	
				if(obj.type==0){
				j('#targetLayer').html("<span style='color:red;'>"+obj.message+"</span>");
				j('#loader_img').hide();
				}else{
				j('#targetLayer').html("<span style='color:green;'>"+obj.message+"</span>");
				j('#loader_img').hide();
				 setTimeout(function(){ window.location = "<?php echo get_permalink() ?>"; }, 3000); 		
					} 
},
error: function(){} 	        
});

}

}));
});
</script>

<script>

j('#upload_image').on('change', function(){
    j("#upload_files").submit();
});

j('#upload_image1').on('change', function(){
    j("#upload_files1").submit();
});


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

	//alert();
    reader.onload = function(e) {
      j('#blah').attr('src', e.target.result);
	  
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }else{
	j('#blah').attr('src', '#');
	j("#blah").hide();
  }
}

j("#thumbimage").change(function() {
	j("#blah").show();
  readURL(this);
});


function opengalley(){
	j("#upload_image").click();
}
function opengalley1(){
	j("#upload_image1").click();
}

function  submitFile(){
	j('#fileup').click();
}
</script>
