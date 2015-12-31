<?php echo $this->Html->image('AkkaFeedback.feedback.png', ['id' => 'akka-feedback-toggle']); ?>
<div id="akka-feedback">
  <a href="#" class="close-feedback pull-right"><i class="fa fa-times"></i> Close</a>
  <h4 class="clearfix">Feedback Form</h4>
  <p>Your feedback helps us understand what we are doing well and where we can improve.</p>
  <?php echo $this->Form->create(null, ['id' => 'akka-feedback-form', 'class' => 'text-left', 'role' => 'form', 'url' => ['plugin' => 'AkkaFeedback', 'controller' => 'Feedbacks', 'action' => 'add']]); ?>
  <div class="alert alert-success"></div>
  <div class="alert alert-error"></div>
  <div class="loading"><?php echo $this->Html->image('AkkaFeedback.loading.gif'); ?></div>
  <fieldset>
    <div class="form-group">
      <label>Name</label>
      <?php echo $this->Form->input('name', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your Full Name']); ?>
    </div>
    <div class="form-group">
      <label>Email</label>
      <?php echo $this->Form->input('email', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your Email']); ?>
    </div>
    <div class="form-group">
      <label>Feedback</label>
      <?php echo $this->Form->textarea('feedback', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Your detailed Feedback', 'id' => 'feedback']); ?>
    </div>
    <?php echo $this->Form->button(__('Submit Feedback'), ['class' => 'btn btn-primary btn-lg']); ?>
  </fieldset>
  <?php echo $this->Form->end(); ?>
</div>
