<?php

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

/**
 * Define bytes in kilobyte.
 */
define('KILOBYTE', 1024);

/**
 * Define bytes in kilobyte.
 */
define('ALLOWABLE_TAGS', '<h1><h2><h3><h4><h5><h6><p><a><ul><ol><li><strong><em>');

// Set default data variables.
$data = array(
  'headerContent' => '',
  'title' => 'Banners Preview',
  'logo' => '',
  'titleMain' => 'Client List Full',
  'titleSub' => '',
  'content' => '',
  'nav' => ''
);

// CHECK FOR QUERYSTRING?
// IF NONE THEN WE ARE AT TOP LEVEL - (current index.php list template)
// If there's a GET "path" argument, render a banner instead of the list.
if (isset($_GET['path']) && !empty($_GET['path'])) {
    
    //echo "path querystring DOES EXIST--<br />";
    
    $path = htmlspecialchars($_GET["path"]);
    
    $pathNew1 = ltrim($path,"./");
    
    $varsPath = explode("/",$pathNew1);
    $pathCount=0;

    foreach ($varsPath as $key => $value) {
        echo "Key IS SET PATH: $key; Value: $value<br />\n";
        
        $pathCount++;
    }
    
    //$directories = get_directories("./" .$path, $data);
    
    echo 'PATHCOUNNNNNNT = ' . $pathCount . '<br /><br />';
    
    $directories = get_directories("./Sony/", $data);
    
    generate_list($directories, $data);
    
    //$directoriesNav = get_directories_nav("./" .$varsPath[0], $data);
    
    //var_dump($directoriesNav);
    
    //generate_list_nav($directoriesNav, $data);
    
    // SET MAIN VARIABLES HERE!!!
    
    //$data['titleMain'] = $varsPath[0];
    
    $data['titleMain'] = '<a href="index.php?path=' . $varsPath[0] . '&orientation=pt">' . $varsPath[0] . '</a>';
    
    if($varsPath[0]==$varsPath[($pathCount-1)]){
        //echo "SAME SAME SAME Same";
    }else{
        $data['titleSub'] = '<a href="index.php?path=' . $pathNew1 . '&orientation=pt">' . $varsPath[($pathCount-1)] . '</a>';
    }

    
    $data['headerContent'] = 'hiiiiiiiiiKKKKKK';
    
    //$titleCampaign = $varsPath[($pathCount-1)];
    //$qsPathLevel1= $varsPath[($pathCount-1)]; // This will be CLIENT NAME

    //$titleClient = $varsPath[0];
//    $qsPathLevel1= $varsPath[0]; // This will be CLIENT NAME
//    //$titleCampaign = $varsPath[1];
//    $qsPathLevel2= $varsPath[1]; // This will generally each campaign path CLIENT NAME
//    //$titleRoute = $varsPath[2];
//    $qsPathLevel3= $varsPath[2]; // This will generally each campaign ROUTE EG COUNTRY OR MEDIA TYPE?? path CLIENT NAME
//    //$titleFormat = $varsPath[3];
//    $qsPathLevel4= $varsPath[3]; // This will be deeper campaign route EG COUNTRY/MEDIA_TYPE/300x250n etc 
    
}else{
    
    $dir    = '.';
    //$files1 = scandir($dir);

    $directories = glob($dir . '/*' , GLOB_ONLYDIR);
    
    $DirPathCount=0;



        // SET MAIN VARIABLES HERE!!!

        //$titleCampaign = $varsPath[($pathCount-1)];
        //$qsPathLevel1= $varsPath[($pathCount-1)]; // This will be CLIENT NAME

        //$titleClient = $varsPath[0];
//        $dirPathLevel1= $directories[0]; // This will be CLIENT NAME
//        //$titleCampaign = $varsPath[1];
//        $dirPathLevel2= $directories[1]; // This will generally each campaign path CLIENT NAME
//        //$titleRoute = $varsPath[2];
//        $dirPathLevel3= $directories[2]; // This will generally each campaign ROUTE EG COUNTRY OR MEDIA TYPE?? path CLIENT NAME
//        //$titleFormat = $varsPath[3];
//        $dirPathLevel4= $directories[3]; // This will be deeper campaign route EG COUNTRY/MEDIA_TYPE/300x250n etc 



$data['headerContent'] = 'hiiiiiiiiiKKKKKK';

$data['content'].= '<ul class="level1">';


    // $directoriesList = get_directories($dir . '/*' , $data);

    // MHERE WE SET all current PATH VARIABLES, SIMILAR TO OUR QUERY STRING VARIABLES.

    //echo "DIRECTORIES = " . $directories;

    //var_dump($directories);
    // Directories to ignore.
    $ignore = array('.', '..', 'cgi-bin', 'images', 'scripts','.DS_Store','copy.txt');
    
    

    foreach ($directories as $key => $value) {

//         echo "LOOP directories=========================<br />\n";
//        echo "Key: $key; Value: $value<br />\n";   

        $pathNew = ltrim($value,"./");

        //echo $pathNew . "<br />";

        //echo "LOOP directories FIRST TIME<br />\n";

          // Check that this file is not to be ignored.
        if (!in_array($pathNew, $ignore)) {  

        //        echo "foreach (directories FIRST LOOP key: $key; Value: $value<br />\n";
                $DirPathCount++;
                $data['content'].= '<li class="t-client"><a href="index.php?path=' . $pathNew . '&orientation=pt">' . $pathNew . '</a></li>';

            }// END if (!in_array($pathNew, $ignore)) {  
        }/// END foreach
    
    //$data['content'].= '</ul>';
}
// END if (isset($_GET['path']) && !empty($_GET['path'])) {


