<?php
// --------------------------------------------------------------------------------
// 1 Minute Gallery 1.0.13 (3/31/2008)
// http://www.1minutegallery.com/
// Copyright 2008 Softcomplex, Inc.
// This software is free for non-commercial use only. See website for more details.
// --------------------------------------------------------------------------------

// --------------------------------------------------------------------------------
// configuration settings
// --------------------------------------------------------------------------------

// title text for gallery pages
define('TITLE', "1 Minute Gallery");
// width of the thumbnail images (height is proportional)
define('THUMBWIDTH', 120);
// width of the sized images (height is proportional)
define('SIZEDWIDTH', 800);
// name of the data file
define('XMLFILE', 'config.xml');
// number of images per page (must match the album template)
define('IMGPERPAGE', 12);
// resizing method (GD2, NetPbm, ImageMagick)
define('RESIZEMETHOD', 'NetPbm');
// path to ImageMagick files
define('IM_PATH', '/usr/local/bin/');
// path to NetPbm files
define('NETPBM_PATH', '/usr/bin/');
// quality of thumbnails
define('TN_JPEG_QUALITY', 100);
// quality of resized images
define('SIZED_JPEG_QUALITY', 75);
// theme path
define('THEME', 'default/');
// controlls messages
// 0 - no messages, 1 - errors only, 2 (default) - errors and reports, 3 - errors, reports and debug info
define('DEBUG', 2);

// --------------------------------------------------------------------------------
// templates - common header
// --------------------------------------------------------------------------------
function tpl_header ($o_album, $o_image=false) {
	$s_albumCaption = $o_album->caption;
	$s_imageCaption = ($o_image ? $o_image['caption'] : '');
?>
	<div id="omgHeader">
		<img src="<?= THEME ?>logo.gif" id="logo" />
<?	if ($o_image) { ?>
		<h2><a href="?p=<?= $o_album->currentPage ?>"><?= $s_albumCaption ?></a></h2>
		<h1><?= $s_imageCaption ?></h1>
<?	}
	else { ?>
		<h1><?= $s_albumCaption ?></h1>
<? } ?>
	</div>
<?
}

// --------------------------------------------------------------------------------
// templates - common footer
// --------------------------------------------------------------------------------
// IMPORTANT: The product information and copyright notice must remain unchanged
// and should be presend in all the pages unless the footnote removal license is
// purchased. In this case the footer must contain HTML comment with the licenense
// number.

function tpl_footer () {
?>
	<div id="omgFooter">
		<p>Powered by <a href="http://www.1minutegallery.com/">1 Minute Gallery 1.0</a></p>
		<p>Developed by <a href="http://www.softcomplex.com/">Softcomplex, Inc</a> &copy;2002-2008</p>
	</div>
<?
}

// --------------------------------------------------------------------------------
// templates - page links
// --------------------------------------------------------------------------------
function tpl_pageLinks ($o_album) {
	$n_page  = $o_album->currentPage;
	$n_pages = $o_album->totalPages;
	 // maximum number of prev/next links 
	$n_links = 3;
?>		<div class="omgPageLinks">
<?	if ($n_page != 1) { ?>
			<a href="?p=<?= $n_page - 1 ?>">&lt;</a>
			<a href="?p=1">1</a>
<?	}
	if ($n_page > $n_links + 1) { ?>
			...
<?	}
	for ($p = max(2, $n_page - $n_links + 1); $p < $n_page; $p++) { ?>
			<a href="?p=<?= $p ?>"><?= $p ?></a>
<?	} ?>
			<span class="omgCurrentPage"><?= $n_page ?></span>
<?	for ($p = ($n_page + 1); $p < min($n_pages, $n_page + $n_links); $p++) { ?>
			<a href="?p=<?= $p ?>"><?= $p ?></a>
<?	}
	if ($n_page < $n_pages - $n_links) { ?>
			...
<?	}
	if ($n_page != $n_pages) { ?>
			<a href="?p=<?= $n_pages ?>"><?= $n_pages ?></a>
			<a href="?p=<?= $n_page + 1 ?>">&gt;</a>
<? } ?>
		</div>
<?
}

// --------------------------------------------------------------------------------
// templates - image links
// --------------------------------------------------------------------------------
function tpl_imageLinks ($o_album, $n_order) {
	$n_images = $o_album->imagecount;
	 // maximum number of prev/next links 
	$n_links = 3;
?>		<div class="omgPageLinks">
<?	if ($n_order > 0) { ?>
			<a href="?i=<?= $o_album->collectionImages[$n_order - 1]['name'] ?>">&lt;</a>
			<a href="?i=<?= $o_album->collectionImages[0]['name'] ?>">1</a>
<?	}
	if ($n_order > $n_links) { ?>
			-
<?	}
	for ($i = max(1, $n_order - $n_links + 1); $i < $n_order; $i++) { ?>
			<a href="?i=<?= $o_album->collectionImages[$i]['name'] ?>"><?= ($i + 1) ?></a>
<?	} ?>
			<span class="omgCurrentPage"><?= ($n_order + 1) ?></span>
<?	for ($i = ($n_order + 1); $i < min($n_images - 1, $n_order + $n_links); $i++) { ?>
			<a href="?i=<?= $o_album->collectionImages[$i]['name'] ?>"><?= ($i + 1) ?></a>
<?	}
	if ($n_order < $n_images - $n_links - 1) { ?>
			-
<?	}
	if ($n_order < $n_images - 1) { ?>
			<a href="?i=<?= $o_album->collectionImages[$n_images - 1]['name'] ?>"><?= $n_images ?></a>
			<a href="?i=<?= $o_album->collectionImages[$n_order + 1]['name'] ?>">&gt;</a>
<? } ?>
		</div>
<?
}


