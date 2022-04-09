<?php if(get_current_user_id()==0){  ?>
<script>
window.location.href = "<?php echo site_url(); ?>";
</script>
<?php } ?>
<style>
.blog_list img {
 width: 100%;
height: 150px;
max-width: 100%;
}


</style>

<?php 
$user_id=get_current_user_id();
global $smof_data;
?>

 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <form name="Sendtosuppliersform" id="Sendtosuppliersform" method="" action="" >
                            <div class="card mb-3">
                                <div class="card-header">
                                    <span class="pull-right">
									<button type="submit" name="sendto" id="sendto" class="btn btn-primary btn-sm" ><i class="fas fa-check" aria-hidden="true"></i> Redmee </button>
									<a href="<?php echo get_permalink(7); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus" aria-hidden="true"></i> Add new video</a>
									
									</span>                                </div>
                                <!-- end card-header -->

                                <div class="card-body">
									<div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
												     <th style="min-width: 50px">Select</th>
                                                    <th style="min-width: 300px">Video details</th>
                                                    <th style="min-width:110px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             									<?php 
										
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args1 = array( 'post_type' => 'post', 'posts_per_page' => 12,'orderby' => 'date',
    'order' => 'desc','author'=>$user_id, 'post_status' => array('publish', 'pending', 'draft'),'paged'=>$paged, 'nopaging' => false);
            
            $testimonialQuery = new WP_Query($args1);
            if($testimonialQuery->have_posts()){ 
            $i=0;
            while($testimonialQuery->have_posts()): $testimonialQuery->the_post(); 
            $thumbnail1 = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full');
            $titles=get_the_title( $post->ID );
            setup_postdata($post);
             $titles;
$categories = get_the_category($post->ID);

$user_to_admin_redeem=get_post_meta ( $post->ID, $key = 'user_to_admin_redeem', $single = true );
/* $post_price=get_post_meta ( $post->ID, $key = 'post_price', $single = true ) */;

$phone_image_1=get_post_meta ( $post->ID, $key = '_video_id', $single = true );
$imagelink =get_post_meta ( $phone_image_1, $key = '_wp_attached_file', $single = true );

if($user_to_admin_redeem==""){
    $user_to_admin_redeem='No';
}

 ?>
                                                <tr>
												<td>
<?php if($post->post_status=='publish'){ ?>
<?php if($user_to_admin_redeem=="No"){ ?>
<input type="checkbox" id="selectposts<?php echo $post->ID;  ?>" name="selectposts[]" value="<?php echo $post->ID;  ?>" />
<?php } } ?>								
												</td>
                                                    <td>
                                                        <div class="blog_list viewer">
													<!--	<img class="thumb"  src="<?php echo $thumbnail1[0]; ?>" alt="" />-->
                                                         <video  controls="false" muted  width="400" mouseover  id="vd"  >
  <source src="<?php echo site_url().'/wp-content/uploads/'.$imagelink;  ?>" id="video_here">
    Your browser does not support HTML5 video.
</video> 
                                                        </div>
                                                        <h4><?php echo $post->post_title; ?></h4>
														<p>
														<b>Status:</b> <?php echo $post->post_status; ?>
														&nbsp;&nbsp;&nbsp;
														<b>Redmee:</b> <?php echo $user_to_admin_redeem; ?>
														</p>
                                                        <p><?php echo substr(strip_tags($post->post_content), 0, 150);
  ?></p>                                                    </td>


                                                    <td>
                            
<a href="<?php echo get_permalink(26); ?>?did=<?php echo $post->ID; ?>" class="btn btn-primary btn-sm btn-block" data-toggle="tooltip" data-placement="top" title="Edit">
<i class="far fa-edit"></i> Edit
</a>
<?php if($user_to_admin_redeem!="Yes" and $post->post_status!='publish' ){ ?>
<a onclick="DeletePost(<?php echo $post->ID; ?>)" href="javascript:;" class="btn btn-danger btn-sm btn-block mt-2" data-toggle="tooltip" data-placement="top" title="Delete">
<i class="fas fa-trash"></i> Delete
</a>
<?php } ?>
														</td>
                                                </tr>
												<?php $i++; endwhile;  ?>
<?php }else{ ?>
<tr class="tr-shadow">
<td colspan="3" class="blog_title">NOT FOUND !</td>
</tr>

<?php } ?>
<?php wp_reset_query();  ?>	

                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="video_page">
														<?php wp_pagenavi( array( 'query' => $testimonialQuery ) ); ?>

                                    </div>	
                                </div>
                                <!-- end card-body -->
                            </div>
							</form>
							<p id="targetLayer" >  </p>

                            <!-- end card -->
                        </div>




<script>
var j = jQuery.noConflict();
function DeletePost(pid){
	   j.ajax({
            type:'POST',
            url:'<?php echo plugin_dir_url(''); ?>theme_options/delete_post.php',
            data:{pid:pid},
            success:function(html){
				//var obj =j.parseJSON(html);
				//j('#message_'+pid).html(obj.message);
				//j('#count_'+pid).html(obj.count);
                //j('#subcat').html(html);
				//alert(html);
				location.reload();
            }
        });	
	
}




</script>
<script>
	var j = jQuery.noConflict();
j(document).ready(function (e){
j("#Sendtosuppliersform").on('submit',(function(e){
e.preventDefault();
	j('#loader_img').show();
j.ajax({
url: "<?php echo plugin_dir_url(''); ?>theme_options/sendtosuppliers.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
//console.log(data);

	var stringified = JSON.stringify(data);
var obj = JSON.parse(stringified);
var obj =j.parseJSON(data);
				if(obj.type==0){
				j('#targetLayer').html("<span style='color:red;'>"+obj.message+"</span>");
				j('#loader_img').hide();
				}else{
				j('#targetLayer').html("<span style='color:green;'>"+obj.message+"</span>");
				j('#loader_img').hide();
				 setTimeout(function(){ window.location = "" }, 3000); 		
					} 
},
error: function(){} 	        
});

}));
});
</script>

<script>
j(function() {
  j('.viewer').mouseenter(function() {
    var $el = j(this);
    //$el.find('.thumb').hide();
    $el.find('video').show()[0].play();
	setTimeout(function(){
    $el.find('video')[0].pause();
    $el.find('video')[0].currentTime = 0;
  }, 5000);
  }).mouseleave(function() {
    var $el = j(this);
    //$el.find('.thumb').show();
    $el.find('video').show()[0].pause();
  });
});

var vids = j("video"); 
j.each(vids, function(){
       this.controls = false; 
});
</script>