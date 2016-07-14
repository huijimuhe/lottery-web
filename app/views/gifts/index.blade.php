@extends('layout.default')
@section('title')
奖品列表
@stop

@section('content') 
<div class="row">
    <div class="col-lg-12"> 
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    
            <p>等级参数请使用整数,不能重复</p> 
            <p>中奖率必须设置为整数，加起来的和不能超过基数！实际中奖率根据奖品的中奖率参数/参数设置中的基数</p> 
            <p><a href="{{ URL::route('gifts.rate') }}">点击这里</a>查看中奖率预测</p> 
        </div>
    </div>
</div> 
<div class="row" style="margin-top: 1em;"> 
    <div class="col-lg-12">  
        @if(count($gifts)!=0) 
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr> 
                    <th>编号  </th>
                    <th>名称  </th>
                    <th>等级  </th> 
                    <th>中奖率  </th> 
                    <th>操作 </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gifts as $gift)
                <tr> 
                    <td>
                        {{ $gift->id }}
                    </td> 
                    <td>   
                        {{ $gift->name }}
                    </td>
                    <td>   
                        {{ $gift->grade }}
                    </td> 
                    <td>   
                        {{ $gift->rate }}
                    </td> 
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">操作<span class="caret"></span></button>
                            <ul class="dropdown-menu">  
                                <li> <a  class="btn btn-link btn-mini" href="{{ URL::route('gifts.edit', $gift->id) }}">编辑</a></li> 
                                <li>{{ Form::open(array('route' => array('gifts.destroy', $gift->id), 'method' => 'delete', 'data-confirm' => '不建议删除,是否继续?')) }}
                                    <button type="submit" class="btn btn-link btn-mini">删除</button>
                                    {{ Form::close() }}</li> 
                            </ul>
                        </div> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>  
        {{$gifts->links()}}
        @endif
    </div>  

</div><!-- /.row -->

<div class="row"> 
    <div class="col-lg-2">
        <a class="btn btn-block btn-social btn-bitbucket" href="{{URL::route('gifts.create')}}">
            <i class="fa fa-plus"></i> 新建奖品
        </a> 
    </div> 
</div><!-- /.row -->
@stop

@section('scripts')
<!-- Page Specific Plugins -->
<script src="{{asset('plugins/tablesorter/jquery.tablesorter.js')}}"></script>
<script src="{{asset('plugins/tablesorter/tables.js')}}"></script>
<script>
</script>
@stop