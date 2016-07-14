@extends('layout.default')
@section('title')
@if (isset($conf))
编辑参数
@else
新建参数
@endif   
@stop

@section('content')

<div class="row "> 
    @if (isset($conf))
    {{ Form::model($conf, ['route' => ['confs.update', $conf->id], 'method' => 'patch']) }}
    @else
    {{ Form::open(['route' => 'confs.store', 'method' => 'post', 'files' => true]) }}
    @endif  

    <div class="col-lg-12">    
        <div class="box">
            <div class="box-header"> 
                <h3 class="box-title">编辑内容</h3> 
            </div><!-- /.box-header -->
            <div class="box-body pad">   
                <div class="box-body">
                    <div class="form-group">
                        <label for="param">名称</label> 
                        {{ Form::text('param',null,array('class' => 'form-control','placeholder'=>'请输入名称' )) }}
                    </div>
                </div> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="val">参数1</label> 
                        {{ Form::text('val',null,array('class' => 'form-control','placeholder'=>'请输入' )) }}
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="val2">参数2</label> 
                        {{ Form::text('val2',null,array('class' => 'form-control','placeholder'=>'请输入' )) }}
                    </div>
                </div> 
            </div>
            <div class="box-footer">
                {{ Form::submit('确定', array('class' => 'btn btn-lg btn-primary btn-block')) }} 
            </div>
        </div>
        <!-- general form elements --> 
        {{Form::close()}} 
    </div>
</div>
@stop
@section('scripts') 
<script type="text/javascript">
    $(function() {
//bootstrap WYSIHTML5 - text editor
// $(".textarea").wysihtml5(); 
</script>
@stop