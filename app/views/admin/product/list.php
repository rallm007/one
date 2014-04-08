<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						所有商品
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<a href='<?php echo base_url();?>admin/products/edit'>
							<button id="sample_editable_1_new" class="btn green">
								<i class="fa fa-plus"></i> 新增商品 
							</button>
							</a>
						</li>
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li><a href="#">所有商品</a></li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-list"></i>所有商品</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn default" href="#" data-toggle="dropdown">
									显示字段
									<i class="fa fa-angle-down"></i>
									</a>
									<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" checked data-column="0">编码</label>
										<label><input type="checkbox" checked data-column="1">名称</label>
										<label><input type="checkbox" checked data-column="2">价格</label>
										<label><input type="checkbox" checked data-column="3">优惠价</label>
									</div>
								</div>
							</div>
							<div class="tools">
								<a class="reload m-r-5" href="javascript:void();" onclick="Product.reload()"></a>
							</div> &nbsp; 
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							</div>
							<?$list = $this->product->all();?>
							<table class="table table-striped table-bordered table-hover" id="product_list">
								<thead>
									<tr>
										<th>编码</th>
										<th>名称</th>
										<th>价格</th>
										<th class="hidden-xs">优惠价</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->code?></td>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->price?></td>
                                		<td><?php echo $item->best_price?></td>
										<td>
											<a href="<?php echo base_url();?>admin/products/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="confirm_dialog('删除确认','确认删除该商品吗？','delete_product','<?php echo $item->id?>')">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>

	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url();?>assets/scripts/product.js"></script>    
	<script>

	</script>
<?$this->load->view('admin/footer');?>