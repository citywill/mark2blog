<?php
namespace lib;

class mark2blog
{
    public $title = 'Mark2blog';
    public $auth = 'citywill';
    public $description = 'mark2blog是用于将md文档生成博客的php程序。目前支持简单的模板，分页索引等功能。';
    public $pageSize = 10;
    public $mdPath;
    public $htmlPath;
    public $tmplPath;
    public $generated;

    /**
     * 设置
     * @param array $config
     */
    public function __construct($config)
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
        if (!file_exists($this->mdPath)) {
            throw new \Exception('mdPath is not exist');
        }
        if (!file_exists($this->htmlPath)) {
            throw new \Exception('htmlPath is not exist');
        }
        if (!file_exists($this->tmplPath)) {
            throw new \Exception('tmplPath is not exist');
        }
    }

    /**
     * 程序执行
     */
    public function run()
    {
        $mdFiles = $this->getMdFiles();
        foreach ($mdFiles as $wholeName => $mdFile) {
            $mdFilePath = $this->mdPath . '/' . $wholeName . '.md';
            $mdContent = file_get_contents($mdFilePath);
            //根据#获取文章标题
            $titleExist = preg_match('/(?:^|\n)#([^#].*)/', $mdContent, $title);
            //如果md文档中没有#，则使用文件名作为标题
            $title = $titleExist ? $title[1] : $mdFile['fileName'];
            $mdFiles[$wholeName]['title'] = $title;
            $assign['wholeName'] = $wholeName;
            $assign['title'] = $title;
            $assign['detail'] = $this->parse($mdContent);
            $assign['date'] = $mdFile['fileDate'];

            $this->generateHtml('article', $wholeName, $assign);
        }
        $this->index2Html($mdFiles);
        $this->generated['article'] = count($mdFiles);
    }

    /**
     * 获取markdown文档列表
     * @return array
     */
    private function getMdFiles()
    {
        $mdFiles = array_diff(scandir($this->mdPath), array('..', '.'));
        if (!$mdFiles) {
            throw new \Exception('no markdown ducument');
        }

        foreach ($mdFiles as $mdFile) {
            list($fileWholeName, $fileExp) = explode('.', $mdFile);
            if ($fileExp == 'md') {
                list($fileDate, $fileName) = explode('_', $fileWholeName);
                $fileDate = strtotime($fileDate);
                $fileName = trim($fileName);
                //判断md文件名是否合格
                if (!$fileDate || !$fileName) {
                    continue;
                }

                $files[$fileWholeName] = [
                    'fileName' => $fileName,
                    'fileDate' => date('Y-m-d', $fileDate),
                ];
            }
        }
        return $files;
    }

    /**
     * 生成索引页
     * @param  array $articles 文章数组
     */
    private function index2Html($articles)
    {
        krsort($articles);
        $articleCount = count($articles);
        $pageCount = (int) ceil($articleCount / $this->pageSize);
        $pages = array_chunk($articles, $this->pageSize, true);
        foreach ($pages as $pageCurrent => $articles) {
            $assign['articles'] = $articles;
            $assign['title'] = $pageCurrent ? ('第' . ($pageCurrent + 1) . '页') : '';
            $assign['pageCurrent'] = $pageCurrent;
            $assign['pageCount'] = $pageCount;
            $assign['pagination'] = $this->getPagination($pageCount, $pageCurrent);
            $this->generateHtml('index', $assign['pagination'][$pageCurrent]['filename'], $assign);
        }
        $this->generated['index'] = $pageCount;
    }

    /**
     * 返回分页
     * @param  int $pageCount 总页数
     * @param  int $pageCurrent 当前页
     * @return array
     */
    private function getPagination($pageCount, $pageCurrent)
    {
        for ($i = 0; $i < $pageCount; $i++) {
            $pagination[$i]['filename'] = 'index' . ($i ? ('-' . ($i + 1)) : '');
            $pagination[$i]['active'] = (($i == $pageCurrent) ? true : false);
            $pagination[$i]['name'] = $i + 1;
        }
        return $pagination;
    }

    /**
     * 生成html文件
     * @param  string $tmpl     模板
     * @param  string $filename 生成的文件名
     * @param  array $assign   向模板传值
     */
    private function generateHtml($tmpl, $filename, $assign)
    {
        ob_start();
        include $this->tmplPath . '/' . $tmpl . '.php';
        $html = ob_get_contents();
        ob_end_clean();

        file_put_contents($this->htmlPath . '/' . $filename . '.html', $html);
    }

    /**
     * 解析md文件
     * @param  string $mdfile md文件路径
     * @return string html
     */
    private function parse($md, $line = false)
    {
        $Parsedown = new \Parsedown();
        if ($line) {
            return $Parsedown->line($md);
        }
        return $Parsedown->text($md);
    }

}
