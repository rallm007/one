ALTER TABLE one_order add column last_price float(10,2) not null default 0 comment'修改后价格' after price; 
ALTER TABLE one_order add column ship_time int(10) not null default 0 comment '发货时间',add column get_time int(10) not null default 0 comment '收货时间'; 