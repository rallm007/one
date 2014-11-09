<?php

function preg_mobile($test){  
        /* 
            匹配手机号码 
            规则： 
                手机号码基本格式： 
                前面三位为： 
                移动：134-139 147 150-152 157-159 182 187 188 
                联通：130-132 155-156 185 186 
                电信：133 153 180 189 
                后面八位为： 
                0-9位的数字 
        */  
          
        $rule  = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9])|170)[0-9]{8}$/A";  
        preg_match($rule,$test,$result);  
        return $result;  
} 