// --------------------------------------------------------------------------------
// templates - album view
// --------------------------------------------------------------------------------
function tpl_album ($o_album) {

	// prepare variables for template
	global $galery;
	$s_caption      = $o_album->caption;
	$s_description  = $o_album->description;
	$n_images       = $o_album->imagecount;
	$n_page         = $o_album->currentPage;
	$n_pages        = $o_album->totalPages;
	$a_images       = $o_album->collectionImages;
	$n_currentImage = $o_album->firstImageOnPage;
	$n_lastImage    = $o_album->lastImageOnPage;
	$a_messages     = $galery->debugMess;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?echo $s_caption ?> - Home</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="<?= $s_description ?>" />
	<meta name="generator" content="1 Minute Gallery 1.0.1" />
	<link rel="stylesheet" type="text/css" href="<?= THEME ?>omgStyles.css" media="all" />
</head>
<body>
<div id="omgMain">
<?= tpl_header($o_album) ?>
	<div id="omgAlbumTopNav">
		<!-- you may need to modify the address of your homepage -->
		<div class="omgBack"><a href="/">Home Page</a></div>
<?= tpl_pageLinks($o_album) ?>
	</div>
	<div id="omgSidebar">
		<div id="omgAlbumDescr"><?= $s_description ?></div>
	</div>
	<div id="omgThumbnails">
<?	// debug output
	if (count($a_messages)) { ?>
	<div id="omgMessages">
		<ul>
<?		foreach ($a_messages as $a_message) { ?>
			<li class="msg<?= $a_message[0] ?>">
				<a href="http://www.1minutegallery.com/docs/#msg<?= $a_message[1] ?>" title="learn about this message"><?= $a_message[1] ?></a> -
				<span><?= $a_message[2] ?></span>
			</li>
<?		 } ?>
		</ul>
	</div>
<?	} 
	// thumbnails output
	for (; $n_currentImage <= $n_lastImage; $n_currentImage++) {
		$o_image = $a_images[$n_currentImage];
?>
		<table><tr><td class="im"><a href="?i=<?= $o_image['path_original'] ?>" title="<?= $o_image['description'] ?>"><img src="<?= $o_image['path_tn'] ?>" /></a></td></tr></tr><td class="cp"><?= $o_image['caption'] ?></td></tr></table>
<?	 } ?>
		<div class="omgClear">&nbsp;</div>
	</div>
	<div id="omgAlbumBotNav">
		<div id="omgStats"><?= $n_images . ' image' .
			($n_images % 10 == 1 ? '' : 's') . ' in this album ' .
			($n_pages > 1 ? ' on ' . $n_pages .  ' page' .
			($n_pages % 10 == 1 ? '' : 's') : '') . '.' ?></div>
<?= tpl_pageLinks($o_album) ?>
	</div>
<?= tpl_footer() ?>
</div>
</body>
</html>
<?
}

// --------------------------------------------------------------------------------
// templates - image view
// --------------------------------------------------------------------------------
function tpl_image ($o_image) {

	$o_album       = $o_image['album'];
	$s_caption     = $o_image['caption'];
	$s_description = $o_image['description'];
	$s_pathSized   = $o_image['path_sized'];
	$s_pathFull    = $o_image['name'];
	$n_order       = $o_image['order'];

	// calculate parameters for previews
	$a_images      = $o_album->collectionImages;
	$n_images      = $o_album->imagecount;
	$n_previews    = 2;
	$n_totalPreviews = $n_previews * 2 + 1;
	$n_pvFirst = max(0, min($n_order - $n_previews, $n_images - $n_totalPreviews));
	$n_pvLast  = min($n_images - 1, max($n_order + $n_previews, $n_totalPreviews - 1));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= TITLE . ' - ' . $s_caption ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="<?= TITLE . '-' . $s_description ?>" />
	<meta name="generator" content="1 Minute Gallery 1.0.1" />
	<link rel="stylesheet" type="text/css" href="<?= THEME ?>omgStyles.css" media="all" />
</head>
<body>
<div id="omgMain">
<?= tpl_header($o_album, $o_image) ?>
	<div id="omgAlbumTopNav">
		<div class="omgBack"><a href="?p=<?= $o_album->currentPage ?>">back to album</a></div>
<?= tpl_imageLinks($o_album, $n_order) ?>
	</div>
	<table id="omgPreviews">
<?	for ($i = $n_pvFirst; $i <= $n_pvLast; $i++) { 
		$o_preview = $a_images[$i];
?>
	<tr><td<?= ($i == $n_order ? ' id="omgCurrent"' : '') ?>><a href="?i=<?= $o_preview['path_original'] ?>" title="<?= $o_preview['description'] ?>"><img src="<?= $o_preview['path_tn'] ?>" /></a></tr></td>
<?	} ?>
	</table>
	<div id="omgImageView">
		<a href="<?= $s_pathFull ?>"><img src="<?= $s_pathSized ?>" class="omgSized" /></a>
<? if ($s_description != '') { ?>
		<div id="omgDescr"><?= $s_description ?></div>
<?}?>
		<div class="omgClear">&nbsp;</div>
	</div>
	<div id="omgAlbumBotNav">
		<div class="omgBack"><a href="?p=<?= $o_album->currentPage ?>">back to album</a></div>
<?= tpl_imageLinks($o_album, $n_order) ?>
	</div>
<?= tpl_footer() ?>
	</div>
</div>
</body>
</html>
<?
}

// --------------------------------------------------------------------------------
// gallery initialization code
// --------------------------------------------------------------------------------

define ('PLATFORM', ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'WIN' : 'UNIX'));
define ('SEPARATOR', (PLATFORM == 'WIN' ? '\\' : '/'));
define ('PHP_VERS', intval(substr(PHP_VERSION, 0, 1)));

$a_pathinfo = pathinfo(__FILE__);
define ('FILEDIR', $a_pathinfo['dirname'] . SEPARATOR);

$galery = new oneMinuteGallery();

// regenerates the thumbnails and sized images, removes abandoned ones
if (isset($_GET['cleanup']))
	$galery->cleanup();
// displays image view
else if ($galery->is_imageSelected)
	tpl_image($galery->getSelectedImage());
// displays album
else
	tpl_album($galery->getAlbum());
exit;

// --------------------------------------------------------------------------------
// gallery implementation - no changes required
// --------------------------------------------------------------------------------

class oneMinuteGallery{
	var $collectionAlbums;
	var $XMLConfig;
	var $debugMess;
	var $is_imageSelected = false;
	var $currentAlbum  = false;
	var $firstImageOnPage = false;
	var $lastImageOnPage = false;
	var $currentPage = 0;
	var $totalPages = 0;
	
	
	function oneMinuteGallery() {
		global $_GET;
		if (!defined('RESIZED_PATH')) {
			define('RESIZED_PATH', './resized/');
		}
		if (!defined('IMGPERPAGE')) {
			define('IMGPERPAGE', 18);
		}
		define ('THUMBNAME','<name>_thumb.<ext>');
		define ('SIZEDNAME','<name>_sized.<ext>');
		$this->config_path = XMLFILE;
		$this->collectionAlbums = array();
		if (defined('IMGPERPAGE')) {
			$this->itemPerPage = IMGPERPAGE;
		}
		else {
			$this->itemPerPage = 9;
		}
		$this->currentPage = 0;
		


		if (is_file(XMLFILE)) {
			if ($this->loadConfig(XMLFILE)) {
				$this->initConfig();
			}
			else
				return false;
		}
		else {
			$this->struct = $this->TGReadDir();
			if (is_array($this->struct)) {
				if(PHP_VERS>4){
					$this->createXML($this->struct);
				}else{
					$this->createXML_PHP4($this->struct);
				}
			}
			if (is_file(XMLFILE)) {
				if ($this->loadConfig(XMLFILE)) {
					$this->initConfig();
				}
				else return false;
			}
			else {
				$this->logMessage('error', 501, "Can't create " . XMLFILE . " file, please grant the webserver write permissions for " . FILEDIR . " folder.");
				return false;
			}
		}
		$this->cleanup();
		//print_r($this->struct);
		//print_r($this->currentAlbum);
		$this->currentAlbum->currentPage = (int)(isset($_GET['p']) ? $_GET['p'] : 1);
		$this->currentAlbum->totalPages = (int)ceil($this->currentAlbum->imagecount/IMGPERPAGE);
		$this->currentAlbum->firstImageOnPage = (int)IMGPERPAGE * ($this->currentAlbum->currentPage - 1);
		$this->currentAlbum->lastImageOnPage = (int)$this->currentAlbum->firstImageOnPage + IMGPERPAGE - 1;
		if ($this->currentAlbum->lastImageOnPage >= $this->currentAlbum->imagecount)
			$this->currentAlbum->lastImageOnPage = (int)$this->currentAlbum->imagecount-1;

		if (isset($_GET['i'])) {
			$this->currentImage = $_GET['i'];
			if ($this->currentAlbum->collectionImages[$this->currentImage]) {
				$this->is_imageSelected = true;
			}
			else {
				$this->is_imageSelected = false;
			}
		}
		else {
			$this->currentImage = null;
			$this->is_imageSelected = false;
		}
	}
	function getSelectedImage() {
		if (!$this->is_imageSelected) return false;
		return $this->getSized($this->currentImage);
	}
	function getAlbum() {
		return $this->getThumbnails();
	}
	
