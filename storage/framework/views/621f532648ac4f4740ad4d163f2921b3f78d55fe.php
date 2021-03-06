<?php $__env->startSection('content'); ?>
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-track" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteTrack"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="<?php echo e(\Illuminate\Support\Facades\Auth::user()['original']['employe']); ?>" data-date="<?= isset($date)? $date : '' ?>"
		data-start = "<?=  isset($active['start']) ? $active['start'] : '' ?>" data-end = "<?=  isset($active['end']) ? $active['end'] : '' ?>">
		<div class="row margin-top-twenty">
			<div class="col-md-12 row">
			   <div class="col-md-4 col-lg-4 toolbar-span ">
				<div class="daterange daterange--double taskarchive picker-width" ></div>
			   </div>
			   <div class="col-md-8 col-lg-8 padding-twenty">
				  <span class="pull-right font-thirty heading-color">Tasks Archive</span>
			   </div>
			</div>
        </div>
		<div class="row-fluid">
		    <div id="track-button-group" class="btn-group track-button-group row col-md-12 margin-bottom-ten">
				<button class="btn btn-sm startdate-calender  margin-ten calender-color" >
					<span>Start Date</span><span class="glyphicon glyphicon-th padding-left-ten"></span>
					<div><input type="text" name="start-date" id="start-date" readonly class="check-box-center"  value=""></div>
				</button>
				<button class="btn btn-sm finishtdate-calender  margin-ten  calender-color" >
					<span>Finish Date</span><span class="glyphicon glyphicon-th padding-left-ten "></span>
					<div><input type="text" name="finish-date" id="finish-date" readonly class="check-box-center"  value=""></div>
				</button>
				<input id="date-archive" class="date-archive" type="hidden" placeholder="Select Dates"/>
				<div class="button-group-width margin-top-ten">
					<button id="search-result" class="btn btn-info search-result no-curve">Search</button> 
					<button id="close-result" class="btn btn-default close-result">Clear</button> 
				</div>
            </div>
		</div>
           
        <div class="row-fluid">
            <!-- block -->
            <div class="block bottom-border no-left-border no-right-border">
                <div class="block-content collapse in">
                    <div class="span12">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="usersTable">
                            <thead>
                              <tr>
                                <th>Project</th>
                                <th>Task</th>
								<th>Assign To</th>
                                <th>Allocated Hours</th>
								<th>Total Time</th>
                                <th>Billable</th>
								<th>Cost</th>
                                <th>Start Date</th>
								<th>Finish Date</th> 
                                <?php if($status == 'Admin' || $status == 'Lead' || $status == 'Supervisor' || $status == 'Developer' ||  $status == 'QA Engineer'): ?>
                                    <th  class="center action-header">Action</th>
                                <?php endif; ?>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th class="thFoot">Project</th>
                                <th class="thFoot">Task</th>
								<th class="thFoot">Assign To</th>
                                <th class="thFoot">Allocated Hours</th>
								<th class="thFoot">Total_time</th>
                                <th class="thFoot">Billable</th>
								<th class="thFoot">Cost</th>
                                <th class="thFoot create-date removeSelect">Start Date</th>
								<th class="thFoot end-date removeSelect">Finish Date</th>
                                <?php if($status == 'Admin' || $status == 'Lead' || $status == 'Supervisor' || $status == 'Developer' ||  $status == 'QA Engineer'): ?>
                                    <th class="removeSelect">Action</th>
                                <?php endif; ?>
                              </tr>
                            </tfoot>
                            <tbody class="track-body">
							<?php  date_default_timezone_set("Asia/Kolkata"); ?>
							<?php
                                  function convertToLocal($second) {
                                     $difference = bcmod($second, 3600);
                                     $hours = (int)($second/3600);
                                     $minutes = (int)($difference/60);
                                     $seconds = bcmod($difference, 60);
                                     if (strlen($hours) < 2){
                                         $hours = '0' . $hours;
                                     }
                                     if (strlen($minutes) < 2){
                                         $minutes = '0' . $minutes;
                                     }
                                     if (strlen($seconds) < 2){
                                         $seconds = '0' . $seconds;
                                     }
                                     return $hours . ':' . $minutes. ':'. $seconds;
                                 }
							?>
                            <?php if(isset($tasks)): ?>
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr class="odd gradeX hover-tr" data-toggle="tooltip" title="">
                                        <td><?php echo e($key->project->project_name); ?></td>
                                        <td class="hover-td" title="Description  : <?php echo e($key->task->task_description ? $key->task->task_description : 'No Description'); ?>" ><span class="task-title"><?php echo e($key->task->task_titly); ?></span>
										</td>
										<td><?php echo e($key->name); ?></td>
                                        <td><?php echo e($key->task->alloceted_hours); ?></td>
										<td><?php echo e($key->total_time ==null ? '-' : convertToLocal($key->total_time)); ?></td>
                                        <td class="check-box-center"> <?= ( $key->task->billable == '1') ? 'Yes' : 'No' ?> </td>
										<!-- SN 06/29/2017: update below code for project cost -->
										<td>
											<?php if($key->billable_time == 1): ?>
												<?php if(isset($key->value)): ?>
													<?php echo e($key->value); ?>

												<?php else: ?>
													-
												<?php endif; ?>
											<?php else: ?>
												0.00
											<?php endif; ?>
										</td>
                                        <td class="check-box-center"><?= date("Y-m-d H:i:s", strtotime($key->created_at." UTC")); ?></td>
										<td><?= date("Y-m-d H:i:s", strtotime($key->finish_track." UTC")); ?>
										
										<?php if($status == 'Developer' || $status == 'QA Engineer'): ?>
											<div class="popup-field tooltip-block popup-height scroll">
												<span>Description  : <?php echo e($key->task->task_description ? $key->task->task_description : 'No Description'); ?></span>
											</div>
                                        <?php endif; ?>
										</td>
                                        <?php if($status == 'Admin' || $status == 'Lead' || $status == 'Supervisor'): ?>
                                            <td>
												<a href="/track/update/<?= $key->id ?>" class="btn btn-info editArchivetask" id="editArchivetask">
												   <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
												</a>
												<button type="button" class="btn btn-danger deleteTrack" data-id="<?php echo e($key->id); ?>" data-url="/track/delete/<?php echo e($key->id); ?>" data-element="<?php echo e($key->task->task_titly); ?>">
													<span class="glyphicon glyphicon-floppy-remove span_no_event" aria-hidden="true"></span> Delete
												</button>
												
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                          </tbody>
                       </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>
    </div>
	<?=  (date_default_timezone_set("UTC")) ? '' : '' ?> 

<script type="text/javascript" src="/js/datefilter.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>