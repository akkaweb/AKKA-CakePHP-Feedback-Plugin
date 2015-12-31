<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Feedback'), ['action' => 'edit', $feedback->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Feedback'), ['action' => 'delete', $feedback->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feedback->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Feedbacks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feedback'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feedbacks view large-9 medium-8 columns content">
    <h3><?= h($feedback->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($feedback->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($feedback->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Browser') ?></th>
            <td><?= h($feedback->browser) ?></td>
        </tr>
        <tr>
            <th><?= __('Uri') ?></th>
            <td><?= h($feedback->uri) ?></td>
        </tr>
        <tr>
            <th><?= __('Ip') ?></th>
            <td><?= h($feedback->ip) ?></td>
        </tr>
        <tr>
            <th><?= __('Referrer') ?></th>
            <td><?= h($feedback->referrer) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($feedback->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($feedback->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($feedback->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Feedback') ?></h4>
        <?= $this->Text->autoParagraph(h($feedback->feedback)); ?>
    </div>
</div>