	function getThumbnails() {
		$tn = new Thumbnail();
		$o_album = $this->currentAlbum;
		$o_images = array();
		$num = 0;
		if(!$o_album)return false;
		foreach($o_album->collectionImages as $key=>$o_image) {
			$or_ext          = $this->getExt($o_image->filename);
			$web_safe_ext    = $tn->getWebSafeFormat($or_ext);
			$i_filename      = str_replace("." . $or_ext,"" , $o_image->filename);
			$path_thumbnail  = str_replace("<ext>", $web_safe_ext, THUMBNAME);
			$path_thumbnail  = str_replace("<name>", $i_filename, $path_thumbnail);
			$path_sized      = str_replace("<ext>", $web_safe_ext, SIZEDNAME);
			$path_sized      = str_replace("<name>", $i_filename, $path_sized);
			$i_info          = @getimagesize($path_thumbnail);
			$i_original_info = @getimagesize($o_image->filename);
			$o_images[$num]  = array(
				'path_tn'         => $path_thumbnail,
				'path_sized'      => $path_sized,
				'path_original'   => $o_image->filename,
				'caption'         => $o_image->caption,
				'description'     => $o_image->description,
				'width'           => $i_info[0],
				'height'          => $i_info[1],
				'original_width'  => $i_original_info[0],
				'original_height' => $i_original_info[1],
				'original_size'   => filesize($o_image->filename),
				'name'            => urlencode($o_image->filename),
				'order'           => $num
			);
			$num ++;
		}
		$res = $o_album;
		$res->collectionImages = $o_images;
		
		return $res;
	}
	
	function getSized($need_image, $additional = true) {
		$tn = new Thumbnail();
		$o_album = $this->currentAlbum;
		$num = 0;
		$before_image = false;
		$next_image = false;
		foreach ($o_album->collectionImages as $key=>$o_image) {
			if ($key == $need_image) {
				$o_image         = $o_album->collectionImages[$need_image];
				$or_ext          = $this->getExt($o_image->filename);
				$web_safe_ext    = $tn->getWebSafeFormat($or_ext);
				$i_filename      = str_replace("." . $or_ext, "", $o_image->filename);
				$path_sized      = str_replace("<ext>", $web_safe_ext, SIZEDNAME);
				$path_sized      = str_replace("<name>", $i_filename, $path_sized);
				$path_thumbnail  = str_replace("<ext>", $web_safe_ext, THUMBNAME);
				$path_thumbnail  = str_replace("<name>", $i_filename, $path_thumbnail);
				$i_info          = getimagesize($path_sized);
				$i_original_info = getimagesize($o_image->filename);
				$result = array (
					'path_sized'      => $path_sized,
					'caption'         => $o_image->caption,
					'description'     => $o_image->description,
					'width'           => $i_info[0],
					'height'          => $i_info[1],
					'width_original'  => $i_original_info[0],
					'height_original' => $i_original_info[1],
					'path_original'   => $o_image->filename,
					'path_tn'         => $path_thumbnail,
					'original_size'   => filesize($o_image->filename),
					'order'           => $num,
					'name'            => urlencode($o_image->filename)
				);
				if ($additional) {
					$this->currentAlbum->currentPage = ceil(($num + 1) / IMGPERPAGE);
					$al = $this->currentAlbum;
					unset($al->checksum);
					//$result['album']=$al;
				}
				if(isset($before))
					$before_image = $before;
			}
			elseif (isset($before) && $before == $need_image) {
				$next_image = $key;
			}
			$before = $key;
			$num++;
		}
		if ($additional) {
			$o_album = $this->getThumbnails();
			$result['album'] = $o_album;
			//$result['previousImage'] = $this->getSized($before_image,false);
			//$result['nextImage'] = $this->getSized($next_image,false);
		}
		return $result;
	}
	function cmp2 ($a, $b) {
		if (substr_count($a, "/") == substr_count($b, "/")) return 0;
		return (substr_count($a, "/") > substr_count($b, "/")) ? 1 : -1;
	}
	function cmp ($a, $b) {
		if (substr_count($a->path, "/") == substr_count($b->path, "/")) return 0;
		return (substr_count($a->path, "/") > substr_count($b->path, "/")) ? 1 : -1;
	}
	function getExt($filename) {
		return substr($filename, strrpos($filename, ".") + 1);
	}
	
