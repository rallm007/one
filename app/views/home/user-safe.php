<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
    <div class='container m-t-20'>
        <div class='row' id="user-safe">
            <!-- left -->
            <?$this->load->view('home/my')?>
            <!-- left end -->
            <!-- right -->
            <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
                 <ul class="nav nav-tabs">
                <li class="">
                    <h4>安全中心</h4>
                </li>

            </ul>
                <div id="main">
                    <div class="tab-content">
                        <!-- 账户安全 -->
                        <div id="tab_1-2" class="tab-pane active">
                            <?php $level=0;
                                if($user->pwd!=''){$level+=2;}
                                if($user->validate_phone=='1') {$level+=2;}
                                if($user->validate_email=='1') {$level+=1;}
                                if($user->pay_pwd!='') {$level+=1;}
                                switch ($level) {
                                    case '5':
                                        $lc = "高级";
                                        break;
                                    case '4':
                                        $lc = "中高级";
                                        break;
                                    case '3':
                                        $lc = "中级";
                                        break;
                                    case '2':
                                    case '1':
                                    default:
                                        $lc = "低级";
                                        break;
                                }
                            ?>
                            <div id="safe05" class="m-b-10 m5">
                                <div class="mc" style="border-width:0px;">
                                    <strong class="m-l-25">安全级别：</strong>
                                    <i class="icon-rank icon-rank0<?php echo $level?>"></i>
                                    <strong class="rank-text ftx-04"><?php echo $lc?></strong>
                                    <?php if($level<5):?>
                                    <div style="margin-left:95px;margin-top:15px;">
                                        <span style="color:#ff4400;">建议您启动全部安全设置，以保障账户及资金安全。</span>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <div class="mc">
                                <div class="fore1">
                                    <s class="<?php echo $user->validate_phone=='1'?'icon-01':'icon-02'?>"></s><strong>手机验证</strong>
                                </div>
                                    <div class="fore2">
                                        验证后，账户余额或优选卡资金变动时，会短信提醒您。
                                    </div>
                                    <div class="fore3">
                                        <a href="<?php echo base_url()?>validate/phone">
                                            <?php if($user->validate_phone==1):?>修改<?php else:?>开始验证<?php endif;?>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="mc">
                                    <div class="fore1">
                                        <s class="<?php echo $user->validate_email==1?'icon-01':'icon-02'?>"></s><strong>邮箱验证</strong></div>
                                        <div class="fore2"><span class="ftx-03">验证后，可用于快速找回登录密码，安全性更高。</span></div>
                                        <div class="fore3">
                                            <a class="btn btn-7" href="<?php echo base_url()?>validate/validate_email" >
                                            <?php if($user->validate_email==1):?>
                                            修改
                                            <?php else:?>
                                            立即验证
                                            <?php endif;?>
                                            </a>
                                            
                                        </div>           
                                </div>
                              
                        
                                <div style="" id="usedFlagCloseDiv" class="mc">
                                    <div class="fore1">
                                        <s class="<?php echo $user->pay_pwd!=''?'icon-01':'icon-02'?>"></s><strong>支付密码</strong>
                                    </div>
                                    <div class="fore2">
                                        <span class="ftx-03">设置后，在使用账户余额或优选卡支付时，需输入支付密码验证用户身份。</span>
                                    </div>
                                    <div class="fore3">
                                        <a class="btn btn-7" href="<?php echo base_url()?>home/users/paypwd"><?php echo $user->pay_pwd!=''?'修改':'立即启用'?></a>
                                    </div>
                                </div>
                                <div class="mc">
                                    <div class="fore1"><s class="icon-01"></s><strong>登录密码</strong></div>
                                    <div class="fore2"><span class="ftx-03"></span><span style="s">互联网账号存在被盗风险，建议您定期更改密码以保护账户安全。</span></div>
                                    <div class="fore3"><a href="<?php echo base_url()?>home/users/password">修改</a></div>
                                </div>
                            
                            </div>
                        </div>
                        <!-- 账户安全结束 -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>