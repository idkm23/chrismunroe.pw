
	<?php 
		function checkIn($obj, $arr) {
			if(count($arr) == 0)
				return false;
			if(count($arr) == 1 && $arr[0] == intval($obj['parent_id']))
				return true;
			else if(count($arr) == 1)
				return false;
						
			foreach($arr as $curObj) {
				if(intval($obj['parent_id']) == $curObj) {
					return true;
				}
			}
			return false;
		}
		
		include('inc/navBar.php'); 
		include('inc/connectDB.php'); 	
					
	?>
    <div id = "bigFWrap">
        <?php 
			if(isset($_GET['t']) && isset($_GET['p'])) { 
				$sql = "SELECT title, detail, author, stamp FROM {$_GET['t']} WHERE parent_id = {$_GET['p']}";
				$result = $conn->query($sql);
		?>
			<h2> <a id = "threadBack" href = <?php echo "forum?t=".$_GET['t'];?> > <?php echo '&lt&lt '.$_GET['t'] ?> </a> </h2> 
		<?php
				$first = true;
				$postNum = 0;
				if($result)
				while($post = $result->fetch_array(MYSQLI_ASSOC)) {		
					if($first) {
						$first = false; 
		?>			
                <h3 id = "threadTitle"><?php echo $post['title']; ?></h3>    
        <?php	
					}
		?>
        	
            <div class = "comment">
                <div class = "namePlate">
                	<i><?php echo "#".++$postNum; ?></i>
                    
                    <a href = 
						<?php 
						$image = reset(glob("res/profile/{$post['author']}.{jpg,jpeg,png,gif}", GLOB_BRACE)); 
						echo ($image) ? $image : "res/profile/default.png";
						?> 
                    >
                    	<img src = 
                                <?php  
                                    $name = glob("res/profile/{$post['author']}.{jpg,jpeg,png,gif}", GLOB_BRACE);
                                    if(isset($name[0]))
                                        echo $name[0];
                                    else 
                                        echo "res/profile/default.png";
                                ?>
                    	>
                    </a>
                    
                    <a href = <?php echo "profile?n=".$post['author'];?> > <?php echo $post['author'] ?> </a>
					<p id = "stamp"><?php echo $post['stamp']; ?></p>
                </div>
                
                <div class = "postContent">
                	<?php echo $post['detail']; ?>
                </div>
            </div>
        
        	<?php } if(isset($_SESSION["login"])) { ?>
            
            <form action = <?php echo "postProcess?t=".$_GET['t']."&p=".$_GET['p'];?> method = "post" enctype = "multipart/form-data" id = "threadPoster">
            	<h2>Post</h2>
                <div class="g-recaptcha" data-sitekey="your_site_key"></div>
                <textarea ROWS = "10" COLS = "60" name = "content"></textarea>
                <br><br>
                <input type = "submit">
            </form>
            
            <?php } ?>
		<?php } else if(isset($_GET['t'])) { ?>
		
        	<h2><?php echo $_GET['t']?></h2>
            <p><a href = "forum">&lt&lt back to topics</a></p>
            <?php if(isset($_SESSION['login'])) { ?>
				<p><a id = "openThr">&gt&gt create a thread</a></p>
            <?php } ?>
            <table id = "tMain">
                <tr>
                    <th class = "nCol">Title</th>
                    <th class = "pCol">Author</th>
                    <th class = "pCol"># of Posts</th>
                    <th class = "pCol">Date</th>
                </tr> 
                <?php 
					$sql = "SELECT id, parent_id FROM {$_GET['t']} ORDER BY id DESC";
					if( !($result = $conn->query($sql)) )
						echo "Topic does not exist";
					else {
						$orderList = array();
						do {
							if(! $hold = $result->fetch_array(MYSQLI_ASSOC))
								break;
							if(!checkIn($hold, $orderList)) {
								$orderList[] = intval($hold['parent_id']);
							}
						} while($orderList[count($orderList)-1] !== false);
						
						$i = 0;
                    	foreach($orderList as $curObj) {
							$sql = "SELECT title, author, detail, stamp, parent_id FROM {$_GET['t']} WHERE id = {$curObj}";
							$thread = $conn->query($sql)->fetch_array(MYSQLI_ASSOC);
				?>
                <tr>
                	<td class = "nCol">
						<a href = <?php echo "?t=".$_GET['t']."&p=".$thread['parent_id']; ?>><xmp style = "font-size: 1em; margin: 0;"><?php echo $thread['title']; ?></xmp></a>
						<xmp style = "font-size: .8em;"><?php echo (strlen($thread['detail']) > 20) ? substr($thread['detail'], 0, 20).'...' : $thread['detail']; ?></xmp>						
                    </td>
                    <td class = "pCol"><a href = <?php echo "profile?n=".$thread['author'] ?>><?php echo $thread['author']; ?></a></td>
                    <td class = "pCol">
                    	<?php
							$sql = "SELECT COUNT(*) FROM {$_GET['t']} WHERE parent_id = {$thread['parent_id']}";
						    $result2 = ($conn->query($sql)->fetch_array(MYSQLI_NUM));
							echo $result2[0];
						?>
                    </td>
                    <td class = "pCol"><?php
                    	$sql = "SELECT stamp FROM {$_GET['t']} WHERE parent_id = {$thread['parent_id']} ORDER BY stamp DESC LIMIT 1";
						$earliestTime = $conn->query($sql)->fetch_array(MYSQLI_ASSOC);
						echo ($earliestTime['stamp']);
					?></td>
                </tr>
                                
				<?php 
							$i++;
						} if($i == 0) { ?>
							<tr><td>No posts</td><td></td><td></td><td></td></tr>
						<?php }
					} 
				?>
            </table>  
			
            <?php if(isset($_SESSION['login'])) { ?>
            <br>
			<form action = <?php echo "postProcess?t=".$_GET['t'];?> method = "post" enctype = "multipart/form-data" id = "threadPoster1" style = "display: none;">               
                <br>
                <h2>Create a thread</h2>
                <input type = "text" name = "title" placeholder = "Title" maxlength = "30">
                <br><br>
                <textarea ROWS = "10" COLS = "60" name = "content" maxlength = "2400" placeholder = "Content"></textarea>
                <br><br>
                <input type = "submit">
            </form> 
            
            <script>
            	document.getElementById('openThr').onclick = function() {
					document.getElementById('threadPoster1').style.display = 'block';
					window.scrollTo(0,document.body.scrollHeight);
				}
            </script>
            
            <?php } ?>
		<?php } else { ?>				
            <h2>Choose a Topic</h2>
          
            <table id = "tMain">
                <tr>
                    <th class = "nCol">Name</th>
                    <th class = "pCol">Posts</th>
                    <th class = "rCol">Recent Activity</th>
                </tr>          
                <?php                   
                    $sql = "SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = 'chrismun_forum' AND TABLE_NAME != 'account'";
                    $result = $conn->query($sql);     
                    $i = 0;
                    while($topic = $result->fetch_array(MYSQLI_ASSOC)) {
						
                ?>
                        <tr id = <?php echo "#fRow".$i ?> >
                            <td class = "nCol">
                                <h3><a href = <?php echo "forum?t=".$topic['TABLE_NAME'] ?> ><?php echo $topic['TABLE_NAME'] ?></a></h3>
                            </td>
                            <td class = "pCol">
                                <?php
                                
                                    $sqlIN = "SELECT COUNT(*) FROM ".$topic['TABLE_NAME']." ORDER BY id DESC";
                                    
                                    $resultIN = $conn->query($sqlIN)->fetch_array(MYSQLI_NUM);
                                    echo $resultIN[0];
                                ?> 
                            </td>
                            <td class = "rCol">
                                <?php
									$sqlIN = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'chrismun_forum' AND TABLE_NAME = '{$topic['TABLE_NAME']}'";
                                    $resultIN = $conn->query($sqlIN)->fetch_array(MYSQLI_NUM);
									
									$sqlIN = "SELECT author, title, detail, stamp, parent_id FROM ".$topic['TABLE_NAME'].(($resultIN > 0)?" WHERE id = ".($resultIN[0]-1):"");
									
                                    $resultIN = $conn->query($sqlIN)->fetch_assoc();
                                    
                                    if($resultIN !== NULL) { 
								?>
                                        <h3><a href = <?php echo "forum?t=".$topic['TABLE_NAME']."&p=".$resultIN['parent_id']."#threadPoster" ?> >					<xmp><?php 
												echo (isset($resultIN['title'])) ? 
													$resultIN['title'] 
													: 
													((strlen($resultIN['detail']) > 20) ? substr($resultIN['detail'], 0, 20).'...' : $resultIN['detail']); 
											?></xmp>
                                        </a></h3>                      		
                                            by <a href = <?php echo "profile.php?n=".$resultIN['author']; ?>><?php echo $resultIN['author'] ?></a> <?php echo " @".$resultIN['stamp'] ?>
										<?php 
                                            } else { 
                                                echo "No posts";
                                            }
                                        ?>
                                
                            </td>
                        </tr>
                    <?php
                        $i++;
                    } ?>
        	</table>
        <?php } ?>
    </div>
</body>
</html>