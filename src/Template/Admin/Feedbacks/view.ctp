<h3>Feedback</h3>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">
        Email <span class="symbol required"></span>
      </label>
      <?php echo $feedback['email']; ?>
    </div>
    <div class="form-group">
      <label class="control-label">
        Name <span class="symbol required"></span>
      </label>
      <?php echo $feedback['name']; ?>
    </div>
    <div class="form-group">
      <label class="control-label">
        Feedback <span class="symbol required"></span>
      </label>
      <?php echo $feedback['feedback']; ?>
    </div>
    <div class="form-group">
      <label class="control-label">
        Browser <span class="symbol required"></span>
      </label>
      <?php echo $feedback['browser']; ?>
    </div>
    <div class="form-group">
      <label class="control-label">
        URI <span class="symbol required"></span>
      </label>
      <?php echo $feedback['uri']; ?>
    </div>
    <div class="form-group">
      <label class="control-label">
        IP <span class="symbol required"></span>
      </label>
      <?php echo $feedback['ip']; ?>
    </div>
    <div class="form-group">
      <label class="control-label">
        Referrer <span class="symbol required"></span>
      </label>
      <?php echo $feedback['referrer']; ?>
    </div>
  </div>
  <div class="col-md-12">
    <?php echo $this->Form->button('Close', ['class' => 'btn btn-primary btn-o margin-right-20 pull-right', 'data-dismiss' => 'modal', 'type' => 'button']); ?>
  </div>
</div>
<?php echo $this->Form->end(); ?>
