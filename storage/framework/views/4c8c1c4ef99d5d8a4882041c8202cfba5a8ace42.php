<?php $__env->startSection('content'); ?>
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-client" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteClient"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="<?php echo e(\Illuminate\Support\Facades\Auth::user()['original']['employe']); ?>">

        <div class="row-fluid">
            <div class="span12">
                <h3 class="h3-my">Clients</h3>
                <a href="/client/create" class="btn btn-large button-orange  margin-left-large">
                    <i class="glyphicon glyphicon-plus"></i> Add Client</a>
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
                                <th class="client-header">Company Name</th>
                                <th class="thHead">Address</th>
                                <th class="thHead">Website</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                              
                                <?php if($status == 'HR Manager' || $status == 'Admin' || $status == 'Super Admin'): ?>
                                    <th class="center action-header">Action</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="thFoot" >Company Name</th>
                                <th class="thFoot thHead">Address</th>
                                <th class="thFoot thHead thFootSite">Website</th>
                                <th class="thFoot">Contact Person</th>
                                <th class="thFoot">Email</th>
                                <th class="thFoot">Phone Number</th>
                                <!--  <th style="min-width: 160px"  class="center">Created at</th> -->
                               <?php if($status == 'HR Manager' || $status == 'Admin' || $status == 'Super Admin'): ?>
                                    <th class="removeSelect" >Action</th>
                                <?php endif; ?>
                            </tr>
                            </tfoot>
                            <tbody>


                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr class="odd gradeX getProjects" data-id="<?php echo e($client->id); ?>">
                                    <td><?php echo e($client->company_name); ?></td>
                                    <td class="thHead"><?php echo e($client->company_address); ?></td>
                                    <td class="webClick website-color" >
                                       <?php echo e($client->website); ?>

                                        </td>
                                    <td><?php echo e($client->contact_person); ?></td>
                                    <td><?php echo e($client->email); ?></td>
                                    <td><?php echo e($client->phone_number); ?></td>
                                  <!--  <td style="text-align: center"><?php echo e($client->created_at); ?></td> -->

                                    <?php if($status == 'HR Manager' || $status == 'Admin' || $status == 'Super Admin'): ?>
                                        <td>
                                            <?php if($status == 'Admin' || $status == 'Super Admin' ||
                                             ($status == 'HR Manager')): ?>

                                                <a href="/client/update/<?php echo e($client->id); ?>"  class="btn btn-info"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                                <button type="button" class="btn btn-danger  deleteClient" data-url="/client/delete/<?php echo e($client->id); ?>" data-element="<?php echo e($client->company_name); ?>">
                                                    <span class="glyphicon glyphicon-floppy-remove span_no_event" aria-hidden="true"></span> Delete</button>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>