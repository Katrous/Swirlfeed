<?php 
include("includes/header.php");

if(isset($_POST['post'])){

	$uploadOk = 1;
	$imageName = $_FILES['image']['name'];
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/images/posts/";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['image']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			
			if(move_uploaded_file($_FILES['image']['tmp_name'], $imageName)) {
				//image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}

	if($uploadOk) {
		$post = new Post($con, $userLoggedIn);
       

        // Upload if post body has content
        if($_POST['post_text'] != '') {
            $post->submitPost($_POST['post_text'], 'none', $imageName);
        } else {
            // Upload if post body has no content
            echo "<div style='text-align:center;' class='alert alert-danger'>
           You cannot post without a text body at this time. Sorry!
        </div>";

        }

      
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}

}
    // session_destroy();
?>
   <!-- <div class="user_details column">
       <a href="<?php echo $userLoggedIn?>"> <img src=".<?php echo $user['profile_pic']; ?>" alt="img test"></a>
       <div class="user_details_left_right">
        <a href="<?php echo $userLoggedIn?>">
            <?php
                echo $user['first_name'] . " " . $user['last_name'];
            ?>
        </a>
            </br>   
        <?php
        echo "Posts: " . $user['num_posts'] . "</br>";
        echo "Likes" . $user['num_likes'];
        ?>
       </div>
   </div> -->

   <div class="main_column column">
        <form action="index.php" method="POST" class="post_form" enctype="multipart/form-data">
        <a href="<?php echo $userLoggedIn?>"> <img src="./<?php echo $user['profile_pic']; ?>" alt="img test" class='post_form_pic'></a>
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
            <input type="submit" name="post" id="post_button" value="Post">
            <label class="btn btn-primary">
                <i class="fa fa-image iconPosition"> Upload a Photo </i> <input type="file" style="display: none;"  name="image">
            </label>
        </form>

        

        <div class="posts_area">

        </div>
        
        <img id="loading" src="assets/images/icons/loading.gif" alt="">
   </div>

   <script>
$(function(){
 
 var userLoggedIn = '<?php echo $userLoggedIn; ?>';
 var inProgress = false;

 loadPosts(); //Load first posts

 $(window).scroll(function() {
     var bottomElement = $(".status_post").last();
     var noMorePosts = $('.posts_area').find('.noMorePosts').val();

     // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
     if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
         loadPosts();
     }
 });

 function loadPosts() {
     if(inProgress) { //If it is already in the process of loading some posts, just return
         return;
     }
     
     inProgress = true;
     $('#loading').show();

     var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

     $.ajax({
         url: "includes/handlers/ajax_load_posts.php",
         type: "POST",
         data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
         cache:false,

         success: function(response) {
             $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
             $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
             $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

             $('#loading').hide();
             $(".posts_area").append(response);

             inProgress = false;
         }
     });
 }

 //Check if the element is in view
 function isElementInView (el) {
     var rect = el.getBoundingClientRect();

     return (
         rect.top >= 0 &&
         rect.left >= 0 &&
         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
         rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
     );
 }
});

   </script>
   </div>
</body>
</html>