/**
 * Get the directories  structured array.
 */
function get_directories($path, &$data, &$list = array()) {
  // Directories to ignore.
  $ignore = array('.', '..', 'cgi-bin', 'images', 'scripts', 'js', 'css');
  // Filetypes to display
  $allowed_filetypes = array('swf', 'jpg', 'png', 'gif', 'html');
    
  // $count will be initialized the first time a() was called
  static $countDir = 0;
  // counter will be incremented each time the method gets called
     
  echo __METHOD__ . " was called $countDir times\n<br /><br />";
    
echo $path . '<br /><br /><br />';
    
    $pathTmpNew1 = ltrim($path,"./");
    
    $varsTmpPath = explode("/",$pathTmpNew1);
    $pathTmpCount=0;

    foreach ($varsTmpPath as $key => $value) {
        echo "Key IS SET PATH: $key; Value: $value<br />\n";
        
        $pathTmpCount++;
    }
    
    echo $pathTmpCount . '<br /><br /><br />';
    
  $countDir++;

    $dirTest = "./Sony";
    
  // Open the directory.
  if ($dh = @opendir($path)) {
  //if ($dh = @opendir($dirTest)) {
    // Loop through the directory.
    while (FALSE !== ($file = readdir($dh))) {
      $dir = "{$path}/{$file}";
        
      

      // Check that this file is not to be ignored.
      if (!in_array($file, $ignore)) {
        if (is_dir($dir)) {
            
            
            
          if (substr($file, 0, 1) != '_') {
            // Its a directory, so we need to keep reading down.
              
//            echo $path . '<br /><br /><br />';
//            echo '<br /><br />OPEN DIR LEVEL 1<br /><br />';
              
            if (number_of_files($dir) != 0) {
                
                echo $path . '<br /><br /><br />';
                
              $list[$file]['title'] = $file;
              $list[$file]['path'] = $dir;
              get_directories($dir, $data, $list[$file]);
            }
          }
        }
        else {
            
            
          // Set logo and meta info.
          switch (pathinfo($file, PATHINFO_FILENAME)) {
            case '_logo':
              $data['logo'] = substr($dir, 1);
              break;
            case '_meta':
              $data['content'] = '<div>' . strip_tags(file_get_contents($dir), ALLOWABLE_TAGS) . '</div>';
              break;
          }

          // Add file into the list.
          if (in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed_filetypes)) {
            // Ignore files that starts with underscore sumbol.
            if (!in_array(substr($file, 0, 1), array('_', '.'))) {
              $fileinfo = pathinfo($file);
              $fileinfo['file_size'] = format_bytes(filesize($dir));
              $fileinfo['file_path'] = $dir;
              $list['files'][] = $fileinfo;
            }
          }
        }
      }
    }

    // Close the directory.
    closedir($dh);
  }

  return $list;
}

/**
 * Generate HTML list of directories and files.
 */