	function cleanup() {
		set_time_limit(0);
		$struct = array();
		$struct = $this->TGReadDir();
		$tn = new Thumbnail();
		$isExists = true;
		$im_coll = $this->currentAlbum->collectionImages;
		foreach($struct as $k=>$v) {
			if ($k !== 'md5_hash') {
				if (!$im_coll[$v[0]]) {
					$isExists = false;
					if (DEBUG) {
						$this->logMessage('message', 201, "New image " . $v[0] . " has been added.");
					}
				}
			}
		}
		if (count($struct) - 1 != $this->currentAlbum->imagecount) {
			$isExists = false;
		}
		$this->TGReadDir($struct);
//		print_r($this->currentAlbum);
		if ($isExists === false) {
			$this->struct = array();
			$this->struct = $this->TGReadDir();
			if (is_array($this->struct)) {
				if(PHP_VERS>4){
					$this->createXML($this->struct);
				}else{
					$this->createXML_PHP4($this->struct);
				}
			}
			if (is_file(XMLFILE)) {
				if ($this->loadConfig(XMLFILE)) {
					$this->initConfig();
				}
				else
					return false;
			}
			else {
				$this->logMessage('error', 502, "Can't create " . XMLFILE . " file, please grant the webserver write permissions for " . FILEDIR . " folder.");
				return false;
			}
		}
		if (!defined('RESIZEMETHOD') || stristr(RESIZEMETHOD, 'none')) {
			$res_NetPbm = NetPbmcheck();
			$res_IM = IMcheck();
			$res_GD2 = checkGD2();
			
			if ($res_NetPbm) {
				define('RESIZEMETHOD', 'NetPbm');
				$keys = array_keys($res_NetPbm);
				define('NETPBM_PATH', $keys[0]);
			}
			else if ($res_IM) {
				define('RESIZEMETHOD', 'ImageMagick');
				$keys = array_keys($res_IM);
				define('NETPBM_PATH', $keys[0]);
			}
			else if ($res_GD2) {
				define('RESIZEMETHOD', 'GD2');
			}
		}else if(defined('RESIZEMETHOD')){
			switch(RESIZEMETHOD){
				case 'GD2':
					$res_GD2 = checkGD2();
					if(!$res_GD2){
						$this->logMessage('error', 607, "The gallery is currently configured to use GD2 library but it can't be found on the server.");
						return false;
					}
				break;
				case 'ImageMagick':
					$res_IM = IMcheck();
					if(!$res_IM){
						$this->logMessage('error', 608, "The gallery is currently configured to use ImageMagick library but it is either not installed, or specified path is incorrect.");
						return false;
					}
				break;
				case 'NetPbm':
					$res_NetPbm = NetPbmcheck();
					if(!$res_NetPbm){
						$this->logMessage('error', 609, "The gallery is currently configured to use NetPbm library but it is either not installed, or specified path is incorrect.");
						return false;
					}
				break;
			}
		}
		$is_configChanged = false;
		if (defined('RESIZEMETHOD') && !stristr(RESIZEMETHOD, 'none')) {
			$o_album = $this->currentAlbum;
			foreach($o_album->collectionImages as $key=>$o_image) {
				$or_ext         = $this->getExt($o_image->filename);
				$web_safe_ext   = $tn->getWebSafeFormat($or_ext);
				$i_filename     = str_replace("." . $or_ext, "", $o_image->filename);
				$path_sized     = str_replace("<ext>", $web_safe_ext, SIZEDNAME);
				$path_sized     = str_replace("<name>", $i_filename, $path_sized);
				$path_thumbnail = str_replace("<ext>", $web_safe_ext, THUMBNAME);
				$path_thumbnail = str_replace("<name>", $i_filename, $path_thumbnail);
				if (!file_exists($path_sized) || !file_exists($path_thumbnail) || @filemtime($o_album->path . $o_image->filename) != $o_image->checksum) {
					//echo "is_file(".$path_sized.")= ".((int)file_exists($path_sized))."; is_file(".$path_thumbnail." = ".((int)file_exists($path_thumbnail))."; filemtime(".$o_album->path.$o_image->filename.") = ".(filemtime($o_album->path.$o_image->filename))." != ".$o_image->checksum." <br>";
					$is_configChanged = true;
					$res = $tn->create($o_image->filename);
					foreach($tn->debugMess as $v)
						$this->logMessage($v[0], $v[1], $v[2]);
					if ($res)
						$this->logMessage('message', 202, "Thumbnail for " . $o_image->filename . " has been created.");
					else
						$this->logMessage('error', 701, "Thumbnail for " . $o_image->filename . " can not be created.");
					flush();
				}
			}
		}
		else
			$this->logMessage('error', 601, "Can't find any of the supported graphic libraries on this server. Please manually adjust the configuration section of the script.");

		if ($is_configChanged) {
			$this->struct = array();
			$this->struct = $this->TGReadDir();
			if (is_array($this->struct)) {
				if (PHP_VERS > 4)
					$this->createXML($this->struct);
				else
					$this->createXML_PHP4($this->struct);
			}
			if (is_file(XMLFILE)) {
				if ($this->loadConfig(XMLFILE))
					$this->initConfig();
				else
					return false;
			}
			else {
				$this->logMessage('error', 503, "Can't create " . XMLFILE . " file, please grant the webserver write permissions for " . FILEDIR . " folder.");
				return false;
			}
		}
	}
	
