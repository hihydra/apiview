@extends('green.layouts')
@section('title'){{$typeCh}}-@stop
@section('content')
@include('green.sidebar')
<div class="three_l zixun_left">
  <div class="three_tit clearfix">
    <h3 class="title_name">{{$typeCh}}</h3>
  </div>
  <div class="three_con clearfix">
    <div class="mailbox">
      <div class="mailbox-from">
      <form method="post" class="saveMaibox">
        <div class="title item">
            <input type="title" name="title" placeholder="请输入标题..." required="required">
        </div>
        <div class="content item">
            <textarea type="content" name="content" placeholder="请输入内容..." required="required"></textarea>
        </div>
        <div class="tel item">
          <input type="tel" name="mobile" placeholder="请输入手机号..." required="required">
          <input class="Btn" type="button" value="发布" onclick="javascript:saveMaibox();">
        </div>
      </form>
      </div>
    </div>
    @if(!empty($datas))
    <div class="profile-1 clearfix">
     <ul>
       @foreach ($datas as $list)
       <li>
         <span>{{$list['ftStr']}}</span>
         <a>{{$list['title']}}</a>
         <p>{{$list['content']}}</p>
         <span>{{$list['isProcessed']?'已处理':'未处理'}}</span>
       </li>
       @endforeach
     </ul>
     <div class="clear"></div>
   </div>

   <div class="turnPage">
     @include('vendor.pagination')
   </div>
   @else
   暂时没有{{$typeCh}}哟
   @endif
 </div>
 </div>
 @stop
 @section('script')
 <script type="text/javascript">
   function saveMaibox(){
      var title = $('input[name^="title"]').val();
      if(title.length<4){
          alert("标题必须大于4个字符！");
          return ;
      }
      var content = $('textarea[name^="content"]').val();
      if(content.length<6){
          alert("内容必须大于6个字符！");
          return ;
      }
      var tel = $('input[name^="mobile"]').val();
      var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
      if (!reg.test(tel)) {
         alert("手机号码错误！");
      }else{
         $('.saveMaibox').attr('action',ctx+'/saveMaibox');
         $(".saveMaibox").submit();
      }
   }
 </script>
 @stop