function generate_list($directories, &$data) {
    
    // $count will be initialized the first time a() was called
     static $count = 0;
     // counter will be incremented each time the method gets called
     

     //echo __METHOD__ . " was called $count times\n";
    
//  $data['content'].= '<ul class="level' . $count . '">';
    
    
    
    
  foreach ($directories as $dir) {
      
    //print_r($dir);
    
    //echo '<br /><br />';
      
    if (isset($dir['title'])) {
        
        $tmpDirPathExplode = explode("/",$dir['path']);
        
        //echo $dir['path'] . '<br /><br /><br />';
        
        $list_dir_url = 'index.php?path=' .  $dir['path'] . '&orientation=pt';
        
        //echo $list_dir_url . "<br /><br />";

        $tmpDirPathCount=0;

        echo "COUNT tmpDirPathExplode = " . count($tmpDirPathExplode) . "<br /><br />";

        foreach ($tmpDirPathExplode as $key => $value) {
            //echo "Key IS SET PATH: $key; Value: $value<br />\n";
            $tmpDirPathCount++;
        }
        
        echo $tmpDirPathCount . '<br /><br /><br />';
        
        
      $data['content'].= '<li class="t-client level-' . count($tmpDirPathExplode) . '"><a href="index.php?path=' .  $dir['path'] . '&orientation=pt">' . $dir['title'] . '</a></li>';
        
      unset($dir['title']);
    }
    if (isset($dir['basename'])) {
      $data['content'].= generate_file_list_item($dir);
    }
    if (isset($dir['files'])) {
      foreach ($dir['files'] as $file) {
        $data['content'].= generate_file_list_item($file);
      }
      unset($dir['files']);
    }
    if (count($dir) && !isset($dir['basename'])) {
//      $data['content'].= '<li>';
        generate_list($dir, $data);
//      $data['content'].= '</li>';
    }
  }// END foreach ($directories as $dir) {
    
  $count ++;    
    
  //$data['content'].= '</ul>';
}

/**
 * Generate file list item with the link to the file.
 */
function generate_file_list_item($file) {
  $extension = strtoupper($file['extension']);
  return "<li class=\"hide\"><a href=\"index.php?path={$file['file_path']}\">[{$file['file_size']}] - {$extension}</a></li>";
}








/**
 * Get the directories nav structured array.
 */
function get_directories_nav($path, &$data, &$list_nav = array()) {
  // Directories to ignore.
  $ignore = array('.', '..', '.DS_Store', 'cgi-bin', 'images', 'scripts', 'js', 'css', 'copy.txt');
  // Filetypes to display
  $allowed_filetypes = array('swf', 'jpg', 'png', 'gif', 'html');

  // Open the directory.
  if ($dh = @opendir($path)) {
    // Loop through the directory.
    while (FALSE !== ($file = readdir($dh))) {
      $dir = "{$path}/{$file}";
        
      //echo "FILE ================= " . $file . "<br /><br /><br />";

      // Check that this file is not to be ignored.
      if (!in_array($file, $ignore)) {
          
          //echo "FILE ================= " . $file . "<br /><br /><br />";
          
        if (is_dir($dir)) {
          if (substr($file, 0, 1) != '_') {
            // Its a directory, so we need to keep reading down.
            if (number_of_files($dir) != 0) {
              $list_nav[$file]['title'] = $file;
              $list_nav[$file]['path'] = $dir;
              get_directories_nav($dir, $data, $list_nav[$file]);
            }
          }
        }
        else {
          // Set logo and meta info.
//          switch (pathinfo($file, PATHINFO_FILENAME)) {
//            case '_logo':
//              $data['logo'] = substr($dir, 1);
//              break;
//            case '_meta':
//              $data['content'] = '<div>' . strip_tags(file_get_contents($dir), ALLOWABLE_TAGS) . '</div>';
//              break;
//          }

          // Add file into the list.
          if (in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed_filetypes)) {
            // Ignore files that starts with underscore sumbol.
            if (!in_array(substr($file, 0, 1), array('_', '.'))) {
              $fileinfo = pathinfo($file);
              //$fileinfo['file_size'] = format_bytes(filesize($dir));
              $fileinfo['file_path'] = $dir;
              $list_nav['files'][] = $fileinfo;
            }
          }
            
        }
      }
    }

    // Close the directory.
    closedir($dh);
  }

  return $list_nav;
}// END function get_directories_nav($path, &$data, &$list = array()) {


/**
 * Generate HTML list of directories and files.
 */
