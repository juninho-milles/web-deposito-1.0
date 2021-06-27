<?php

namespace App\Libraries;

use App\Controllers\BaseController;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

class LblDropbox extends BaseController {

    protected $dropboxKey = "ncr2i55zz8of7zs";
    protected $dropboxSecret = "f9fml7klquipki4";
    protected $dropboxToken = "GmJt0vL6d9sAAAAAAAAAAdJWiMlBYFyjEa5lVto0mLogYKHdUgaVbi0rd2M8w0w4";

    protected $app;
    protected $dropbox;

    public function __construct() {
        $this->app = new DropboxApp($this->dropboxKey, $this->dropboxSecret, $this->dropboxToken);
        $this->dropbox = new Dropbox($this->app);
    }

    public function salvarArquivos($tempFile, $nomeDropbox) {
        $file = $this->dropbox->simpleUpload( $tempFile, $nomeDropbox, ['autorename' => true]);

        if($file):
            return $file->name;
        else:
            return '';
        endif;
    }

    public function getUrlArquivo($arquivo) {
        return $this->dropbox->getTemporaryLink($arquivo)->getLink();
    }

}