<!doctype html>
<html>
<head>
    <title>Problem {{$problem->problem_id}}</title>
    @include("layout.head")
    <link rel="stylesheet" href="/css/main.css">
    <script>
        $(function(){
            $("#problem").addClass("active");

            $("#submit").click(function(){
                $("#mymodal").modal("toggle");
            });
            $("#promblem_submit_textarea").keydown(function(){
                if($("#promblem_submit_textarea").val().length<50||
                        $("#promblem_submit_textarea").val().length>50000) {
                    $("#hint_code").addClass("label-warning");
                    $("#hint_code").html("the character range must be [50,50000]");
                }else{
                    $("#hint_code").removeClass("label-warning");
                }
            });
            $("#submit_code").click(function(){
                if($("#promblem_submit_textarea").val().length>=50&&
                        $("#promblem_submit_textarea").val().length<=50000){
                    $(this).attr("disabled",true);
                    setTimeout("$('#submit_code').removeAttr('disabled');",3000);
                    $("#form_code").submit();
                }
            });
        });
    </script>
</head>
<body>
    @include("layout.header")


    <h3 class="text-center">Problem: {{ $problem->title }}</h3>
    <div class="text-center text-primary">Time limit: {{ $problem->time_limit }}s&nbsp;&nbsp;&nbsp;&nbsp;Mem limit:@if($problem->mem_limit < 1000)
            {{ $problem->mem_limit }} KB
        @else
            {{ $problem->mem_limit / 1000 }} MB
        @endif
            @if($problem->is_spj == 1) <b>Special Judge</b>@endif
        @if(isset($contest))
            AC/Submission: <a href="/contest/{{ $contest->contest_id }}/status/p/1?result=Accepted?pid={{ $problem->problem_id }}"/>{{ $problem->acSubmissionCount }}</a>/ <a href="/contest/{{ $contest->contest_id }}/status/p/1?pid={{ $problem->problem_id }}">{{ $problem->totalSubmissionCount }}</a>
        @endif
        @if(!isset($contest))
            AC/Submission: <a href="/status/p/1?result=Accepted&pid={{ $problem->problem_id }}"/>{{ $problem->acSubmissionCount }}</a>/ <a href="/status/p/1?pid={{ $problem->problem_id }}">{{ $problem->totalSubmissionCount }}</a>
        @endif
    </div>

    @if(isset($contest))
        <div class="contest_single_nav text-center">
            <a class="btn btn-default" href="/contest/{{ $contest->contest_id }}">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>
            <a class="btn btn-default" href="/contest/{{ $contest->contest_id }}/ranklist">Ranklist</a>
            <a class="btn btn-default" href="/contest/{{ $contest->contest_id }}/status">&nbsp;Status&nbsp;</a>
            <span id="contest_countdown_text">Time Remaining:</span>
            <span class="badge countdown">
                <strong id="day_show">0天</strong>
                <strong id="hour_show">0时</strong>
                <strong id="minute_show">00分</strong>
                <strong id="second_show">00秒</strong>
            </span>
        </div>
        <script type="text/javascript">
            var begin=new Date("{{$contest->begin_time}}").getTime();
            var now=new Date().getTime();
            var end=new Date("{{$contest->end_time}}").getTime();
            var wholetime=(end-begin)/1000;
            var pretime=(begin-now)/1000;
            var remaintime=(end-now)/1000;
            function timer(){
                window.setInterval(function(){
                    var day=0,
                            hour=0,
                            minute=0,
                            second=0;//时间默认值
                    if(pretime<=0){
                        $('#contest_countdown_text').html("Time Remaining:");
                        if(remaintime > 0){
                            day = Math.floor(remaintime / (60 * 60 * 24));
                            hour = Math.floor(remaintime / (60 * 60)) - (day * 24);
                            minute = Math.floor(remaintime/ 60) - (day * 24 * 60) - (hour * 60);
                            second = Math.floor(remaintime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                        }
                        if (minute <= 9) minute = '0' + minute;
                        if (second <= 9) second = '0' + second;
                        $('#day_show').html(day+"天");
                        $('#hour_show').html('<s id="h"></s>'+hour+'时');
                        $('#minute_show').html('<s></s>'+minute+'分');
                        $('#second_show').html('<s></s>'+second+'秒');
                        remaintime--;
                    }
                    else{
                        $('#contest_countdown_text').html("Pending:");
                        day = Math.floor(pretime/ (60 * 60 * 24));
                        hour = Math.floor(pretime / (60 * 60)) - (day * 24);
                        minute = Math.floor(pretime / 60) - (day * 24 * 60) - (hour * 60);
                        second = Math.floor(pretime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                        if (minute <= 9) minute = '0' + minute;
                        if (second <= 9) second = '0' + second;
                        $('#day_show').html(day+"天");
                        $('#hour_show').html('<s id="h"></s>'+hour+'时');
                        $('#minute_show').html('<s></s>'+minute+'分');
                        $('#second_show').html('<s></s>'+second+'秒');
                        pretime--;
//                    if(pretime==0)
//                    {
//                        location.reload();
//                    }
                    }
                }, 1000);
            }
            $(function () {
                timer();
            })
        </script>

    @endif

    <div class="panel panel-default main">

        <h3>Problem Description</h3>
        <p class="word_cut">{{ $problem->description }}</p>
        <hr>
        <h3>Input</h3>
        <p class="word_cut">{{ $problem->input }}</p>
        <hr>
        <h3>Output</h3>
        <p class="word_cut">{{ $problem->output }}</p>
        <hr>
        <h3>Sample Input</h3>
        <p class="word_cut">{{ $problem->sample_input }}</p>
        <hr>
        <h3>Sample Output</h3>
        <p class="word_cut">{{ $problem->sample_output }}</p>
        <hr>
        <h3>Source</h3>
        <p class="word_cut">{{ $problem->source }}</p>
    </div>
    @if(Request::session()->get('username') != NULL)
        <div class="text-center" style="padding-bottom: 50px"><a class="btn btn-success" id="submit">submit</a></div>
    @else
        <div class="text-center" style="padding-bottom: 50px"><a href="/auth/signin">Sign in</a> to Submit your code</div>
    @endif

    <div class="modal fade" id="mymodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #286090">
                    <button type="button" class="close" data-dismiss="modal" style="color: white"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"style="color: white">Submit</h4>
                </div>
                <div class="modal-body">
                    @if(!isset($contest))
                        <form action="/submit/{{ $problem->problem_id }}" method ="POST" id="form_code">
                    @endif
                    @if(isset($contest))
                        <form action="/submit/{{ $contest->contest_id }}/{{ $problem->problem_id }}" method ="POST" id="form_code">
                    @endif
                     {{ csrf_field() }}
                        <span name="Language" style="float: left;font-size: 16px;margin-top: 8px">language:</span>
                        <select name="lang" class="form-control" style="display: inline-block;width: 100px;margin-bottom: 10px">
                            <option name="c">C</option>
                            <option name="cpp">C++</option>
                        </select>
                        <textarea name="code" id="promblem_submit_textarea" class="form-control" placeholder="Input your code here..."></textarea>
                        <input type="reset" class="btn btn-primary pull-right" value="&nbsp;Reset&nbsp;" style="margin-left: 10px;margin-top: 10px"/>
                        <input type="button" class="btn btn-primary pull-right" value="Submit" style="margin-top: 10px" id="submit_code"/>
                        <div style="margin-top: 15px"><div class="label label-warning" style="font-size: 13px;" id="hint_code">the character range must be [50,50000]</div></div>
                        <div class="text-center" style="padding-bottom: 20px;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        @include("layout.footer")
</body>
<html>
