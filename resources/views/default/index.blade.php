@extends('default.layouts')
@section('content')
<div class="content">
     <div class="content-table">
        <div class="xy_space" style=" padding-top:30px;">
          <div id="div_schoolPhoto"  class="xy_cgzs fl mgt8" style="padding-right:20px;">
            <ul id="div_schoolPhoto_photo">
             @foreach ($loadSchoolPictures['datas'] as $loadSchoolPicture)
              <li id="schoolPhoto_0">
                <a target="_blank" href="/open/school/22/index/photo">
                  <img src="http://111.47.13.92:16800/open/school/0/photo/index_school_picture/{{$loadSchoolPicture['hash']}}/{{$loadSchoolPicture['id']}}.jpg">
                  <p style="overflow: hidden; ">{{$loadSchoolPicture['name']}}</p>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="fl" style="width:530px; padding-right:0; position:relative;"><!--2016-5-20-->
                    <div class="more-right-1" style="top:20px;">
                      <a id="a_schoolInfo" href="/open/school/22/index">更多</a>
                    </div>
                    <div class="Switch">
                      <ul>
                            <li id="li_schoolIntro" class="hover">
                              <a href="javascript:doLoadSchoolIntro();">园所简介</a></li>
                            <li id="li_schoolEnrollment" class="no">
                              <a href="javascript:doLoadSchoolEnrollment();">招生信息</a></li>
                        </ul>
            		</div>
            <div class="clear"></div>
                    <ul id="div_topSchoolInfo" class="xy_newslist-1" style="height:270px;">

                    </ul>
                </div>
                <div class="clear"></div>
          </div>
            <div class="xy_space">
              <div class="xy_cgzs fl mgt8"  style="margin-right:20px;">
                  <div class="more-right-1"><a href="/open/school/22/news">更多</a></div>
                    <h3><img src="/assets/default/img/tittle1.png" /></h3><!-- 活动动态 -->
                    <div id="div_topNews">
                      <div id="schoolNews" style="overflow: hidden; width: 510px; height: 350px">
                        <ul id="ul_news" class="xy_newslist-1" style="width: 490px; height: 1296px;">
                        @foreach ($loadRecentlyNews['datas'] as $loadRecentlyNew)
                          <li>
                          <a target="_blank" href="/open/school/22/news?initId=17">
                          <strong style="font-size: 18px;">{{$loadRecentlyNew['title']}}</strong>
                          </a>
                          </li><!--2016-5-20-->
                          <p>{{$loadRecentlyNew['reduced']}}</p>
                          <div class="clear" style="height: 25px;"></div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                 <div class="clear"></div>
          </div>

          <div class="xy_cgzs fl mgt8" style="width:452px;">
              <div class="more-right-1"><a href="/open/apply/22/teacher">更多</a></div>
                    <h3><img src="/assets/default/img/tittle2.png" /></h3><!-- 教育资源 -->
                    <div id="div_topTeacher" class="xy_newslist-1" style="width:435px;overflow: hidden;height:335px"">
                      <ul id="ul_teacher" class="min-img">
                        @foreach ($loadTeacherPhotos['datas'] as $loadTeacherPhoto)
                          <li id="topteacher_0" style="display: list-item;">
                            <a target="_blank" href="/open/apply/22/teacher">
                              <img src="http://111.47.13.92:16800/open/school/0/{{$loadTeacherPhoto['id']}}/photo/source/{{$loadTeacherPhoto['photo']['large']}}/{{$loadTeacherPhoto['photo']['large']}}.jpg">
                              <p>{{$loadTeacherPhoto['name']}}</p>
                             </a>
                           </li>
                        @endforeach
                       </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
      <div class="w960 xy_space clearfix" style=" padding:20px 0 55px; position:relative;"><!--2016-1-25-->
        <div class="more-right-1"><a href="/open/apply/22/kindsPhoto">更多</a></div>
        <h2><img src="/assets/default/img/tittle4.png" /></h2>

        <div class="clear"></div>
            <div id="div_topKinds">
                <div id="photoKinds" style="overflow: hidden; width: 990px; height: 130px">
                    <ul class="xy_pic_box" style="width: 2720px;">
                     @foreach ($loadKindsPhotos['datas'] as $loadKindsPhoto)
                        <li>
                            <a target="_blank" href="/open/apply/22/kindsPhoto">
                                <img src="http://111.47.13.92:16800/open/school/0/photo/index_school_picture/{{$loadKindsPhoto['hash']}}/{{$loadKindsPhoto['id']}}.jpg">
                            </a>
                            <p>{{$loadKindsPhoto['name']}}</p>
                        </li>
                       @endforeach
                    </ul>
                </div>
            </div>
        <div class="clear"></div>
      </div>
    </div>
</div>
@stop

@section('script')
@stop