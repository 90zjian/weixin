<?php

require 'weixin.class.php';

class DefaultWeixin extends wxmessage {


    public function processRequest($data) {
        // $input is the content that user inputs
        $input = $data->Content;       
        // deal with text msg from user
        if ($this->isTextMsg()) {
            switch ($input) {
                case 'subscribe'://new user subscribes
                    $this->welcome();
                    break;
                case 'Hello2BizUser'://only available before March 26,2013
                    $this->welcome();
                    break;
                case 'news'://news
                    $this->fulinews();
                    break;
                case 'music':
                    $this->yishengmusic();
                    break;              
              case 'joke':
                   $this->xiaohua();
                   break;
                default:
              $this->xiaohua();
                break;
                   
            }         
        }
        // deal with geographical location
        elseif ($this->isLocationMsg()) {
            $this->fulinews();
        } elseif ($this->isImageMsg()) {
            $this->fulinews();
        } elseif ($this->isLinkMsg()) {
            $this->fulinews();
        } elseif ($this->isEventMsg()) {
            
        } else {
            
        }
    }

   
    /**
     * return news
     */
    private function fulinews() {
        $text = 'QQ���ꡢ���ꡢ���ꡢ�����10Q����ѡ��һ';
        $posts = array(
            array(
                'title' => '��������',
                'discription' => $text,
                'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
                'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
            )
        );
        $xml = $this->outputNews($posts);
        header('Content-Type: application/xml');
        echo $xml;
    }

    /**
     * return text
     */
    private function text($text) {
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }

    /**
     * return jokes
     */
    private function xiaohua() {
        $text = "��ã��װ������ѣ��ҿ��ܲ��ڵ����ԡ��ȿ���Ц���ɡ��и�С���ﴩ��һ����ɫ�����ڵȳ���һ���ܺ��Ӱ��ɿ���ѩ���������������ˣ���������˵�Բ����Ӻ�Ƥ�����������Ͱ���˵��С���ѣ������������Ժ�˭�ڴ���·��Ϲ��˭����ȫ�Һò��ã���������������~";
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }

    /**
     * return welcome msg
     */
    private function welcome() {
        $text = "�װ������ѣ���ӭ��ע���ӡ��ظ���news���������ӵ�10ԪQ��С��ɡ�";
        // outputText ���������ı���Ϣ
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }

    private function music() {
        $music = array(
            'title' => '�ڴ�����',
            'discription' => '�ڴ�����-����',
            'musicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/inspring.wma',
            'hdmusicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/inspring.mp3'
        );
        $xml = $this->outputMusic($music);
        //sae_log($xml);
        header('Content-Type: application/xml');
        echo $xml;
    }

    private function yishengmusic() {
        $music = array(
            'title' => 'һ������',
            'discription' => 'Ϊʲôѡ���׸��أ���Ϊ�ҵ���������һ���������˿���һ��������أ��װ������ѣ�',
            'musicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/song/%E5%8D%A2%E5%86%A0%E5%BB%B7-%E4%B8%80%E7%94%9F%E6%89%80%E7%88%B1.mp3',
            'hdmusicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/song/%E5%8D%A2%E5%86%A0%E5%BB%B7-%E4%B8%80%E7%94%9F%E6%89%80%E7%88%B1.mp3'
        );
        $xml = $this->outputMusic($music);
        header('Content-Type: application/xml');
        echo $xml;
    }

    /**
     * Pre processing��common usage:save the request into your database.
	 * Because weixin save your msgs only 5 days.
     * @return boolean
     */
    protected function beforeProcess($postData) {

        return true;
    }

    protected function afterProcess() {
    }

    public function errorHandler($errno, $error, $file = '', $line = 0) {
        $msg = sprintf('%s - %s - %s - %s', $errno, $error, $file, $line);
    }

    public function errorException(Exception $e) {
        $msg = sprintf('%s - %s - %s - %s', $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    }

    private function saveRequest($request) {
        
    }

}




