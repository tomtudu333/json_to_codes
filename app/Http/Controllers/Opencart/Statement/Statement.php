<?php

namespace App\Http\Controllers\Opencart\Statement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Statement extends Controller
{
    //
    //php code for the function
public static function createSimpleGetPagePage($array){

  $classPath = $array["classPath"];

$functionName = $array["functionName"];

$classPathArray = explode("/",$classPath);

for($i=0;$i<sizeof($classPathArray);$i++){
  $classPathArray[$i] = ucwords($classPathArray[$i]);
}

$className = "Controller".implode("",$classPathArray);

//echo $className;


$resultString = "<?php"."\n"."\n"."\n";

  $resultString.='class '.$className.' extends Controller {
'."\n";
 $resultString.='
'."\n";
 $resultString.='      public function '.$functionName.'(){
'."\n";
 $resultString.='
'."\n";
 $resultString.='
'."\n";
 $resultString.='//      $data[\'column_left\'] = $this->load->controller(\'common/column_left\');
'."\n";
 $resultString.='// 		$data[\'column_right\'] = $this->load->controller(\'common/column_right\');
'."\n";
 $resultString.='// 		$data[\'content_top\'] = $this->load->controller(\'common/content_top\');
'."\n";
 $resultString.='// 		$data[\'content_bottom\'] = $this->load->controller(\'common/content_bottom\');
'."\n";
 $resultString.='		$data[\'footer\'] = $this->load->controller(\'common/footer\');
'."\n";
 $resultString.='		$data[\'header\'] = $this->load->controller(\'common/header\');
'."\n";
 $resultString.='
'."\n";
 $resultString.='
'."\n";
 $resultString.='    	if (file_exists(DIR_TEMPLATE . $this->config->get(\'config_template\') . \'/template/'.$classPath.'/'.$functionName.'.tpl\')) {
'."\n";
 $resultString.='			$this->response->setOutput($this->load->view($this->config->get(\'config_template\') . \'/template/'.$classPath.'/'.$functionName.'.tpl\', $data));
'."\n";
 $resultString.='		} else {
'."\n";
 $resultString.='			$this->response->setOutput($this->load->view(\'default/template/'.$classPath.'/'.$functionName.'.tpl\', $data));
'."\n";
 $resultString.='		}
'."\n";
 $resultString.='      }
'."\n";
 $resultString.='
'."\n";
 $resultString.='
'."\n";
 $resultString.='}'."\n";

   $resultString.='
'."\n";
 $resultString.='
'."\n";
 $resultString.='//the template file
'."\n";
 $resultString.='
'."\n";

 //get the template file
   $resultString.='<?php echo $header; ?>
'."\n";
 $resultString.='
'."\n";
 $resultString.='          <div class="container">
'."\n";
 $resultString.='
'."\n";
 $resultString.='
'."\n";
 $resultString.='          </div>
'."\n";
 $resultString.='<?php echo $footer; ?>'."\n";



    return $resultString;
}

}
