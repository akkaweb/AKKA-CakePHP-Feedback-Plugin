<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle">Feedbacks</h1>
        </div>
    </div>
</section>
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" id="sample-table-2">
                <thead>
                    <tr>
                        <th class="">Email</th>
                        <th class="">Name</th>
                        <th class="">Feedback</th>
                        <th class="">IP</th>
                        <th class="hidden-xs">Created</th>
                        <th class="center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feedback): ?>
                        <tr class="<?php echo (!$feedback->viewed) ? 'info' : ''; ?>">
                            <td class=""><?php echo $feedback->email; ?></td>
                            <td class=""><?php echo $feedback->name; ?></td>
                            <td class=""><?php echo $feedback->feedback; ?></td>
                            <td class=""><?php echo $feedback->ip; ?></td>
                            <td class="hidden-xs"><?php echo $feedback->created; ?></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="/admin/feedbacks/view/<?php echo $feedback->id; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="View" data-toggle="modal" data-target=".bs-view-feedback" data-feedback="<?php echo $feedback->id; ?>"><i class="fa fa-eye"></i></a>
                                    <?php
                                    echo $this->Form->postLink(
                                        '<i class="fa fa-trash-o"></i>', ['action' => 'delete', $feedback->id], ['confirm' => 'Are you sure you want to delete this Feedback?', 'class' => 'btn btn-transparent btn-xs tooltips', 'escape' => false]);
                                    ?>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group" dropdown="">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" dropdown-toggle="">
                                            <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right dropdown-light" role="menu">
                                            <li>
                                                <a href="#" data-toggle="modal" data-target=".bs-example-modal-right">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Share
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
