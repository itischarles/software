<?php

 if (!defined('BASEPATH')) exit('No direct script access allowed');

 /**
  * NOTE I HAD TO ADD THIS LINE 
  * require_once(DOMPDF_LIB_DIR . "/php-font-lib/src/FontLib/Font.php");
  * TO dompdf-master/dompdf_config.inc.php bevuase it was asking for font directory
  */

//
//
//// disable DOMPDF's internal autoloader if you are using Composer
//define('DOMPDF_ENABLE_AUTOLOAD', false);

// include DOMPDF's default configuration

require_once 'dompdf-master/dompdf_config.inc.php';

class Pdf_dompdf { 
    
    
    function pdf_create($html, $clientID,$filename = "invoice",  $stream=true, $papersize = 'A4', $orientation = 'portrait')
    {
        //require_once("dompdf/dompdf_config.inc.php");
 
        $dompdf = new DOMPDF();
        
        
        
        $dompdf->load_html($html);
        $dompdf->set_paper($papersize, $orientation);
        $dompdf->render();
        
        
        $font = Font_Metrics::get_font("helvetica", "bold");
        $canvas = $dompdf->get_canvas();
        $footer = $canvas->open_object();       
         $canvas->page_text(300, 808, "{PAGE_NUM} of {PAGE_COUNT}",   $font, 7, array(0,0,0));
        $canvas->close_object();
        $canvas->add_object($footer, "all");

        if ($stream)
        {
            $options['Attachment'] = 1;
            $options['Accept-Ranges'] = 0;
            $options['compress'] = 1;
            $dompdf->stream($filename.".pdf", $options);
        }
        else
        {      
            /**
             * @todo find out if you would needto download and save thee pdf
             */
            //make sure the client docsfile exist
            fileHelp_mkdir('client_docs');
            fileHelp_mkdir("client_docs/$clientID");
            
	    $file_location = "client_docs/$clientID/$filename.pdf";
           // write_file("client_docs/$clientID/$filename.pdf", $dompdf->output());
	    write_file("$file_location", $dompdf->output());
	    
	    return $file_location;
        }
    }
    
    
}
?>