function generate_list_nav($directories, &$data, &$list_nav_url = array()) {
    
  foreach ($directories as $dir) { 
      
    if (isset($dir['title'])) {
        
        $tmpPathExplode = explode("/",$dir['path']);
        
        //echo $dir['path'] . '<br /><br /><br />';
        
        $list_nav_url = 'index.php?path=' .  $dir['path'] . '&orientation=pt';

        $tmpPathCount=0;

        //echo "COUNT tmpPathExplode = " . count($tmpPathExplode) . "<br />";

        foreach ($tmpPathExplode as $key => $value) {
            //echo "Key IS SET PATH: $key; Value: $value<br />\n";
            $tmpPathCount++;
        }

        if (isset($dir['files'])) {

            $data['nav'].= '<li class="directory-header dir-level-' . $tmpPathCount . ' dir-level-final"><a href="index.php?path=' .  $dir['path'] . '&orientation=pt">' . $dir['title'] . '</a></li>';
            
            //$list_nav_url = 'index.php?path=' .  $dir['path'] . '&orientation=pt';
            
            unset($dir['title']);

        }else{

            $data['nav'].= '<li class="directory-header dir-level-' . $tmpPathCount . '"><a href="index.php?path=' .  $dir['path'] . '&orientation=pt">' . $dir['title'] . '</a></li>';
            
//            $list_nav_url = 'index.php?path=' .  $dir['path'] . '&orientation=pt';
            
            unset($dir['title']);

        }// END if (isset($dir['files'])) {
        
    }// END if (isset($dir['title'])) {
      

    if (count($dir) && !isset($dir['basename'])) {
      //$data['nav'].= '<li>';
      generate_list_nav($dir, $data, $list_nav_url);
      //$data['nav'].= '</li>';
    }
      
  }
    //print_r($list_nav_url);
    
    return $list_nav_url;
    
}// END function generate_list_nav($directories, &$data) {





/**
 * Get logo file if it exists
 */
function get_logo($path, &$data) {
    
    $pathNewTemp1 = ltrim($path,"./");
    $varsPath = explode("/",$pathNewTemp1);
    $pathCount=0;
    
  // Replace the logo if it exist.
    $logo = "_logo.";
    $types = array('jpg', 'png', 'gif');
    
    foreach ($types as $type) {
        if (file_exists($varsPath[0] . '/' . $logo . $type)) {
            
            $data['logo'] .= '<a href="index.php?path=' . $varsPath[0] . '&orientation=pt"><img id="logo_client" src="' . $varsPath[0] . '/' . $logo . $type . '" /></a>';

        }// END if (file_exists($varsPath[3] . '/' . $logo . $type)) {
    }// END foreach ($types as $type) {
  return $data['logo'];   
}// END function get_logo($path) {

/**
 * Recursively scan the directory to get the meta.
 */
function meta_scan_directories(&$path, $dir, &$meta) {
  $file = "{$path}{$dir}/_meta.txt";
  $path = "{$path}{$dir}/";
  if (file_exists($file)) {
    $meta = '<div>' . strip_tags(file_get_contents($file), ALLOWABLE_TAGS) . '</div>';
  }
}

// If there's a GET "orientation" argument, render correct styles etc.
if (isset($_GET['orientation']) && !empty($_GET['orientation'])) {
    $orientation = htmlspecialchars($_GET["orientation"]);
}

//generate_list($directories, $data);

/**
 * Generates a string representation for the given byte count.
 */
function format_bytes($bytes, $precision = 2) { 
  $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

  $bytes = max($bytes, 0); 
  $pow = floor(($bytes ? log($bytes) : 0) / log(KILOBYTE)); 
  $pow = min($pow, count($units) - 1); 

  $bytes /= pow(KILOBYTE, $pow);

  return round($bytes, $precision) . ' ' . $units[$pow]; 
} 

/**
 * Count the number of files in the directory.
 */
function number_of_files($directories) {
    //console.log('function number_of_files($directories) {');
    
  $files_count = 0;
  $directories = new DirectoryIterator($directories);
  foreach ($directories as $file) {
    $files_count++;
  }
  $files_count = $files_count-2;
    //echo "FILES_COUNT = " . $files_count . "<br />";
  return $files_count;
}

