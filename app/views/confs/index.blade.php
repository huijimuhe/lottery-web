@extends('layout.default')
@section('title')
参数设定列表
@stop

@section('content') 
<div class="row">
    <div class="col-lg-12"> 
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
            <p>请慎重修改,不要随意删除或添加新的参数</p> 
            <p>week指一周奖品总量 参数1是总计 参数2是动态剩余 每月第一天参数2自动修改为参数1的值</p> 
            <p>month指一月奖品总量 暂未使用</p> 
            <p>base_rate指中奖率基数</p> 
        </div>
    </div>
</div> 
<div class="row" style="margin-top: 1em;"> 
    <div class="col-lg-12">  
        @if(count($confs)!=0) 
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr> 
                    <th>编号  </th>
                    <th>名称  </th>
                    <th>参数1  </th> 
                    <th>参数2  </th> 
                    <th>操作 </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($confs as $conf)
                <tr> 
                    <td>
                        {{ $conf->id }}
                    </td> 
                    <td>   
                        {{ $conf->param }}
                    </td>
                    <td>   
                        {{ $conf->val }}
                    </td> 
                    <td>   
                        {{ $conf->val2 }}
                    </td> 
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">操作<span class="caret"></span></button>
                            <ul class="dropdown-menu">  
                                <li> <a  class="btn btn-link btn-mini" href="{{ URL::route('confs.edit', $conf->id) }}">编辑</a></li> 
                                <li>{{ Form::open(array('route' => array('confs.destroy', $conf->id), 'method' => 'delete', 'data-confirm' => '不建议删除,是否继续?')) }}
                                    <button type="submit" class="btn btn-link btn-mini">删除</button>
                                    {{ Form::close() }}</li> 
                            </ul>
                        </div> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>  
        {{$confs->links()}}
        @endif
    </div>  

</div><!-- /.row -->

<div class="row"> 
    <div class="col-lg-2">
        <a class="btn btn-block btn-social btn-bitbucket" href="{{URL::route('confs.create')}}">
            <i class="fa fa-plus"></i> 新建参数
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