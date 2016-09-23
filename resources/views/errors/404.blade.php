<!DOCTYPE html>
<html>
<head>
    <title>404</title>

    <style>

        body {
            width: 100%;
            color: #b7bdc0;
            font-weight: 100;
            background-color: #f3f3f3;
        }
        .header {
            margin-top: 15%;
            text-align: center;
        }
        .my_404 {
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 65px;
        }
        .content{
            margin-top: 5%;
        }

        .my_a{
            font-family: Arial, Helvetica, sans-serif;
            color: #5cb85c;
            opacity: 0.8;
            text-decoration: none;
            font-size:15px;
        }
        .my_a:hover {
            color: #5cb85c;
            opacity: 0.9;
            font-size: 17px;
        }
        .hint{
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 3%;
            margin-left: 37%;
            line-height: 25px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="my_404"><em>404 ERROR</em></div>
</div>
<div class="content">
    <a href="/" class="my_a" style="float: left; margin-left: 38%"><strong>Back to Home Page</strong></a>
    <a href="/" class="my_a" style="float: right; margin-right: 38%" onclick="history.go(-1)"><strong>Back to Last Page</strong></a>
    <div style="clear: both"></div>
    <div class="hint">
        Oops! Page Not Found <br/>
        If you are tired, you can read some interesting news on <a href="http://www.neu.edu.cn" class="my_a" style="color: indianred;"><strong>NEU website</strong></a>.<br/>
        Also, you can <a href="http://oj.neu.edu.cn" class="my_a" style="color: indianred;"><strong>go on practicing</strong></a>.<br/>
        Good Luck!<br/>
    </div>
</div>
</body>
</html>
