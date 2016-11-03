<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect_url extends CI_Controller {

	public function index(){
        
        if ($this->os_info()=="Android") {
            // header( 'Location: https://play.google.com/store/apps/details?id=com.twofellows.cmlumobile' ) ;
            header('Location: https://play.google.com/store/apps/details?id=com.twofellows.phetchaburija');
        }elseif($this->os_info()=="iPhone"||$this->os_info()=="iPad"){
            header( 'Location: https://itunes.apple.com/us/app/phetchaburi-ja/id1033844381?l=th&ls=1&mt=8' ) ;
        }else{
            // header( 'Location: https://play.google.com/store/apps/details?id=com.twofellows.cmlumobile' );
            header('Location: https://play.google.com/store/apps/details?id=com.twofellows.phetchaburija');
        }
        //echo $this->os_info();
        exit;
        
    }
    
    

    public function os_info()
    {
        $oses   = array(
            'Win311' => 'Win16',
            'Win95' => '(Windows 95)|(Win95)|(Windows_95)',
            'WinME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
            'Win98' => '(Windows 98)|(Win98)',
            'Win2000' => '(Windows NT 5.0)|(Windows 2000)',
            'WinXP' => '(Windows NT 5.1)|(Windows XP)',
            'WinServer2003' => '(Windows NT 5.2)',
            'WinVista' => '(Windows NT 6.0)',
            'Windows 7' => '(Windows NT 6.1)',
            'Windows 8' => '(Windows NT 6.2)',
            'WinNT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'OpenBSD' => 'OpenBSD',
            'SunOS' => 'SunOS',
            'Ubuntu' => 'Ubuntu',
            'Android' => 'Android',
            'Linux' => '(Linux)|(X11)',
            'iPhone' => 'iPhone',
            'iPad' => 'iPad',
            'MacOS' => '(Mac_PowerPC)|(Macintosh)',
            'QNX' => 'QNX',
            'BeOS' => 'BeOS',
            'OS2' => 'OS/2',
            'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
        );
        $uagent = strtolower($this->uagent ? $this->uagent : $_SERVER['HTTP_USER_AGENT']);
        foreach ($oses as $os => $pattern)
            if (preg_match('/' . $pattern . '/i', $uagent))
                return $os;
        return 'Unknown';
    }
    
}
