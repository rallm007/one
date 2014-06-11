
							<table class="table table-striped table-bordered table-hover" id="ship_list">
								<thead>
									<tr>
										<th width='*'>名称</th>
										<th width='*'>计费方式</th>
										<th width='10%'>操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->billing?></td>
										<td>
											<a href="<?php echo base_url();?>admin/ship_type/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/ship_type/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>