	function TGReadDir($structure=array()) {
		$path = '.';
		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if (!is_dir($path . "/" . $file)) {
						if (@getimagesize($path . "/" . $file)) {
							if ($this->isOriginal($file)) {
								//if (DEBUG) echo "<font color=green><b>FOLDER</b>".$path." <b>FILE</b> ".$file."</font><br>";
								$md5 = filemtime($path . "/" . $file);
								$struct[] = array($file, $md5);
							}
							else if (count($structure)) {
								$or_ext   = $this->getExt($file);
								$original = str_replace($or_ext, "", $file);
								$pat      = array('_sized.', '_thumb.');
								$rep      = array('', '');
								$original = str_replace($pat, $rep, $original);
								
								if (!$this->fileExist($path, $original)) {
									if (@unlink($path . "/" . $file)) {
										if (DEBUG) {
											$this->logMessage('message', 203, "File " . $path . "/" . $file . " has been deleted.");
										}
									}
								}
							}
						}
						else {
							//if (DEBUG) echo "<font color=green><b>NOT IMAGE FILE</b>".$path."/".$file."</font><br>";
						}
					}
				}
			}
			closedir($handle);
		}
		$struct['md5_hash'] = filemtime($path);
		return $struct;
	}
	function fileExist ($dir, $file_name) {
		if ($dir = opendir($dir)) {
			while (($file = readdir($dir)) !== false) {
				$name = substr($file, 0, strrpos($file, "."));
				if ($name == $file_name)
					return true;
			}
			closedir($dir);
		}
		return false;
	}
	function isOriginal($name) {
		$tn = new Thumbnail();
		$or_ext = $this->getExt($name);
		$web_safe_ext = $tn->getWebSafeFormat($or_ext);
		if (strpos(strtolower($name), '_sized.' . $web_safe_ext)) return false;
		if (strpos(strtolower($name), '_thumb.' . $web_safe_ext)) return false;
		return true;
	}
	
	function getChildren($vals, &$i) { 
		$children = array(); 
		if (!isset($vals[$i]['attributes'])) { 
			$vals[$i]['attributes'] = ""; 
		}
		while(++$i < count($vals)) { 
			if (!isset($vals[$i]['attributes'])) { 
				$vals[$i]['attributes'] = ""; 
			}
			if (!isset($vals[$i]['value'])) { 
				$vals[$i]['value'] = ""; 
			}
			switch ($vals[$i]['type']) { 
				case 'complete': 
					array_push($children, 
						array(
							'tag'        => $vals[$i]['tag'], 
							'attributes' => $vals[$i]['attributes'], 
							'value'      => $vals[$i]['value']
						)
					); 
				break;
				case 'open':
					array_push($children,
						array(
							'tag'        => $vals[$i]['tag'], 
							'attributes' => $vals[$i]['attributes'], 
							'children'   => $this->getChildren($vals, $i)
						)
					); 
				break;
				case 'close':
					return $children; 
				break;
			}
		}
		return $children; 
	}
	
	function loadConfig($file) { 
		if (!is_readable($file)) {
			$this->logMessage('error', 507, "Can't read configuration file " . $file . " Please check permission.");
			return false;
		}
		$data = implode("", file($file));
		$xml = xml_parser_create(); 
		xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1); 
		xml_parse_into_struct($xml, $data, $vals, $index); 
		xml_parser_free($xml); 
		$tree = array();
		$i = 0; 
		array_push (
			$tree, 
			array(
				'tag'        => $vals[$i]['tag'],
				'attributes' => $vals[$i]['attributes'],
				'children'   => $this->getChildren($vals, $i)
			)
		);
		
		
		$this->dirtyXML = $tree;
		return true;
		//print_r($this->dirtyXML);
	}
	
	function initConfig() {
		foreach ($this->dirtyXML[0]['children'] as $k => $v) {
			if ($v['tag'] == 'ALBUM') {
				$this->initAlbum($v);
			}
		}
	}
	
	function initAlbum($a_data) {
		$o_images = array();
		$o_album_settings = array();
		foreach($a_data['children'] as $key => $value) {
			if ($value['tag'] == 'IMAGE') {
				$im = $this->initImage($value);
				$o_images[$im->filename] = $im;
			}
			else {
				$o_album_settings[strtolower($value['tag'])] = $value['value'];
			}
		}
		$o_album_settings['collectionImages'] = $o_images;
		$o_album_settings['imagecount'] = count($o_images);
		$al = new TGAlbum($o_album_settings);
		$this->currentAlbum = $al;
	}
	
	function initImage($a_data) {
		$o_image_settings = array('filename' => $a_data['attributes']['NAME']);
		foreach ($a_data['children'] as $key => $value) {
			$o_image_settings[strtolower($value['tag'])] = $value['value'];
		}
		return new TGImage($o_image_settings);
	}
	
	function createXMLforAlbum($doc, $globalParentNode, $folderStructure) {
		$o_album = $doc->createElement('album');
		$o_album_caption = $doc->createElement("caption");
		$o_album_caption->appendChild($doc->createTextNode(($this->currentAlbum ? $this->currentAlbum->caption : "My Album")));
		$o_album_description = $doc->createElement("description");
		$o_album_description->appendChild($doc->createTextNode(($this->currentAlbum
			? $this->currentAlbum->description
			: "My Album created on " . date("F d, Y")
		)));
		$o_album_checksum = $doc->createElement("checksum");
		$o_album_checksum->appendChild($doc->createTextNode($folderStructure['md5_hash']));
		$o_album->appendChild($o_album_caption);
		$o_album->appendChild($o_album_description);
		$o_album->appendChild($o_album_checksum);
		$globalParentNode->appendChild($o_album);
		$al = isset($this->currentAlbum)?$this->currentAlbum:false;
		if($al)
			$im = $al->collectionImages;
		foreach($folderStructure as $key=>$values) {
			if ($key!=='md5_hash') {//if it is one of the images
				$o_image = $doc->createElement('image');
				$i_name = $doc->createAttribute("name");
				$i_name->appendChild($doc->createTextNode($values[0]));
				$i_caption = $doc->createElement("caption");
				$i_caption->appendChild($doc->createTextNode($al && $al->collectionImages[$values[0]]
					? $al->collectionImages[$values[0]]->caption
					: $values[0])
				);
				$i_description = $doc->createElement("description");
				$i_description->appendChild($doc->createTextNode($al && $al->collectionImages[$values[0]]
					? $al->collectionImages[$values[0]]->description
					: "[no description]"
				));
				$i_checksum = $doc->createElement("checksum");
				$i_checksum->appendChild($doc->createTextNode($values[1]));
				$o_image->appendChild($i_name);
				$o_image->appendChild($i_caption);
				$o_image->appendChild($i_description);
				$o_image->appendChild($i_checksum);
				$o_album->appendChild($o_image);
			}
		}
	}
	
	function createXML($folderStructure) {
		$doc = new DOMDocument('1.0','UTF-8');
		$doc->formatOutput = true;
		//start making XML config file header
		$root = $doc->createElement("oneMinuteGallery");
		$version = $doc->createAttribute('version');
		$version->appendChild($doc->createTextNode("1.0.1"));
		$root->appendChild($version);
		$metadata = $doc->createElement("metadata");
		$link = $doc->createElement("link");
		$time = $doc->createElement("time");
		$time->appendChild($doc->createTextNode(date("D M j G:i:s T Y")));
		$link->appendChild($doc->createTextNode("http://www.1minutegallery.com/"));
		$metadata->appendChild($link);
		$metadata->appendChild($time);
		$root->appendChild($metadata);
		//end making XML config file header
		$this->createXMLforAlbum($doc, $root, $folderStructure);
		$doc->appendChild($root);
		$f = @fopen(XMLFILE, 'w+');
		if (!$f) {
			$this->logMessage('error', 504, "Can't create " . XMLFILE . " file, please grant the webserver write permissions for " . FILEDIR . " folder.");
			return false;
		}
		else
			fclose($f);
		$doc->save(XMLFILE);
	}
	function createXMLforAlbum_PHP4($doc, $globalParentNode, $folderStructure) {
		$o_album = $doc->create_element('album');
		$o_album_caption = $doc->create_element("caption");
		$o_album_caption->append_child($doc->create_text_node(($this->currentAlbum ? $this->currentAlbum->caption : "My Album")));
		$o_album_description = $doc->create_element("description");
		$o_album_description->append_child($doc->create_text_node(($this->currentAlbum
			? $this->currentAlbum->description
			: "My Album created on " . date("F d, Y")
		)));
		$o_album_checksum = $doc->create_element("checksum");
		$o_album_checksum->append_child($doc->create_text_node($folderStructure['md5_hash']));
		$o_album->append_child($o_album_caption);
		$o_album->append_child($o_album_description);
		$o_album->append_child($o_album_checksum);
		$globalParentNode->append_child($o_album);
		$al = isset($this->currentAlbum)?$this->currentAlbum:false;
		if($al)
			$im = $al->collectionImages;
		foreach($folderStructure as $key=>$values) {
			if ($key!=='md5_hash') {//if it is one of the images
				$o_image = $doc->create_element('image');
				$i_name = $o_image->set_attribute("name",$values[0]);
				//$i_name->append_child($doc->create_text_node($values[0]));
				$i_caption = $doc->create_element("caption");
				$i_caption->append_child($doc->create_text_node($al->collectionImages[$values[0]]
					? $al->collectionImages[$values[0]]->caption
					: $values[0])
				);
				$i_description = $doc->create_element("description");
				$i_description->append_child($doc->create_text_node($al->collectionImages[$values[0]]
					? $al->collectionImages[$values[0]]->description
					: "[no description]"
				));
				$i_checksum = $doc->create_element("checksum");
				$i_checksum->append_child($doc->create_text_node($values[1]));
				$o_image->append_child($i_name);
				$o_image->append_child($i_caption);
				$o_image->append_child($i_description);
				$o_image->append_child($i_checksum);
				$o_album->append_child($o_image);
			}
		}
	}
	function createXML_PHP4($folderStructure) {
		$doc = domxml_new_doc('1.0');
		$doc->formatOutput = true;
		//start making XML config file header
		$root = $doc->create_element("oneMinuteGallery");
		$version = $doc->create_attribute('version',"1.0.1");
		$root->append_child($version);
		$metadata = $doc->create_element("metadata");
		$link = $doc->create_element("link");
		$time = $doc->create_element("time");
		$time->append_child($doc->create_text_node (date("D M j G:i:s T Y")));
		$link->append_child($doc->create_text_node ("Link"));
		$metadata->append_child($link);
		$metadata->append_child($time);
		$root->append_child($metadata);
		//end making XML config file header
		$this->createXMLforAlbum_PHP4($doc, $root, $folderStructure);
		$doc->append_child($root);
		$f = @fopen(XMLFILE, 'w+');
		if (!$f) {
			$this->logMessage('error', 505, "Can't create " . XMLFILE . " file, please grant the webserver write permissions for " . FILEDIR . " folder.");
			return false;
		}
		else
			fclose($f);
		$doc->dump_file(XMLFILE, false, true);
	}
	function logMessage ($s_level, $n_code, $s_text) {
			if (DEBUG == 0 || ($s_level == 'info' && DEBUG < 3) || ($s_level == 'message' && DEBUG < 2)) return;
			$this->debugMess[] = array($s_level, $n_code, $s_text);
	}
}

