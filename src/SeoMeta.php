<?php

namespace Xcalder\SeoMeta;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Xcalder\Xunsearch\XunsearchClient;
use XSTokenizerScws;

class SeoMeta
{
    private $meta = [];
    private $link = [];
    private $title = '';
    private $description = '';
    
    public function __construct()
    {
        //
    }
    
    public function addMeta($data = []){
        if(empty($data)){
            return false;
        }
        $this->meta[] = $data;
    }
    
    public function addlink($data = []){
        if(empty($data)){
            return false;
        }
        $this->link[] = $data;
    }
    
    public function setTitle($title) {
        if(is_array($title)){
            $title = implode(',', $title);
        }
        $this->title = $title . '-' . config('app.name');
    }
    
    public function setDescription($description) {
        if(is_array($description)){
            $description = implode(',', $description);
        }
        $this->description = $description;
    }
    
    public function getSeoHtml(){
        $html = '';
        
        if(!empty($this->title)){
            $html .= '<title>'.Str::limit($this->title, 150).'</title>';
        }
        if(!empty($this->meta)){
            foreach($this->meta as $key=>$meta){
               $name = $meta['name'] ?? '';
               $content = $meta['content'] ?? '';
               $html .= '<meta name="'.$name.'" content="'.$content.'"/>';
            }
        }
        if(!empty($this->link)){
            foreach($this->link as $key=>$link){
                
            }
        }
        
        $html .= $this->otherMeta();
        
        return $html;
    }
    
    private function otherMeta(){
        $base_url = url('');
        $mobile_url = m_url(URL::current());
        $pc_url = pc_url(URL::current());
        $html = '';
        $keywords = $this->WordSegmentation($this->title.$this->description.$this->description, 10);
        $html .= '<meta name="keywords" content="'.$keywords.'">';
        $html .= '<meta name="description" content="'. (Str::limit($this->description, 150)) .'"/>'; 
        $html .= '<link rel="alternate" href="'.URL::current().'" hreflang="'.str_replace('_', '-', app()->getLocale()).'"/>';
        $html .= '<link rel="dns-prefetch" href="'.$base_url.'">';
        $html .= '<base href="'.$base_url.'">';
        $html .= '<link rel="shortcut icon" href="'.asset('favicon.ico').'" />';
        
        if($base_url == config('app.mobile_url')){
            $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
            $html .= '<meta http-equiv="Cache-Control" content="no-cache"/>';
            $html .= '<!--禁止百度转码-->';
            $html .= '<meta http-equiv="Cache-Control" content="no-transform" />';
            $html .= '<meta http-equiv="Cache-Control" content="no-siteapp"/>';
            $html .= '<link rel="canonical" href="'.$pc_url.'"/>';
        }
        
        if($base_url == config('app.url')){
            $html .= '<meta http-equiv="mobile-agent" content="format=xhtml; url='.$mobile_url.'" data-url="'.$mobile_url.'">';
            $html .= '<meta http-equiv="mobile-agent" content="format=html5; url='.$mobile_url.'">';
        }
        
        return $html;
    }
    
    private function WordSegmentation($text, $length = 3){
        $xs = new XunsearchClient(
            config('scout.xunsearch.index'),
            config('scout.xunsearch.search'),
            ['schema' => config('scout.xunsearch.schema')]
            );
        $xs->initIndex('keywords');
        $tokenizer = new XSTokenizerScws(10);
        $tops = $tokenizer->getTops($text, $length, 'n');
        if(empty($tops)){
            return $text;
        }
        $text = laravel_array_column($tops, 'word');
        $text = implode(',', $text);
        return $text;
    }
}
