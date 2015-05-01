<?php
class DeleteFileTempCommand extends CConsoleCommand
{
    public $webRoot;

    public function init() {
        $this->webRoot = dirname(__FILE__);
        //30 2  * * *  /usr/bin/php  /path/to/console.php dbcleaner >/dev/null
    }

    public function getHelp()
    {
        $out = "Clean command allows you to clean up various temporary data Yii and an application are generating.\n\n";
        return $out.parent::getHelp();
    }

    public function actionCache()
    {
        if(empty($this->webRoot))
        {
            echo "Please specify a path to webRoot in command properties.\n";
            Yii::app()->end();
        }

        $this->cleanDir($this->webRoot.'/../runtime/cache');
        echo "Done.\n";
    }

    public function actionAssets()
    {
        if(empty($this->webRoot))
        {
            echo "Please specify a path to webRoot in command properties.\n";
            Yii::app()->end();
        }

        $this->cleanDir($this->webRoot.'/../../assets');

        echo "Done.\n";
    }

    public function actionRuntime()
    {
        $this->cleanDir(Yii::app()->getRuntimePath());
        echo "Done.\n";
    }

    private function cleanDir($dir)
    {
        $di = new DirectoryIterator($dir);
        foreach($di as $d)
        {
            if(!$d->isDot())
            {
                echo "Removed ".$d->getPathname()."\n";
                $this->removeDirRecursive($d->getPathname());
            }
        }
    }

    private function removeDirRecursive($dir)
    {
        $files = glob($dir.'*', GLOB_MARK);
        foreach ($files as $file)
        {
            if (is_dir($file))
                $this->removeDirRecursive($file);
            else
                unlink($file);
        }

        if (is_dir($dir))
            rmdir($dir);
    }
}