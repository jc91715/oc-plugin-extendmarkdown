<?php namespace Jc91715\ExtendMarkDown\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Md Back-end Controller
 */
class Md extends Controller
{
    public function handle()
    {
        $content= request()->base64;
        preg_match('/^(data:\s*image\/(\w+);base64,)/', $content, $result);
        $type = $result[2];
        $filename = str_random(10);
        \Storage::put(sprintf('blog/%s.%s',$filename,$type),base64_decode(str_replace($result[1], '', $content)));
        $url=\Storage::disk('local')->url(sprintf('app/blog/%s.%s',$filename,$type));
        return response()->json(['url'=>$url]);
    }
}
