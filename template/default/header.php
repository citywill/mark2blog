<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $this->title ?> <?php echo $assign['title'] ?></title>
<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css
" rel="stylesheet">
<link rel="stylesheet" href="src/github-markdown.css">
<style>
.container {max-width:800px;}
.head{
text-align: center;
border-bottom: 1px solid #eee;
padding:30px;
}
.head h1{
font-size:48px;
}
.head p{
font-size:24px;
}
</style>
</head>
<body>
<div class="head">
    <div class="container">
        <h1><a href="index.html"><?php echo $this->title ?></a></h1>
        <p>by <?php echo $this->auth ?></p>
        <p><?php echo $this->description ?></p>
    </div>
</div>
<div class="container" style="padding-top:30px;padding-bottom:30px;">