class Thumbnail {
	var $debugMess = array();
	function Thumbnail() {
		$this->t_width   = THUMBWIDTH;
		$this->s_width   = SIZEDWIDTH;
		$this->tn_dir    = substr(THUMBNAME, 0, strrpos(THUMBNAME, '/') + 1);
		$this->sized_dir = substr(SIZEDNAME, 0, strrpos(THUMBNAME, '/') + 1);
		
		if (!defined('THUMBWIDTH')) {
			define('THUMBWIDTH', 120);
		}
		if (!defined('SIZEDWIDTH')) {
			define('SIZEDWIDTH', 800);
		}
	}
	
	function getWebSafeFormat($type) {
		switch($type) {
			case 'gif':
			case 'png':
				return 'png';
			break;
				default:
				return 'jpeg';
		}
	}
	function create($file) {
		$this->imagepath = $file;
		$this->GetImgType();
		if (RESIZEMETHOD == 'GD2') {
			$GD_version=$this->getGDVersion();
			if ($GD_version < 2) {
				$this->logMessage('error', 602, "This version of GD library (" . $GD_version . ") is not supported.");
				return false;
			}
		}
		switch (RESIZEMETHOD) {
			case 'GD2':
				return $this->createGDThumbnail();
			break;
			case 'NetPbm':
				return $this->createNetPBMThumbnail();
			break;
			case 'ImageMagick':
				return $this->createImageMagickThumbnail();
			break;
		}
	}
	function createImageMagickThumbnail () {
		if (!defined('IM_PATH')) {
			define('IM_PATH', '/usr/local/bin/');
		}
		$fileout_sized = str_replace("<ext>", $this->uimage_extension, SIZEDNAME);
		$fileout_sized = str_replace("<name>", $this->filename, $fileout_sized);
		$fileout_tn = str_replace("<ext>", $this->uimage_extension, THUMBNAME);
		$fileout_tn = str_replace("<name>", $this->filename, $fileout_tn);
		if (is_file($fileout_tn)) @unlink($fileout_tn);
		if (is_file($fileout_sized)) @unlink($fileout_sized);
		$f1 = $this->tryToCreate($fileout_tn);
		$f2 = $this->tryToCreate($fileout_sized);
		if (!$f1 || !$f2) return false;
		$command  = IM_PATH . 'convert -quality ' . TN_JPEG_QUALITY . ' -sample ' . $this->t_width
			. 'x' . $this->t_height . ' ' . $this->imagepath . ' ' . $fileout_tn;
		$res = system($command);
		if (DEBUG) {
			$this->logMessage('info', 204, $command . "<br>" . $res);
		}
		if ($res === false)
			return false;
		$command  = IM_PATH . 'convert -quality ' . SIZED_JPEG_QUALITY . ' -sample ' . $this->s_width
			. 'x' . $this->s_height . ' ' . $this->imagepath . ' ' . $fileout_sized;
		$res2 = system ($command);
		if (DEBUG) {
			$this->logMessage('info', 205, $command . "<br>" . $res2);
		}
		if ($res2 === false)
			return false;
		return true;
	}
	
	function createNetPBMThumbnail() {
		$command = $command2 = array();
		if (!defined('NETPBM_PATH')) {
			define('NETPBM_PATH', '/usr/bin/');
		}
		if (!defined('TN_JPEG_QUALITY')) {
			define('TN_JPEG_QUALITY', 100);
		}
		if (!defined('SIZED_JPEG_QUALITY')) {
			define('SIZED_JPEG_QUALITY', 75);
		}
		$command[]     = NETPBM_PATH ."pnmscale -width $this->t_width -height $this->t_height";
		$command2[]    = NETPBM_PATH ."pnmscale -width $this->s_width -height $this->s_height";
		$fileout_sized = str_replace("<ext>", $this->uimage_extension, SIZEDNAME);
		$fileout_sized = str_replace("<name>", $this->filename, $fileout_sized);
		$fileout_tn    = str_replace("<ext>", $this->uimage_extension, THUMBNAME);
		$fileout_tn    = str_replace("<name>", $this->filename, $fileout_tn);
		if (is_file($fileout_tn)) @unlink($fileout_tn);
		if (is_file($fileout_sized)) @unlink($fileout_sized);
		
		$f1 = $this->tryToCreate($fileout_tn);
		$f2 = $this->tryToCreate($fileout_sized);
		if (!$f1 || !$f2) return false;
		array_unshift($command,  NETPBM_PATH . $this->uimage_extension .'topnm ' . $this->imagepath);
		array_unshift($command2, NETPBM_PATH . $this->uimage_extension .'topnm ' . $this->imagepath);
		$arg = '';
		switch($this->getWebSafeFormat(strtolower($this->uimage_extension))) {
			case 'gif':
				$command[]  = NETPBM_PATH . "ppmto" . $this->uimage_extension;
				$command2[] = NETPBM_PATH . "ppmto" . $this->uimage_extension;
			break;
			case 'jpg':
			case 'jpeg':
				$arg_tn    = "--quality=" . TN_JPEG_QUALITY;
				$arg_sized = "--quality=" . SIZED_JPEG_QUALITY;
			default:
				$command[]  = NETPBM_PATH . "ppmto" . $this->uimage_extension . " $arg_tn";
				$command2[] = NETPBM_PATH . "ppmto" . $this->uimage_extension . " $arg_sized";
			break;
		}
		$cmd = implode('|', $command) . ">" . $fileout_tn;
		$res = system($cmd);
		if (DEBUG) {
			$this->logMessage('info', 206, $cmd . "<br>" . $res);
		}
		if ($res === false) return false;
		$cmd2 = implode('|', $command2) . ">" . $fileout_sized;
		$res2 = system ($cmd2);
		if (DEBUG) {
			$this->logMessage('info', 207, $cmd2 . "<br>" . $res2);
		}
		if ($res2 === false) return false;
		return true;
	}
	function return_bytes($val) {
		$val = trim($val);
		$last = strtolower($val{ strlen($val) - 1 });
		switch($last) {
		// The 'G' modifier is available since PHP 5.1.0
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
		}
		return $val;
	}