//generate_list($directories, $data);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Norton</title>
<link href="css/stylezim.css" rel="stylesheet" type="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    
<link href='https://fonts.googleapis.com/css?family=Dosis:400,200,300,500,600,700' rel='stylesheet' type='text/css'>    
</head>
<body id="css-zen-garden">
    
    <div class="page-wrapper">

	<section class="intro" id="zen-intro">
		<header role="banner">
			<h1>CSS Zen cunt</h1>
			<h2>The Beauty of <abbr title="Cascading Style Sheets">CSS</abbr> Design</h2>
		</header>

		<div class="summary" id="zen-summary" role="article">
			<p>I have worked in the internet field for 20 years and still enjoy the challenges that are presented with every new project.</p>
			<p>I want to continue to grow my skills in the internet field.</p>
		</div>

		<div class="preamble" id="zen-preamble" role="article">
			<h3>Early Career</h3>
			<p>MINISTRY OF SOUND, London Jan 1997 – Jan 2000</p>	
<p>Web Developer</p>
<p>Responsibilities</p>

<p>Hand coding of Ministryofsound.com using HTML, ASP, Javascript</p>
<p>Helped develop and maintain the Content Management System for MoS.COM using HTML ASP and SQL server</p>
		</div>
	</section>

	<div class="main supporting" id="zen-supporting" role="main">
		<div class="explanation" id="zen-explanation" role="article">
			<h3>Learning In The Field</h3>
			<p>EMAP UK FHM, London					Jan 2000 – Mar 2007	
Web Developer
Responsibilities

<p>Producing and maintaining FHM web site Using HTML, JavaScript, ASP, Enterprise Manager. Photoshop, Homesite.</p>
<p>Project managing site development from beginning to end, including asset and people management.</p>
<p>Production of internet based marketing tools.</p>
<p>Manage internal and external production relations for FHM.com website.</p>
<p>The creative development of the FHM.com web site.</p>
<p>Testing and bug fixing.</p>
<p>Contributing ideas and suggestions for the FHM.com website</p>
<p>Project management.</p>

<p>Day to day</p>
<p>Hand coding of Micro sites and Competitions for the FHM.com web (Using intermediate classic ASP to develop data base driven pages that write to and read from SQL tables) – Including 100 Sexiest voting mechanism, 100 Greatest Internet Games and many more.
Coding of site for cross browser compatability.</p>
<p>Hand coding of Micro sites and Competitions for advertising and marketing departments using XHTML, ASP, CSS, JavaScript.</p>
<p>Manage and provide information from FHM Microsoft SQL database for advertising and marketing departments.</p>
<p>Help to develop and maintain the Content Management System for FHM.com using ASP and Microsoft SQL Server.</p>
<p>Project manage micro sites from start to finish.</p>
<p>Day to day management and bug fixing of FHM.Com web site. Including Code changes and image changes.</p>
<p>Construction of FHM.COM email newsletters using HTML and Bluestreak Email system.</p>
		</div>

		<div class="participation" id="zen-participation" role="article">
			<h3>Networking... Growing My Skills</h3>
            
            <p>WILSON FLETHCER</p>
            
			<p>ARCHIBALD INGALL STRETTON, London Nov 2009 – present</p>
<p>Front End Web Developer</p>
<p>Responsibilities</p>

<p>Production of O2 Preference capture microsite Using XHTML, CSS, JavaScript, JQuery, within .NET 2, visual studio 2008, SVN environment to W3C standards</p>

<p>O2 Preference capture microsite – NOT YET LIVE</p>


<p>SEVEN SQUARED, London Aug 2009 – Nov 2009</p>
<p>Front End Web Developer</p>
<p>Responsibilities</p>

<p>Production of cutting edge web sites Using XHTML, CSS, JavaScript, JQuery, Silverstripe CMS to W3C standards.for Large projects</p>

 <p>HYPERLINK "http://www3.sainsburys.co.uk/littleones/" http://www3.sainsburys.co.uk/littleones/</p>
<p>Royal Bank of Scotland – NOT YET LIVE</p>
<p>Seven Squared – NOT YET LIVE</p>



<p>MYKINDAPLACE/BURST INTERACTIVE, London Mar 2008 – June 2009</p>
<p>Front End Web Developer</p>
<p>Responsibilities</p>

