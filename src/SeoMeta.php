<?php

namespace Xcalder\SeoMeta;

class SeoMeta
{
    private $meta = [];
    private $link = [];
    private $title = '';
    
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
        $this->title = $title . '-' . config('app.name');
    }
    
    public function getSeoHtml(){
        $html = '';
        if(!empty($this->title)){
            $html .= '12';
        }
        if(!empty($this->meta)){
            foreach($this->meta as $key=>$meta){
               $html .= '456'; 
            }
        }
        if(!empty($this->link)){
            foreach($this->link as $key=>$link){
                $html .= '1236';
            }
        }
        return $html;
    }
}
