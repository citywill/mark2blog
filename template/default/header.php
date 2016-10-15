<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $this->title ?> <?php echo $assign['title'] ?></title>
<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css
" rel="stylesheet">
<link rel="stylesheet" href="src/github-markdown.css">
<link rel="shortcut icon" href="src/favicon.ico" type="image/x-icon">
<style>

body {background-color: #F2F2F2;}

.container {max-width:750px;}

#bloghead{
    text-align: center;
    border-bottom: 1px solid #eee;
    padding:30px;
    background-color: #159957;
    background-image:linear-gradient(120deg, #155799, #159957);
}

#bloghead h1 a {
    font-size:1.2em;
    color:#ffffff;
}

#bloghead p.description {
    font-size:1.6em;
    color:#ffffff;
}

#bloghead span.label {
    font-size:0.5em;
    font-weight: normal
}

.comment,
#article,
#articleList .page-header {
    background-color:#FFF;
    padding:39px;
    border:1px solid #dadada;
    margin:30px 0;
}

.comment .page-header,
#article .page-header {
    margin:0;
}

.comment .page-header h3,
#article .page-header h1,
#articleList .page-header h2 {
    margin: 0px;
}

#articleList .page-header h2 a {
    color:#000;
}

#article .page-header p.status,
#articleList .page-header p.status,
#articleList .page-header p.image,
#articleList .page-header p.readmore,
#articleList .page-header p.excerpt {
    font-size:1.2em;
    margin:0px;
    margin-top:30px;
}


#article .page-header p.status{
    margin-bottom:20px;
}

article {
    margin-top: 30px;
}

#articleList .page-header h2 a {
    color: #444;
}

#article .page-header p.status,
#articleList .page-header p.status,
#articleList .page-header p.excerpt {
    color: #6B6B6B;
}

@media (max-width: 480px) {
    .comment,
    #article,
    #articleList .page-header {
        padding:20px;
        margin:20px 0;
    }

    #article .page-header p.status,
    #articleList .page-header p.status,
    #articleList .page-header p.image,
    #articleList .page-header p.readmore,
    #articleList .page-header p.excerpt {
        margin-top:20px;
    }

    #article .page-header h1,
    #articleList .page-header h2 a {
        font-size:24px;
    }
}

</style>
</head>
<body>
    <div id="bloghead">
        <div class="container">
            <h1><a href="index.html"><?php echo $this->title ?></a></h1>
            <p class="description"><?php echo $this->description ?></p>
            <p class="nav">
                <a href="index.html" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"></span></a>
                <a href="https://www.zhihu.com/people/pmzhang" target="_blank" class="btn btn-primary btn-sm">知乎</a>
                <a href="http://weibo.com/citywill" target="_blank" class="btn btn-danger btn-sm">微博</a>
                <a href="2013-10-09_about.html" class="btn btn-info btn-sm">关于</a>
                <a href="atom.xml" target="_blank" class="btn btn-warning btn-sm">RSS</a>
            </p>
        </div>
    </div>
    <div class="container" style="padding-bottom:30px;">