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
    color:#ffffff;
}

#bloghead a {color:#ffffff;}
#bloghead h1 {font-size:3em;}
#bloghead p {font-size:2em;}

#bloghead span.label {
    font-size:0.5em;
    font-weight: normal
}

.comment,
#article article,
#article .page-header,
#articleList .page-header {
    background-color:#FFF;
    padding:40px;
    border:1px solid #dadada;
    margin:30px 0;
}

.comment .page-header {
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
    #article article,
    #article .page-header,
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
            <p><?php echo $this->description ?></p>
            <p>
                <a href="https://www.zhihu.com/people/pmzhang" target="_blank"><span class="label label-primary">知乎</span></a>
                <a href="http://weibo.com/citywill" target="_blank"><span class="label label-danger">微博</span></a>
            </p>
        </div>
    </div>
    <div class="container" style="padding-top:30px;padding-bottom:30px;">