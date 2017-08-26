<?php

function downloadFile ($url, $path) {
	
    $file = fopen ($url, "rb");
    if ($file) {
	    if(fopen ($path, "wb")){		  
            $newf = fopen ($path, "wb");
	    }
	    else{
		    return false;
	    }
        if ($newf)
            while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
            }
    }
    else{
	    return false;
    }

    if ($file) {
        fclose($file);
    }

    if ($newf) {
        fclose($newf);
    }
    return true;
}
?>