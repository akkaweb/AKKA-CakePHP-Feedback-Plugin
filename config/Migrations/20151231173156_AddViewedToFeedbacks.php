<?php
use Migrations\AbstractMigration;

class AddViewedToFeedbacks extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('feedbacks');
        $table->addColumn('viewed', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