<p>Producing and maintaining http://www.mykindaplace.com web site Using XHTML, HTML, CSS, JavaScript, JQuery, Photoshop, Visual Studio 2005 to W3C standards.</p>
<p>Production and maintenance of Sites and microsites for Burst Interactive Using XHTML, HTML, CSS, JavaScript, JQuery, Visual Studio 2005 (And numerous microsites for sky digital as MYKINDAPLACE/BURST INTERACTIVE is owned by sky digital) to W3C standards.</p>

 <p>Including:</p>

 <p>HYPERLINK "http://www.umusic.co.uk/" http://www.umusic.co.uk/</p>
 <p>HYPERLINK "http://inkpop.com/" http://inkpop.com/</p>
 <p>HYPERLINK "http://www.authonomy.com" http://www.authonomy.com</p>
 <p>HYPERLINK "http://www.lolasland.com" http://www.lolasland.com</p>
<p>http://www.angiesmith.co.uk</p>
<p>http://www.redrockcreative.co.uk</p>
<p>http://news.sky.com/skynews/video</p>
 <p>HYPERLINK "http://style.sky.com/" http://style.sky.com/</p>



<p>GUERRILLA, London Mar 2007 – Nov 2007</p>
<p>Web Developer</p>
            <p>Responsibilities</p>

            <p>Producing and maintaining http://www.Guerrilla.uk.com web site Using HTML, JavaScript, PHP, Photoshop, DreamWeaver 8.</p>
            <p>Production of Site http:// HYPERLINK "http://www.shortlist.com" www.shortlist.com using ASP.NET 2</p>
<p>This was my first project in ASP.NET 2 using Microsoft Visual Studio .NET 2005 and SQL Server to produce the CMS behind this site. I very much enjoy this development environment and want to progress in this area.</p>
		</div>

		<div class="benefits" id="zen-benefits" role="article">
			<h3>Cementing Knowledge On Big Projects</h3>
			<p><p>Aptivata</p>
            <p>NHS Mobile App</p>
            
            <p>SEVEN SQUARED, London Aug 2009 – Dec 20011</p>
<p>Mobile/Web Developer</p>
<p>Responsibilities</p>
            
            <p>Medtronic’s innovating for life comms app.</p>
            
            <p>Showtime's new tv series House of Lies.</p>

<p>Production of Project Ipad magazine</p>
		</div>

		<div class="requirements" id="zen-requirements" role="article">
			<h3>Currently</h3>
			<p>TAG Wortldwide Front End Developer</p>
            
            <p>AA Magazine</p>
            
            <p>BASF STite</p>
            
            <p>CHI stuff</p>
            <p>- valentines</p>
            <p>- LEXUS</p>
            
            <p>BT EMAILS</p>
            
            <p>HTML5</p>
            
            <p>BANNERS</p>
            
            <p>SONY PHP MODULE</p>
            
            
            
            
            
            
		</div>

		<footer>
			<a href="http://validator.w3.org/check/referer" title="Check the validity of this site&#8217;s HTML" class="zen-validate-html">HTML</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer" title="Check the validity of this site&#8217;s CSS" class="zen-validate-css">CSS</a>
			<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="View the Creative Commons license of this site: Attribution-NonCommercial-ShareAlike." class="zen-license">CC</a>
			<a href="http://mezzoblue.com/zengarden/faq/#aaa" title="Read about the accessibility of this site" class="zen-accessibility">A11y</a>
			<a href="https://github.com/mezzoblue/csszengarden.com" title="Fork this site on Github" class="zen-github">GH</a>
		</footer>

	</div>


	<aside class="sidebar" role="complementary">
		<div class="wrapper">

			<div class="design-selection" id="design-selection">
				<h3 class="select">List of Stuff</h3>
				<nav role="navigation">
					<ul>
					<li>
						<a href="/221/" class="design-name">Stuff</a> by						<a href="http://andrewlohman.com/" class="designer-name">Someone</a>
					</li>					<li>
						<a href="/220/" class="design-name">Garments</a> by						<a href="http://danielmall.com/" class="designer-name">Dan Mall</a>
					</li>					<li>
						<a href="work/ipad-iframe.html" class="design-name">Ipad</a> by						<a href="http://steffen-knoeller.de" class="designer-name">Zim</a>
					</li>					<li>
						<a href="/218/" class="design-name">Apothecary</a> by						<a href="http://trentwalton.com" class="designer-name">Trent Walton</a>
					</li>					<li>
						<a href="/217/" class="design-name">Screen Filler</a> by						<a href="http://elliotjaystocks.com/" class="designer-name">Elliot Jay Stocks</a>
					</li>					<li>
						<a href="/216/" class="design-name">Fountain Kiss</a> by						<a href="http://jeremycarlson.com" class="designer-name">Jeremy Carlson</a>
					</li>					<li>
						<a href="/215/" class="design-name">A Robot Named Jimmy</a> by						<a href="http://meltmedia.com/" class="designer-name">meltmedia</a>
					</li>					<li>
						<a href="/214/" class="design-name">Verde Moderna</a> by						<a href="http://www.mezzoblue.com/" class="designer-name">Dave Shea</a>
					</li>					</ul>
				</nav>
			</div>

			<div class="design-archives" id="design-archives">
				<h3 class="archives">Archives:</h3>
				<nav role="navigation">
					<ul>
						<li class="next">
							<a href="/214/page1">
								Next Designs <span class="indicator">&rsaquo;</span>
							</a>
						</li>
						<li class="viewall">
							<a href="http://www.mezzoblue.com/zengarden/alldesigns/" title="View every submission to the Zen Garden.">
								View All Designs							</a>
						</li>
					</ul>
				</nav>
			</div>

			<div class="zen-resources" id="zen-resources">
				<h3 class="resources">Resources:</h3>
				<ul>
					<li class="view-css">
						<a href="style.css" title="View the source CSS file of the currently-viewed design.">
							View This Design&#8217;s <abbr title="Cascading Style Sheets">CSS</abbr>						</a>
					</li>
					<li class="css-resources">
						<a href="http://www.mezzoblue.com/zengarden/resources/" title="Links to great sites with information on using CSS.">
							<abbr title="Cascading Style Sheets">CSS</abbr> Resources						</a>
					</li>
					<li class="zen-faq">
						<a href="http://www.mezzoblue.com/zengarden/faq/" title="A list of Frequently Asked Questions about the Zen Garden.">
							<abbr title="Frequently Asked Questions">FAQ</abbr>						</a>
					</li>
					<li class="zen-submit">
						<a href="http://www.mezzoblue.com/zengarden/submit/" title="Send in your own CSS file.">
							Submit a Design						</a>
					</li>
					<li class="zen-translations">
						<a href="http://www.mezzoblue.com/zengarden/translations/" title="View translated versions of this page.">
							Translations						</a>
					</li>
				</ul>
			</div>
		</div>
	</aside>


