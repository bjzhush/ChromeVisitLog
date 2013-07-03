<?php
class PCurl
{
    protected $ch;

    public function setUrl($url)
    {
        $this->ch = curl_init($url);
        return $this;
    }

    public function getTitle(){
        curl_setopt($this->ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);
        $html = curl_exec($this->ch);
        $curlInfo = curl_getinfo($this->ch);

        if($curlInfo['redirect_time'] > 0) {
            //has a redirect action ,return a empty url
            return 'RedirectTitle';
        }

        if ($html) {
            $res = preg_match("!(<title[^>]*>)(.*)(</title>)!i", $html, $titles);
            if(!$res) {
                $title = '';
            } else {
                $title = preg_replace('/\s+/', ' ', $titles[2]);
                $title = trim($title);
            }
        } else {
            $title = '';
        }
        return $title;
    }
}
