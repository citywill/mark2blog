<?php
namespace lib;

class mark2blog
{
    public $title = 'Mark2blog';
    public $auth = 'citywill';
    public $description = 'mark2blog是用于将md文档生成博客的php程序。目前支持简单的模板，分页索引等功能。';
    public $pageSize = 10;
    public $mdPath = 'markdown';
    public $htmlPath = 'html';
    public $tmplPath = 'template';
    public $generated;

    /**
     * 设置
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
        if (!file_exists($this->mdPath)) {
            throw new \Exception('mdPath does not exist');
        }
        if (!file_exists($this->htmlPath)) {
            throw new \Exception('htmlPath does not exist');
        }
        if (!file_exists($this->tmplPath)) {
            throw new \Exception('tmplPath does not exist');
        }
    }

    /**
     * 程序执行
     */
    public function run()
    {
        $mdFiles = $this->getMdFiles();

        //为计算相邻文章
        $mdFileNames = array_keys($mdFiles);
        $i = 0;

        foreach ($mdFiles as $wholeName => $mdFile) {
            //构造md文档路径并获取md文档内容
            $mdFilePath = $this->mdPath . '/' . $wholeName . '.md';

            $mdContent = file_get_contents($mdFilePath);

            //获取文本头信息，并返回剩余文本
            $head = $this->getHead($mdContent, $mdContent);

            //生成文章数据
            $articles[$wholeName] = array_merge($mdFiles[$wholeName], $head);
            $articles[$wholeName]['wholeName'] = $wholeName;
            $articles[$wholeName]['date'] = $mdFile['fileDate'];
            $articles[$wholeName]['detail'] = $this->parse($mdContent);

            //上一篇文章
            if (isset($mdFileNames[$i - 1])) {
                $articles[$wholeName]['previous']['wholeName'] = $mdFileNames[$i - 1];
            }

            //下一篇文章
            if (isset($mdFileNames[$i + 1])) {
                $articles[$wholeName]['next']['wholeName'] = $mdFileNames[$i + 1];
            }

            $i++;
        }

        //生成文章
        foreach ($articles as $wholeName => $article) {
            $assign = $article;

            //相邻文章
            if (isset($article['previous'])) {
                $previous = $article['previous']['wholeName'];
                $assign['previous']['title'] = $articles[$previous]['title'];
            }

            if (isset($article['next'])) {
                $next = $article['next']['wholeName'];
                $assign['next']['title'] = $articles[$next]['title'];
            }

            $this->generateHtml('article', $wholeName, $assign);
        }

        //生成结果数据：生成文章数量
        $this->generated['article'] = count($articles);

        //生成索引页
        $this->index2Html($articles);
    }

    /**
     * 获取markdown文档列表
     * @return array
     */
    protected function getMdFiles()
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
                    'title' => str_replace('-', ' ', $fileName),
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
    protected function index2Html($articles)
    {
        krsort($articles);

        $articleCount = count($articles);

        $pageCount = (int) ceil($articleCount / $this->pageSize);

        //将数组按照页数分割
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
    protected function getPagination($pageCount, $pageCurrent)
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
    protected function generateHtml($tmpl, $filename, $assign)
    {
        ob_start();
        include $this->tmplPath . '/' . $tmpl . '.php';
        $html = ob_get_contents();
        ob_end_clean();

        file_put_contents($this->htmlPath . '/' . $filename . '.html', $html);
    }

    /**
     * 获取md文档的头信息
     * @param  string $mdContent md文档内容
     * @param  string &$mdContentBody 返回去掉头信息的文档内容
     * @return array 头信息数组
     */
    protected function getHead($mdContent, &$mdContentBody)
    {
        $mdContentBody = trim($mdContent);
        //匹配头信息
        if (preg_match('/^-{3,}(.*?)-{3,}/s', $mdContentBody, $headReg)) {
            list($headStr, $head) = $headReg;

            //将头信息从内容中删除
            $mdContentBody = trim(substr($mdContentBody, strlen($headStr) - strlen($mdContentBody)));

            //判断头信息是否有效
            if (preg_match_all('/([^:]*):(.*)/m', $head, $headDataArr)) {
                foreach ($headDataArr[1] as $key => $value) {
                    $headData[trim($value)] = trim($headDataArr[2][$key]);
                }
            }
        }

        //判断是否获取到标题
        if (!isset($headData['title'])) {

            //根据#获取文章标题
            if (preg_match('/^#([^#].*)/', $mdContentBody, $title)) {
                $headData['title'] = trim($title[1]);
                $mdContentBody = trim(substr($mdContentBody, strlen($title[1]) - strlen($mdContentBody)));
            }
        }
        return $headData;
    }

    /**
     * 解析md文件
     * @param  string $mdfile md文件路径
     * @return string html
     */
    protected function parse($md, $line = false)
    {
        $Parsedown = new \Parsedown();
        if ($line) {
            return $Parsedown->line($md);
        }
        return $Parsedown->text($md);
    }

}