</div>

<ul id="main_nav" style="background-color:#f0f0f0;">
<img src="images/icon-close.png" id="cta_close_nav" class="cta-close-nav" />

<?php print $data['nav']; ?>
</ul>

<div id="wrapper_outer">
    kgukg
    
    <header>
        <a href="index.php"><img id="logo" src="http://tdi.tagmedia.co.uk/T/tag_logo_new2.gif"/></a>
        
       
        
        <?php if (empty($data['logo'])){ ?>
        
            
        
        <?php } else { //echo $data['logo'][0];
    
            if($data['logo'][0]=="/"){
                $data['logo'] = substr($data['logo'], 1);
            }
    
        ?>

        <?php print $data['logo']; ?>
        
        <?php } ?>
        
        <ul class="controls">
           
            <img src="images/arr-l.png" id="arr_l" class="arr-l" />
            
            <img src="images/arr-r.png" id="arr_r" class="arr-r" />
            
            <img src="images/icon-menu.png" id="icon_menu" class="icon-menu" />
            
        </ul>
    </header>

    <h1 id="title_main"><?php print $data['titleMain']; ?></h1>
    
    <?php if (empty($data['titleSub'])){ ?>
        
            
        
        <?php } else { //echo $data['logo'][0];
            ?>
<h3 id="title_sub"><?php print $data['titleSub']; ?></h3>
        
        
        <?php } ?>
       
    <ul class="level1">
    
    <?php print $data['content']; ?>
      
 
    <?php
    
    

    
?>    

</div>
<!-- end wrapper_outer -->

<script>
    
    function init(){
       console.log('FUNCTION init CALLLED');
        
       var ctaNav = document.getElementById("icon_menu");
       var ctaCloseNav = document.getElementById("cta_close_nav");
       var mainNav = document.getElementById("main_nav");
    
        ctaNav.addEventListener("click", function(){
            //console.log('ctaNav HIT');            
            mainNav.style.right = "0px";
        });
        
        ctaCloseNav.addEventListener("click", function(){
            //console.log('ctaCloseNav HIT');            
            mainNav.style.right = "-50%";
        });
        
    }// END function init()
        

    
    document.addEventListener('DOMContentLoaded', init, false);
    
    
    
    
</script>

</body>
</html>