	function createGDThumbnail () {
		$mem_limit = $this->return_bytes(ini_get('memory_limit'));
		$mem_need  = $this->s_width * $this->s_height * 24;
		if ($mem_need > ($mem_limit / 2)) {
			$this->logMessage('error', 603, "GD can't create image. Out of memory");
			return false;
		}
		switch ($this->uimage_extension) {
			case "gif":
				if (imagetypes() & IMG_GIF) {
					$this->orig_img = imagecreatefromgif ($this->imagepath);
				}
				else {
					$this->logMessage('error', 604, "No GIF support in this PHP build.");
					return false;
				}
			break;
			case "png":
				if (imagetypes() & IMG_PNG) {
					$this->orig_img = @imagecreatefrompng($this->imagepath);
				}
				else {
					$this->logMessage('error', 605, "No PNG support in this PHP build.");
					return false;
				}
			break;
			case "jpeg":
				if (imagetypes() & IMG_JPEG) {
					$this->orig_img = imagecreatefromjpeg($this->imagepath);
				}else{
					$this->logMessage('error', 606, "No JPEG support in this PHP build.");
					return false;
				}
			break;
			default:
				return false;
		}
		
		//create Thumbnail
		if (function_exists('imagecreatetruecolor'))
			$this->thumb_img = imagecreatetruecolor($this->t_width, $this->t_height);
		else
			$this->thumb_img = imagecreate($this->t_width, $this->t_height);
		if ($this->original_size[0] > $this->t_width) {
			if (function_exists('imagecopyresampled'))
				imagecopyresampled (
					$this->thumb_img, $this->orig_img, 0, 0, 0, 0, $this->t_width,
					$this->t_height, $this->original_size[0], $this->original_size[1]
				);
			else
				imagecopyresized (
					$this->thumb_img, $this->orig_img, 0, 0, 0, 0, $this->t_width,
					$this->t_height, $this->original_size[0], $this->original_size[1]
				);
		}
		//create Sized image
		if (function_exists('imagecreatetruecolor')) {
			$this->sized_img = imagecreatetruecolor($this->s_width, $this->s_height);
		}
		else {
			$this->sized_img = imagecreate($this->s_width, $this->s_height);
		}
		if ($this->original_size[0]>$this->s_width) {
			if (function_exists('imagecopyresampled'))
				imagecopyresampled($this->sized_img, $this->orig_img, 0, 0, 0, 0, $this->s_width, $this->s_height, $this->original_size[0], $this->original_size[1]);
			else
				imagecopyresized($this->sized_img, $this->orig_img, 0, 0, 0, 0, $this->s_width, $this->s_height, $this->original_size[0], $this->original_size[1]);
		}
		$fileout_sized = str_replace("<ext>", $this->uimage_extension, SIZEDNAME);
		$fileout_sized = str_replace("<name>", $this->filename, $fileout_sized);
		$fileout_tn    = str_replace("<ext>", $this->uimage_extension, THUMBNAME);
		$fileout_tn    = str_replace("<name>", $this->filename, $fileout_tn);
		if (is_file($fileout_tn)) @unlink($fileout_tn);
		if (is_file($fileout_sized)) @unlink($fileout_sized);
		$f1 = $this->tryToCreate($fileout_tn);
		$f2 = $this->tryToCreate($fileout_sized);
		if (!$f1 || !$f2)return false;
		switch ($this->uimage_extension) {
			case "gif":
			case "png":
				imagepng($this->sized_img, $fileout_sized);
				imagepng($this->thumb_img, $fileout_tn);
			break;
			case "jpeg":
				imagejpeg($this->sized_img, $fileout_sized);
				imagejpeg($this->thumb_img, $fileout_tn);
			break;
			default:
				imagedestroy($this->thumb_img);
				imagedestroy($this->sized_img);
				imagedestroy($this->orig_img);
				return false;
			break;
		}
		imagedestroy($this->thumb_img);
		imagedestroy($this->sized_img);
		imagedestroy($this->orig_img);
		return true;
	}
	
	function tryToCreate($file) {
		$f = @fopen($file, 'w+');
		if ($f) {
			@unlink($file);
			@fclose($f);
			return true;
		}
		else {
			$this->logMessage('error', 506, "Can't create " . $file . " file, please grant the webserver write permissions for " . FILEDIR . " folder.");
			return false;
		}
	}
	
