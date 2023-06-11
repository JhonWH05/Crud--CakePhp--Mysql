<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $domain
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $domain->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Domains'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains form content">
            <?= $this->Form->create($domain) ?>
            <fieldset>
                <legend><?= __('Edit Domain') ?></legend>
                <?php
                    echo $this->Form->control('domain');
                    echo $this->Form->control('checked');
                    echo $this->Form->control('has_favicon');
                    echo $this->Form->control('path_favicon');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
