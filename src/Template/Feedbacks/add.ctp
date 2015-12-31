<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Feedbacks'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="feedbacks form large-9 medium-8 columns content">
    <?= $this->Form->create($feedback) ?>
    <fieldset>
        <legend><?= __('Add Feedback') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('name');
            echo $this->Form->input('feedback');
            echo $this->Form->input('browser');
            echo $this->Form->input('uri');
            echo $this->Form->input('ip');
            echo $this->Form->input('referrer');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
