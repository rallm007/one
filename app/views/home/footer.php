
    <div class='container m-b-20' id='footer'>
        <div class='row service'>
            <div class='col-md-6 item'>
                <div class='row'>
                    <div class='col-md-3 p-l-30'>
                        <div class='m-b-10 f-14'><strong>购物指南</strong></div>
                        <div class='m-b-8'><a>购物流程</a></div>
                        <div class='m-b-8'><a>会员介绍</a></div>
                        <div class='m-b-8'><a>团购/机票</a></div>
                        <div class='m-b-8'><a>常见问题</a></div>
                        <div class='m-b-8'><a>联系客服</a></div>
                    </div>
                    <div class='col-md-3 p-l-30'>
                        <div class='m-b-10 f-14'><strong>配送方式</strong></div>
                        <div class='m-b-8'><a>上门自提</a></div>
                        <div class='m-b-8'><a>211限时达</a></div>
                        <div class='m-b-8'><a>配送服务查询</a></div>
                        <div class='m-b-8'><a>配送费收取标准</a></div>
                        <div class='m-b-8'><a>海外配送</a></div>
                    </div>
                    <div class='col-md-3 p-l-30'>
                        <div class='m-b-10 f-14'><strong>支付方式</strong></div>
                        <div class='m-b-8'><a>货到付款</a></div>
                        <div class='m-b-8'><a>在线支付</a></div>
                        <div class='m-b-8'><a>分期付款</a></div>
                        <div class='m-b-8'><a>邮局汇款</a></div>
                        <div class='m-b-8'><a>公司转账</a></div>
                    </div>
                    <div class='col-md-3 p-l-30'>
                        <div class='m-b-10 f-14'><strong>售后服务</strong></div>
                        <div class='m-b-8'><a>售后政策</a></div>
                        <div class='m-b-8'><a>价格保护</a></div>
                        <div class='m-b-8'><a>退款说明</a></div>
                        <div class='m-b-8'><a>返修/退换货</a></div>
                        <div class='m-b-8'><a>取消订单</a></div>
                    </div>
                </div>
            </div>
            <div class='col-md-3 item'>
                <div class='row'>
                    <div class='col-md-6 p-l-25'>
                        <div class='m-b-15 f-14'><strong>壹心微购</strong></div>
                        <div>
                            <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/2.png'>
                        </div>
                    </div>
                    <div class='col-md-6 p-l-10'>
                        <div class='m-b-15'><strong class=' f-14'>微信账号:</strong><span class='c-6'>壹心易购</span></div>
                        <div>
                            <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/2.png'>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-3 text-center'>
                <div class='row p-l-30 m-b-15 text-right'>
                    <div class='guanzhubtn btn'><span class='icon pull-left'></span><span>关注壹心易购</span></div>
                </div>
                <div class='row p-l-30 m-b-15'>
                    <span class='kefu'>壹心客服: </span><span class='kefu-num'>4009 170 170</span>
                </div>
                <div class='row p-l-30 '>
                    <form class="form-inline" role="form">
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="输入邮箱订阅促销信息">
                      </div>
                      <button type="submit" class="btn dingyue">订阅</button>
                    </form>
                </div>
            </div>
        </div>

        <div class='row  text-center m-b-30'>
            <div class='about m-b-10'>
                <a>关于我们</a>
                |
                <a>联系我们</a>
                |
                <a>人才招聘</a>
                |
                <a>商家入驻</a>
                |
                <a>广告服务</a>
                |
                <a>手机易购</a>
                |
                <a>友情链接</a>
                |
                <a>销售联盟</a>
                |
                <a>易购社区</a>
            </div>
            <div class='cr'>
                网络文化经营许可证京网文[2014]0178-061号 Copyright © 2013-2014 易购170ES.com 版权所有
            </div>
        </div>

        <div class='row text-center fb'>
            <!-- 只显示最新的五条友情链接 start-->
            <?php if(isset($link) && !empty($link)): ?>
            <?foreach($link as $key => $item):?>
                <a target="_blank" href="<?php echo $item->url;?>"><img class='img-responsive' style="height:40px;width:108px;" src='<?php echo $this->link->pic($item->id)?>'></a>
            <?endforeach;?>
            <?endif;?>  
            <!-- 友情链接 end-->
        </div>
    </div>
    <!-- modal -->
    <div aria-hidden="true" aria-labelledby="_confirm_dialogLabel" role="dialog" tabindex="-1" class="modal fade" id="_confirm_dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id='_confirm_btn'>确定</button>
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <!-- 登录表单 -->
    <div id='_login_form' class='modal hide' role="dialog" tabindex="-1" aria-hidden="false" style='display:none;z-index:2015'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title">登录</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'login/verify'?>" id='_relogin_form'>
                        <div class="form-group" >
                            <label class="control-label col-md-3">用户名 :</label>
                            <div class="col-md-7">
                                <input type="text" id="username" name='username' value=""  maxlength='30' class="form-control" >
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-md-3">密码 :</label>
                            <div class="col-md-7">
                              <input type="password" id="password" name='password' value="" maxlength='20' class="form-control" > 
                            </div>
                        </div>
                        <div class="form-group hide" >
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="red col-md-8" id='error_message'></div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="col-md-7">
                                <strong>使用合作网站账号登录170ES：</strong> 
                            </div>
                            <div class="col-md-7">
                                <a href='<?php echo base_url()?>login/byqq'><span><strong>QQ</strong></span></a>
                                <span>|</span><span>
                                <a href='<?php echo base_url()?>login/byweixin'><strong>微信</strong></span></a>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="col-md-8">
                                如果您还不是会员，请先<a href="<?php echo base_url().'register';?>" target='_blank'>注册</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id='relogin_form_submit_btn' onclick="login();">登录</button> &nbsp;
                    <button class="btn btn-default" data-dismiss="modal"  onclick="hide_login_form();">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?3c45204976a73daa4b62ba95a56f1081";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>

</body>
<!-- END BODY -->
</html>