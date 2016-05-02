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
 * Get the directories  structured array.
 */
//function get_directories($path, &$data, &$list = array()) {
//    
//   // echo 'function get_directories($path, &$data, &$list = array()) {=============================<br />';
//    get_logo($path, $data);
//    
//    
//    
////    echo "<br />HHHHHHHHHHHHHHH";
////    echo $data['logo'];
////    echo "<br />";
//    
//  // Directories to ignore.
//  $ignore = array('.', '..', 'cgi-bin', 'images', 'scripts', 'js', 'css', 'manifest.json','.DS_Store','copy.txt');
//  // Filetypes to display
//  $allowed_filetypes = array('swf', 'jpg', 'png', 'gif', 'html');
//  // Directories to ignore.
//  $ignoreLogo = array('_logo.jpg', '_logo.gif', '_logo.png');
//
//  // Open the directory.
//  if ($dh = @opendir($path)) {
//      
//      $loopCount = 1;
//      // INCLUDE FOR SWF WIDTH DETECTION
//      include('./blob_data_as_file_stream.php');
//      
//      $pathNewTemp = ltrim($path,"./");
//      
//      
//      
//      echo 'if ($dh = @opendir($path)) {aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa<br />' . $pathNewTemp . "<br />";
//      
//      //if (file_exists($varsTemp[0] . "/" . $varsTemp[1] . "/copy.txt")) {
//        if (file_exists($pathNewTemp . "/copy.txt")) {
//            echo "The copy.txt file exists";
//
//            $myfile1 = fopen($pathNewTemp . "/copy.txt", "r") or die("Unable to open file!");
//            $copyIndex = 0;
//            
//            $itemTitleArray;
//            $copyArray;
//
//            while(! feof($myfile1)){
//
//                $copyStrTemp = fgets($myfile1);        
//                $varsStrTemp = explode("/",$copyStrTemp);
//
//                var_dump($varsStrTemp);
//                $itemTitleArray[$copyIndex] = $varsStrTemp[0];
//                $copyArray[$copyIndex] = $varsStrTemp[1];
//                $copyIndex++;
//
//            }// end while(! feof($myfile1))
//
//            fclose($myfile1);  
//
//        } else {
//            echo "The copy.txt file does not exist";    
//            //echo $varsTemp[0] . "/" . $varsTemp[1] . "/copy.txt";
//
//            //$myfileTemp = fopen($pathNew . "copy.txt", "w");
//
////            foreach ($list as $key => $value) {
////                //echo "Key: $key; Value: $value<br />\n";
////                $keyInt = intval($key);
////                $keyInt = $keyInt+1;
////                $txt = "pic" . $keyInt . "/\n";        
////                fwrite($myfileTemp, $txt);
////            }// END foreach ($filesTemp as $key => $value) {
//
//            //fclose($myfileTemp);
//
//        }// END if (file_exists($varsTemp[0] . "/" . $varsTemp[1] . "/copy.txt")) {
//      
//      
//      $data['content'].= '<ul class="level1">';
//      
//    // Loop through the directory.
//    while (FALSE !== ($file = readdir($dh))) {
//      $dir = "{$path}/{$file}";
//        
////        echo "// Loop through the directory..................." . $dir . "<br />";
//        //echo $dir . "<br />";
//
//      // Check that this file is not to be ignored.
//      if (!in_array($file, $ignore)) {
//          //echo "// NOT IGNORED..................." . $dir . "<br />";
//        if (is_dir($dir)) {
////            $data['content'].= 'FUUUUCK iT<br />';
////            echo "// IS directory..................." . $dir . "<br />";
////            $data['content'].= '<li class="t-client"><a href="index.php?path=' . $dir . '&orientation=pt">' . $dir . '</a></li>';
//            
//          if (substr($file, 0, 1) != '_') {
//              
////              echo "// IS directory..................." . $dir . "<br />";
////            $data['content'].= '<li class="t-client"><a href="index.php?path=' . $dir . '&orientation=pt">' . $dir . '</a></li>';
//              
//            // Its a directory, so we need to keep reading down.
//            if (number_of_files($dir) != 0) {
//                $list[$file]['title'] = $file;
//                 //echo "// IS directory...................<br />" . $dir . "<br />";
//              $data['content'].= '<li class="t-client"><a href="index.php?path=' . $dir . '&orientation=pt">' . $file . '</a></li>';
//              //$list[$file]['title'] = $file;
//              //$data['content'].= 'FUUUUCK iT<br />';
//              //get_directories($dir, $data, $list[$file]);
//            }
//              
//          }
//            
//        }
//        else {
//            
//            //echo $file . "<br /><br /><br />"; 
//            
//            
//          // Set logo and meta info.
////          switch (pathinfo($file, PATHINFO_FILENAME)) {
////            case '_logo':
////              $data['logo'] = substr($dir, 1);
////              break;
////            case '_meta':
////              $data['content'] = '<div>' . strip_tags(file_get_contents($dir), ALLOWABLE_TAGS) . '</div>';
////              break;
////          }
//
//          // Add file into the list.
//          if (in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed_filetypes)) {
//              //echo "PLEEAAASE<br />";
//              echo $file;
//            // Ignore files that starts with underscore sumbol.
//            if (!in_array(substr($file, 0, 1), array('_', '.'))) {
//                echo "WWWWAAAAAAAAA<br />";
//              //$fileinfo = pathinfo($file);
//              //$fileinfo['file_size'] = format_bytes(filesize($dir));
//              //$fileinfo['file_path'] = $dir;
//              //$list['files'][$loopCount++] = $fileinfo;
//            }// END IF
//          }// END IF
//            
//            
//          if ((in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed_filetypes))and(substr($file, 0, 1) != '_')) {
//                
//                $extension = pathinfo($file, PATHINFO_EXTENSION);
//                
//                //echo $extension . '<br />';
//                
//                switch ($extension) {
//                    // Render an image.
//                    case 'gif':
//                    case 'jpg':
//                    case 'png':
//                        
//                        echo $file;
//                        
//                        $size = getimagesize($dir);
//                        
//                        var_dump($size);
//                        
//                        $data['content'].= '<li class="item-wrapper item-wrapper-pt item-wrapper-pt-' . $size[0] . '">';
//
//                        // ADD TO $data[content].
//                        $data['content'].= '<div>' . $itemTitleArray[$loopCount-1] . '</div><div class="item-img"><img src="' . $dir . '" alt="" class="sub-img" /></div><div><p class="sub" data-edit="false">' . $copyArray[$loopCount-1];
//
//                        // ADD TO $data[content].
//                          $data['content'].= '</p></div></li>';
//
//                      break;
//                    // Render HTML iframe.
//                    case 'html':
//                        
//                      $data['content'].= '<iframe src="' . $dir . '" frameborder="0" width="100%" height="100%"></iframe>';
//                        
//                      break;
//                    // Render Flash object.
//                    case 'swf':
//                        
//                        
//                        #Register the stream wrapper
//                        stream_wrapper_register("BlobDataAsFileStream", "blob_data_as_file_stream");
//                        
//                        $swf_url = $dir;
//                        $swf_blob_data = file_get_contents($swf_url);                      
//
//                #Store $swf_blob_data to the data stream
//                        blob_data_as_file_stream::$blob_data_stream = $swf_blob_data;
//
//                #Run getimagesize() on the data stream
//                        $swf_info = getimagesize('BlobDataAsFileStream://');
//                        var_dump($swf_info);
////                        
//                        echo $swf_info[3];
//                        
//                        $data['content'].= '<li class="item-wrapper item-wrapper-pt item-wrapper-pt-' . $swf_info[0] . '"><div>' . $itemTitleArray[$loopCount-1] . '</div>';
//                        
//                      $data['content'].= '<div class="item-flash"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ' . $swf_info[3] . ' >
//                        <param name="movie" value="' . $dir . '" />
//                        <!--[if !IE]>-->
//                          <object type="application/x-shockwave-flash" data="' . $dir . '" ' . $swf_info[3] . '>
//                        <!--<![endif]-->
//                          <p>Unfortunately it appears your flash version does not support this file, please download the latest version of flash.</p>
//                        <!--[if !IE]>-->
//                          </object>
//                        <!--<![endif]-->
//                      </object></div>';
//                        
//                        // ADD TO $data[content].
//                          $data['content'].= '<p class="sub" data-edit="false">' . $copyArray[$loopCount-1] . '</p></li>';
//                        
//                      break;
//                  }
//                
//                
//            
////                $data['content'].= '<li class="item-wrapper item-wrapper-pt">';
////
////                // ADD TO $data[content].
////                $data['content'].= '<div><img src="' . $dir . '" alt="" class="sub-img" /></div><div><p class="sub" data-edit="false">copy here';
////
////                // ADD TO $data[content].
////                  $data['content'].= '</p></div>
////                    </li>';
//            
//            }// end if    
//            
//        }// END if (is_dir($dir)) {
//          
//          $loopCount++;
//      }// END if (!in_array($file, $ignore)) {
//        
//        
//    }
//      $data['content'].= '</ul>';
//    // Close the directory.
//    closedir($dh);
//  }// END if ($dh = @opendir($path)) {
//
//    var_dump($list);
//  return $list;
//}
// END function get_directories($path, &$data, &$list = array()) {

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
<link href="css/main.css" rel="stylesheet" type="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body id="css-zen-garden">
    
    <div class="page-wrapper">

	<section class="intro" id="zen-intro">
		<header role="banner">
			<h1>CSS Zen Garden</h1>
			<h2>The Beauty of <abbr title="Cascading Style Sheets">CSS</abbr> Design</h2>
		</header>

		<div class="summary" id="zen-summary" role="article">
			<p>A demonstration of what can be accomplished through <abbr title="Cascading Style Sheets">CSS</abbr>-based design. Select any style sheet from the list to load it into this page.</p>
			<p>Download the example <a href="/examples/index" title="This page's source HTML code, not to be modified.">html file</a> and <a href="/examples/style.css" title="This page's sample CSS, the file you may modify.">css file</a></p>
		</div>

		<div class="preamble" id="zen-preamble" role="article">
			<h3>The Road to Enlightenment</h3>
			<p>Littering a dark and dreary road lay the past relics of browser-specific tags, incompatible <abbr title="Document Object Model">DOM</abbr>s, broken <abbr title="Cascading Style Sheets">CSS</abbr> support, and abandoned browsers.</p>
			<p>We must clear the mind of the past. Web enlightenment has been achieved thanks to the tireless efforts of folk like the <abbr title="World Wide Web Consortium">W3C</abbr>, <abbr title="Web Standards Project">WaSP</abbr>, and the major browser creators.</p>
			<p>The CSS Zen Garden invites you to relax and meditate on the important lessons of the masters. Begin to see with clarity. Learn to use the time-honored techniques in new and invigorating fashion. Become one with the web.</p>
		</div>
	</section>

	<div class="main supporting" id="zen-supporting" role="main">
		<div class="explanation" id="zen-explanation" role="article">
			<h3>So What is This About?</h3>
			<p>There is a continuing need to show the power of <abbr title="Cascading Style Sheets">CSS</abbr>. The Zen Garden aims to excite, inspire, and encourage participation. To begin, view some of the existing designs in the list. Clicking on any one will load the style sheet into this very page. The <abbr title="HyperText Markup Language">HTML</abbr> remains the same, the only thing that has changed is the external <abbr title="Cascading Style Sheets">CSS</abbr> file. Yes, really.</p>
			<p><abbr title="Cascading Style Sheets">CSS</abbr> allows complete and total control over the style of a hypertext document. The only way this can be illustrated in a way that gets people excited is by demonstrating what it can truly be, once the reins are placed in the hands of those able to create beauty from structure. Designers and coders alike have contributed to the beauty of the web; we can always push it further.</p>
		</div>

		<div class="participation" id="zen-participation" role="article">
			<h3>Participation</h3>
			<p>Strong visual design has always been our focus. You are modifying this page, so strong <abbr title="Cascading Style Sheets">CSS</abbr> skills are necessary too, but the example files are commented well enough that even <abbr title="Cascading Style Sheets">CSS</abbr> novices can use them as starting points. Please see the <a href="http://www.mezzoblue.com/zengarden/resources/" title="A listing of CSS-related resources"><abbr title="Cascading Style Sheets">CSS</abbr> Resource Guide</a> for advanced tutorials and tips on working with <abbr title="Cascading Style Sheets">CSS</abbr>.</p>
			<p>You may modify the style sheet in any way you wish, but not the <abbr title="HyperText Markup Language">HTML</abbr>. This may seem daunting at first if you&#8217;ve never worked this way before, but follow the listed links to learn more, and use the sample files as a guide.</p>
			<p>Download the sample <a href="/examples/index" title="This page's source HTML code, not to be modified.">HTML</a> and <a href="/examples/style.css" title="This page's sample CSS, the file you may modify.">CSS</a> to work on a copy locally. Once you have completed your masterpiece (and please, don&#8217;t submit half-finished work) upload your <abbr title="Cascading Style Sheets">CSS</abbr> file to a web server under your control. <a href="http://www.mezzoblue.com/zengarden/submit/" title="Use the contact form to send us your CSS file">Send us a link</a> to an archive of that file and all associated assets, and if we choose to use it we will download it and place it on our server.</p>
		</div>

		<div class="benefits" id="zen-benefits" role="article">
			<h3>Benefits</h3>
			<p>Why participate? For recognition, inspiration, and a resource we can all refer to showing people how amazing <abbr title="Cascading Style Sheets">CSS</abbr> really can be. This site serves as equal parts inspiration for those working on the web today, learning tool for those who will be tomorrow, and gallery of future techniques we can all look forward to.</p>
		</div>

		<div class="requirements" id="zen-requirements" role="article">
			<h3>Requirements</h3>
			<p>Where possible, we would like to see mostly <abbr title="Cascading Style Sheets, levels 1 and 2">CSS 1 &amp; 2</abbr> usage. <abbr title="Cascading Style Sheets, levels 3 and 4">CSS 3 &amp; 4</abbr> should be limited to widely-supported elements only, or strong fallbacks should be provided. The CSS Zen Garden is about functional, practical <abbr title="Cascading Style Sheets">CSS</abbr> and not the latest bleeding-edge tricks viewable by 2% of the browsing public. The only real requirement we have is that your <abbr title="Cascading Style Sheets">CSS</abbr> validates.</p>
			<p>Luckily, designing this way shows how well various browsers have implemented <abbr title="Cascading Style Sheets">CSS</abbr> by now. When sticking to the guidelines you should see fairly consistent results across most modern browsers. Due to the sheer number of user agents on the web these days &#8212; especially when you factor in mobile &#8212; pixel-perfect layouts may not be possible across every platform. That&#8217;s okay, but do test in as many as you can. Your design should work in at least IE9+ and the latest Chrome, Firefox, iOS and Android browsers (run by over 90% of the population).</p>
			<p>We ask that you submit original artwork. Please respect copyright laws. Please keep objectionable material to a minimum, and try to incorporate unique and interesting visual themes to your work. We&#8217;re well past the point of needing another garden-related design.</p>
			<p>This is a learning exercise as well as a demonstration. You retain full copyright on your graphics (with limited exceptions, see <a href="http://www.mezzoblue.com/zengarden/submit/guidelines/">submission guidelines</a>), but we ask you release your <abbr title="Cascading Style Sheets">CSS</abbr> under a Creative Commons license identical to the <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="View the Zen Garden's license information.">one on this site</a> so that others may learn from your work.</p>
			<p role="contentinfo">By <a href="http://www.mezzoblue.com/">Dave Shea</a>. Bandwidth graciously donated by <a href="http://www.mediatemple.net/">mediatemple</a>. Now available: <a href="http://www.amazon.com/exec/obidos/ASIN/0321303474/mezzoblue-20/">Zen Garden, the book</a>.</p>
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
				<h3 class="select">Select a Design:</h3>
				<nav role="navigation">
					<ul>
					<li>
						<a href="/221/" class="design-name">Mid Century Modern</a> by						<a href="http://andrewlohman.com/" class="designer-name">Andrew Lohman</a>
					</li>					<li>
						<a href="/220/" class="design-name">Garments</a> by						<a href="http://danielmall.com/" class="designer-name">Dan Mall</a>
					</li>					<li>
						<a href="/219/" class="design-name">Steel</a> by						<a href="http://steffen-knoeller.de" class="designer-name">Steffen Knoeller</a>
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