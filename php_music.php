<html>
<!-- Configuration section - To be added Later-->
<?php

	// set this to the folder containing your MP3 files
	// Ex. $curr_dir = '/home/deven/my_mp3s/';
	$curr_dir = null;

?>


<!-- Developer only section -->
<?php

	if (! isset($curr_dir)) {
		$curr_dir = getcwd();
	}

	$thelist = '';
	if ($handle = opendir($curr_dir)) {
	    while (false !== ($file = readdir($handle))) {
	        $extension = strtolower(substr($file, strrpos($file, '.') + 1));

	        if ($file != "." && $file != ".."
	        	&& ( $extension == 'mp3'
	        	|| $extension == 'ogg'
	        	|| $extension == 'wav')
	       	) {
	            $thelist[] = $file;
	        }
	    }
	    closedir($handle);
	}

	sort($thelist);

?>
	<p>
	<?php
		for ($i = 0; $i < count($thelist); $i++)
			echo $thelist[$i] . "<br>";
	?>
	</p>
	<br>
	<h3 id="mp3_name"></h3>

	<audio id="audio" controls>
		<source class="player_handles" id="mp3_handle1" src="" type="audio/mp3">
		<source class="player_handles" id="mp3_handle2" src="" type="audio/wav">
		<source class="player_handles" id="mp3_handle3" src="" type="audio/ogg">
		Your browser does not support the audio tag.
	</audio>

	<br>

	<script>
		var list_mp3s = [
			<?php
				for ($i = 0; $i < count($thelist); $i++) {
					echo "'" , $thelist[$i] , "', \n";
				};
			?>
			''
		];
		var curr = 0;
		var count_of_mp3s = <?php echo count($thelist); ?>;

		// to remove the redundant '' string in array.
		list_mp3s.pop();

		function play() {
			if (curr < count_of_mp3s) {
				var handles = document.getElementsByClassName("player_handles");
				handles[0].src = handles[1].src = handles[2].src = list_mp3s[curr];
				document.getElementById("audio").load();
				document.getElementById("audio").play();
				document.getElementById("mp3_name").innerHTML = list_mp3s[curr];
			} else {
				document.getElementById("audio").stop();
			}
		}

		function previous() {
			if (curr > 0) {
				curr--;
			}
			play();
		}

		function forward() {
			if (curr < count_of_mp3s - 1) {
				curr++;
			}
			play();
		}

		function moveToNext() {
			curr++;
			play();
		}

		audio.addEventListener('ended', moveToNext);
		play();

	</script>


	<button onclick="forward();">Next</button>
		&emsp;
	<button onclick="previous();">Previous</button>

</html>