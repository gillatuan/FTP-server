<?php
$url = !empty($video[0]) ? $video[0]->link_youtube : 'http://www.youtube.com/watch?v=ToawoyyUOOU';
// we get the unique video id from the url by matching the pattern
preg_match("/v=([^&]+)/i", $url, $matches);
$name = count($video) ? $video[0]->name : $matches[0];
$id = $matches[1];

// this is your template for generating embed codes
$code = '<object height="400" title="' . $name . '"><param name="movie" value="http://www.youtube.com/v/{id}&hl=en_US&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/{id}&hl=en_US&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="510" height="400"></embed></object>';

// we replace each {id} with the actual ID of the video to get embed code for this particular video
echo $code = str_replace('{id}', $id, $code);