	function getGDVersion() {
		$a_res = array();
		if (! extension_loaded('gd')) return false;
		if (function_exists('gd_info')) {
			$a_GDinfo = gd_info();
			preg_match('/\d/', $a_GDinfo['GD Version'], $a_res);
			return $a_res[0];
		}
		ob_start();
		phpinfo(8);
		$str_tmp = ob_get_contents();
		ob_end_clean();
		$str_tmp = stristr($str_tmp, 'gd version');
		preg_match('/\d/', $str_tmp, $a_res);
		return $a_res[0];
	}
	function GetImgType() {
		$this->original_size = getimagesize($this->imagepath);
		$this->t_width = THUMBWIDTH;
		$this->s_width = SIZEDWIDTH;
		$k = $this->original_size[0] / $this->original_size[1];
		#1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order,
		# 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC
		if (is_array($this->original_size)) {
			switch ((int)$this->original_size[2]) {
				case '1':
					$this->uimage_extension = 'gif';
				break;
				case '2':
					$this->uimage_extension = 'jpeg';
				break;
				case '3':
					$this->uimage_extension = 'png';
				break;
				case '4':
					$this->uimage_extension = 'swf';
				break;
				case '5':
					$this->uimage_extension = 'psd';
				break;
				case '6':
					$this->uimage_extension = 'bmp';
				break;
				case '7':
				case '8':
					$this->uimage_extension = 'tiff';
				break;
				default:
					$this->logMessage('error', 610, "We do not recognize this image format (" . $this->original_size[2] . ")");
					return false;
			}
			
			if ($this->original_size[0] < $this->original_size[1]) {//horizontal image
				$this->t_height = $this->t_width;
				$this->t_width  = ceil($this->t_height * $k);
				$this->s_height = $this->s_width;
				$this->s_width  = ceil($this->s_height * $k);
			}
			else {//vertical image
				$this->t_height = ceil($this->t_width / $k);
				$this->s_height = ceil($this->s_width / $k);
			}
			$fileInfo = pathinfo($this->imagepath);
			$this->filename = str_replace("." . $fileInfo['extension'], "", $fileInfo['basename']);
			return true;
		}
		else {
			$this->logMessage('error', 611, "Cannot fetch image or images details...<br>$o_image");
			return false;
		}
	}
	function logMessage ($s_level, $n_code, $s_text) {
			$this->debugMess[] = array($s_level, $n_code, $s_text);
	}
}
class TGImage{
	var $filename;
	var $s_caption;
	var $s_description;
	/*
	var $date;
	var $order;
	var $last;
	var $page;
	var $o_album;
	*/
	function TGImage($params) {
		foreach($params as $k=>$v) {
			$this->$k = $v;
		}
	}
}
class TGAlbum{
	var $s_caption;
	var $s_description;
	var $o_imagecount;
	var $collectionImages;
	function TGAlbum($params) {
		$this->currentPage = 0;
		$this->collectionImages = array();
		foreach ($params as $k => $v) {
			$this->$k = $v;
		}
	}
}


	function checkGD2() {
		$GD_version=getGDVersion();
		if ($GD_version < 2)
			return false;
		if (imagetypes() & IMG_GIF) {
			$avail[]="GIF";
		}
		if (imagetypes() & IMG_JPEG) {
			$avail[]="JPEG";
		}
		if (imagetypes() & IMG_PNG) {
			$avail[]="PNG";
		}
		if (!count($avail))
			return false;
		else
			return $avail;
	}
	
	function getGDVersion() {
		$a_res = array();
		if (!extension_loaded('gd')) return false;
		if (function_exists('gd_info')) {
			$a_GDinfo = gd_info();
			preg_match('/\d/', $a_GDinfo['GD Version'], $a_res);
			return $a_res[0];
		}
		ob_start();
		phpinfo(8);
		$str_tmp = ob_get_contents();
		ob_end_clean();
		$str_tmp = stristr($str_tmp, 'gd version');
		preg_match('/\d/', $str_tmp, $a_res);
		return $a_res[0];
	}
	
function NetPbmcheck() {
	$paths = array();
	$success1 = false;
	$success2 = false;
	if (PLATFORM == 'WIN') {
		foreach (explode(';', getenv('PATH')) as $path) {
			$path = trim($path);
			if (empty($path)) {
				continue;
			}
			if ($path{strlen($path)-1} != SEPARATOR) {
				$path .= SEPARATOR;
			}
			$paths[] = $path;
		}
		$paths[] = "C:\\Program Files\\netpbm\\";
		$paths[] = "C:\\apps\\netpbm\\";
		$paths[] = "C:\\apps\\jhead\\";
		$paths[] = "C:\\netpbm\\";
		$paths[] = "C:\\jhead\\";
		$paths[] = "C:\\cygwin\\bin\\";
	}
	else {
		foreach (explode(':', getenv('PATH')) as $path) {
			$path = trim($path);
			if (empty($path)) {
				continue;
			}
			if ($path{strlen($path)-1} != SEPARATOR) {
				$path .= SEPARATOR;
			}
			$paths[] = $path;
		}
		$paths[] = '/usr/bin/';
		$paths[] = '/usr/local/bin/';
		$paths[] = '/usr/local/netpbm/bin/';
		$paths[] = '/bin/';
		$paths[] = '/sw/bin/';
	}
	/* Now try each path in turn to see which ones work */
	$avail = array();
	foreach ($paths as $path) {
		$binaryData = array(
			'scale'      => array('pnmscale'),
			'image/jpeg' => array('jpegtopnm', 'ppmtojpeg'),
			'image/gif'  => array('giftopnm',  'ppmtogif'),
			'image/png'  => array('pngtopnm',  'pnmtopng')
			);
		$path = $path . (substr($path,-1) == SEPARATOR ? '' : SEPARATOR);
		foreach ($binaryData as $mimeList => $binaryList) {
			$found = 0;
			foreach ($binaryList as $i => $binary) {
				$fullPath = $path . $binary;
				if (PLATFORM == 'WIN') {
					$fullPath .= '.exe';
				}
				$fullPath .= ' --version';
				exec($fullPath,$results, $status);
				if ($status == 0) {
					$found ++;
				}
			}
			if ($found == 2 && $mimeList!='scale') {
				if (!@in_array($mimeList,$avail[$path])) {
					$avail[$path][] = $mimeList;
					$success1 = true;
				}
			}elseif ($found == 1 && $mimeList == 'scale') {
				$success2 = true;
			}
		}
	}
	if (!$success1 || !$success2)
		return false;
	if (count($avail))
		return $avail;
	else
		return false;
}

function IMcheck() {
	$paths = array();
	if (PLATFORM == 'WIN') {
		foreach (explode(';', getenv('PATH')) as $path) {
			$path = trim($path);
			if (empty($path)) {
				continue;
			}
			if ($path{ strlen($path) - 1 } != SEPARATOR) {
				$path .= SEPARATOR;
			}
			$paths[] = $path;
		}
		$paths[] = "C:\\Program Files\\ImageMagick\\";
		$paths[] = "C:\\apps\ImageMagick\\";
		$paths[] = "C:\\ImageMagick\\";
		$paths[] = "C:\\ImageMagick\\VisualMagick\\bin\\";
		$paths[] = "C:\\cygwin\\bin\\";
	}
	else {
		foreach (explode(':', getenv('PATH')) as $path) {
			$path = trim($path);
			if (empty($path)) {
				continue;
			}
			if ($path{strlen($path) - 1} != SEPARATOR) {
				$path .= SEPARATOR;
			}
			$paths[] = $path;
		}
		$paths[] = '/usr/bin/';
		$paths[] = '/usr/local/bin/';
		$paths[] = '/bin/';
		$paths[] = '/sw/bin/';
	}
	
	/* Now try each path in turn to see which ones work */
	$avail = array();
	foreach ($paths as $path) {
		$path = $path . (substr($path, -1) == SEPARATOR ? '' : SEPARATOR);
		$binary = 'compare';
		$fullPath = $path . $binary;
		if (PLATFORM == 'WIN') {
			$fullPath .= '.exe';
		}
		$fullPath .= ' -version';
		exec($fullPath,$results, $status);
		if ($status == 0) {
			$avail[$path] = 1;
		}
	}
	if (count($avail))return $avail;
	else return false;
}

?>
