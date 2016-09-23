<!doctype html>
<html>
<head>
    <title>Contest Ended!</title>
    @include("layout.head")
    <link rel="stylesheet" href="/css/main.css">
    <style>
        body {
            background-color: #f3f3f3;
        }
        .my_404 {
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 35px;
        }
        .content {
            margin-top: 5%;
        }
        .content img{
            opacity: 0.7;
        }
        .content span {
            font-family:"YaHe Arial", Arial, Helvetica, sans-serif;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
@include("layout.header")

<div class="text-center content">
    <div class="my_404 text-center">Contest Ended!</div><br/><br/>
    <img src="/image/contest_end.gif"/><br/><br/><br/>
    <span class="text-muted">You are not allowed to submit now, Click <a href="/contest/{{ $contest->contest_id }}"><b>Here</b></a> to back to contest Page</span>
</div>
<br/>
<br/>
@include("layout.footer")
</body>
</html>