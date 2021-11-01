<?php


namespace App\Helpers;


use App\File;
use phpDocumentor\Reflection\Type;

class MainHelpers {
    public static $project_fields   = [
        'description'        => 'описание',
        'title'              => 'название',
        'price'              => 'стоимость',
        'project_appendices' => 'приложения к проекту',
        'simple_projects'    => 'примеры тсполнения',
        'project_results'    => 'параметры результата проекта',
        'technical_task'     => 'техническое задание',
    ];
    static public function wrapProjectDiff($diff){
        $diff_keys = array_keys($diff);
        $msg = 'В проект были внесены изменения. Затронуты следующие значения: ';
        $added_string = '';
        foreach($diff_keys as $key){
            if(isset(self::$project_fields[$key])){
                $added_string .= self::$project_fields[$key].', ';
            }
        }
        if(!$added_string){
            return false;
        }
        $msg .= substr($added_string,0,-2).'. Проверьте новые значения и примите либо отклоните их.';
        return $msg;
    }
    static public function pinUnpinFile($urls, $type, $id){
	    File::whereIn('url', $urls)->update(['fileable_id' => $id]); //прикрепляем все url

	    File::where('fileable_type', $type)     //откреплемем все что не нашли
		    ->where('fileable_id', $id)
		    ->whereNotIn('url', $urls)
		    ->delete();

    }
    static public function pinFile($urls, $id){
	    File::whereIn('url', $urls)->update(['fileable_id' => $id]); //прикрепляем все url

    }
}
