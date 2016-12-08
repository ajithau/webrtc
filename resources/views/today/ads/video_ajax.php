<option value=""></option>
<?php
foreach ($video as $key => $value) {
	$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->video);
    $img = explode('public', $withoutExt);
	echo '<option data-subtitle="'.$value->duration.'" data-url="'.$value->video.'" value="'.$value->id.'" data-left="<img src='.url('/').'/public'.$img[1].'_130.jpg>">'.$value->title.'</option>';
}
?>