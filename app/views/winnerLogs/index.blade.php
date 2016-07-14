@extends('layout.default')
@section('title')
获奖列表
@stop

@section('content') 

<div class="row" style="margin-top: 1em;"> 
    <div class="col-lg-12">  
        @if(count($logs)!=0) 
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr> 
                    <th>编号  </th>  
                    <th>奖品  </th>
                    <th>获奖人  </th>
                    <th>时间 </th>   
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr> 
                    <td>
                        {{ $log->id }}
                    </td> 
                    <td>
                        {{ $log->gift?$log->gift->name:"奖品已删除" }}
                    </td> 
                    <td>
                        {{ $log->phone }}/{{$log->name}}
                    </td>  
                    <td>
                        {{ $log->created_at }}
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>  
        {{$logs->links()}}
        @endif
    </div>  

</div><!-- /.row -->

@stop

@section('scripts')
<!-- Page Specific Plugins -->
<script src="{{asset('plugins/tablesorter/jquery.tablesorter.js')}}"></script>
<script src="{{asset('plugins/tablesorter/tables.js')}}"></script>


<script>
$('#btn_mulitDelete').click(function(e) {
    e.preventDefault();
    var _ids = new Array();
    var _url = $(this).attr('data-href'),
            _btn = $(this),
            _token = $(this).attr('data-token');
    //获得选中的input 
    $('input[type="checkbox"][name="ids[]"]:checked').each(function() {
        _ids.push($(this).val());
    });
    if (_ids.length == 0) {
        alert("未选择");
        return false;
    }
    if (confirm('您确定要执行此操作吗？请慎重！') == true) {
        _btn.attr("disabled", true);
        $.ajax({
            type: 'POST',
            url: _url,
            data: {'_token': _token, 'ids': _ids},
            dataType: 'json',
            beforeSend: function() {
                _btn.attr("disabled", true);
            },
            success: function(data) {
                location.reload();
                _btn.attr("disabled", false);
            },
            error: function(e, a, b) {
                if (e.status == 200) {
                    location.reload();
                } else {
                    alert('出错了，请稍候再试....');
                }
                _btn.attr("disabled", false);
            }
        });
    }
    return false;
});
</script>
@stop