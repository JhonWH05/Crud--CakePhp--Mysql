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
            <?= $this->Html->link(__('Edit Domain'), ['action' => 'edit', $domain->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Domain'), ['action' => 'delete', $domain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Domains'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Domain'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains view content">
            <h3><?= h($domain->domain) ?></h3>
            <table>
                <tr>
                    <th><?= __('Domain') ?></th>
                    <td><?= h($domain->domain) ?></td>
                </tr>
                <tr>
                    <th><?= __('Path Favicon') ?></th>
                    <td><?= h($domain->path_favicon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($domain->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Checked') ?></th>
                    <td><?= $this->Number->format($domain->checked) ?></td>
                </tr>
                <tr>
                    <th><?= __('Has Favicon') ?></th>
                    <td><?= $this->Number->format($domain->has_favicon) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
